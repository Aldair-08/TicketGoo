<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\CompraDetalle;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{

    public function guardarCompra(Request $request)
    {
        $data = $request->validate([
            'formato_entrega' => 'required|in:eticket,retiro',
        ]);

        $tickets = session('tickets', []);

        if (empty($tickets)) {
            return redirect()->route('elegir.formato')->with('error', 'No hay tickets seleccionados');
        }

        // Calcular total real
        $total = 0;
        foreach ($tickets as $ticket) {
            $total += $ticket['cantidad'] * $ticket['precio'];
        }

        if ($data['formato_entrega'] === 'retiro') {
            $total += 12;
        }

        $compra = Compra::create([
            'usuario_id' => Auth::id(),
            'formato_entrega' => $data['formato_entrega'],
            'total' => $total,
            'estado' => 'pendiente',
            'fecha' => now(), // ✅ Guarda la fecha para mostrar en el voucher
        ]);

        foreach ($tickets as $tipo => $ticket) {
            if ($ticket['cantidad'] > 0) {
                CompraDetalle::create([
                    'compra_id' => $compra->id,
                    'tipo_ticket' => strtoupper($tipo),
                    'cantidad' => $ticket['cantidad'],
                    'precio_unitario' => $ticket['precio'],
                    'subtotal' => $ticket['cantidad'] * $ticket['precio'],
                ]);
            }
        }

        // Limpia la sesión para evitar confusión
        session()->forget(['tickets', 'total']);

        return redirect()->route('pagoduki')->with('success', 'Compra registrada correctamente');
    }
    public function vistaPago()
    {
        $user = Auth::user();

        $compra = Compra::with('detalles')
            ->where('usuario_id', $user->id)
            ->where('estado', 'pendiente')
            ->latest()
            ->first();

        if (!$compra) {
            return redirect()->route('inicio')->with('error', 'No hay compra pendiente');
        }

        // Calculamos el resumen igual que en mostrarPagoFinal
        $resumen = $compra->detalles->map(function ($detalle) {
            return [
                'descripcion' => $detalle->cantidad . ' TICKET ' . strtoupper($detalle->tipo_ticket),
                'precio' => $detalle->precio_unitario,
                'total' => $detalle->cantidad * $detalle->precio_unitario,
            ];
        });

        $totalFinal = number_format($compra->total, 2);

        return view('pago.pagoduki', compact('compra', 'resumen', 'totalFinal'));
    }


    public function pagar(Request $request)
    {
        $compra = Compra::find($request->compra_id);

        if (!$compra || $compra->estado != 'pendiente') {
            return redirect()->back()->with('error', 'Compra inválida o ya pagada.');
        }

        $compra->estado = 'pagado';
        $compra->save();

        return redirect()->route('pago.exito')->with('mensaje', '¡Pago realizado con éxito!');
    }


    public function mostrarPagoFinal()
    {
        $usuarioId = Auth::id();
        $compra = Compra::with('detalles')
            ->where('usuario_id', $usuarioId)
            ->where('estado', 'pendiente')
            ->whereHas('detalles')
            ->latest()
            ->first();

        if (!$compra) {
            return redirect()->route('inicio')->with('error', 'No se encontró una compra activa asociada a tu cuenta.');
        }

        //  Generar resumen para la vista identificadorduki
        $resumen = $compra->detalles->map(function ($detalle) {
            return [
                'descripcion' => $detalle->cantidad . ' TICKET ' . strtoupper($detalle->tipo_ticket),
                'precio' => $detalle->precio_unitario,
                'total' => $detalle->cantidad * $detalle->precio_unitario,
            ];
        });

        $totalFinal = $compra->total;

        return view('usuario.pagoduki', compact('resumen', 'totalFinal', 'compra'));
    }

    public function eliminarDetalle($detalleId)
    {
        $detalle = CompraDetalle::find($detalleId);

        if ($detalle) {
            $compra = $detalle->compra;
            $detalle->delete();

            //  Si ya no hay más detalles, elimina la compra también
            if ($compra->detalles()->count() === 0) {
                $compra->delete();
                return redirect()->route('inicio')->with('warning', 'No hay más tickets en tu compra.');
            }

            return redirect()->back()->with('success', 'Ticket eliminado correctamente.');
        }

        return redirect()->back()->with('error', 'No se pudo eliminar el ticket.');
    }
    public function confirmarPedido()
    {
        $usuarioId = Auth::id();

        // Buscar la última compra pendiente del usuario con sus detalles
        $compra = Compra::with('detalles')
            ->where('usuario_id', $usuarioId)
            ->where('estado', 'pendiente')
            ->latest()
            ->first();

        if (!$compra) {
            return redirect()->route('inicio')->with('error', 'No hay compra activa que confirmar.');
        }

        // Crear resumen para la vista
        $resumen = $compra->detalles->map(function ($detalle) {
            return [
                'descripcion' => $detalle->cantidad . ' TICKET ' . strtoupper($detalle->tipo_ticket),
                'precio_unitario' => number_format($detalle->precio_unitario, 2),
                'subtotal' => number_format($detalle->cantidad * $detalle->precio_unitario, 2),
            ];
        });

        // Calcular total final
        $totalFinal = number_format($compra->total, 2);

        return view('usuario.confirmar_pedido', compact('resumen', 'totalFinal'));
    }

    public function confirmarCompra(Request $request)
    {
        // Paso 1: Crear la compra
        $compra = new Compra();
        $compra->usuario_id = Auth::id(); // o $request->usuario_id si no estás autenticando
        $compra->fecha = now();
        $compra->total = $request->total;
        $compra->estado = 'Confirmada';
        $compra->save();

        // Paso 2: Agregar los detalles de los tickets
        foreach ($request->entradas as $entrada) {
            $detalle = new CompraDetalle();
            $detalle->compra_id = $compra->id;
            $detalle->tipo_ticket = $entrada['tipo'];
            $detalle->cantidad = $entrada['cantidad'];
            $detalle->precio_unitario = $entrada['precio'];
            $detalle->save();
        }

        // Paso 3: Redirigir a la vista del voucher
        return redirect()->route('voucher.mostrar', ['id' => $compra->id]);
    }
    public function mostrarVoucher($id)
    {
        $compra = Compra::with(['detalles', 'usuario'])->findOrFail($id);

        return view('usuario.vaucherduki', compact('compra'));
    }

    public function vistaVaucher()
    {
        $compraId = session('compra_id');

        if (!$compraId) {
            return redirect()->route('home')->with('error', 'No hay una compra activa.');
        }

        $compra = Compra::with(['detalles', 'usuario'])->find($compraId);

        if (!$compra) {
            return redirect()->route('home')->with('error', 'Compra no encontrada.');
        }

        return view('usuario.vaucherduki', ['compra' => $compra]); 
    }


    public function mostrarIdentificador($compra_id)
    {
        $compra = Compra::with('detalles')->findOrFail($compra_id);

        // Asegurar que el usuario accede solo a su propia compra
        if ($compra->usuario_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver esta compra');
        }

        $resumen = $compra->detalles->map(function ($detalle) {
            return [
                'descripcion' => $detalle->cantidad . ' TICKET ' . strtoupper($detalle->tipo_ticket),
                'precio' => $detalle->precio_unitario,
                'total' => $detalle->cantidad * $detalle->precio_unitario,
            ];
        });

        $totalFinal = $compra->detalles->sum(function ($detalle) {
            return $detalle->cantidad * $detalle->precio_unitario;
        });

        return view('usuario.identificadorduki', compact('compra', 'resumen', 'totalFinal'));
    }
}
