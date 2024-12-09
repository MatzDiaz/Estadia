<?php

namespace App\Http\Controllers;

use App\Models\entradas;
use App\Models\Productos;
use App\Models\salidas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntradasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $entradas = Entradas::with('producto')->get();
        $producto = Productos::all();
        $salidas = Salidas::with('producto')->get();
        return view('productos.inventario', compact('entradas','producto','salidas'));
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
    
        // Obtener la última entrada del producto para calcular la existencia acumulada
        $ultimaEntrada = Entradas::where('id_producto', $request->id_producto)
                                 ->orderBy('id_entrada', 'desc')
                                 ->first();
    
        // Calcular la nueva existencia
        $nuevaExistencia = $ultimaEntrada ? $ultimaEntrada->existencia + $request->cantidad : $request->cantidad;
    
        // Crear un nuevo registro de entrada con la nueva cantidad y existencia acumulada
        Entradas::create([
            'id_producto' => $request->id_producto,
            'cantidad' => $request->cantidad,
            'existencia' => $nuevaExistencia, // Actualizar la existencia acumulada
            'tipo_entrada' => $request->tipo, // Registrar el tipo de entrada
        ]);
    
        // Actualizar la cantidad en la tabla de productos
        $producto = Productos::find($request->id_producto);
        if ($producto) {
            $producto->cantidad = $nuevaExistencia; // Actualizar la existencia
            $producto->save();
        }
    
        return redirect()->back()->with('success', 'Entrada registrada y existencia actualizada correctamente.');
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(entradas $entradas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(entradas $entradas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, entradas $entradas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(entradas $entradas)
    {
        //
    }
}
