<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Proveedor;
use App\Models\Carrusel;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = \App\Models\Evento::all();
        return view('admin.eventos.index', compact('eventos'));
    }

    public function create()
    {
        $proveedores = \App\Models\Proveedor::where('estado', 'ACTIVO')->get();
        return view('admin.AgregarEvento', compact('proveedores'));
    }

    public function store(Request $request)
    {
        $evento = new Evento();
        $evento->nombre = $request->nombre;
        $evento->categoria = $request->categoria;
        $evento->descripcion = $request->descripcion;
        $evento->fecha = $request->fecha;
        $evento->ubicacion = $request->ubicacion;
        $evento->id_proveedor = $request->id_proveedor;

        // si hay imagen
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('eventos', 'public');
            $evento->imagen = $path;
        }

        if ($request->hasFile('imagen_fondo')) {
            $pathFondo = $request->file('imagen_fondo')->store('eventos', 'public');
            $evento->imagen_fondo = $pathFondo;
        }

        $evento->save();
        return redirect()->route('admin.eventos.index')->with('success', 'Evento registrado');
    }

    public function edit($id)
    {
        $evento = Evento::findOrFail($id);
        $proveedores = Proveedor::all();
        return view('admin.eventos.edit', compact('evento', 'proveedores'));
    }

    public function update(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);
        $evento->update($request->except('_token', '_method'));

        return redirect()->route('admin.eventos.index')->with('success', 'Evento actualizado');
    }

    public function destroy($id)
    {
        Evento::destroy($id);
        return back()->with('success', 'Evento eliminado');
    }
    public function gestionar($id)
    {
        $evento = \App\Models\Evento::findOrFail($id);
        return view('admin.eventos.gestionar', compact('evento'));
    }

    public function publicar(Request $request, $id)
    {
        $request->validate([
            'precio_vip' => 'required|numeric|min:0',
            'stock_vip' => 'required|integer|min:0',
            'ticket_vip' => 'required|integer|min:1',
            'precio_general' => 'required|numeric|min:0',
            'stock_general' => 'required|integer|min:0',
            'ticket_general' => 'required|integer|min:1',
            'precio_preferencial' => 'required|numeric|min:0',
            'stock_preferencial' => 'required|integer|min:0',
            'ticket_preferencial' => 'required|integer|min:1',
        ]);

        $evento = \App\Models\Evento::findOrFail($id);

        // Guardar entradas (VIP, GENERAL, PREFERENCIAL)
        $tipos = ['vip', 'general', 'preferencial'];
        foreach ($tipos as $tipo) {
            \App\Models\Entrada::updateOrCreate(
                ['evento_id' => $evento->id_evento, 'tipo' => strtoupper($tipo)],
                [
                    'precio' => $request->input("precio_$tipo"),
                    'stock' => $request->input("stock_$tipo"),
                    'ticket_por_persona' => $request->input("ticket_$tipo"),
                ]
            );
        }

        // Marcar evento como publicado
        $evento->publicado = true;
        $evento->save();

        return redirect()->route('admin.eventos.index')->with('success', '¡Evento publicado correctamente!');
    }

    public function publicos()
    {
        $eventos = \App\Models\Evento::where('publicado', true)->get();
        return view('usuario.eventos', compact('eventos'));
    }

    public function explorar()
    {
        $eventos = \App\Models\Evento::where('publicado', true)->get();
        return view('welcome', compact('eventos'));
    }

    public function usuarioEventos()
    {
        $eventos = \App\Models\Evento::where('publicado', 1)->get();
        $imagenes = Carrusel::all();
        return view('usuario.principallog', compact('eventos', 'imagenes'));
    }

    public function show($id)
    {
        $evento = Evento::with('entradas')->findOrFail($id);
        return view('usuario.detalleevento', compact('evento'));
    }
}
