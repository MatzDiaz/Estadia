<form action="{{route('usuarios.update', $usuario->id)}}" method="POST">
@csrf
@method('PUT')
<!-- Modal editar-->
<div class="modal fade" id="edit{{$usuario->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!--cuerpo-->
        
        <!-- Campo de Nombre -->
        <div class="form-outline mb-4">
            <label class="form-label" for="name">Nombre</label>
            <input type="text" id="name" name="nombre" class="form-control" placeholder="Nombre" required  value="{{$usuario->name}}"/>
        </div>

        <!-- Campo de Apellido -->
        <div class="form-outline mb-4">
            <label class="form-label" for="apellido">Apellido</label>
            <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Apellido" required value="{{$usuario->apellido}}"/>
        </div>

        <!-- Campo de Correo Electrónico -->
        <div class="form-outline mb-4">
            <label class="form-label" for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Correo Electrónico" required value="{{$usuario->email}}"/>
        </div>

        <!-- Campo de Teléfono -->
        <div class="form-outline mb-4">
            <label class="form-label" for="telefono">Teléfono</label>
            <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Teléfono" value="{{$usuario->telefono}}"/>
        </div>

        <!-- Campo de Estado -->
    <div class="form-outline mb-4">
        <label class="form-label" for="direccion">Estado</label>
        <select id="direccion" name="direccion" class="form-control">
            <option value="" disabled selected>{{$usuario->direccion}}</option>
            <option value="Aguascalientes">Aguascalientes</option>
            <option value="Baja California">Baja California</option>
            <option value="Baja California Sur">Baja California Sur</option>
            <option value="Campeche">Campeche</option>
            <option value="Chiapas">Chiapas</option>
            <option value="Chihuahua">Chihuahua</option>
            <option value="Ciudad de México">Ciudad de México</option>
            <option value="Coahuila">Coahuila</option>
            <option value="Colima">Colima</option>
            <option value="Durango">Durango</option>
            <option value="Estado de México">Estado de México</option>
            <option value="Guanajuato">Guanajuato</option>
            <option value="Guerrero">Guerrero</option>
            <option value="Hidalgo">Hidalgo</option>
            <option value="Jalisco">Jalisco</option>
            <option value="Michoacán">Michoacán</option>
            <option value="Morelos">Morelos</option>
            <option value="Nayarit">Nayarit</option>
            <option value="Nuevo León">Nuevo León</option>
            <option value="Oaxaca">Oaxaca</option>
            <option value="Puebla">Puebla</option>
            <option value="Querétaro">Querétaro</option>
            <option value="Quintana Roo">Quintana Roo</option>
            <option value="San Luis Potosí">San Luis Potosí</option>
            <option value="Sinaloa">Sinaloa</option>
            <option value="Sonora">Sonora</option>
            <option value="Tabasco">Tabasco</option>
            <option value="Tamaulipas">Tamaulipas</option>
            <option value="Tlaxcala">Tlaxcala</option>
            <option value="Veracruz">Veracruz</option>
            <option value="Yucatán">Yucatán</option>
            <option value="Zacatecas">Zacatecas</option>
        </select>

        <!-- Campo de Sexo -->
        <div class="form-outline mb-4">
          <label class="form-label" for="sexo">Sexo</label>    
          <select id="sexo" name="sexo" class="form-control" required>
                <option value="{{$usuario->sexo}}">{{$usuario->sexo}}</option>
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
        <button type="submit" class="btn btn-success">Actualizar</button>
      </div>
    </div>
  </div>
</div>
</form>

  
<!-- Modal eliminar-->
<div class="modal fade" id="delete{{$usuario->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<form action="{{route('usuarios.destroy', $usuario->id)}}" method="POST">
@csrf
@method('DELETE')
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!--cuerpo-->
        <label>¿Quieres eliminar al productor <strong>{{$usuario->name 
        }} </strong>de forma permanente?</label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  </div>
</div>
</form>