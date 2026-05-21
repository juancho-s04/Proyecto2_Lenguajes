<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $Solicitudes = Solicitud::all();
        return response()->json([
            'success' => true,
            'data' => $Solicitudes,
            'message' => __('messages.solicitud_list')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
           'descripcion' => 'required|string',
           'nombre_solicitante' => 'required|string',
           'correo_solicitante' => 'required|email',
           'estado' => 'sometimes|required|in:PENDIENTE,EN_PROCESO,FINALIZADA',
           'fecha' => 'required|date',
           'user_id' => 'nullable|exists:users,id',
           'cliente_id' => 'nullable|exists:clientes,id',
           'consultoria_id' => 'required|exists:consultorias,id',
        ]);

        $solicitud = Solicitud::create($validated);
        return response()->json([
            'success' => true,
            'data' => $solicitud,
            'message' => 'Solicitud creada exitosamente'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Solicitud $solicitud)
    {
        return response()->json([
            'success' => true,
            'data' => $solicitud,
            'message' => 'Solicitud obtenida correctamente'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        $validated = $request->validate([
           'descripcion' => 'sometimes|required|string',
           'nombre_solicitante' => 'sometimes|required|string',
           'correo_solicitante' => 'sometimes|required|email',
           'estado' => 'sometimes|required|in:PENDIENTE,EN_PROCESO,FINALIZADA',
           'fecha' => 'sometimes|required|date',
           'user_id' => 'nullable|exists:users,id',
           'cliente_id' => 'nullable|exists:clientes,id',
           'consultoria_id' => 'sometimes|required|exists:consultorias,id',
        ]);
        $solicitud->update($validated);
        return response()->json([
            'success' => true,
            'data' => $solicitud,
            'message' => 'Solicitud actualizada correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Solicitud $solicitud)
    {
         $solicitud->delete();
        return response()->json([
            'success' => true,
            'message' => 'Solicitud eliminada correctamente'
        ]);
    }
}
