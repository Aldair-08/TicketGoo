<?php

namespace App\Http\Controllers;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::all(); // Asegúrate de tener el modelo importado
        return view('admin.GestionarProveedor', compact('proveedores'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.AgregarProveedor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'correo' => 'required|email|max:255',
        'telefono' => 'nullable|string|max:20',
        'empresa' => 'nullable|string|max:255',
        'estado' => 'required|in:ACTIVO,INACTIVO',
    ]);

    Proveedor::create($request->all());

    return redirect()->route('admin.proveedores.index')->with('success', 'Proveedor creado correctamente.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $proveedor = Proveedor::find($id);
        return view('admin.VerProveedor', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('admin.EditarProveedor', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'empresa' => 'nullable|string|max:255',
            'estado' => 'required|in:ACTIVO,INACTIVO',
        ]);

        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update($request->all());

        return redirect()->route('admin.proveedores.index')->with('success', 'Proveedor actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();

        return redirect()->route('admin.proveedores.index')->with('success', 'Proveedor eliminado correctamente.');
    }
}
