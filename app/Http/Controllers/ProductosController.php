<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\User;
use App\Models\Categorias;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /*
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $categorias = Categorias::all();
        $producto = Productos::where('id_productor', auth()->user()->id)->get();
        return view('productos.productos', compact('producto','categorias'));
    }

    public function home()
    {
        if(auth()->user()->rol == 'Consumidor'){
            
            $productos = Productos::all();
            return view('ventas.home', compact('productos'));
        }else{
            if(auth()->user()->rol == 'Admin'){
                $usuarios =  User::all();
                return view('usuarios.productores', compact('usuarios'));
            }
        }
        $producto = Productos::where('id_productor', auth()->user()->id)->get();
        $categorias = Categorias::all();
        return view('productos.productos', compact('producto','categorias'));
    }

    public function inventario()
    {
        $producto =  Productos::all();
        return view('productos.inventario', compact('producto'));
    }
    
    public function welcome()
    {
        $productos =  Productos::all();
        return view('welcome', compact('productos'));
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
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.string' => 'El nombre del producto debe ser un texto válido.',
            'nombre.max' => 'El nombre del producto no puede exceder los 255 caracteres.',
            
            'descripcion.required' => 'La descripción del producto es obligatoria.',
            'descripcion.string' => 'La descripción debe ser un texto válido.',
        
            'precio.required' => 'El precio del producto es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número válido.',
            'precio.min' => 'El precio debe ser mayor o igual a 0.',
        
            'id_categoria.required' => 'La categoría es obligatoria.',
            'id_categoria.exists' => 'La categoría seleccionada no es válida.',
        
            'imagen.image' => 'El archivo subido debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe tener uno de los siguientes formatos: jpeg, png, jpg o gif.',
            'imagen.max' => 'La imagen no debe superar los 2 MB de tamaño.',
        ]);
        
    
        // Crear una nueva instancia del modelo Producto
        $producto = new Productos;
        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion');
        $producto->precio = $request->input('precio');
        $producto->id_cateogria = $request->input('id_categoria');
        $producto->id_productor = auth()->user()->id;
    
        // Procesar la imagen si se proporciona
        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            $path = $archivo->store('public/imagenes'); // Almacena la imagen en storage/app/public/imagenes
            $producto->imagen = basename($path); // Guardar solo el nombre del archivo
        }
    
        // Guardar el producto en la base de datos
        $producto->save();
        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'Producto creado correctamente.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Productos $productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Productos $productos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
        public function update(Request $request, $id_producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    // Buscar el producto por ID
        $producto = Productos::find($id_producto);

        // Validar que el producto exista
        if (!$producto) {
            return redirect()->back()->with('error', 'El producto no existe.');
        }

        // Actualizar los datos del producto
        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion');
        $producto->precio = $request->input('precio');
        $producto->id_cateogria = $request->input('id_categoria');

        // Si hay una nueva imagen, procesarla
        if ($request->hasFile('imagen')) {
            // Verificar si el producto tiene una imagen previa y eliminarla
            if ($producto->imagen && \Storage::exists('public/imagenes/' . $producto->imagen)) {
                \Storage::delete('public/imagenes/' . $producto->imagen);
            }
        
            // Subir la nueva imagen y guardar la ruta
            $archivo = $request->file('imagen');
            $path = $archivo->store('public/imagenes'); // Almacena la imagen en storage/app/public/imagenes
            $producto->imagen = basename($path); // Guardar solo el nombre del archivo en la base de datos
        }
        
        // Guardar los cambios en la base de datos
        $producto->save();

        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', 'Producto actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_producto)
    {
        $producto = Productos::find($id_producto);
        $producto->delete();
        return redirect()->back();
    }
}