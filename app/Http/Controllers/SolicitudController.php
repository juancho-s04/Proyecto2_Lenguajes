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
            'nombreSolicitante' => 'required|string',
            'correoSolicitante' => 'required|email',
            'estado' => 'sometimes|required|in:PENDIENTE,EN_PROCESO,FINALIZADA',
            'fecha' => 'required|date',
            'usuarioId' => 'nullable|exists:users,id',
            'clienteId' => 'nullable|exists:clientes,id',
            'consultoriaId' => 'required|exists:consultorias,id',
        ]);

        $solicitud = Solicitud::create([
            'descripcion' => $validated['descripcion'],
            'nombre_solicitante' => $validated['nombreSolicitante'],
            'correo_solicitante' => $validated['correoSolicitante'],
            'estado' => $validated['estado'] ?? 'PENDIENTE',
            'fecha' => $validated['fecha'],
            'user_id' => $validated['usuarioId'] ?? null,
            'cliente_id' => $validated['clienteId'] ?? null,
            'consultoria_id' => $validated['consultoriaId'],
        ]);

        try {
            \Illuminate\Support\Facades\Mail::to($solicitud->correo_solicitante)
                ->send(new \App\Mail\SolicitudCreadaMail($solicitud));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error enviando correo de Gmail: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'data' => $solicitud,
            'message' => 'Solicitud creada exitosamente y correo de confirmación enviado'
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
            'nombreSolicitante' => 'sometimes|required|string',
            'correoSolicitante' => 'sometimes|required|email',
            'estado' => 'sometimes|required|in:PENDIENTE,EN_PROCESO,FINALIZADA',
            'fecha' => 'sometimes|required|date',
            'usuarioId' => 'nullable|exists:users,id',
            'clienteId' => 'nullable|exists:clientes,id',
            'consultoriaId' => 'sometimes|required|exists:consultorias,id',
        ]);

        $dataToUpdate = [];
        if ($request->has('descripcion')) $dataToUpdate['descripcion'] = $validated['descripcion'];
        if ($request->has('nombreSolicitante')) $dataToUpdate['nombre_solicitante'] = $validated['nombreSolicitante'];
        if ($request->has('correoSolicitante')) $dataToUpdate['correo_solicitante'] = $validated['correoSolicitante'];
        if ($request->has('estado')) $dataToUpdate['estado'] = $validated['estado'];
        if ($request->has('fecha')) $dataToUpdate['fecha'] = $validated['fecha'];
        if ($request->has('usuarioId')) $dataToUpdate['user_id'] = $validated['usuarioId'];
        if ($request->has('clienteId')) $dataToUpdate['cliente_id'] = $validated['clienteId'];
        if ($request->has('consultoriaId')) $dataToUpdate['consultoria_id'] = $validated['consultoriaId'];

        $solicitud->update($dataToUpdate);

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
