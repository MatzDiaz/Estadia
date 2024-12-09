<form action="<?php echo e(route('categorias.update',$categoria->id_categoria)); ?>" method="POST">
<?php echo csrf_field(); ?>
<?php echo method_field('PUT'); ?>
<!-- Modal editar-->
<div class="modal fade" id="edit<?php echo e($categoria->id_categoria); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar categoría</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!--cuerpo-->
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" required value="<?php echo e($categoria->nombre_cat); ?>"/>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Descripción</label>
            <input type="text" class="form-control" name="descripcion" id="descripcion" required value="<?php echo e($categoria->descripcion); ?>"/>
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
<div class="modal fade" id="delete<?php echo e($categoria->id_categoria); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<form action="<?php echo e(route('categorias.destroy', $categoria->id_categoria)); ?>" method="POST">
<?php echo csrf_field(); ?>
<?php echo method_field('DELETE'); ?>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar categoría</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!--cuerpo-->
        <label>¿Quieres eliminar la categoría <strong><?php echo e($categoria->nombre_cat); ?> </strong>de forma permanente?</label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  </div>
</div>
</form><?php /**PATH C:\xampp\htdocs\EcoMercado\resources\views/categorias/modCat.blade.php ENDPATH**/ ?>