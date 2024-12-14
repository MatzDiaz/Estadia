<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Http\Controllers\Controller;
use App\Models\Ventas;
use App\Models\Detalle_venta;
use App\Models\Producto;
use App\Models\Carrito;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    //
    public function index(){
        $total = Carrito::where('id_usuario', auth()->user()->id)
        ->sum('SubTotalPorducto');

        return view('ventas.RealizarVenta', compact('total'));
    }

    public function realizarVenta(Request $request)
    {
        $venta = new Ventas();
        $venta->id_cliente = auth()->user()->id;
        $total = Carrito::where('id_usuario', auth()->user()->id)
            ->sum('SubTotalPorducto'); 
        $venta->total = $total;
        $venta->fecha_venta = now()->toDateString(); 
        $venta->direccion_envio = $request->direccion_envio; 
        $venta->metodo_pago = $request->metodo_pago; 
        $venta->estado = "Finalizado"; 
        $venta->save(); 

        $productos = Carrito::where('id_usuario', auth()->user()->id)->get();

        foreach ($productos as $producto) {
            $detalle = new Detalle_venta();
            $detalle->id_venta = $venta->id_venta; 
            $detalle->id_producto = $producto->id_producto; 
            $detalle->cantidad = $producto->cantidad; 
            $detalle->precio_unitario = $producto->producto->precio; 
            $detalle->total = $producto->SubTotalPorducto; 
            $detalle->save(); 
        }

        Carrito::where('id_usuario', auth()->user()->id)->delete();
        session()->flash('success', '¡Compra realizada con éxito!');
        return redirect()->route('home');
    }

}
