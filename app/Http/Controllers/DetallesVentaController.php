<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Detalle_venta;

class DetallesVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener productos del productor autenticado
        $producto = Productos::where('id_productor', auth()->id())->get();
        
        // Obtener salidas de los productos de ese productor
        $detalles = Detalle_venta::with('producto')
            ->whereIn('id_producto', $producto->pluck('id_producto'))  // Filtrar salidas por los productos del productor
            ->get();
        return view('ventas.ventas', compact('detalles','producto'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_detalle)
    {
        //
        $detalles = Detalle_venta::find($id_detalle);
        $detalles->estatus = $request->input('estatus');
        $detalles->update();
        return redirect()->back()->with('success', 'Venta actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_detalle)
    {
        //
        $detalles = Detalle_venta::find($id_detalle);
        $detalles->delete();
        return redirect()->back()->with('error', 'Venta eliminada.');
    }
}
