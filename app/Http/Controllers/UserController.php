<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Muestra una lista de todos los usuarios.
     * 
     * @return \Illuminate\View\View Retorna la vista con todos los usuarios.
     */
    public function index()
    {
        $usuarios = User::all(); // Obtiene todos los registros de usuarios de la base de datos.
        return view('usuarios.usuarios', compact('usuarios')); // Retorna la vista 'usuarios.usuarios' con los usuarios.
    }

    /**
     * Muestra una lista de productores.
     * 
     * @return \Illuminate\View\View Retorna la vista con los productores.
     */
    public function indexProductores()
    {
        $usuarios = User::all(); // Obtiene todos los registros de usuarios.
        return view('usuarios.productores', compact('usuarios')); // Retorna la vista 'usuarios.productores' con los usuarios.
    }

    /**
     * Muestra una lista de usuarios.
     * 
     * @return \Illuminate\View\View Retorna la vista con los usuarios.
     */
    public function indexUsuarios()
    {
        $usuarios = User::all(); // Obtiene todos los registros de usuarios.
        return view('usuarios.usuarios', compact('usuarios')); // Retorna la vista 'usuarios.usuarios' con los usuarios.
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     * 
     * @param Request $request Datos enviados desde el formulario.
     * @return \Illuminate\Http\RedirectResponse Redirige a la página anterior con un mensaje de éxito.
     */
    public function store(Request $request)
    {
        $request->validate([//Verificar los datos sean los adecuados Entradas
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'password' => 'required',
            'sexo' => 'required',
            'rol' => 'required',
        ]);

        $usuarios = new User();
        $usuarios->name = $request->input('nombre'); // Asigna el nombre al modelo.
        $usuarios->apellido = $request->input('apellido'); // Asigna el apellido.
        $usuarios->email = $request->input('email'); // Asigna el email.
        $usuarios->telefono = $request->input('telefono'); // Asigna el teléfono.
        $usuarios->direccion = $request->input('direccion'); // Asigna la dirección.
        $usuarios->password = bcrypt($request->input('password')); // Encripta y asigna la contraseña.
        $usuarios->sexo = $request->input('sexo'); // Asigna el género.
        $usuarios->rol = $request->input('rol'); // Asigna el rol.
        $usuarios->save(); // Guarda el modelo en la base de datos.

        return redirect()->back()->with('success', 'Usuario registrado correctamente.');//Salidas
    }

    /**
     * Actualiza un usuario existente en la base de datos.
     * 
     * @param Request $request Datos enviados desde el formulario.
     * @param int $id ID del usuario a actualizar.
     * @return \Illuminate\Http\RedirectResponse Redirige a la página anterior con un mensaje de éxito.
     */
    public function update(Request $request, $id)
    {
        $request->validate([//Valida las entradas de datos
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required',
            'sexo' => 'required',
        ]);

        $usuarios = User::find($id); // Busca al usuario por su ID.
        $usuarios->name = $request->input('nombre'); // Actualiza el nombre.
        $usuarios->apellido = $request->input('apellido'); // Actualiza el apellido.
        $usuarios->email = $request->input('email'); // Actualiza el email.
        $usuarios->telefono = $request->input('telefono'); // Actualiza el teléfono.
        $usuarios->direccion = $request->input('direccion'); // Actualiza la dirección.
        $usuarios->sexo = $request->input('sexo'); // Actualiza el género.
        $usuarios->update(); // Guarda los cambios en la base de datos.

        return redirect()->back()->with('success', 'Usuario actualizado correctamente.');//Salida generada 
    }

    /**
     * Elimina un usuario de la base de datos.
     * 
     * @param int $id ID del usuario a eliminar.
     * @return \Illuminate\Http\RedirectResponse Redirige a la página anterior con un mensaje de éxito.
     */
    public function destroy($id)
    {
        $usuarios = User::find($id); // Busca al usuario por su ID.
        $usuarios->delete(); // Elimina al usuario de la base de datos.

        return redirect()->back()->with('success', 'Usuario eliminado correctamente.');//Salida 
    }

    /**
     * Muestra las gráficas relacionadas con los usuarios y productores.
     * 
     * @return \Illuminate\View\View Retorna la vista con datos para las gráficas.
     */
    public function graficas()
    {
        // Contar productores por género
        $proveedoresPorGenero = User::where('rol', 'productor')
            ->selectRaw('sexo, COUNT(*) as total')
            ->groupBy('sexo')
            ->pluck('total', 'sexo');

        // Contar productores por dirección
        $proveedoresPorDireccion = DB::table('users')
        ->where('rol', 'productor') 
        ->select('direccion', DB::raw('COUNT(*) as total')) 
        ->groupBy('direccion') 
        ->pluck('total', 'direccion');


        return view('usuarios.graficas', [
            'proveedoresPorGenero' => $proveedoresPorGenero,
            'proveedoresPorDireccion' => $proveedoresPorDireccion,
        ]);
    }
}
