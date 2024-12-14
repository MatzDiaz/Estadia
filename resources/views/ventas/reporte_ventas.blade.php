<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Ejecutivo</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 30px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #000;
            font-weight: bold;
            margin-top: 0;
        }

        p, .h4 {
            font-size: 18px;
            color: #333;
        }

        /* Estilo de las tablas */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #000;
            color: #fff;
            text-transform: uppercase;
        }

        tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Estilo de los botones */
        .btn {
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #000;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            border-radius: 5px;
            text-transform: uppercase;
        }

        .btn:hover {
            background-color: #333;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Ticket Promedio -->
         <center>
            <h1> Resumen de venta</h1>
        </center>
        <div class="ticket-promedio">
            <h3>Ticket Promedio</h3>
            <p class="h4">${{ number_format($ticketPromedio, 2) }}</p>
            <p class="h4">Total de ingresos: ${{ number_format($totalIngresos, 2) }}</p>
            <p class="h4">Cantidad de tickets: {{ $cantidadTickets }}</p>
        </div>

        <!-- Productos Más Vendidos -->
        <div class="productos-vendidos">
            <h3>Productos Más Vendidos</h3>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad Vendida</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productosMasVendidos as $producto)
                        <tr>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->total_vendido }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Ingresos por Categoría -->
        <div class="ingresos-categoria">
            <h3>Ingresos por Categoría</h3>
            <table>
                <thead>
                    <tr>
                        <th>Categoría</th>
                        <th>Mes</th>
                        <th>Ingresos Totales</th>
                        <th>Productos Vendidos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ingresos as $ingreso)
                        <tr>
                            <td>{{ $ingreso->categoria }}</td>
                            <td>{{ $ingreso->mes }}</td>
                            <td>${{ number_format($ingreso->ingreso_total_mensual, 2) }}</td>
                            <td>{{ $ingreso->productos_vendidos }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Botón de Acción -->
        <h2>Reporte de Proveedores y Compras</h2>
        <img src="{{ $imgSrc }}" alt="Gráfico de Productores por Género" style="max-width: 100%; height: auto;">
        <!-- Proveedores Más Vendidos -->
        <div class="table-container">
            <h3 class="table-title">Proveedores Más Vendidos</h3>
            <table>
                <thead>
                    <tr>
                        <th>Proveedor</th>
                        <th>Total Vendido</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedores as $proveedor)
                        <tr>
                            <td>{{ $proveedor->productor_nombre }}</td>
                            <td>{{ $proveedor->total_vendido }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Compras por Cliente -->
        <div class="table-container" style="margin-top: 40px;">
            <h3 class="table-title">Compras por Cliente</h3>
            <table>
                <thead>
                    <tr>
                        <th>Cliente frecuentas</th>
                        <th>Número de Compras</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comprasPorCliente as $cliente)
                        <tr>
                            <td>{{ $cliente->name }}</td>
                            <td>{{ $cliente->numeroCompras }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
