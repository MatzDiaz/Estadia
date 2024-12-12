<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación de Agotamiento de Producto</title>

    <!-- Enlace a Bootstrap 4 desde la CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f4f6f9; padding: 20px;">

    <div class="container" style="max-width: 600px; background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <div class="text-center">
            <h2 class="text-primary">¡Atención!</h2>
            <p class="lead">Este es un aviso importante sobre el estado de uno de tus productos.</p>
        </div>

        <p style="font-size: 16px; color: #555;">
            {{ $mensajeCorreo }}
        </p>

        <div class="text-center mt-4">
            <p style="font-size: 14px; color: #888;">Si tienes alguna pregunta o necesitas más información, no dudes en ponerte en contacto con nosotros.</p>
            <p><strong>Gracias por confiar en nosotros.</strong></p>
        </div>

        <div class="mt-5 text-center">
            <small style="color: #888;">Este correo fue enviado automáticamente, por favor no lo respondas.</small>
        </div>
    </div>

    <!-- Enlace a Bootstrap JS (opcional, para interacciones si necesitas) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
