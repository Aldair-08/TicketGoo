<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Carrusel;
use App\Models\Evento;

class CarruselController extends Controller
{
    public function index()
    {
        $imagenes = \App\Models\Carrusel::all();
        $eventos = \App\Models\Evento::whereNotNull('imagen')->get();
        return view('admin.carrusel.index', compact('imagenes', 'eventos'));
    }

    public function create()
    {
        return view('admin.carrusel.create');
    }

    public function store(Request $request)
    {
        if ($request->has('ruta')) {
            // Añadir imagen de evento
            \App\Models\Carrusel::create(['ruta' => $request->input('ruta')]);
        } else {
            $request->validate([
                'imagen' => 'required|image|max:5120',
            ]);
            $ruta = $request->file('imagen')->store('carrusel', 'public');
            \App\Models\Carrusel::create(['ruta' => $ruta]);
        }

        return redirect()->route('admin.carrusel.index')->with('success', 'Imagen añadida correctamente.');
    }

    public function edit(string $id)
    {
        $imagen = Carrusel::findOrFail($id);
        return view('admin.carrusel.edit', compact('imagen'));
    }

    public function update(Request $request, string $id)
    {
        $carrusel = Carrusel::findOrFail($id);

        $request->validate([
            'imagen' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            Storage::disk('public')->delete($carrusel->ruta);

            $ruta = $request->file('imagen')->store('carrusel', 'public');
            $carrusel->ruta = $ruta;
        }

        $carrusel->save();

        return redirect()->route('admin.carrusel.index')->with('success', 'Imagen actualizada correctamente.');
    }

    public function destroy($id)
    {
        $carrusel = Carrusel::findOrFail($id);

        // Verifica si la imagen está asociada a un evento
        $esImagenDeEvento = \App\Models\Evento::where('imagen', $carrusel->ruta)->exists();

        if (!$esImagenDeEvento) {
            // Si NO es de evento, elimina el archivo físico
            Storage::disk('public')->delete($carrusel->ruta);
        }

        // En ambos casos, elimina el registro del carrusel
        $carrusel->delete();

        return redirect()->route('admin.carrusel.index')->with('success', 'Imagen quitada del carrusel correctamente.');
    }

    public function welcome()
    {
        $eventos = Evento::all();
        $imagenes = Carrusel::all();
        return view('welcome', compact('eventos', 'imagenes'));
    }
}
