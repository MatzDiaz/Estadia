<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $usuarios =  User::all();
        return view('usuarios.usuarios',compact('usuarios'));
    }

    public function indexProductores()
    {
        $usuarios =  User::all();
        return view('usuarios.productores', compact('usuarios'));
    }
    
    public function indexUsuarios()
    {
        $usuarios =  User::all();
        return view('usuarios.usuarios', compact('usuarios'));
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
        $usuarios = new User;
        $usuarios->name = $request->input('nombre');
        $usuarios->apellido = $request->input('apellido');
        $usuarios->email = $request->input('email');
        $usuarios->telefono = $request->input('telefono');
        $usuarios->direccion = $request->input('direccion');
        $usuarios->password = $request->input('password');
        $usuarios->sexo = $request->input('sexo');
        $usuarios->rol = $request->input('rol');        
        $usuarios->save();
        return redirect()->back();
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
    public function update(Request $request, $id)
    {
        //
        $usuarios = User::find($id);
        $usuarios->name = $request->input('nombre');
        $usuarios->apellido = $request->input('apellido');
        $usuarios->email = $request->input('email');
        $usuarios->telefono = $request->input('telefono');
        $usuarios->direccion = $request->input('direccion');
        $usuarios->sexo = $request->input('sexo');
        $usuarios->update();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $usuarios = User::find($id);
        $usuarios->delete();
        return redirect()->back();
    }
}
