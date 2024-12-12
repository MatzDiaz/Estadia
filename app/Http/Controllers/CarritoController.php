<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Productos;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\Correostock;


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
        
        $producto = new Productos;
        $producto = Productos::find($request->id);
        $producto->cantidad = $producto->cantidad - $request->cantidad;
        $producto->save();

        $carrito->SubTotalPorducto = $producto->precio * $request->cantidad;


        if($producto->cantidad <= 5){
            $mensaje = "El producto ".$producto->nombre." esta por agotarse, solo quedan ".$producto->cantidad." unidades";
            $user = User::where('id', '=', $producto->id_productor)->first();
            
            Mail::to($user->email)->send(new Correostock($mensaje));

        }
        $carrito->save();
        return response()->json(['message' => $request->all()]);
    }

    public function ShowMyCart(){
        $carrito = Carrito::with('producto')
        ->where('id_usuario', auth()->user()->id)->get();
        $total =0;
        foreach ($carrito as $item) {
            $total += $item->SubTotalPorducto;
        }
        return view('ventas.carrito', compact('carrito', 'total'));
    }

    public function DeleteOneProduc(Request $request){

        $carrito = Carrito::where('id_usuario', auth()->user()->id)
        ->where('id_carrito', $request->id)->first();
        
        $producto = Productos::find($carrito->id_producto);
        $producto->cantidad = $producto->cantidad + $carrito->cantidad;
        $producto->save();
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
