<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\CompraDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraDetalleController extends Controller
{
    public function guardarDetalle(Request $request)
    {
        $precios = [
            'vip' => 345.00,
            'preferencial' => 288.00,
            'general' => 173.00,
        ];

        $tickets = [];
        $total = 0;

        foreach (['vip', 'preferencial', 'general'] as $tipo) {
            $cantidad = (int) $request->input($tipo, 0);
            $precio = $precios[$tipo];
            $subtotal = $cantidad * $precio;

            $tickets[$tipo] = [
                'cantidad' => $cantidad,
                'precio' => $precio,
                'subtotal' => $subtotal,
            ];

            $total += $subtotal;
        }

        // Guardar temporalmente en sesión
        session(['tickets' => $tickets, 'total' => $total]);

        return redirect()->route('elegirduki')->with('success', 'Selecciona tu método de entrega.');
    }

    public function mostrarVistaEntrega()
    {
        $tickets = session('tickets', []);
        $tipos = ['vip', 'preferencial', 'general'];

        foreach ($tipos as $tipo) {
            if (!isset($tickets[$tipo])) {
                $tickets[$tipo] = ['cantidad' => 0, 'precio' => 0, 'subtotal' => 0];
            }
        }

        $total = session('total', 0);

        return view('usuario.elegirduki', compact('tickets', 'total'));
    }


   public function guardarFormatoEntrega(Request $request)
    {
        $formato = $request->input('formato_entrega');
        $tickets = session('tickets', []);
        $total = session('total', 0);

        // Si seleccionó retiro en tienda, sumamos 12
        if ($formato === 'retiro') {
            $total += 12;
        }

        // Crear compra
        $compra = Compra::create([
            'usuario_id' => Auth::id() ?? 1, // Asume ID 1 si no hay login
            'evento_id' => session('evento_id'),
            'total' => $total,
            'estado' => 'pendiente',
            'formato_entrega' => $formato,
        ]);

        foreach ($tickets as $tipo => $ticket) {
            if ($ticket['cantidad'] > 0) {
                CompraDetalle::create([
                    'compra_id' => $compra->id,
                    'tipo_ticket' => strtoupper($tipo),
                    'cantidad' => $ticket['cantidad'],
                    'precio_unitario' => $ticket['precio'],
                ]);
            }
        }

        // Limpiar sesión
        session()->forget(['tickets', 'total', 'evento_id']);

        return redirect()->route('welcome')->with('success', 'Compra y método de entrega registrados.');
    } 
}
