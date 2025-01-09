<div class="modal fade" id="edit{{$bg->id_blog}}" tabindex="-1" aria-labelledby="editLabel{{$bg->id_blog}}" aria-hidden="true">
    <form action="{{route('blog.update', $bg->id_blog)}}" method="POST">
        @csrf
        @method('PUT')
        <!-- Modal Editar -->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editLabel{{$bg->id_blog}}">Editar Blog</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Cuerpo -->
                    <div class="form-group mb-3">
                        <label for="titulo{{$bg->id_blog}}">Título</label>
                        <input type="text" class="form-control" id="titulo{{$bg->id_blog}}" name="titulo" value="{{ old('titulo', $bg->titulo) }}" placeholder="Ingresa el título" required>
                        @if ($errors->has('titulo'))
                            <span class="text-danger">{{ $errors->first('titulo') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="descripcion{{$bg->id_blog}}">Descripción</label>
                        <textarea class="form-control" id="descripcion{{$bg->id_blog}}" name="descripcion" rows="3" placeholder="Ingresa la descripción" required>{{ old('descripcion', $bg->descripcion) }}</textarea>
                        @if ($errors->has('descripcion'))
                            <span class="text-danger">{{ $errors->first('descripcion') }}</span>
                        @endif
                    </div>
                    <!-- Fin del cuerpo -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Modal Eliminar -->
<div class="modal fade" id="delete{{$bg->id_blog}}" tabindex="-1" aria-labelledby="deleteLabel{{$bg->id_blog}}" aria-hidden="true">
    <form action="{{ route('blog.destroy', $bg->id_blog) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteLabel{{$bg->id_blog}}">Eliminar publicación</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Cuerpo -->
                    <label>¿Seguro que deseas eliminar la publicación <strong>{{$bg->titulo}}</strong> de forma permanente?</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </form>
</div>
