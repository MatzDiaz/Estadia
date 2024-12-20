<!doctype html>
<html lang="en">
    <head>
        <title>Producto</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        @include('partials.navbar') <!-- Incluye la barra de navegación -->
        <div class="container mt-5">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
            <i class="bi bi-plus-lg"></i>Nuevo
        </button>
        <br><br>
            <div class="row">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @foreach($producto as $prod)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm" style="width: 100%;">
                            <!-- Imagen de la publicación -->
                            @if($prod->imagen)
                                <img src="{{ asset('storage/imagenes/' . $prod->imagen) }}" alt="Imagen del blog" class="img-fluid" style="width: 386px; height: 386px; object-fit: cover;">
                            @endif

                            <div class="card-body">
                                <!-- Título y precio del producto -->
                                <h5 class="card-title">{{ $prod->nombre }} <br> 
                                    <small class="text-muted">$ {{ $prod->precio }}</small>
                                </h5>

                                <!-- Descripción del producto -->
                                <p class="card-text">
                                    {{ Str::limit($prod->descripcion, 100) }}
                                </p>

                                <!-- Botones alineados horizontalmente -->
                                <div class="d-flex justify-content-between">
                                    <!-- Botón para abrir el modal -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$prod->id_producto}}">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit{{$prod->id_producto}}">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('productos.modProducto')
                    @endforeach
                @include('productos.creaProducto')
            </div>
        </div>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if ($errors->any())
                    // Si hay errores, muestra el modal al cargar la página
                    var myModal = new bootstrap.Modal(document.getElementById('create'));
                    myModal.show();
                @endif
            });
        </script>
    </body>
</html>