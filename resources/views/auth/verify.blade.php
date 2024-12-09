<!doctype html>
<html lang="en">
    <head>
                <title>Inicio de sesión</title>
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
                <link rel="stylesheet" href="{{ asset('assets/estilos.css') }}">
            </head>

            <body>
            <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                <div class="row g-0">
                    <div class="col-lg-12">
                    <div class="card-body p-md-5 mx-md-4">

                        <div class="text-center">
                        
                        <h4 class="mt-1 mb-5 pb-1">¿Olvidó su contraseña?</h4>
                        </div>

                        <form action="{{route('login')}}" method="POST">

                        <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example11">Email</label>
                        <input type="email" id="email" name="email" class="form-control"
                            placeholder="Correo electrónico" />
                        </div>

                       
                        <div class="text-center pt-1 mb-5 pb-1">
                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Enviar link de restablecimiento</button>
                        </div>
                        </form>

                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>
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
