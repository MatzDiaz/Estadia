<!DOCTYPE html>
<html lang="es">
<head>
    <title>Gráficas</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .chart-container {
            position: relative;
            height: 40vh;
            width: 100%;
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <div class="container mt-5">

        <div class="row mt-5">
            <div class="col-md-4">
                <a target="_blank" href="{{ route('ventas.reporteVentas') }}" class="btn btn-primary w-100">Generar Reporte PDF</a>
            </div>
            <div class="col-md-4">
                <button class="btn btn-success w-100">Generar Reporte PDF</button>
            </div>
            <div class="col-md-4">
                <button class="btn btn-danger w-100">Generar Reporte PDF</button>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h1 class="text-center">Gráficas</h1>

        <!-- Formulario de Fechas (opcional para filtrar) -->
        
            <div class="row mb-4">
                <div class="col-md-5">
                    <label for="fecha_inicio">Fecha de inicio</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ $fechaInicio->toDateString() }}">
                </div>
                <div class="col-md-5">
                    <label for="fecha_fin">Fecha de fin</label>
                    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ $fechaFin->toDateString() }}">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button onclick="filtro()"  type="button" class="btn btn-primary">Generar Reporte</button>
                </div>
            </div>
        

        <!-- Resumen de ventas y ticket promedio -->
        <h3 class="mt-5">Resumen de Ventas</h3>
        <ul>
            <li>Total de ingresos: ${{ number_format($totalIngresos, 2) }}</li>
            <li>Cantidad de tickets: {{ $cantidadTickets }}</li>
            <li>Ticket promedio: ${{ number_format($ticketPromedio, 2) }}</li>
        </ul>

        <!-- Gráficas -->
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-center">Ventas Mensuales</h2>
                <div class="chart-container">
                    <canvas id="ventasChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="text-center">Productos Más Vendidos</h2>
                <div class="chart-container">
                    <canvas id="productosChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Gráfico de Ventas por Mes -->
        <h3 class="mt-5">Ventas por Mes</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Mes</th>
                    <th>Total de Ventas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventasPorMes as $venta)
                    <tr>
                        <td>{{ $venta->mes }}</td>
                        <td>${{ number_format($venta->total_ventas, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h3 class="mt-5">Ingresos por Categoría y Mes</h3>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Mes</th>
                        <th>Ingreso Total Mensual</th>
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
    <!---->
<!-- Botón de Acción -->
<h2 class="mt-5">Reporte de Proveedores y Compras</h2>
        <!-- Proveedores Más Vendidos -->
                <!-- Gráficas -->
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-center">Proveedores por Direccion</h2>
                <div class="chart-center">
                    <canvas id="graficaDireccion"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="text-center">Proveedores por genero</h2>
                <div class="chart-container">
                    <canvas id="generoChart"></canvas>
                </div>
            </div>
        </div>
        <div class="table-container">
            <h3 class="mt-5">Proveedores Más Vendidos</h3>
            <div class="table-responsive">
            <table class="table table-striped">
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
        </div>

        <!-- Compras por Cliente -->
        <div class="table-container" style="margin-top: 40px;">
            <h3 class="mt-5">Compras por Cliente</h3>
            <div class="table-responsive">
            <table class="table table-striped">
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
    </div>
    </div>
    <script>
        
        const generoData = {!! json_encode($datagenero) !!};
        const procentaje = {!! json_encode($porcentajegenero) !!};

        const generoCtx = document.getElementById('generoChart').getContext('2d');
        const generochart= new Chart(generoCtx, {
            type: 'bar',
            data: {
                labels: ['Masculino', 'Femenino', 'Otro'],
                datasets: [{
                    label: 'Proveedores por genero',
                    data: generoData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label:
                            function(tooltipItem) {
                                return tooltipItem.label + ': ' + procentaje[tooltipItem.dataIndex] + '%';
                            }
                        }
                    }
                }
            }
        });

    </script>

    <script>
        // Gráfico de Ventas Mensuales
        const ventasLabels = {!! json_encode($labels) !!};
        const ventasData = {!! json_encode($data) !!};
        const ventasCtx = document.getElementById('ventasChart').getContext('2d');
        const ventasgrafica = new Chart(ventasCtx, {
            type: 'bar',
            data: {
                labels: ventasLabels,
                datasets: [{
                    label: 'Ventas Mensuales',
                    data: ventasData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Gráfico de Productos Más Vendidos
        const productosLabels = {!! json_encode($productosLabels) !!};
        const productosData = {!! json_encode($productosData) !!};
        const productosCtx = document.getElementById('productosChart').getContext('2d');
        const productosgrafica = new Chart(productosCtx, {
            type: 'pie',
            data: {
                labels: productosLabels,
                datasets: [{
                    label: 'Productos Más Vendidos',
                    data: productosData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw +' unidades';
                            }
                        }
                    }
                }
            }
        });
    </script>

<script>
    // Datos para la gráfica de Dirección
    const proveedoresPorDireccion = @json($proveedoresPorDireccion);

    // Calcular el total de proveedores para obtener los porcentajes
    const totalProveedores = Object.values(proveedoresPorDireccion).reduce((a, b) => a + b, 0);
    const porcentajesDireccion = Object.values(proveedoresPorDireccion).map(value => ((value / totalProveedores) * 100).toFixed(2));

    // Datos de la gráfica de Dirección
    const dataDireccion = {
        labels: Object.keys(proveedoresPorDireccion), // Direcciones
        datasets: [{
            label: 'Proveedores por Dirección', // Título de la gráfica
            data: Object.values(proveedoresPorDireccion), // Total de proveedores por dirección
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)', 
                'rgba(54, 162, 235, 0.2)', 
                'rgba(255, 206, 86, 0.2)', 
                'rgba(75, 192, 192, 0.2)', 
                'rgba(153, 102, 255, 0.2)', 
                'rgba(255, 159, 64, 0.2)'
            ], // Colores de las secciones
            borderColor: [
                'rgba(255, 99, 132, 1)', 
                'rgba(54, 162, 235, 1)', 
                'rgba(255, 206, 86, 1)', 
                'rgba(75, 192, 192, 1)', 
                'rgba(153, 102, 255, 1)', 
                'rgba(255, 159, 64, 1)'
            ], // Bordes de las secciones
            borderWidth: 1 // Ancho del borde
        }]
    };

    // Configuración y renderización de la gráfica de Dirección
    new Chart(document.getElementById('graficaDireccion'), {
        type: 'pie', // Tipo de gráfica (pastel)
        data: dataDireccion, // Datos que alimentan la gráfica
        options: {
            responsive: true,
            maintainAspectRatio: false, // Mantener el aspecto de la gráfica
            plugins: {
                legend: {
                    position: 'top', // Posición de la leyenda
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            const label = dataDireccion.labels[tooltipItem.dataIndex]; // Dirección
                            const value = dataDireccion.datasets[0].data[tooltipItem.dataIndex]; // Total de proveedores
                            const percentage = porcentajesDireccion[tooltipItem.dataIndex]; // Porcentaje
                            return `${label}: ${value} proveedores (${percentage}%)`; // Etiqueta con valor y porcentaje
                        }
                    }
                }
            }
        }
    });
</script>


    <script>
        function filtro(){
            var fecha_inicio = document.getElementById('fecha_inicio').value;
            var fecha_fin = document.getElementById('fecha_fin').value;
            console.log(fecha_inicio);
            console.log(fecha_fin);
            const response = axios.post('/graficasPorFecha', {
                fecha_inicio: fecha_inicio,
                fecha_fin: fecha_fin
            }).then(function (response) {
                console.log(response.data);
                ventasgrafica.data.labels = response.data.labels;
                ventasgrafica.data.datasets[0].data = response.data.data;
                ventasgrafica.update();
                productosgrafica.data.labels = response.data.productosLabels;
                productosgrafica.data.datasets[0].data = response.data.productosData;
                productosgrafica.update();
            }).catch(function (error) {
                console.log(error);
            });
            
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
