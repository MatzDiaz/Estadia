<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
            <img src="<?php echo e(asset('assets/LogoComercio.png')); ?>" style="width: 100px;" alt="logo">
        </a>
        
        <!-- Botón de colapso (hamburguesa) para dispositivos pequeños -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('/') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('productos') ? 'active' : ''); ?>" href="<?php echo e(route('usuarios.productores')); ?>">Productores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('contacto') ? 'active' : ''); ?>" href="<?php echo e(route('usuarios.usuarios')); ?>">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('categorias') ? 'active' : ''); ?>" href="<?php echo e(route('categorias.index')); ?>">Categorías</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('blog') ? 'active' : ''); ?>" href="<?php echo e(route('blog.index')); ?>">Blog</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('entradas') ? 'active' : ''); ?>" href="<?php echo e(route('entradas.index')); ?>">Inventario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('productos') ? 'active' : ''); ?>" href="<?php echo e(route('productos.index')); ?>">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('base') ? 'active' : ''); ?>" href="<?php echo e(route('base.index')); ?>">Base de datos</a>
                </li>
                <!-- Enlace para iniciar o cerrar sesión -->
                <?php if(auth()->guard()->check()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->is('carrito') ? 'active' : ''); ?>" href="<?php echo e(route('carrito.index')); ?>"><h4><i class="bi bi-cart4"></i></h4></a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('login')); ?>">Iniciar sesión</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap JS (necesario para el botón de hamburguesa) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php /**PATH C:\xampp\htdocs\EcoMercado\resources\views/partials/navbar.blade.php ENDPATH**/ ?>