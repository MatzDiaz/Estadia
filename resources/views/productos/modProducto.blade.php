  <!-- Modal -editar -->
  <div class="modal fade" id="edit{{$prod->id_producto}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="{{ route('productos.update', $prod->id_producto) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar producto</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Cuerpo -->
          <div class="mb-3">
            <!-- Nombre del Producto -->
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $prod->nombre }}" required>
          </div>
          
          <div class="mb-3">
            <!-- Descripción -->
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required>{{ $prod->descripcion }}</textarea>
          </div>
          
          <div class="mb-3">
            <!-- Precio -->
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" name="precio" id="precio" value="{{ $prod->precio }}" step="0.01" min="0" required>
          </div>
          
          <div class="mb-3">
            <!-- Imagen -->
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" name="imagen" id="imagen" accept="image/*">
            <small class="form-text text-muted">Deje este campo vacío si no desea cambiar la imagen.</small>
          </div>
          
          <div class="mb-3">
            <!-- Categoría -->
            <label for="id_categoria" class="form-label">Categoría</label>
            <select class="form-control" name="id_categoria" id="id_categoria" required>
              @foreach($categorias as $categoria)
                <option value="{{ $categoria->id_categoria }}" {{ $categoria->id_categoria == $prod->id_categoria ? 'selected' : '' }}>
                  {{ $categoria->nombre_cat }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success">Guardar cambios</button>
        </div>
      </div>
    </div>
  </div>
</form>


<!-- Modal eliminar -->
<div class="modal fade" id="delete{{$prod->id_producto}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"> <!-- Centrado verticalmente -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <p>¿Quieres eliminar el producto <strong>{{ $prod->nombre }}</strong> de forma permanente?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <form action="{{ route('productos.destroy', $prod->id_producto) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>
