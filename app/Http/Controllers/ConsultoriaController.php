<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultoria;

class ConsultoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultorias = Consultoria::all();
        return response()->json([
            'success' => true,
            'data' => $consultorias,
            'message' => __('messages.consultoria_list')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo' => 'required|string',
            'descripcion' => 'required|string',
        ]);

        $consultoria = Consultoria::create($validated);
        return response()->json([
            'success' => true,
            'data' => $consultoria,
            'message' => 'Consultoria creada exitosamente'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Consultoria $consultoria)
    {
        return response()->json([
            'success' => true,
            'data' => $consultoria,
            'message' => 'Consultoria obtenida correctamente'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consultoria $consultoria)
    {
        $validated = $request->validate([
            'tipo' => 'sometimes|required|string',
            'descripcion' => 'sometimes|required|string',
        ]);

        $consultoria->update($validated);

        return response()->json([
            'success' => true,
            'data' => $consultoria,
            'message' => 'Consultoria actualizada correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consultoria $consultoria)
    {
        $consultoria->delete();

        return response()->json([
            'success' => true,
            'message' => 'Consultoria eliminada correctamente'
        ]);
    }
}
