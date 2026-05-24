<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConsultoriaController;
use App\Http\Controllers\SolicitudController;

Route::middleware(['auth:sanctum', 'role:ADMINISTRADOR'])->group(function () {
    Route::apiResource('usuarios', UserController::class);
    Route::apiResource('roles', RolController::class)->parameters(['roles' => 'rol']);
    Route::apiResource('clientes', ClienteController::class);
    Route::apiResource('consultorias', ConsultoriaController::class);
    Route::apiResource('solicitudes', SolicitudController::class)->parameters(['solicitudes' => 'solicitud']);
});

Route::post('/registro', [UserController::class, 'register']);

// Login
Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();
    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Credenciales inválidas'], 401);
    }

    $token = $user->createToken('token')->plainTextToken;
    return response()->json([
        'token' => $token,
        'rol' => $user->rol?->nombre,
        'user' => $user->load('rol'),
    ]);
});

// Logout
Route::post('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();
    return response()->json(['message' => 'Sesión cerrada']);
})->middleware('auth:sanctum');

// Ruta protegida de ejemplo
Route::middleware('auth:sanctum')->get('/perfil', function (Request $request) {
    return $request->user();
});
