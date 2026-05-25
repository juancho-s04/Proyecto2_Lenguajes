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
        
        return view('consultorias.index', compact('consultorias'));
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

        Consultoria::create($validated);
        
        return redirect('/vista/admin/consultorias')->with('successMessage', 'Consultoría creada exitosamente');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('consultorias.create'); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $consultoria = Consultoria::findOrFail($id);
        return view('consultorias.edit', compact('consultoria')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $consultoria = Consultoria::findOrFail($id);

        $validated = $request->validate([
            'tipo' => 'sometimes|required|string',
            'descripcion' => 'sometimes|required|string',
        ]);

        $consultoria->update($validated);

        return redirect('/vista/admin/consultorias')->with('successMessage', 'Consultoría actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $consultoria = Consultoria::findOrFail($id);
        $consultoria->delete();

        return redirect('/vista/admin/consultorias')->with('successMessage', 'Consultoría eliminada correctamente');
    }
}