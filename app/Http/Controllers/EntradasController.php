<?php

namespace App\Http\Controllers;

use App\Models\Entradas;
use App\Models\Productos;
use App\Models\Salidas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntradasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener productos del productor autenticado
        $producto = Productos::where('id_productor', auth()->id())->get();
        
        // Obtener salidas de los productos de ese productor
        $salidas = Salidas::with('producto')
            ->whereIn('id_producto', $producto->pluck('id_producto'))  // Filtrar salidas por los productos del productor
            ->get();

        $entradas = Entradas::with('producto')
            ->whereIn('id_producto', $producto->pluck('id_producto'))  // Filtrar entradas por los productos del productor
            ->get();
        
        return view('productos.inventario', compact('entradas', 'producto', 'salidas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'cantidad' => 'required|integer|min:1',
            'tipo' => 'required|string|max:255',
        ]);
    
        // Obtener el producto
        $producto = Productos::find($request->id_producto);
        
        // Verificar si el producto ya tiene existencias
        if ($producto) {
            // Si el producto ya tiene existencia, se le sumará la cantidad ingresada
            $nuevaCantidad = $producto->cantidad + $request->cantidad;
        } else {
            // Si el producto no existe, se creará con la cantidad ingresada
            $nuevaCantidad = $request->cantidad;
        }

        // Registrar la entrada en la tabla de entradas
        Entradas::create([
            'id_producto' => $request->id_producto,
            'cantidad' => $request->cantidad,
            'existencia' => $nuevaCantidad, // La nueva cantidad acumulada
            'tipo_entrada' => $request->tipo, // Registrar el tipo de entrada
        ]);
    
        // Actualizar la cantidad en la tabla de productos
        if ($producto) {
            $producto->cantidad = $nuevaCantidad; // Actualizar la cantidad en el producto
            $producto->save();
        } else {
            // Si el producto no existe, se crea un nuevo registro
            Productos::create([
                'id_producto' => $request->id_producto,
                'cantidad' => $nuevaCantidad,
                'nombre' => $request->nombre, // Asegúrate de incluir el nombre u otros campos necesarios
                // Otros campos del producto que puedan ser necesarios
            ]);
        }
    
        return redirect()->back()->with('success', 'Entrada registrada y existencia actualizada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Entradas $entradas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entradas $entradas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entradas $entradas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entradas $entradas)
    {
        //
    }
}
