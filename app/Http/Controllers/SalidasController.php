<?php

namespace App\Http\Controllers;


use App\Models\salidas;
use App\Models\Productos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalidasController extends Controller
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

        // Obtener el producto para verificar la existencia actual
        $producto = Productos::find($request->id_producto);

        // Validar que haya suficiente existencia antes de registrar la salida
        if ($producto->cantidad < $request->cant) {
            return redirect()->back()->with('error', 'No hay suficiente existencia para esta salida.');
        }

        // Calcular la nueva existencia (disminuyendo la cantidad)
        $nuevaExistencia = $producto->cantidad - $request->cant;

        // Crear un nuevo registro de salida
        Salidas::create([
            'id_producto' => $request->id_producto,
            'cantidad' => $request->cant,
            'tipo_salida' => $request->tipo,
            'fecha_salida' => now(), // Registrar la fecha actual
        ]);

        // Actualizar la existencia en la tabla de productos
        $producto->cantidad = $nuevaExistencia;
        $producto->save();

        return redirect()->back()->with('success', 'Salida registrada y existencia actualizada correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(salidas $salidas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(salidas $salidas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, salidas $salidas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(salidas $salidas)
    {
        //
    }
}
