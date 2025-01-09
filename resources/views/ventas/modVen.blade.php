<form action="{{route('ventasProductor.update',$det->id_detalle)}}" method="POST">
@csrf
@method('PUT')
<!-- Modal editar-->
<div class="modal fade" id="edit{{$det->id_detalle}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar venta</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!--cuerpo-->
        <div class="form-outline mb-4">
          <label class="form-label" for="estatus">Estatus</label>    
          <select id="estatus" name="estatus" class="form-control" required>
                <option value="{{$det->estatus}}">Selecciona una opción</option>
                <option value="Finalizado">Finalizado</option>
                <option value="Pendiente">Pendiente</option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Actualizar</button>
      </div>
    </div>
  </div>
</div>
</form>



<!-- Modal eliminar-->
<div class="modal fade" id="delete{{$det->id_detalle}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<form action="{{route('ventasProductor.destroy', $det->id_detalle)}}" method="POST">
@csrf
@method('DELETE')
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar venta</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!--cuerpo-->
        <label>¿Quieres eliminar la venta con ID <strong>{{$det->id_detalle}} </strong>de forma permanente?</label>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  </div>
</div>
</form>