<!doctype html>
<html lang="en">
<head>
    <title>Registro</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('assets/estilos.css') }}">
</head>
<body>
<section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">
                                <div class="text-center">
                                    <h4 class="mt-1 mb-5 pb-1">Crear nueva cuenta</h4>
                                </div>
                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <!-- Campo de Nombre -->
                                    <div class="form-outline mb-4">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Nombre" required />
                                        <label class="form-label" for="name">Nombre</label>
                                    </div>

                                    <!-- Campo de Apellido -->
                                    <div class="form-outline mb-4">
                                        <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Apellido" required />
                                        <label class="form-label" for="apellido">Apellido</label>
                                    </div>

                                    <!-- Campo de Correo Electrónico -->
                                    <div class="form-outline mb-4">
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Correo Electrónico" required />
                                        <label class="form-label" for="email">Correo Electrónico</label>
                                    </div>

                                    <!-- Campo de Contraseña -->
                                    <div class="form-outline mb-4">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required />
                                        <label class="form-label" for="password">Contraseña</label>
                                    </div>

                                    <!-- Campo de Confirmación de Contraseña -->
                                    <div class="form-outline mb-4">
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirmar Contraseña" required />
                                        <label class="form-label" for="password_confirmation">Confirmar Contraseña</label>
                                    </div>

                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center">
                            <div class="px-3 py-4 p-md-5 mx-md-4">
                                <br><br>

                                <!-- Campo de Teléfono -->
                                <div class="form-outline mb-4">
                                    <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Teléfono" />
                                    <label class="form-label" for="telefono">Teléfono</label>
                                </div>

                                <!-- Campo de Dirección -->
                                <div class="form-outline mb-4">
                                    <textarea id="direccion" name="direccion" class="form-control" placeholder="Dirección"></textarea>
                                    <label class="form-label" for="direccion">Dirección</label>
                                </div>

                                <!-- Campo de Sexo -->
                                <div class="form-outline mb-4">
                                    <select id="sexo" name="sexo" class="form-control" required>
                                        <option value="otro">Selecciona tu sexo</option>
                                        <option value="masculino">Masculino</option>
                                        <option value="femenino">Femenino</option>
                                        <option value="otro">Otro</option>
                                    </select>
                                    <label class="form-label" for="sexo">Sexo</label>
                                </div>

                                <t><img src="{{ asset('assets/user.png') }}" style="width: 120px; margin: 40px;" alt="logo">
                                <!-- Botón de Registro -->
                                <div class="text-center pt-1 mb-5 pb-1">
                                    <button class="btn btn-primary btn-block gradient-custom-2 mb-3" type="submit">Registrarse</button>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</form>
</body>
</html>
