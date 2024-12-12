<!doctype html>
<html lang="en">
<head>
    <title>Blog</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
@include('partials.navbar')
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-md-2"></div>
        <div class="col-md-8">
        <br>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
                <i class="bi bi-plus-lg"></i> Nueva publicación
            </button>
            <br><br>
            @foreach($blog as $bg)
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <!-- Título y nombre del usuario -->
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">{{$bg->titulo}} - <small class="text-muted">{{ $bg->user->name }}</small></h5>
                                
                                <!-- Menú de opciones de tres puntos -->
                                <div class="dropdown">
                                    <button class="btn btn-light" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#edit{{$bg->id_blog}}">
                                                Editar
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete{{$bg->id_blog}}">
                                                Eliminar
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            <p class="card-text">
                                {{$bg->descripcion}}
                            </p>
                        </div>
                        <!-- Mostrar la imagen -->
                        @if($bg->multimedia)
                            <img src="{{ asset('storage/imagenes/' . $bg->multimedia) }}" alt="Imagen del blog" class="img-fluid">
                        @endif
                    </div>
                </div>
            </div>
            @include('blog.modBlog')
            <br><br>    
            @endforeach
            @include('blog.ceaBlog')
        </div>
        <div class="col-md-2"></div>
    </div>
    <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if ($errors->any())
                    // Si hay errores, muestra el modal al cargar la página
                    var myModal = new bootstrap.Modal(document.getElementById('create'));
                    myModal.show();
                @endif
            });
    </script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
