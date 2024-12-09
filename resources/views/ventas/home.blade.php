<!doctype html>
<html lang="en">
    <head>
        <title>Principal</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>

    <body>
        @include('partials.navbar') <!-- Incluye la barra de navegación -->
        <div class="container mt-5">
            <div class="row">
                @foreach($productos as $prod)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm" style="width: 100%;">
                            <!-- Imagen de la publicación -->
                            @if($prod->imagen)
                                <img src="{{ asset('storage/imagenes/' . $prod->imagen) }}" alt="Imagen del blog" class="img-fluid">
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

                                <!-- Botón para agregar al carrito -->
                                <button class="btn btn-success">
                                    <i class="bi bi-cart-plus"></i> Agregar al carrito
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Scripts de Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    </body>
</html>