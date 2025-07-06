<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\CompraDetalle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'evento_id' => session('evento_id'),
            'formato_entrega' => $data['formato_entrega'],
            'total' => $total,
            'estado' => 'pendiente',
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
        session()->forget(['tickets', 'total', 'evento_id']);

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
            return response()->json(['success' => false, 'message' => 'Compra inválida o ya pagada.'], 400);
        }

        $compra->estado = 'pagado';
        $compra->save();

        return response()->json(['success' => true, 'message' => '¡Pago realizado con éxito!']);
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
        $compra = Compra::create([
            'usuario_id' => Auth::id(),
            'total' => $request->total,
            'estado' => 'Confirmada',
        ]);

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

        return view('usuario.vaucher', compact('compra'));
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
    //nuevo
    public function index($id_evento)
    {
        $evento = \App\Models\Evento::with('entradas')->where('id_evento', $id_evento)->firstOrFail();
        $promociones = \App\Models\Promocion::where('id_evento', $evento->id_evento)
            ->where('estado', 'ACTIVO')
            ->get();
        return view('usuario.comprar', compact('evento', 'promociones'));
    }

    public function procesarCompra(Request $request)
    {
        DB::beginTransaction();
        try {
            $eventoId = null;
            $total = 0;
            $tickets = [];
            
            foreach ($request->entradas as $entradaId => $cantidad) {
                $entrada = \App\Models\Entrada::find($entradaId);
                if (!$entrada || $entrada->stock < $cantidad) {
                    throw new \Exception('Stock insuficiente para una de las entradas.');
                }
                
                // Obtener el evento_id de la primera entrada
                if ($eventoId === null) {
                    $eventoId = $entrada->evento_id;
                }
                
                // Calcular total y preparar tickets
                $subtotal = $cantidad * $entrada->precio;
                $total += $subtotal;
                
                $tickets[$entrada->tipo] = [
                    'cantidad' => $cantidad,
                    'precio' => $entrada->precio,
                    'subtotal' => $subtotal,
                ];
                
                $entrada->stock -= $cantidad;
                $entrada->save();
            }
            
            // Guardar el evento_id y tickets en la sesión
            if ($eventoId) {
                session(['evento_id' => $eventoId, 'tickets' => $tickets, 'total' => $total]);
            }
            
            // Crear la compra
            $compra = Compra::create([
                'usuario_id' => Auth::id(),
                'evento_id' => $eventoId,
                'total' => $total,
                'estado' => 'pendiente',
                'formato_entrega' => 'eticket',
            ]);
            
            // Crear los detalles de la compra
            foreach ($tickets as $tipo => $ticket) {
                CompraDetalle::create([
                    'compra_id' => $compra->id,
                    'tipo_ticket' => strtoupper($tipo),
                    'cantidad' => $ticket['cantidad'],
                    'precio_unitario' => $ticket['precio'],
                    'subtotal' => $ticket['subtotal'],
                ]);
            }
            
            DB::commit();
            return response()->json(['success' => true, 'compra_id' => $compra->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function descargarBoleta(Request $request)
    {
        // Recibe los datos de la compra desde el frontend
        $data = $request->all();

        // Renderiza una vista Blade como PDF
        $pdf = Pdf::loadView('usuario.boleta_pdf', $data)->setPaper([0, 0, 350, 580]);

        // Descarga el archivo
        return $pdf->download('boleta_ticketgo.pdf');
    }

    public function mostrarCompras()
    {
        $usuarioId = Auth::id();
        
        // Obtener todas las compras del usuario con sus detalles y evento
        $compras = Compra::with(['detalles', 'evento'])
            ->where('usuario_id', $usuarioId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('usuario.compras', compact('compras'));
    }

    public function mostrarVoucherCompra($compra_id)
    {
        $compra = Compra::with(['detalles', 'evento', 'usuario'])->findOrFail($compra_id);

        // Asegurar que el usuario accede solo a su propia compra
        if ($compra->usuario_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver esta compra');
        }

        // Verificar que la compra esté pagada
        if ($compra->estado !== 'pagado') {
            abort(403, 'Esta compra no ha sido pagada');
        }

        // Preparar resumen de tickets
        $resumen = $compra->detalles->map(function ($detalle) {
            return [
                'descripcion' => $detalle->cantidad . ' TICKET ' . strtoupper($detalle->tipo_ticket),
                'precio' => $detalle->precio_unitario,
                'total' => $detalle->cantidad * $detalle->precio_unitario,
            ];
        });

        $totalFinal = $compra->total;

        return view('usuario.voucher_compra', compact('compra', 'resumen', 'totalFinal'));
    }
}
