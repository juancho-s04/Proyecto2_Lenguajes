<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();

        if (! $user) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'No autenticado'], 401);
            }
            return redirect()->route('login')->with('errorMessage', 'Debes iniciar sesión primero.');
        }

        if ($user->rol?->nombre !== $role) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'No autorizado'], 403);
            }

            if ($user->rol?->nombre === 'CLIENTE') {
                return redirect('/user')->with('errorMessage', 'No tienes permisos de Administrador para ingresar a esta sección.');
            }

            return redirect('/')->with('errorMessage', 'No tienes autorización para ver esta sección.');
        }

        return $next($request);
    }
}