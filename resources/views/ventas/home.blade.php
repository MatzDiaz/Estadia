<!doctype html>
<html lang="en">
    <head>
        <title>Principal</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body>
        @include('partials.navbar') <!-- Incluye la barra de navegación -->
        <div class="container mt-5">
            <div class="row">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
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

                                <!-- Botón para agregar al carrito -->
                                 @if($prod->cantidad > 0)
                                    <button onclick="obtenerId({{ $prod->id_producto }},{{$prod->cantidad}})" class="btn btn-success" >
                                        <i class="bi bi-cart-plus"></i> Agregar al carrito
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Scripts de Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script >
            function obtenerId(id,cantidad){
                Swal.fire({
                    title: "¿Cuánto desea agregar?",
                    icon: "question",
                    input: "range",
                    inputLabel: "Número de productos",
                    inputAttributes: {
                        min: "1",
                        max: cantidad,  
                        step: "1"
                    },
                    inputValue: 1,
                    showCancelButton: true,  
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        const cantidadSeleccionada = result.value;  
                        console.log(`Cantidad seleccionada: ${cantidadSeleccionada}`);
                        axios.post('/carrito/' + id, {
                            cantidad: cantidadSeleccionada
                        })
                        .then(function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Producto agregado al carrito',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                            
                            
                        })
                        .catch(function (error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Hubo un error al agregar el producto al carrito',
                                text: error.response ? error.response.data.message : error.message,
                            });
                        });
                    } else {
                        console.log('Acción cancelada');
                    }
                });
                
            }

        </script>
    </body>
</html>