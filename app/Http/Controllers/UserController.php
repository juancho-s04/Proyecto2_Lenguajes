<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'telefono' => 'nullable|string|max:50',
            'empresa' => 'nullable|string|max:255',
        ]);

        $clienteRol = Rol::where('nombre', 'CLIENTE')->firstOrFail();

        $data['password'] = Hash::make($data['password']);
        $data['rol_id'] = $clienteRol->id;

        $usuario = User::create($data);

        return response()->json([
            'success' => true,
            'data' => $usuario->load('rol'),
            'message' => 'Usuario registrado exitosamente'
        ], 201);
    }

    public function registerWeb(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'telefono' => 'nullable|string|max:50',
            'empresa' => 'nullable|string|max:255',
        ]);

        $clienteRol = Rol::where('nombre', 'CLIENTE')->firstOrFail();

        $data['password'] = Hash::make($data['password']);
        $data['rol_id'] = $clienteRol->id;

        User::create($data);

        return redirect('/login')->with('successMessage', 'Cuenta creada correctamente. Ya puedes iniciar sesion.');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::with('rol')->get();
        return response()->json([
            'success' => true,
            'data' => $usuarios
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'telefono' => 'nullable|string|max:50',
            'empresa' => 'nullable|string|max:255',
            'rol_id' => 'required|exists:roles,id',
        ]);

        $data['password'] = Hash::make($data['password']);

        $usuario = User::create($data);

        return response()->json([
            'success' => true,
            'data' => $usuario,
            'message' => 'Usuario creado exitosamente'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $usuario)
    {
        return response()->json([
            'success' => true,
            'data' => $usuario->load('rol'),
            'message' => 'Usuario obtenido correctamente'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $usuario)
    {
        $data = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $usuario->id,
            'password' => 'sometimes|nullable|string|min:6',
            'telefono' => 'nullable|string|max:50',
            'empresa' => 'nullable|string|max:255',
            'rol_id' => 'sometimes|required|exists:roles,id',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $usuario->update($data);

        return response()->json([
            'success' => true,
            'data' => $usuario,
            'message' => 'Usuario actualizado exitosamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        $usuario->delete();
        return response()->json([
            'success' => true,
            'message' => 'Usuario eliminado'
        ]);
    }
}
