<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'es'])) {
        Session::put('locale', $locale);
    }
    return Redirect::back();
});

//rutas públicas
Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/login', [IndexController::class, 'login'])->name('login');
Route::get('/registro', [IndexController::class, 'registro']);


Route::post('/login', [AuthController::class, 'login']);
Route::post('/registro', [UserController::class, 'registerWeb']);

//logout protegida
Route::get('/auth/logout', [AuthController::class, 'logout'])->middleware('auth');

//aquí protegemos el panel del cliente 
Route::middleware('auth')->group(function () {
    Route::get('/user', [IndexController::class, 'user']);

    Route::prefix('vista')->controller(PanelController::class)->group(function () {
        Route::get('/servicios', 'servicios');

        Route::get('/solicitudes', 'solicitudes');
        Route::get('/solicitudes/nueva', 'solicitudForm');
        Route::post('/solicitudes/nueva', 'solicitudStore');
        Route::get('/solicitudes/editar/{solicitud}', 'solicitudForm');
        Route::put('/solicitudes/editar/{solicitud}', 'solicitudUpdate');
        Route::delete('/solicitudes/eliminar/{solicitud}', 'solicitudDestroy');
    });
});

//protegemos todo lo administrativo para que solo lo vea el administrador
Route::middleware(['auth', 'role:ADMINISTRADOR'])->group(function () {
    Route::get('/admin', [IndexController::class, 'admin']);

    Route::prefix('vista')->controller(PanelController::class)->group(function () {
        Route::get('/clientes', 'clientes');
        Route::get('/clientes/nuevo', 'clienteForm');
        Route::post('/clientes/nuevo', 'clienteStore');
        Route::get('/clientes/editar/{cliente}', 'clienteForm');
        Route::put('/clientes/editar/{cliente}', 'clienteUpdate');
        Route::delete('/clientes/eliminar/{cliente}', 'clienteDestroy');

        Route::get('/consultorias', 'consultorias');
        Route::get('/consultorias/nueva', 'consultoriaForm');
        Route::post('/consultorias/nueva', 'consultoriaStore');
        Route::get('/consultorias/editar/{consultoria}', 'consultoriaForm');
        Route::put('/consultorias/editar/{consultoria}', 'consultoriaUpdate');
        Route::delete('/consultorias/eliminar/{consultoria}', 'consultoriaDestroy');

        Route::get('/usuarios', 'usuarios');
        Route::get('/usuarios/nuevo', 'usuarioForm');
        Route::post('/usuarios/nuevo', 'usuarioStore');
        Route::get('/usuarios/editar/{usuario}', 'usuarioForm');
        Route::put('/usuarios/editar/{usuario}', 'usuarioUpdate');
        Route::delete('/usuarios/eliminar/{usuario}', 'usuarioDestroy');
    });
});
