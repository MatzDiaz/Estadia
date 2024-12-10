<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;


class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $carrito = Carrito::all();
        return view('ventas.carrito', compact('carrito'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function PutInCart(Request $request){
        $carrito = new Carrito;
        $carrito->id_usuario = auth()->user()->id;
        $carrito->id_producto = $request->id;
        $carrito->cantidad = $request->cantidad;
        $carrito->fecha_agregado =Carbon::now()->toDateString();
        $carrito->save();
        return response()->json(['message' => $request->all()]);
    }

    public function ShowMyCart(){
        $carrito = Carrito::with('producto')
        ->where('id_usuario', auth()->user()->id)->get();
        return view('ventas.carrito', compact('carrito'));
    }

    public function DeleteOneProduc(Request $request){
        $carrito = Carrito::where('id_usuario', auth()->user()->id)
        ->where('id_carrito', $request->id)->first();
        $carrito->delete();
        return response()->json(['message' => 'Producto eliminado']);
    }

    

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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
