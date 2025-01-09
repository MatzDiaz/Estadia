<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $blog =  blog::all();
        return view('blog.blog',compact('blog'));
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
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validación de imagen
        ]);

        $blog = new Blog;
        $blog->titulo = $request->input('titulo');
        $blog->descripcion = $request->input('descripcion');
        $blog->id_productor = $request->input('id_productor');
        $blog->fecha_pub = $request->input('fecha_pub');

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $path = $file->store('public/imagenes'); // Almacena la imagen en storage/app/public/imagenes
            $blog->multimedia = basename($path); // Guardar solo el nombre del archivo
        }

        $blog->save();
        return redirect()->back()->with('success', 'Publicación creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_blog)
    {
        //
        $blog = Blog::find($id_blog);
        $blog->titulo = $request->input('titulo');
        $blog->descripcion = $request->input('descripcion');
        $blog->update();
        return redirect()->back()->with('success', 'Publicación actualizada con éxito.');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_blog)
    {
        //
        $blog = Blog::find($id_blog);
        $blog->delete();
        return redirect()->back()->with('success', 'Publicación eliminada con éxito.');;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
