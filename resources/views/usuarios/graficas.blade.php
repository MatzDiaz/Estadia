<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficas de Proveedores</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous"
    />
    <style>
        .chart-container {
            width: 100%;
            max-width: 500px; /* Ajusta el tamaño máximo */
            margin: auto;
        }
        canvas {
            padding: 10px;
        }
    </style>
</head>
<body>
@include('partials.navbar')

<div class="container my-5">
    <div class="row justify-content-center">
        <!-- Gráfica de Género -->
        <div class="col-md-6 chart-container text-center">
            <h2>Proveedores por Género</h2>
            <canvas id="graficaGenero"></canvas>
        </div>
        
        <!-- Gráfica de Dirección -->
        <div class="col-md-6 chart-container text-center">
            <h2>Proveedores por Estado</h2>
            <canvas id="graficaDireccion"></canvas>
        </div>
    </div>
</div>

<script>
    // Datos para la gráfica de Género
    const proveedoresPorGenero = @json($proveedoresPorGenero);
    const dataGenero = {
        labels: Object.keys(proveedoresPorGenero),
        datasets: [{
            data: Object.values(proveedoresPorGenero),
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'], // Colores
        }]
    };

    // Datos para la gráfica de Dirección
    const proveedoresPorDireccion = @json($proveedoresPorDireccion);
    const dataDireccion = {
        labels: Object.keys(proveedoresPorDireccion),
        datasets: [{
            data: Object.values(proveedoresPorDireccion),
            backgroundColor: ['#4BC0C0', '#FF9F40', '#9966FF'], // Colores
        }]
    };

    // Configuración y renderización de la gráfica de Género
    new Chart(document.getElementById('graficaGenero'), {
        type: 'pie',
        data: dataGenero,
    });

    // Configuración y renderización de la gráfica de Dirección
    new Chart(document.getElementById('graficaDireccion'), {
        type: 'pie',
        data: dataDireccion,
    });
</script>
</body>
</html>
