<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias =  categorias::all();
        return view('categorias.categorias',compact('categorias'));
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
        $categorias = new categorias;
        $categorias->nombre_cat = $request->input('nombre');
        $categorias->descripcion = $request->input('descripcion');
        $categorias->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorias $categorias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorias $categorias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_categoria)
    {
        $categorias = categorias::find($id_categoria);
        $categorias->nombre_cat = $request->input('nombre');
        $categorias->descripcion = $request->input('descripcion');
        $categorias->update();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_categoria)
    {
        //
        $categorias = categorias::find($id_categoria);
        $categorias->delete();
        return redirect()->back();
    }
}
