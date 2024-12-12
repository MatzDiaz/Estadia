<form action="{{route('blog.update', $bg->id_blog)}}" method="POST">
@csrf
@method('PUT')
<!-- Modal editar-->
<div class="modal fade" id="edit{{$bg->id_blog}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!--cuerpo-->
            <div class="form-group mb-3">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ingresa el título" required>
                @if ($errors->has('titulo'))
                    <spam class="text-danger"> {{ $errors->first('titulo') }} </spam>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Ingresa la descripción" required></textarea>
                @if ($errors->has('descripcion'))
                    <spam class="text-danger"> {{ $errors->first('descripcion') }} </spam>  
                @endif
            </div>
        
        <!--  -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Actualizar</button>
      </div>
    </div>
  </div>
</div>
</form>

<form action="{{route('blog.store')}}" method="POST">
@csrf
@method('DELETE')
<!-- Modal eliminar-->
<div class="modal fade" id="delete{{$bg->id_blog}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar publicación</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!--cuerpo-->
        <label>¿Quieres eliminar la publicación <strong>{{$bg->titulo}} </strong>de forma permanente?</label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  </div>
</div>
</form>