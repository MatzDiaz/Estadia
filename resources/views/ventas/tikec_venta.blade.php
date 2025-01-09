<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Venta</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .ticket-container {
            width: 300px; /* Ancho típico de un ticket */
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 14px;
        }

        h3 {
            color: #000;
            font-weight: bold;
            margin: 5px 0;
        }

        p {
            margin: 5px 0;
        }

        .ticket-header,
        .ticket-footer {
            text-align: center;
        }

        .ticket-header {
            font-weight: bold;
            font-size: 16px;
        }

        .ticket-footer {
            font-size: 12px;
            color: #777;
        }

        .ticket-items {
            margin-top: 10px;
        }

        .ticket-items table {
            width: 100%;
            border-collapse: collapse;
        }

        .ticket-items th, .ticket-items td {
            text-align: left;
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }

        .ticket-items th {
            background-color: #000;
            color: #fff;
        }

        .total {
            font-weight: bold;
            font-size: 16px;
            margin-top: 10px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #000;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            border-radius: 5px;
            text-transform: uppercase;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #333;
        }
    </style>
</head>
<body>

    <div class="ticket-container">
        <div class="ticket-header">
            <h3>Resumen de Venta</h3>
            <p>Fecha: {{ $venta->fecha_venta }}</p>
            <p>Referencia: {{ $venta->referencia_pago }}</p>
        </div>

        <div class="ticket-items">
            <h3>Productos</h3>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->producto->nombre }}</td>
                            <td>{{ $producto->cantidad }}</td>
                            <td>${{ number_format($producto->SubTotalPorducto, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="total">
            <p>Total: ${{ number_format($venta->total, 2) }}</p>
        </div>

        <div class="ticket-footer">
            <p>Gracias por su compra.</p>
        </div>
    </div>

</body>
</html>
