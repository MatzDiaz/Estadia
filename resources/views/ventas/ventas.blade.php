
<!doctype html>
<html lang="en">
    <head>
        <title>Ventas</title>
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
    @include('partials.navbar')

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <br><br>
                <h3>Ventas realizadas</h3>
                <br>
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
                <br>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark text-white">
                            <tr>
                                <th scope="col">ID venta</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Total</th>
                                <th scope="col">Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detalles as $det)
                            <tr class="">
                                <td>{{$det->id_detalle}}</td>
                                <td>{{$det->total}}</td>
                                <td>{{$det->precio_unitario}}</td>
                                <td>{{$det->total}}</td>
                                <td>{{$det->estatus}}</td>
                                <td>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit{{$det->id_detalle}}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$det->id_detalle}}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @include('ventas.modVen')

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    const alerts = document.querySelectorAll('.alert');
                    alerts.forEach(alert => {
                        alert.classList.add('fade');
                        setTimeout(() => alert.remove(), 500); // Eliminar del DOM después de la animación
                    });
                }, 5000); // Tiempo en milisegundos
            });
        </script>
    </body>
</html>
