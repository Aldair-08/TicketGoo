<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boleta de Compra - TicketGO</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .titulo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            color: #eda812;
        }

        .seccion {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #fafafa;
        }

        .label {
            font-weight: bold;
            color: #555;
            display: inline-block;
            min-width: 120px;
        }

        .value {
            color: #333;
        }

        .seccion div {
            margin-bottom: 8px;
            padding: 5px 0;
        }

        .seccion ul {
            margin: 10px 0;
            padding-left: 20px;
        }

        .seccion li {
            margin-bottom: 5px;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            color: #eda812;
            text-align: right;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 2px solid #eda812;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            color: #666;
            font-size: 14px;
        }

        .document-section {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }

        .document-section h3 {
            color: #856404;
            margin-top: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="titulo">Boleto de compra</div>

        <div class="seccion">
            <div><span class="label">Nombre de cuenta:</span> <span class="value">{{ $nombre_cuenta ?? $compra->usuario->name }}</span>
            </div>
            <div><span class="label">DNI:</span> <span class="value">{{ $dni ?? $compra->usuario->dni }}</span></div>
            <div><span class="label">Correo:</span> <span class="value">{{ $correo ?? $compra->usuario->email }}</span></div>
            <div><span class="label">Evento:</span> <span
                    class="value">{{ $evento ?? ($compra->evento->nombre ?? 'Evento no disponible') }}</span></div>
            <div><span class="label">Fecha del evento:</span> <span
                    class="value">{{ $fecha ?? ($compra->evento->fecha_evento_formateada ?? 'Por definir') }}</span></div>
            <div><span class="label">Ubicación:</span> <span
                    class="value">{{ $ubicacion ?? ($compra->evento->ubicacion ?? 'Por definir') }}</span></div>
            <div><span class="label">Fecha de pago:</span> <span
                    class="value">{{ $fecha_pago ?? ($compra->fecha_pago ? $compra->fecha_pago->format('d/m/Y H:i') : now()->format('d/m/Y H:i')) }}</span>
            </div>
        </div>

        <div class="seccion">
            <div class="label">Entradas compradas:</div>
            <ul>
                @if(isset($entradas))
                    @foreach ($entradas as $entrada)
                        <li>{{ $entrada['cantidad'] }} {{ $entrada['tipo'] }} - S/.
                            {{ number_format($entrada['subtotal'], 2) }}</li>
                    @endforeach
                @else
                    @foreach ($compra->detalles as $detalle)
                        <li>{{ $detalle->cantidad }} {{ strtoupper($detalle->tipo_ticket) }} - S/.
                            {{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}</li>
                    @endforeach
                @endif
            </ul>
            @if(isset($subtotal_entradas) && isset($costo_entrega))
                <div style="margin-top: 10px; padding: 5px 0;">
                    <div style="display: flex; justify-content: space-between;">
                        <span>Subtotal entradas:</span>
                        <span>S/. {{ number_format($subtotal_entradas, 2) }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>Costo de entrega:</span>
                        <span>S/. {{ number_format($costo_entrega, 2) }}</span>
                    </div>
                </div>
                <div class="total">TOTAL: S/. {{ number_format($total, 2) }}</div>
            @else
                @php
                    $subtotal_entradas = $compra->detalles->sum(function($detalle) {
                        return $detalle->cantidad * $detalle->precio_unitario;
                    });
                    $costo_entrega = $compra->formato_entrega == 'retiro' ? 10 : 0;
                @endphp
                <div style="margin-top: 10px; padding: 5px 0;">
                    <div style="display: flex; justify-content: space-between;">
                        <span>Subtotal entradas:</span>
                        <span>S/. {{ number_format($subtotal_entradas, 2) }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>Costo de entrega:</span>
                        <span>S/. {{ number_format($costo_entrega, 2) }}</span>
                    </div>
                </div>
                <div class="total">TOTAL: S/. {{ number_format($compra->total, 2) }}</div>
            @endif
        </div>

        <div class="seccion">
            <div class="label">Método de pago:</div>
            <span class="value">{{ $datosPago['metodo'] ?? 'No especificado' }}</span>
            @if (isset($datosPago['detalles']) && !empty($datosPago['detalles']))
                <div style="margin-top: 10px; padding: 10px; background-color: #f8f9fa; border-radius: 5px; border-left: 4px solid #eda812;">
                    {!! is_string($datosPago['detalles']) ? $datosPago['detalles'] : json_encode($datosPago['detalles'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
                </div>
            @endif
        </div>

        <div class="seccion">
            <div class="label">Forma de entrega:</div>
            <span class="value">
                @if(isset($forma_entrega))
                    @if($forma_entrega == 'eticket')
                        E-Ticket por correo electrónico (S/ 0)
                    @elseif($forma_entrega == 'retiro')
                        Retiro en tienda (Lima - Santa Anita - Mall Aventuras) (S/ 10)
                    @else
                        {{ ucfirst($forma_entrega) }}
                    @endif
                @else
                    @if($compra->formato_entrega == 'eticket')
                        E-Ticket por correo electrónico (S/ 0)
                    @elseif($compra->formato_entrega == 'retiro')
                        Retiro en tienda (Lima - Santa Anita - Mall Aventuras) (S/ 10)
                    @else
                        {{ ucfirst($compra->formato_entrega ?? 'No especificado') }}
                    @endif
                @endif
            </span>
        </div>

        <div class="document-section">
            <h3>📎 Documento Adjunto</h3>
            <p style="margin: 0; color: #856404;">
                <strong>Se ha adjuntado la boleta oficial</strong> de esta compra en formato PDF.
                Este documento es tu comprobante oficial de pago y debe ser conservado.
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} TicketGO. Todos los derechos reservados.</p>
            <p>Esta boleta es tu comprobante oficial de pago.</p>
            <p>Para cualquier consulta, contacta a nuestro soporte.</p>
        </div>
    </div>
</body>

</html>
