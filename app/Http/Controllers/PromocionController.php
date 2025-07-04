<?php

namespace App\Http\Controllers;

use App\Models\Promocion;
use App\Models\Evento;
use Illuminate\Http\Request;

class PromocionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promociones = Promocion::with('evento')->get(); // Cargar evento relacionado si existe relación
        return view('admin.GestionarPromociones', compact('promociones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $eventos = Evento::all(); // Para el dropdown de eventos
        return view('admin.AgregarPromocion', compact('eventos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:50',
            'valor' => 'required|numeric|min:0',
            'id_evento' => 'required|exists:eventos,id_evento',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $data = $request->all();
        $data['estado'] = $request->input('estado', 'ACTIVO');

        Promocion::create($data);

        return redirect()->route('admin.promociones.index')->with('success', 'Promoción creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $promocion = Promocion::with('evento')->findOrFail($id);
        return view('admin.VerPromocion', compact('promocion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $promocion = Promocion::findOrFail($id);
        $eventos = Evento::all(); // Para dropdown
        return view('admin.EditarPromocion', compact('promocion', 'eventos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:50',
            'valor' => 'required|numeric|min:0',
            'id_evento' => 'required|exists:eventos,id_evento',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $promocion = Promocion::findOrFail($id);

        $data = $request->all();
        $data['estado'] = $request->input('estado', 'ACTIVO');

        $promocion->update($data);

        return redirect()->route('admin.promociones.index')->with('success', 'Promoción actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $promocion = Promocion::findOrFail($id);
        $promocion->delete();

        return redirect()->route('admin.promociones.index')->with('success', 'Promoción eliminada exitosamente.');
    }
}
