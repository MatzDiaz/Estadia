<!doctype html>
<html lang="es">
    <head>
        <title>Formulario de Compra</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS v5.3.2 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body>
        @include('partials.navbar')

        <div class="container mt-5">
            <div class="row">
                <h2>Formulario de Compra</h2>
                <p>Por favor, completa los datos para proceder con tu compra.</p>

                <!-- Formulario de Venta -->
                <form action="{{ route('ventas.RealizarVenta') }}" method="POST">
                    @csrf
                
                    <div class="mb-3">
                        <label for="metodo_pago" class="form-label">Método de Pago</label>
                        <select class="form-select" id="metodo_pago" name="metodo_pago" required>
                            <option value="efectivo">Efectivo</option>
                            <option value="tarjeta">Tarjeta de Crédito</option>
                            <option value="paypal">PayPal</option>
                            <option value="otros">Otros</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="direccion_envio" class="form-label">Dirección de Envío</label>
                        <textarea class="form-control" id="direccion_envio" name="direccion_envio" rows="3" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-6">
                        <h3>Total: $<span id="total">{{$total}}</span></h3>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Finalizar Compra</button>
                </form>
            </div>
        </div>

        

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    </body>
</html>
