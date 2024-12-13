<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <img src="{{ asset('assets/LogoComercio.png') }}"
            style="width: 100px;" alt="logo">
            <a class="navbar-brand">EcoMercado</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/home') }}" class="nav-link">Home</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">Iniciar sesión</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link">Registrarse</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!--Aqui productos-->
    <div class="container mt-5">
            <div class="row">
                @foreach($productos as $prod)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm" style="width: 100%;">
                            @if($prod->cantidad == 0)
                                <div class="alert alert-danger" role="alert">
                                    Producto agotado
                                </div>
                            @endif
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
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzWBbqEnK2HIjq81HsZLxPmlm9IYfRvH+8abtTEK21zO" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0ey+2Bjc8C4GpC5KCk67h1rE/j5SRK5RjDNFzBd1AIF5IukH/x68k34/" crossorigin="anonymous"></script>
</body>
</html>
