<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backup y Restauración</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <!-- Incluye la barra de navegación -->
<div class="container">
    <h1>Respaldo y Restauración</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <h2>Generar respaldo</h2>
    <form action="<?php echo e(route('backup.generate')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-primary">Generar respaldo</button>
    </form>

    <h2 class="mt-4">Restaurar respaldo</h2>
    <form action="<?php echo e(route('backup.restore')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <input type="file" name="backup_file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Restaurar</button>
    </form>

    <h2 class="mt-4">Respaldos disponibles</h2>
    <ul class="list-group">
        <?php $__empty_1 = true; $__currentLoopData = $backups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $backup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <li class="list-group-item">
                <?php echo e($backup->path()); ?>

                <span class="text-muted">(<?php echo e($backup->size()); ?> bytes)</span>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <li class="list-group-item">No hay respaldos disponibles.</li>
        <?php endif; ?>
    </ul>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\EcoMercado\resources\views/backup_restore/index.blade.php ENDPATH**/ ?>