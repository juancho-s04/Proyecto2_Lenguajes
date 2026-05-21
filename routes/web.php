<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

Route::get('/', function () {
    return view('welcome');
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'es'])) {
        Session::put('locale', $locale);
    }
    return Redirect::back();
});

Route::get('/', [IndexController::class, 'index']);
Route::get('/login', [IndexController::class, 'login']);
Route::get('/registro', [IndexController::class, 'registro']);
Route::get('/admin', [IndexController::class, 'admin']);
Route::get('/user', [IndexController::class, 'user']);

/*
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

 // Grupo de rutas para el Módulo de Usuarios (estructuradas bajo '/vista')
Route::prefix('vista')->group(function () {

    // Vista del listado principal de usuarios registrados (index.blade.php)
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');

    // Vista del formulario para crear un nuevo usuario (form.blade.php)
    Route::get('/usuarios/nuevo', [UsuarioController::class, 'create'])->name('usuarios.create');

    // Acción para procesar y guardar el nuevo usuario en la Base de Datos
    Route::post('/usuarios/nuevo', [UsuarioController::class, 'store'])->name('usuarios.store');

    // Vista del formulario para editar un usuario existente por ID (form.blade.php)
    Route::get('/usuarios/editar/{id}', [UsuarioController::class, 'edit'])->name('usuarios.edit');

    // Acción para procesar la actualización del usuario editado en la Base de Datos
    Route::put('/usuarios/editar/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');

    Route::delete('/usuarios/eliminar/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');


    Route::get('/solicitudes/panel', [UsuarioController::class, 'user'])->name('usuarios.user');

    Route::get('/servicios', function () {
        return view('servicios.index');
    });
    Route::get('/solicitudes', function () {
        return view('solicitudes.index');
    });
    Route::get('/solicitudes/nueva', function () {
        return view('solicitudes.create');
    });
});

Route::get('/auth/logout', [UsuarioController::class, 'logout'])->name('auth.logout');
*/