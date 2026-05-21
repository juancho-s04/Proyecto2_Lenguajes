<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return response()->json([
            'success' => true,
            'data' => $clientes,
            'message' => __('messages.cliente_list')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'telefono' => 'required|string',
            'empresa' => 'nullable|string',
            'correo' => 'required|email|unique:clientes,correo',
        ]);

        $cliente = Cliente::create($validated);
        return response()->json([
            'success' => true,
            'data' => $cliente,
            'message' => 'Cliente creado exitosamente'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        return response()->json([
            'success' => true,
            'data' => $cliente,
            'message' => 'Cliente obtenido correctamente'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $validated = $request->validate([
            'nombre' => 'sometimes|required|string',
            'telefono' => 'sometimes|required|string',
            'empresa' => 'nullable|string',
            'correo' => 'sometimes|required|email|unique:clientes,correo,' . $cliente->id,
        ]);
        $cliente->update($validated);
        return response()->json([
            'success' => true,
            'data' => $cliente,
            'message' => 'Cliente actualizado correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return response()->json([
            'success' => true,
            'message' => 'Cliente eliminado correctamente'
        ]);
    }
}
