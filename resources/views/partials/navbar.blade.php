<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('assets/LogoComercio.png') }}" style="width: 100px;" alt="logo">
        </a>
        
        <!-- Botón de colapso (hamburguesa) para dispositivos pequeños -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @if (auth()->user() && auth()->user()->rol=='Admin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('graficas.ver') ? 'active' : '' }}" href="{{ route('graficas.ver') }}">Dashboard</a>
                    </li>    

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('productos') ? 'active' : '' }}" href="{{ route('usuarios.productores') }}">Productores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contacto') ? 'active' : '' }}" href="{{ route('usuarios.usuarios') }}">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('categorias') ? 'active' : '' }}" href="{{ route('categorias.index') }}">Categorías</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('blog') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('entradas') ? 'active' : '' }}" href="{{ route('entradas.index') }}">Inventario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('productos') ? 'active' : '' }}" href="{{ route('productos.index') }}">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('base') ? 'active' : '' }}" href="{{ route('base.index') }}">Base de datos</a>
                    </li>
                @endif
                @if (auth()->user() && auth()->user()->rol=='Consumidor')
                    @include('partials.navConsu')
                @endif

                @if (auth()->user() && auth()->user()->rol=='Productor')
                    @include('partials.notify')
                    @include('partials.navProductor')
                @endif

                <!-- Enlace para iniciar o cerrar sesión -->
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('carrito') ? 'active' : '' }}" href="{{ route('carrito.Mostrar') }}"><h4><i class="bi bi-cart4"></i></h4></a>
                    </li>
                    
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap JS (necesario para el botón de hamburguesa) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
