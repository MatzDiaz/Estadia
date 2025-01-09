<!doctype html>
<html lang="en">
<head>
    <title>Carrito</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    @include('partials.navbar')
    <div class="container mt-5">
        <h2>Mi carrito</h2>
        <h3>Lista de productos</h3>

        @if(count($carrito) == 0)
            <h4>No hay productos en el carrito</h4>


        @else
        <div class="row">
            @foreach($carrito as $productos)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $productos->producto->nombre }} <br> 
                                <small class="text-muted">Precio unitario ${{ $productos->producto->precio }}</small>
                                <br>
                                <small class="text-muted">Cantidad comprada {{ $productos->cantidad }} Unidades</small>
                                <br>
                                <small class="text-muted">Precio en conjunto ${{ $productos->SubTotalPorducto }}</small>
                            </h5>
                            <button onclick="Eliminar({{ $productos->id_carrito }})" class="btn btn-danger">
                                <i class="bi bi-cart-plus"></i> Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <h2>Precio total</h2>
            <h3>Total: $<span id="total">{{$total}}</span></h3>
        </div>

        <div class="row">
            <div class="card shadow-sm" style="width: 100%;">
                <div class="card-body">
                    <!-- Formulario para enviar -->
                    <form id="finalizarCompraForm" action="{{ route('ventas.RealizarVenta') }}" method="POST">
                        @csrf
                        <a href="{{ route('carrito.Mostrar') }}" class="btn btn-primary mt-3">Seguir comprando</a>
                        <button type="submit" class="btn btn-success mt-3">Finalizar Compra</button>
                    </form>
                </div>
            </div>
        </div>


        @endif


    </div>

    <script>
        // Función para enviar el formulario por AJAX y recargar la página
        document.getElementById('finalizarCompraForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevenir el envío estándar del formulario

        Swal.fire({
            title: 'Generando PDF...',
            text: 'Por favor espera mientras procesamos tu compra.',
            icon: 'info',
            showConfirmButton: false,
            allowOutsideClick: false,
        });

        // Enviar el formulario por AJAX con axios
        axios.post(this.action, new FormData(this), {
            responseType: 'blob' // Especificamos que la respuesta es un archivo binario (PDF)
        })
        .then(function (response) {
            // Crear un enlace temporal para descargar el archivo
            const link = document.createElement('a');
            const url = window.URL.createObjectURL(new Blob([response.data])); // Crear URL del blob

            link.href = url;
            link.setAttribute('download', 'ticket.pdf'); // Nombre del archivo
            document.body.appendChild(link);
            link.click(); // Forzar clic en el enlace

            // Limpiar el enlace temporal
            document.body.removeChild(link);

            // Mostrar confirmación de éxito
            Swal.fire({
                icon: 'success',
                title: 'Compra finalizada',
                text: 'Tu compra ha sido completada y el PDF fue generado.',
                timer: 2000
            });

            // Recargar la página después de unos segundos
            setTimeout(() => {
                window.location.reload(); // Recargar la página después de 2 segundos
            }, 2500);
        })
        .catch(function (error) {
            console.error(error);
            Swal.fire({
                icon: 'error',
                title: 'Hubo un error',
                text: 'Algo salió mal, por favor intentalo nuevamente.',
            });
        });
    });


        // Eliminar producto del carrito
        function Eliminar(id) {
            console.log(id);
            Swal.fire({
                title: "¿Desea eliminar este producto?",
                text: "No se podrá revertir esta acción.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar!",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/carritoEliminar/' + id)
                        .then(function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Producto eliminado del carrito.',
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
