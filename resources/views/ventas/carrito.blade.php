<!doctype html>
<html lang="en">
    <head>
        <title>Carrito</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta   
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body>
       @include('partials.navbar')
        <!-- Bootstrap JavaScript Libraries -->
        <div class="container mt-5">
            <div class="row">
                <h2>Mi carrito</h2>
                <h3>Lista de productos</h3>
                @if(count($carrito) == 0)
                    <h4>No hay productos en el carrito</h4>
                @endif
                <div class="row">
                    @foreach($carrito as $productos)
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm" style="width: 100%;">                                
                                <div class="card-body">
                                    <h5 class="card-title">{{ $productos->producto->nombre }} <br> 
                                        <small class="text-muted
                                        ">Precio unitario ${{ $productos->producto->precio }}</small>
                                        <br>
                                        <small class="text-muted
                                        ">Cantidad comprada {{ $productos->cantidad }} Unidades</small>
                                        <br>
                                        <small class="text-muted
                                        ">Presio en cojunto ${{ $productos->SubTotalPorducto }} </small>
                                    </h5>
                                    <button onclick="Eliminar({{ $productos->id_carrito }})" class="btn btn-danger" >
                                        <i class="bi bi-cart
                                        -plus"></i> Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row" >
                <h2>Precio total</h2>
                
                <h3>Total: $<span id="total">{{$total}}</span></h3>
            </div>
            <div class="row" >
            <div class="card shadow-sm" style="width: 100%;">                                
                    <div class="card-body">        
                        <a href="{{ route('carrito.Mostrar') }}" class="btn btn-primary">Seguir comprando</a>
                        <a href="" class="btn btn-success">Comprar</a>
                                    
                    </div>
                </div>
            </div>
        </div>
        <script >
            function Eliminar(id){
                console.log(id);
                Swal.fire({
                    title: "Desea eliminar este proyecto?",
                    text: "No se podra revertir esta acción",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, eliminar!",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            axios.delete('/carritoEliminar/' + id)
                            .then(function (response) {
                                console.log(response);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'El producto ha sido eliminado del carrito.',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2500);
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                        }
                    });  
            }

        </script>
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
        <script >

            function total(carrito){
                let total = 0;
                carrito.forEach(element => {
                    total += element.producto.precio * element.cantidad;
                });
                console.log(total);
                document.getElementById('total').innerText = total;
            }
        </script>
    </body>
</html>
