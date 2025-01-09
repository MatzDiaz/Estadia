<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use App\Models\Ventas;
use App\Models\Detalle_venta;
use App\Models\Productos;
use App\Models\Categorias;
use App\Models\Entradas;
use App\Models\Salidas;
use App\Models\Carrito;
use App\Models\User;
use App\Models\notificaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class BackupRestoreController extends Controller
{
    /**
     * Mostrar los respaldos disponibles.
     */
    public function index()
    {
        // Listar archivos de respaldo en el disco configurado
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $backups = collect($disk->allFiles(config('backup.backup.name')))
            ->filter(fn($file) => str_ends_with($file, '.zip'))
            ->sortDesc();

        return view('backup_restore.index', compact('backups'));
    }

    /**
     * Generar un respaldo.
     */
    public function backupDatabase()
    {
        try {
            // Ejecutar el comando de respaldo
            Artisan::call('backup:run');

            return back()->with('success', 'Respaldo generado exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al generar el respaldo: ' . $e->getMessage());
        }
    }

    /**
     * Restaurar un respaldo.
     */
    public function restoreDatabase(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file|mimes:zip',
        ]);

        $filePath = $request->file('backup_file')->storeAs(
            config('backup.backup.name'),
            $request->file('backup_file')->getClientOriginalName(),
            config('backup.backup.destination.disks')[0]
        );

        // Proceso de restauración (personalizado según tu implementación)
        try {
            $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
            $backupPath = $disk->path($filePath);

            // Restaurar la base de datos desde el archivo
            $command = sprintf(
                'mysql -u%s -p%s -h%s %s < %s',
                escapeshellarg(env('DB_USERNAME')),
                escapeshellarg(env('DB_PASSWORD')),
                escapeshellarg(env('DB_HOST')),
                escapeshellarg(env('DB_DATABASE')),
                escapeshellarg($backupPath)
            );

            system($command, $output);

            if ($output === 0) {
                return back()->with('success', 'Base de datos restaurada exitosamente.');
            } else {
                throw new \Exception('El proceso de restauración falló.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error al restaurar la base de datos: ' . $e->getMessage());
        }
    }


    public function graficas(){
        $ventasPorMes = Ventas::selectRaw('MONTHNAME(fecha_venta) as mes_nombre, MONTH(fecha_venta) as mes_numero, COUNT(*) as total_ventas')
        ->whereYear('fecha_venta', now()->year)
        ->groupBy('mes_nombre', 'mes_numero')
        ->orderBy('mes_numero')
        ->get();
        $labels = $ventasPorMes->pluck('mes_nombre');
        $data = $ventasPorMes->pluck('total_ventas');

        $fechaInicio = now()->startOfYear();  // Primer día del año actual
        $fechaFin = now();   

        // Calcular datos de ventas y ticket promedio
        $totalIngresos = Ventas::whereBetween('fecha_venta', [$fechaInicio, $fechaFin])->sum('total');
        $cantidadTickets = Ventas::whereBetween('fecha_venta', [$fechaInicio, $fechaFin])->count();
        $ticketPromedio = $cantidadTickets > 0 ? $totalIngresos / $cantidadTickets : 0;

        // Obtener productos más vendidos
        $productosMasVendidos = Detalle_venta::join('producto', 'detalles_venta.id_producto', '=', 'producto.id_producto')
                                ->join('ventas', 'detalles_venta.id_venta', '=', 'ventas.id_venta')
                                ->select('producto.nombre', DB::raw('SUM(detalles_venta.cantidad) as total_vendido'))
                                ->whereBetween('ventas.fecha_venta', [$fechaInicio, $fechaFin]) // Filtramos por el rango de fechas de las ventas
                                ->groupBy('producto.id_producto', 'producto.nombre')
                                ->orderByDesc('total_vendido') // Ordenamos de mayor a menor
                                ->limit(10) // Limitar a los 10 productos más vendidos
                                ->get();

        // Preparar los datos para el gráfico
        $productosLabels = $productosMasVendidos->pluck('nombre');
        $productosData = $productosMasVendidos->pluck('total_vendido');

        // Datos para gráfico de ventas mensuales (como el ejemplo que ya tienes)
        $ventasPorMes = Ventas::select(DB::raw('monthname(fecha_venta) as mes'), DB::raw('SUM(total) as total_ventas'))
            ->whereBetween('fecha_venta', [$fechaInicio, $fechaFin])
            ->groupBy(DB::raw('monthname(fecha_venta)'))
            ->get();
        $labels = $ventasPorMes->pluck('mes');
        $data = $ventasPorMes->pluck('total_ventas');

        $ingresos = DB::table('categorias as c')
        ->join('producto as p', 'c.id_categoria', '=', 'p.id_cateogria')
        ->join('detalles_venta as dv', 'p.id_producto', '=', 'dv.id_producto')
        ->join('ventas as v', 'dv.id_venta', '=', 'v.id_venta')
        ->select(
            'c.nombre_cat as categoria',
            DB::raw("DATE_FORMAT(v.fecha_venta, '%Y-%m') as mes"),
            DB::raw("SUM(dv.total) as ingreso_total_mensual"),
            DB::raw("SUM(dv.cantidad) as productos_vendidos")
        )
        ->whereYear('v.fecha_venta', now()->year)
        ->groupBy('c.nombre_cat', DB::raw("DATE_FORMAT(v.fecha_venta, '%Y-%m')"))
        ->orderBy('c.nombre_cat')
        ->orderBy('mes')
        ->get();

        $generoProductores = User::where('rol', 'productor') // Filtramos por rol "productor"
            ->select('sexo', DB::raw('COUNT(*) as total_productores'))
            ->groupBy('sexo') // Agrupamos por género
            ->get();

        $totalProductores = User::where('rol', 'productor')->count(); // Contamos el total de productores

        $generoProductoresConPorcentaje = $generoProductores->map(function ($item) use ($totalProductores) {
            $item->porcentaje = $totalProductores > 0 ? ($item->total_productores / $totalProductores) * 100 : 0;
            return $item;
        });

        $porcentajegenero = $generoProductoresConPorcentaje->pluck('porcentaje');


        $datagenero = $generoProductoresConPorcentaje->pluck('total_productores');


        $proveedores = DB::table('detalles_venta')
        ->join('producto', 'detalles_venta.id_producto', '=', 'producto.id_producto')
        ->join('users', 'producto.id_productor', '=', 'users.id')
        ->select('users.id as productor_id', 'users.name as productor_nombre', DB::raw('SUM(detalles_venta.cantidad) as total_vendido'))
        ->groupBy('users.id', 'users.name')  
        ->orderByDesc(DB::raw('SUM(detalles_venta.cantidad)'))  
        ->get();

        $comprasPorCliente = DB::table('ventas')
        ->join('users', 'ventas.id_cliente', '=', 'users.id')
        ->select('users.id', 'users.name', DB::raw('COUNT(ventas.id_venta) as numeroCompras'))
        ->groupBy('users.id', 'users.name')
        ->orderByDesc(DB::raw('COUNT(ventas.id_venta)'))
        ->limit(5)
        ->get();
        
         // Contar productores por dirección
        $proveedoresPorDireccion = DB::table('users')
        ->where('rol', 'productor') 
        ->select('direccion', DB::raw('COUNT(*) as total')) 
        ->groupBy('direccion') 
        ->pluck('total', 'direccion');

        return view('backup_restore.panel', compact('labels', 'data', 'ventasPorMes','fechaInicio', 'fechaFin', 'totalIngresos', 'cantidadTickets', 'ticketPromedio', 'productosMasVendidos', 'productosLabels', 'productosData', 'labels', 'data', 'ingresos', 'porcentajegenero', 'datagenero', 'proveedoresPorDireccion','comprasPorCliente','proveedores'));
    }


    public function filtro(Request $request){
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');



        // Obtener productos más vendidos
        $productosMasVendidos = Detalle_venta::join('producto', 'detalles_venta.id_producto', '=', 'producto.id_producto')
                                ->join('ventas', 'detalles_venta.id_venta', '=', 'ventas.id_venta')
                                ->select('producto.nombre', DB::raw('SUM(detalles_venta.cantidad) as total_vendido'))
                                ->whereBetween('ventas.fecha_venta', [$fechaInicio, $fechaFin]) // Filtramos por el rango de fechas de las ventas
                                ->groupBy('producto.id_producto', 'producto.nombre')
                                ->orderByDesc('total_vendido') // Ordenamos de mayor a menor
                                ->limit(10) // Limitar a los 10 productos más vendidos
                                ->get();

        // Preparar los datos para el gráfico
        $productosLabels = $productosMasVendidos->pluck('nombre');
        $productosData = $productosMasVendidos->pluck('total_vendido');

        // Datos para gráfico de ventas mensuales (como el ejemplo que ya tienes)
        $ventasPorMes = Ventas::select(DB::raw('monthname(fecha_venta) as mes'), DB::raw('SUM(total) as total_ventas'))
            ->whereBetween('fecha_venta', [$fechaInicio, $fechaFin])
            ->groupBy(DB::raw('monthname(fecha_venta)'))
            ->get();
        $labels = $ventasPorMes->pluck('mes');
        $data = $ventasPorMes->pluck('total_ventas');

        return json_encode(array('labels' => $labels, 'data' => $data, 'productosLabels' => $productosLabels, 'productosData' => $productosData));
    }


    public function reporteVentas(){
        $fechaInicio = now()->startOfYear();  
        $fechaFin = now();    

        $totalIngresos = Ventas::whereBetween('fecha_venta', [$fechaInicio, $fechaFin])->sum('total');
        $cantidadTickets = Ventas::whereBetween('fecha_venta', [$fechaInicio, $fechaFin])->count();
        $ticketPromedio = $cantidadTickets > 0 ? $totalIngresos / $cantidadTickets : 0;

        $productosMasVendidos = Detalle_venta::join('producto', 'detalles_venta.id_producto', '=', 'producto.id_producto')
            ->join('ventas', 'detalles_venta.id_venta', '=', 'ventas.id_venta')
            ->select('producto.nombre', DB::raw('SUM(detalles_venta.cantidad) as total_vendido'))
            ->whereBetween('ventas.fecha_venta', [$fechaInicio, $fechaFin]) 
            ->groupBy('producto.id_producto', 'producto.nombre')
            ->orderByDesc('total_vendido') 
            ->limit(10) 
            ->get();

        // Preparar los datos para el gráfico
        $productosLabels = $productosMasVendidos->pluck('nombre');
        $productosData = $productosMasVendidos->pluck('total_vendido');

        $ingresos = DB::table('categorias as c')
            ->join('producto as p', 'c.id_categoria', '=', 'p.id_cateogria')
            ->join('detalles_venta as dv', 'p.id_producto', '=', 'dv.id_producto')
            ->join('ventas as v', 'dv.id_venta', '=', 'v.id_venta')
            ->select(
                'c.nombre_cat as categoria',
                DB::raw("DATE_FORMAT(v.fecha_venta, '%Y-%m') as mes"),
                DB::raw("SUM(dv.total) as ingreso_total_mensual"),
                DB::raw("SUM(dv.cantidad) as productos_vendidos")
            )
            ->whereYear('v.fecha_venta', now()->year)
            ->groupBy('c.nombre_cat', DB::raw("DATE_FORMAT(v.fecha_venta, '%Y-%m')"))
            ->orderBy('c.nombre_cat')
            ->orderBy('mes')
            ->get();

            $generoProductores = User::where('rol', 'productor')
                ->select('sexo', DB::raw('COUNT(*) as total_productores'))
                ->groupBy('sexo')
                ->get();

            $totalProductores = User::where('rol', 'productor')->count();

            $generoProductoresConPorcentaje = $generoProductores->map(function ($item) use ($totalProductores) {
                $item->porcentaje = $totalProductores > 0 ? ($item->total_productores / $totalProductores) * 100 : 0;
                return $item;
            });

            $porcentajegenero = $generoProductoresConPorcentaje->pluck('porcentaje');
            $datagenero = $generoProductoresConPorcentaje->pluck('total_productores');

            $labels = $generoProductoresConPorcentaje->pluck('sexo')->toArray();  
            $data = $datagenero->toArray();  
            $porcentaje = $porcentajegenero->toArray();  
            // Crear la URL para QuickChart
            $chartUrl = 'https://quickchart.io/chart?c=' . urlencode(json_encode([
                'type' => 'pie', 
                'data' => [
                    'labels' => $labels,
                    'datasets' => [[
                        'data' => $data,
                        'backgroundColor' => ['#FF6384', '#36A2EB','#FFCE56'], 
                        'label' => 'Productores por Género'
                    ]]
                ],
                'options' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Distribución de Productores por Género'
                    ],
                    'plugins' => [
                        'tooltip' => [
                            'callbacks' => [
                                'label' => 'function(tooltipItem) { return tooltipItem.label + ": " + tooltipItem.raw + " productores (" + porcentaje[tooltipItem.index] + "%)"; }'
                            ]
                        ]
                    ]
                ]
            ]));

            // Obtener la imagen desde la URL
            $image = file_get_contents($chartUrl);

            // Codificar la imagen a base64
            $base64 = base64_encode($image);
            $imgSrc = 'data:image/png;base64,' . $base64;

            $proveedores = DB::table('detalles_venta')
            ->join('producto', 'detalles_venta.id_producto', '=', 'producto.id_producto')
            ->join('users', 'producto.id_productor', '=', 'users.id')
            ->select('users.id as productor_id', 'users.name as productor_nombre', DB::raw('SUM(detalles_venta.cantidad) as total_vendido'))
            ->groupBy('users.id', 'users.name')  
            ->orderByDesc(DB::raw('SUM(detalles_venta.cantidad)'))  
            ->get();

            $comprasPorCliente = DB::table('ventas')
            ->join('users', 'ventas.id_cliente', '=', 'users.id')
            ->select('users.id', 'users.name', DB::raw('COUNT(ventas.id_venta) as numeroCompras'))
            ->groupBy('users.id', 'users.name')
            ->orderByDesc(DB::raw('COUNT(ventas.id_venta)'))
            ->limit(5)
            ->get();


            
            return view('backup_restore.panel', compact('ingresos', 'totalIngresos', 'cantidadTickets', 'ticketPromedio', 'productosMasVendidos', 'productosLabels', 'productosData', 'imgSrc', 'proveedores', 'comprasPorCliente'));
            $pdf = PDF::loadView('ventas.reporte_ventas', compact('ingresos', 'totalIngresos', 'cantidadTickets', 'ticketPromedio', 'productosMasVendidos', 'productosLabels', 'productosData', 'imgSrc', 'proveedores', 'comprasPorCliente'));
            return $pdf->stream('reporte_ventas.pdf');
    }


    public function notificaciones(){
        $notificaciones = notificaciones::where('id_usua', auth()->user()->id)->get();
        return json_decode($notificaciones);
    }
}