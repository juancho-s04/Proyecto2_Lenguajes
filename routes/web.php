<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\UserController;

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'es'])) {
        session(['locale' => $locale]);
    }
    return back();
});

// Rutas públicas
Route::get('/', [IndexController::class, 'index']);
Route::get('/login', [IndexController::class, 'login'])->name('login');
Route::get('/registro', [IndexController::class, 'registro']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/registro', [UserController::class, 'registerWeb']);

Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


// ==========================================
// PANEL DEL CLIENTE
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/user', [IndexController::class, 'user'])->name('user.panel');

    Route::prefix('vista/cliente')->controller(PanelController::class)->group(function () {
        Route::get('/servicios', 'servicios');

        Route::get('/solicitudes', 'solicitudes');
        Route::get('/solicitudes/nueva', 'solicitudForm');
        Route::post('/solicitudes/nueva', 'solicitudStore');
        Route::get('/solicitudes/editar/{solicitud}', 'solicitudForm');
        Route::put('/solicitudes/editar/{solicitud}', 'solicitudUpdate');
        Route::delete('/solicitudes/eliminar/{solicitud}', 'solicitudDestroy');
    });
});

// ==========================================
// PANEL ADMINISTRATIVO
// ==========================================
Route::middleware(['auth', 'role:ADMINISTRADOR'])->group(function () {
    Route::get('/admin', [IndexController::class, 'admin'])->name('admin.panel');

    Route::prefix('vista/admin')->group(function () {
        Route::controller(PanelController::class)->group(function () {
            // Clientes
            Route::get('/clientes', 'clientes');
            Route::get('/clientes/nuevo', 'clienteForm');
            Route::post('/clientes/nuevo', 'clienteStore');
            Route::get('/clientes/editar/{cliente}', 'clienteForm');
            Route::put('/clientes/editar/{cliente}', 'clienteUpdate');
            Route::delete('/clientes/eliminar/{cliente}', 'clienteDestroy');

            // Solicitudes (AQUÍ ESTABA EL CONFLICTO)
            Route::get('/solicitudes', 'solicitudes');
            Route::get('/solicitudes/editar/{solicitud}', 'solicitudForm');
            Route::put('/solicitudes/editar/{solicitud}', 'solicitudUpdate'); // Cambiado a PUT
            Route::delete('/solicitudes/eliminar/{solicitud}', 'solicitudDestroy');
        });

        // Consultorias
        Route::controller(\App\Http\Controllers\ConsultoriaController::class)->group(function () {
            Route::get('/consultorias', 'index');
            Route::get('/consultorias/nueva', [PanelController::class, 'consultoriaForm']);
            Route::post('/consultorias/nueva', 'store');
            Route::get('/consultorias/editar/{consultoria}', [PanelController::class, 'consultoriaForm']);
            Route::put('/consultorias/editar/{consultoria}', 'update');
            Route::delete('/consultorias/eliminar/{consultoria}', 'destroy');
        });

        // Usuarios
        Route::controller(PanelController::class)->group(function () {
            Route::get('/usuarios', 'usuarios');
            Route::get('/usuarios/nuevo', 'usuarioForm');
            Route::post('/usuarios/nuevo', 'usuarioStore');
            Route::get('/usuarios/editar/{usuario}', 'usuarioForm');
            Route::put('/usuarios/editar/{usuario}', 'usuarioUpdate');
            Route::delete('/usuarios/eliminar/{usuario}', 'usuarioDestroy');
        });
    });
});