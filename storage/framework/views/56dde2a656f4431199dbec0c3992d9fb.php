<!doctype html>
<html lang="en">
    <head>
        <title>Inventario</title>
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
    </head>

    <body>
    <?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container mt-4">
        <div class="row">
            
            <!-- Lista de Productos -->
            <div class="col-md-3">
            <h5>Catálogo de Productos</h5>
            <ul class="list-group">
            <?php $__currentLoopData = $producto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item"><?php echo e($pd->nombre); ?> cant -> <?php echo e($pd->cantidad); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            </div>
            
            <!-- Entradas y Salidas -->
            <div class="col-md-9">
            <div class="row">  
                <!-- Tabla de Entradas -->
                <div class="col-md-6 table-responsive" style="max-height: 300px; overflow-y: auto;">
                <h5>Entradas</h5>
                <table class="table table-bordered" style="position: relative; border-collapse: collapse;">
                    <thead class="table-light" style="position: sticky; top: 0; z-index: 1;">
                    <tr>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Cant</th>
                        <th>Exi</th>
                        <th>Producto</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $entradas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $en): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($en->fecha_entrada); ?></td>
                        <td><?php echo e($en->tipo_entrada); ?></td>
                        <td><?php echo e($en->cantidad); ?></td>
                        <td><?php echo e($en->existencia); ?></td>
                        <td><?php echo e($en->producto->nombre); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                </div>
                
                <!-- Tabla de Salidas -->
                <div class="col-md-6 table-responsive" style="max-height: 300px; overflow-y: auto;">
                <h5 style="position: sticky; top: 0; z-index: 1;">Salidas</h5>
                <table class="table table-bordered" style="position: relative; border-collapse: collapse;">
                    <thead class="table-light" style="position: sticky; top: 0; z-index: 1;">
                    <tr>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Cant</th>
                        <th>Producto</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $salidas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($sd->fecha_salida); ?></td>
                        <td><?php echo e($sd->tipo_salida); ?></td>
                        <td><?php echo e($sd->cantidad); ?></td>
                        <td><?php echo e($sd->producto->nombre); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                </div>
                
            </div>
            </div>
            
        </div>
        
        <!-- Botones de Acción -->
        <div class="d-flex justify-content-end mt-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#entradas">
                Registrar entrada
            </button>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#salidas">
                Registrar salida
            </button>
        </div>
        <?php echo $__env->make('productos.entradas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('productos.salidas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php /**PATH C:\xampp\htdocs\EcoMercado\resources\views/productos/inventario.blade.php ENDPATH**/ ?>