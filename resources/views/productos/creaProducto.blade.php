<form action="{{route('productos.store')}}" method="POST" enctype="multipart/form-data">
@csrf
<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar producto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!--cuerpo-->
        <div class="mb-3">
            <!-- Nombre del Producto -->
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese el nombre del producto" required>
        </div>
        
        <div class="mb-3">
            <!-- Descripción -->
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion" rows="3" placeholder="Ingrese una descripción del producto" required></textarea>
        </div>
        
        <div class="mb-3">
            <!-- Precio -->
            <label for="precio" class="form-label">Precio</label>
            <input type="text" class="form-control" name="precio" id="precio" placeholder="Ingrese el precio del producto" step="0.01" min="0" required>
        </div>
        
        <div class="mb-3">
            <!-- Imagen -->
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" name="imagen" id="imagen" accept="image/*" required>
        </div>
        
        <div class="mb-3">
            <!-- Categoría -->
            <label for="id_categoria" class="form-label">Categoría</label>
            <select class="form-control" name="id_categoria" id="id_categoria" required>
                <option value="">Seleccione una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria}}">{{ $categoria->nombre_cat}}</option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="id_productor" value="{{ auth()->user()->id }}">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Agregar</button>
      </div>
    </div>
  </div>
</div>
</form>