
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backup y Restauración</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
@include('partials.navbar') <!-- Incluye la barra de navegación -->
<div class="container">
    <h1>Respaldo y Restauración</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <h2>Generar respaldo</h2>
    <form action="{{ route('backup.generate') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Generar respaldo</button>
    </form>

    <h2 class="mt-4">Restaurar respaldo</h2>
    <form action="{{ route('backup.restore') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="file" name="backup_file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Restaurar</button>
    </form>
<!--
   
-->
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>