<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\EntradasController;
use App\Http\Controllers\SalidasController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\BackupRestoreController;
use App\Http\Controllers\VentasController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/verify', function () {
    return view('auth.verify');
})->name('verify');


Route::get('/', [ProductosController::class, 'welcome']);


Route::get('/check-session', function () {
    return response()->json(['expired' => auth()->guest()]);
});


Auth::routes();

Route::get('/home', [ProductosController::class, 'home'])->name('home')->middleware('auth');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('productos', ProductosController::class);
Route::resource('categorias', CategoriasController::class);
Route::resource('blog', BlogController::class);
Route::resource('usuarios', UserController::class);
Route::get('/graficas', [UserController::class, 'graficas'])->name('usuarios.graficas');
Route::resource('entradas', EntradasController::class);
Route::resource('salidas', SalidasController::class);
Route::resource('carrito', CarritoController::class);
Route::resource('base', BackupRestoreController::class);
Route::get('/productores', [UserController::class, 'indexProductores'])->name('usuarios.productores');
Route::get('/usuarios', [UserController::class, 'indexUsuarios'])->name('usuarios.usuarios');

Route::get('/backups', [BackupRestoreController::class, 'index'])->name('backup.index');
Route::post('/backups/generate', [BackupRestoreController::class, 'backupDatabase'])->name('backup.generate');
Route::post('/backups/restore', [BackupRestoreController::class, 'restoreDatabase'])->name('backup.restore');

//Rutas para el carrito
Route::post('/carrito/{id}', [CarritoController::class, 'PutInCart'])->name('carrito.Agregar');
Route::get('/MyCarrito', [CarritoController::class, 'ShowMyCart'])->name('carrito.Mostrar');
Route::delete('/carritoEliminar/{id}', [CarritoController::class, 'DeleteOneProduc'])->name('carrito.quitar');

//para recuperar contraseña



Auth::routes();


//para ver grafica:
Route::get('/graficas', [BackupRestoreController::class, 'graficas'])->name('graficas.ver');

//para la compra/venta
Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.index');
Route::post('/ventas', [VentasController::class, 'RealizarVenta'])->name('ventas.RealizarVenta');

//para actualizar graficas:
Route::post('/graficasPorFecha', [BackupRestoreController::class, 'filtro'])->name('graficas.filtro');

//reporte pdf de ventas
Route::get('/reporteVentas', [BackupRestoreController::class, 'reporteVentas'])->name('ventas.reporteVentas');


//para notificaciones:
Route::get('/notificaciones', [BackupRestoreController::class, 'notificaciones'])->name('notificaciones.index');
