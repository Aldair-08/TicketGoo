<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    /**
     * Simula la subida del documento (no guarda realmente).
     */
    public function simular(Request $request)
    {
        $request->validate([
            'documento' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Respuesta JSON simulando éxito
        return response()->json(['mensaje' => 'Documento subido correctamente.'], 200);
    }
}
