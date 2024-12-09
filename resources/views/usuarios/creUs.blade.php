<form action="{{route('usuarios.store')}}" method="POST">
@csrf
<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!--cuerpo-->
        
        <!-- Campo de Nombre -->
        <div class="form-outline mb-4">
            <label class="form-label" for="name">Nombre</label>
            <input type="text" id="name" name="nombre" class="form-control" placeholder="Nombre" required />
        </div>

        <!-- Campo de Apellido -->
        <div class="form-outline mb-4">
            <label class="form-label" for="apellido">Apellido</label>
            <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Apellido" required />
        </div>

        <!-- Campo de Correo Electrónico -->
        <div class="form-outline mb-4">
            <label class="form-label" for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Correo Electrónico" required />
        </div>

        <!-- Campo de Contraseña -->
        <div class="form-outline mb-4">
        <label class="form-label" for="password">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required />
        </div>

        <!-- Campo de Teléfono -->
        <div class="form-outline mb-4">
            <label class="form-label" for="telefono">Teléfono</label>
            <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Teléfono" />
        </div>

        <!-- Campo de Dirección -->
        <div class="form-outline mb-4">
            <label class="form-label" for="direccion">Dirección</label>
            <textarea id="direccion" name="direccion" class="form-control" placeholder="Dirección"></textarea>
        </div>

        <!-- Campo de Sexo -->
        <div class="form-outline mb-4">
          <label class="form-label" for="sexo">Sexo</label>    
          <select id="sexo" name="sexo" class="form-control" required>
                <option value="otro">Selecciona tu sexo</option>
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
                <option value="otro">Otro</option>
            </select>
        </div>

        <input type="text" name="rol" class="form-control" value="Consumidor" hidden />

        <!--  -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Agregar</button>
      </div>
    </div>
  </div>
</div>
</form>