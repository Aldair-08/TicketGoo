{{-- filepath: resources/views/usuario/boleta_pdf.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Boleta TicketGO</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .titulo {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .seccion {
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="titulo">Boleto de compra</div>
    <div class="seccion">
        <div><span class="label">Nombre de cuenta:</span> {{ $nombre_cuenta }}</div>
        <div><span class="label">DNI:</span> {{ $dni }}</div>
        <div><span class="label">Correo:</span> {{ $correo }}</div>
        <div><span class="label">Evento:</span> {{ $evento }}</div>
        <div><span class="label">Fecha:</span> {{ $fecha }}</div>
        <div><span class="label">Ubicación:</span> {{ $ubicacion }}</div>
    </div>
    <div class="seccion">
        <div class="label">Entradas compradas:</div>
        <ul>
            @foreach ($entradas as $entrada)
                <li>{{ $entrada['cantidad'] }} {{ $entrada['tipo'] }} - S/. {{ number_format($entrada['subtotal'], 2) }}
                </li>
            @endforeach
        </ul>
        <div class="label">TOTAL: S/. {{ number_format($total, 2) }}</div>
    </div>
    <div class="seccion">
        <div class="label">Método de pago:</div> {{ $metodo_pago }}
        @if (isset($datos_pago))
            <div>{!! $datos_pago !!}</div>
        @endif
    </div>
</body>

</html>
