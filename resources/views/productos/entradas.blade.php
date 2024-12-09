<!-- Modal salidas-->
<div class="modal fade" id="entradas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar entrada</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="{{route('entradas.store')}}" method="POST">
      @csrf
        <div class="mb-3">
            <label for="id_producto" class="form-label">Producto</label>
            <select id="id_producto" name="id_producto" class="form-control" required>
              @foreach($producto as $pd)
                  <option value="{{ $pd->id_producto }}">{{ $pd->nombre }}</option>
              @endforeach
            </select>

            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="form-control" name="cantidad" id="cantidad" aria-describedby="helpId" required/>

            <label class="form-label" for="tipo">Tipo de entrada</label>    
            <select id="tipo" name="tipo" class="form-control" required>
                <option value="Compra">Seleccionar tipo</option>
                <option value="Compra">Compra</option>
                <option value="Devolucions">Devolucion</option>
            </select>
        </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>