<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher de Compra - TicketGO</title>
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
        .header {
            text-align: center;
            background: linear-gradient(135deg, #eda812 0%, #f39c12 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 14px;
        }
        .section {
            margin-bottom: 25px;
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #fafafa;
        }
        .section h2 {
            color: #eda812;
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 18px;
            border-bottom: 2px solid #eda812;
            padding-bottom: 5px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            padding: 5px 0;
        }
        .info-label {
            font-weight: bold;
            color: #555;
        }
        .info-value {
            color: #333;
        }
        .ticket-item {
            background-color: white;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border-left: 4px solid #eda812;
        }
        .total-section {
            background-color: #eda812;
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            color: #666;
            font-size: 14px;
        }
        .instructions {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }
        .instructions h3 {
            color: #856404;
            margin-top: 0;
        }
        .instructions ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        .instructions li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎫 VOUCHER DE COMPRA</h1>
            <p>¡Gracias por tu compra en TicketGO!</p>
        </div>

        <div class="section">
            <h2>📋 Información de la Compra</h2>
            <div class="info-row">
                <span class="info-label">Número de Orden:</span>
                <span class="info-value">TG-{{ $compra->id }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Fecha de Compra:</span>
                <span class="info-value">{{ $compra->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Estado:</span>
                <span class="info-value">{{ ucfirst($compra->estado) }}</span>
            </div>
        </div>

        @if($evento)
        <div class="section">
            <h2>🎭 Información del Evento</h2>
            <div class="info-row">
                <span class="info-label">Evento:</span>
                <span class="info-value">{{ $evento->nombre }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Fecha:</span>
                <span class="info-value">{{ $evento->fecha ? \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y H:i') : 'Por definir' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Lugar:</span>
                <span class="info-value">{{ $evento->ubicacion ?? 'Por definir' }}</span>
            </div>
        </div>
        @endif

        <div class="section">
            <h2>🎟️ Tickets Comprados</h2>
            @foreach($detalles as $detalle)
            <div class="ticket-item">
                <div class="info-row">
                    <span class="info-label">{{ $detalle->cantidad }}x {{ strtoupper($detalle->tipo_ticket) }}</span>
                    <span class="info-value">S/ {{ number_format($detalle->precio_unitario, 2) }} c/u</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Subtotal:</span>
                    <span class="info-value">S/ {{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}</span>
                </div>
            </div>
            @endforeach
        </div>

        <div class="total-section">
            <div class="info-row">
                <span class="info-label">TOTAL PAGADO:</span>
                <span class="info-value">S/ {{ number_format($compra->total, 2) }}</span>
            </div>
        </div>

        <div class="section">
            <h2>👤 Información del Comprador</h2>
            <div class="info-row">
                <span class="info-label">Nombre:</span>
                <span class="info-value">{{ $usuario->name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Email:</span>
                <span class="info-value">{{ $usuario->email }}</span>
            </div>
            @if($usuario->dni)
            <div class="info-row">
                <span class="info-label">DNI:</span>
                <span class="info-value">{{ $usuario->dni }}</span>
            </div>
            @endif
            @if($usuario->phone)
            <div class="info-row">
                <span class="info-label">Celular:</span>
                <span class="info-value">{{ $usuario->phone }}</span>
            </div>
            @endif
        </div>

        <div class="instructions">
            <h3>📝 Instrucciones Importantes</h3>
            <ul>
                <li>Presenta este voucher al ingresar al evento</li>
                <li>Llega con anticipación al lugar del evento</li>
                <li>Este voucher es válido solo para la fecha indicada</li>
                <li>Conserva este email como comprobante de tu compra</li>
                <li>Para cualquier consulta, contacta a nuestro soporte</li>
            </ul>
        </div>

        <div class="section" style="background-color: #e8f4fd; border-color: #bee5eb;">
            <h2 style="color: #0c5460;">📎 Documento Adjunto</h2>
            <p style="margin: 0; color: #0c5460;">
                <strong>Se ha adjuntado un PDF oficial</strong> de este voucher que puedes descargar e imprimir. 
                Este documento contiene toda la información necesaria para el ingreso al evento.
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} TicketGO. Todos los derechos reservados.</p>
            <p>Este es un email automático, por favor no respondas a este mensaje.</p>
        </div>
    </div>
</body>
</html> 