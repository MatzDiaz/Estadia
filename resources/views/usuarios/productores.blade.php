<!doctype html>
<html lang="en">

<head>
    <title>Productores</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
          crossorigin="anonymous" />

    <!-- Custom Styles -->
    <style>
        .table img {
            width: 100px; /* Ancho uniforme */
            height: 100px; /* Altura uniforme */
            object-fit: cover; /* Ajustar el contenido sin deformarlo */
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Main Content -->
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <br><br>
            <h3>Gestión de Productores</h3>
            <br>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>¡Éxito!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Error Messages -->
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>¡Error!</strong> Por favor corrige los errores antes de continuar.
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Add New Producer Button -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
                <i class="bi bi-plus-lg"></i> Nuevo
            </button>
            <br><br>

            <!-- Producers Table -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-dark text-white">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Email</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Sexo</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            @if($usuario->rol != 'Consumidor')
                                <tr>
                                    <td>{{ $usuario->id }}</td>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->apellido }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ $usuario->telefono }}</td>
                                    <td>{{ $usuario->direccion }}</td>
                                    <td>{{ $usuario->sexo }}</td>
                                    <td>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit{{ $usuario->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $usuario->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @include('usuarios.modPro')
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            @include('usuarios.crePro')
        </div>
        <div class="col-md-2"></div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" 
            crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" 
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" 
            crossorigin="anonymous">
    </script>

    <!-- Modal Error Display Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if ($errors->any())
                // Show the modal if there are errors
                var myModal = new bootstrap.Modal(document.getElementById('create'));
                myModal.show();
            @endif
        });
    </script>
</body>

</html>
 