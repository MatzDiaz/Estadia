@section('productos')
    <div class="container mt-5">
            <div class="row">
                @foreach($producto as $prod)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm" style="width: 100%;">
                            <!-- Imagen de la publicación -->
                            <img src="{{ asset('storage/' . $prod->imagen) }}" alt="Imagen del producto" class="img-fluid">

                            <div class="card-body">
                                <!-- Título y precio del producto -->
                                <h5 class="card-title">{{ $prod->nombre }} <br> 
                                    <small class="text-muted">$ {{ $prod->precio }}</small>
                                </h5>

                                <!-- Descripción del producto -->
                                <p class="card-text">
                                    {{ Str::limit($prod->descripcion, 100) }}
                                </p>

                                <!-- Botón para agregar al carrito -->
                                <button class="btn btn-success">
                                    <i class="bi bi-cart-plus"></i> Agregar al carrito
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
@endsection