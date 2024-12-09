<!doctype html>
<html lang="en">
    <head>
        <title>Producto</title>
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
        <?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <!-- Incluye la barra de navegación -->
        <div class="container mt-5">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
            <i class="bi bi-plus-lg"></i>Nuevo
        </button>
        <br><br>
            <div class="row">
                <?php $__currentLoopData = $producto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm" style="width: 100%;">
                            <!-- Imagen de la publicación -->
                            <?php if($prod->imagen): ?>
                                <img src="<?php echo e(asset('storage/imagenes/' . $prod->imagen)); ?>" alt="Imagen del blog" class="img-fluid">
                            <?php endif; ?>
                            <div class="card-body">
                                <!-- Título y precio del producto -->
                                <h5 class="card-title"><?php echo e($prod->nombre); ?> <br> 
                                    <small class="text-muted">$ <?php echo e($prod->precio); ?></small>
                                </h5>

                                <!-- Descripción del producto -->
                                <p class="card-text">
                                    <?php echo e(Str::limit($prod->descripcion, 100)); ?>

                                </p>

                                <!-- Botones alineados horizontalmente -->
                                <div class="d-flex justify-content-between">
                                    <!-- Botón para abrir el modal -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?php echo e($prod->id_producto); ?>">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit<?php echo e($prod->id_producto); ?>">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo $__env->make('productos.modProducto', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('productos.creaProducto', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
        <!-- Bootstrap JavaScript Libraries -->
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


<?php /**PATH C:\xampp\htdocs\EcoMercado\resources\views/productos/productos.blade.php ENDPATH**/ ?>