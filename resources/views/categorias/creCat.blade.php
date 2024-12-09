<form action="{{route('categorias.store')}}" method="POST">
@csrf
<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar categoría</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!--cuerpo-->
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" required/>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Descripción</label>
            <input type="text" class="form-control" name="descripcion" id="descripcion" required/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Agregar</button>
      </div>
    </div>
  </div>
</div>
</form>