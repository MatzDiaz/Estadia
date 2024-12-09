
<!doctype html>
<html lang="en">
    <head>
        <title>Productores</title>
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
                <h3>Gestion de productores</h3>
                <br>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
                <i class="bi bi-plus-lg"></i>Nuevo
                </button>
                <br><br>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark text-white">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Email</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Direccion</th>
                                <th scope="col">Sexo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $usuario)
                            @if($usuario->rol != 'Consumidor')
                            <tr class="">
                                <td>{{$usuario->id}}</td>
                                <td>{{$usuario->name}}</td>
                                <td>{{$usuario->apellido}}</td>
                                <td>{{$usuario->email}}</td>
                                <td>{{$usuario->telefono}}</td>
                                <td>{{$usuario->direccion}}</td>
                                <td>{{$usuario->sexo}}</td>
                                <td>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit{{$usuario->id}}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$usuario->id}}">
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
    </body>
</html>
