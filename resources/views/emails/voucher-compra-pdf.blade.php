<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher de Compra - TicketGO</title>
    <style>
        @page {
            size: auto;
            margin: 0.5cm;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: white;
            font-size: 10px;
            line-height: 1.1;
            margin: 0;
            padding: 0;
            width: auto;
            height: auto;
        }
        
        .voucher-container {
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 0.2rem;
            box-shadow: none;
            max-width: none;
            margin: 0;
            width: auto;
            min-width: 200px;
            max-width: 80%;
        }
        
        .header {
            background: linear-gradient(to right, #fbbf24, #d97706);
            padding: 0.3rem;
            text-align: center;
            color: white;
            border-radius: 0.2rem 0.2rem 0 0;
        }
        
        .header-content {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.1rem;
        }
        
        .header h1 {
            font-size: 1rem;
            font-weight: bold;
            margin: 0;
        }
        
        .header p {
            font-size: 0.7rem;
            margin: 0;
        }
        
        .content {
            padding: 0.3rem;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.3rem;
            margin-bottom: 0.3rem;
        }
        
        .info-item {
            font-size: 0.7rem;
        }
        
        .info-label {
            font-weight: 600;
            color: #4b5563;
        }
        
        .info-value {
            color: #1f2937;
            font-weight: bold;
        }
        
        .status-badge {
            padding: 0.1rem 0.3rem;
            background-color: #dcfce7;
            color: #166534;
            border-radius: 0.2rem;
            font-size: 0.7rem;
            font-weight: bold;
            display: inline-block;
        }
        
        .section {
            border-top: 1px solid #e5e7eb;
            padding-top: 0.3rem;
            margin-bottom: 0.3rem;
        }
        
        .section h3 {
            font-weight: bold;
            color: #1f2937;
            margin: 0 0 0.1rem 0;
            font-size: 0.7rem;
        }
        
        .event-info {
            font-size: 0.7rem;
            line-height: 1.2;
        }
        
        .event-info div {
            margin-bottom: 0.05rem;
        }
        
        .event-info .font-semibold {
            font-weight: 600;
        }
        
        .tickets-list {
            line-height: 1.2;
        }
        
        .ticket-item {
            display: flex;
            justify-content: space-between;
            font-size: 0.7rem;
            margin-bottom: 0.05rem;
        }
        
        .ticket-total {
            border-top: 1px solid #d1d5db;
            margin-top: 0.1rem;
            padding-top: 0.1rem;
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            font-size: 0.8rem;
        }
        
        .buyer-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.3rem;
            font-size: 0.7rem;
        }
        
        .buyer-item {
            line-height: 1.2;
        }
        
        .buyer-item .font-semibold {
            font-weight: 600;
        }
        
        .instructions {
            font-size: 0.7rem;
            color: #4b5563;
            line-height: 1.2;
        }
        
        .instructions ul {
            margin: 0.1rem 0;
            padding-left: 0.5rem;
        }
        
        .instructions li {
            margin-bottom: 0.05rem;
        }
        
        .validation-code {
            text-align: center;
            border-top: 1px solid #e5e7eb;
            padding-top: 0.3rem;
        }
        
        .code-container {
            display: inline-block;
            border: 1px solid #d1d5db;
            padding: 0.1rem;
            border-radius: 0.2rem;
        }
        
        .code-label {
            font-size: 0.7rem;
            color: #6b7280;
        }
        
        .code-value {
            font-family: monospace;
            font-size: 0.7rem;
            font-weight: bold;
        }
        
        /* Asegurar que el contenido se ajuste */
        .text-xs {
            font-size: 0.7rem;
            line-height: 1.2;
            word-wrap: break-word;
        }
        
        /* Reducir espaciado */
        .space-y-0\.5 > * + * {
            margin-top: 0.1rem;
        }
        
        /* Hacer el voucher más compacto */
        .rounded-lg {
            border-radius: 0.2rem;
        }
    </style>
</head>
<body>
    <div class="voucher-container">
        <!-- Header del Voucher -->
        <div class="header">
            <div class="header-content">
                <h1>VOUCHER DE COMPRA</h1>
            </div>
            <p>¡Gracias por tu compra!</p>
        </div>

        <!-- Contenido Compacto -->
        <div class="content">
            <!-- Información Principal en Grid -->
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">N° Orden:</div>
                    <div class="info-value">#{{ $compra->id }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Fecha y Hora:</div>
                    <div class="info-value">{{ $compra->fecha_compra_formateada }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Estado:</div>
                    <div class="status-badge">PAGADO</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Entrega:</div>
                    <div class="info-value">{{ ucfirst($compra->formato_entrega) }}</div>
                </div>
            </div>

            <!-- Información del Evento -->
            @if($compra->evento)
            <div class="section">
                <h3>EVENTO</h3>
                <div class="event-info">
                    <div><span class="font-semibold">Nombre:</span> {{ $compra->evento->nombre }}</div>
                    <div><span class="font-semibold">Fecha:</span> {{ $compra->evento->fecha_evento_formateada }}</div>
                    <div><span class="font-semibold">Ubicación:</span> {{ $compra->evento->ubicacion }}</div>
                </div>
            </div>
            @endif

            <!-- Tickets Compactos -->
            <div class="section">
                <h3>TICKETS</h3>
                <div class="tickets-list">
                    @foreach($compra->detalles as $detalle)
                    <div class="ticket-item">
                        <span>{{ $detalle->cantidad }}x {{ strtoupper($detalle->tipo_ticket) }}</span>
                        <span>S/. {{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}</span>
                    </div>
                    @endforeach
                </div>
                <div class="ticket-total">
                    <span>TOTAL:</span>
                    <span>S/. {{ number_format($compra->total, 2) }}</span>
                </div>
            </div>

            <!-- Comprador Compacto -->
            <div class="section">
                <h3>COMPRADOR</h3>
                <div class="buyer-info">
                    <div class="buyer-item"><span class="font-semibold">Nombre:</span> {{ $compra->usuario->name }}</div>
                    <div class="buyer-item"><span class="font-semibold">DNI:</span> {{ $compra->usuario->dni }}</div>
                    <div class="buyer-item"><span class="font-semibold">Email:</span> {{ $compra->usuario->email }}</div>
                    <div class="buyer-item"><span class="font-semibold">Celular:</span> {{ $compra->usuario->phone ?: 'No disponible' }}</div>
                </div>
            </div>

            <!-- Instrucciones Muy Compactas -->
            <div class="section">
                <h3>INSTRUCCIONES</h3>
                <ul class="instructions">
                    <li>• Presenta este voucher al ingresar al evento</li>
                    <li>• Llega con anticipación</li>
                    <li>• Válido solo para la fecha indicada</li>
                </ul>
            </div>

            <!-- Código de Validación -->
            <div class="validation-code">
                <div class="code-container">
                    <div class="code-label">CÓDIGO</div>
                    <div class="code-value">{{ strtoupper(substr(md5($compra->id), 0, 8)) }}</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 