<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Http\Controllers\Controller;
use App\Models\Ventas;
use Carbon\Carbon;

use App\Models\Detalle_venta;
use App\Models\Productos;
use App\Models\salidas;
use App\Models\notificaciones;
use App\Models\Carrito;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    public function index(){
        $total = Carrito::where('id_usuario', auth()->user()->id)
        ->sum('SubTotalPorducto');

        return view('ventas.RealizarVenta', compact('total'));
    }

    public function realizarVenta(Request $request)
    {
        $total = Carrito::where('id_usuario', auth()->user()->id)
            ->sum('SubTotalPorducto');
        if($total == 0){
            session()->flash('error', '¡No hay productos en el carrito!');
            return redirect()->route('carrito.Mostrar')->with('error', 'No hay productos en el carrito');
        }
        
        $venta = new Ventas();
        $venta->id_cliente = auth()->user()->id;

        $venta->total = $total;

        
        $venta->fecha_venta = now()->toDateString(); 

        $fechaActual = Carbon::now()->format('Ymd'); 
        $idUsuario = auth()->user()->id;

        $ultimaVenta = Ventas::latest('id_venta')
            ->select('id_venta')
        ->first();
        $cadena = $fechaActual . $idUsuario . $ultimaVenta->id_venta;
        $venta->referencia_pago = $cadena; 
        $venta->estado = "Finalizado"; 
        $venta->save(); 

        $productos = Carrito::where('id_usuario', auth()->user()->id)->get();

        foreach ($productos as $producto) {
            // Crear el detalle de la venta
            $detalle = new Detalle_venta();
            $detalle->id_venta = $venta->id_venta; 
            $detalle->id_producto = $producto->id_producto; 
            $detalle->cantidad = $producto->cantidad; 
            $detalle->precio_unitario = $producto->producto->precio; 
            $detalle->total = $producto->SubTotalPorducto; 
            $detalle->save(); 
            
            // Obtener información del producto
            $productoInfo = Productos::find($producto->id_producto);
    
            // Crear una notificación para el productor del producto
            if ($productoInfo) {
                $notificacion = new notificaciones();
                $notificacion->id_usua = $productoInfo->id_productor; // ID del productor
                $notificacion->mensaje = sprintf(
                    "Felicidades, tu producto: %s vendió: %d unidades. Total de venta: %.2f",
                    $productoInfo->nombre,
                    $producto->cantidad,
                    $producto->SubTotalPorducto
                );
                $notificacion->fecha = now();
                $notificacion->save();
            }

            // Registrar la salida del producto
            $salida = new salidas();
            $salida->id_producto = $producto->id_producto;
            $salida->cantidad = $producto->cantidad;
            $salida->tipo_salida = 'Venta'; // Tipo de salida
            $salida->fecha_salida = now()->toDateString();
            $salida->save();
        }

        // Eliminar los productos del carrito después de realizar la venta
        Carrito::where('id_usuario', auth()->user()->id)->delete();
        $pdf = PDF::loadView('ventas.tikec_venta', compact('venta', 'productos'));
        return $pdf->download('ticket_venta.pdf');
        return response()->json(['success' => true, 'message' => 'Venta realizada correctamente']);

    }
}
