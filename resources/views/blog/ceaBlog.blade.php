<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva publicación</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" class="p-4">
            @csrf
            <!-- Campo oculto para la fecha de publicación -->
            <input type="hidden" name="fecha_pub" value="{{ date('Y-m-d') }}">

            <!-- Campo oculto para el autor de publicación -->
            <input type="hidden" name="id_productor" value="{{ auth()->user()->id }}">

            <div class="form-group mb-3">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ingresa el título" required>
            </div>

            <div class="form-group mb-3">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Ingresa la descripción" required></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="multimedia">Archivo Multimedia</label>
                <input type="file" class="form-control" id="imagen" name="imagen">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Agregar</button>
      </div>
      </form>
    </div>
  </div>
</div>