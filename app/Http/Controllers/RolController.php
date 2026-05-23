<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Rol::all();
        return response()->json([
            'success' => true,
            'data' => $roles,
            'message' => __('messages.rol_list')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|unique:roles,nombre',
            'descripcion' => 'nullable|string',
        ]);

        $rol = Rol::create($validated);
        return response()->json([
            'success' => true,
            'data' => $rol,
            'message' => 'Rol creado exitosamente'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rol $rol)
    {
       return response()->json([
            'success' => true,
            'data' => $rol,
            'message' => 'Rol obtenido correctamente'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rol $rol)
    {
        $validated = $request->validate([
            'nombre' => 'sometimes|required|string|unique:roles,nombre,' . $rol->id,
            'descripcion' => 'nullable|string',
        ]);

        $rol->update($validated);

        return response()->json([
            'success' => true,
            'data' => $rol,
            'message' => 'Rol actualizado correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rol $rol)
    {
         $rol->delete();
        return response()->json([
            'success' => true,
            'message' => 'Rol eliminado correctamente'
        ]);
    }
}
