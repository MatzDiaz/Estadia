  <!-- Modal -editar -->
  <div class="modal fade" id="edit<?php echo e($prod->id_producto); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="<?php echo e(route('productos.update', $prod->id_producto)); ?>" method="POST" enctype="multipart/form-data">
  <?php echo csrf_field(); ?>
  <?php echo method_field('PUT'); ?>
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
            <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo e($prod->nombre); ?>" required>
          </div>
          
          <div class="mb-3">
            <!-- Descripción -->
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required><?php echo e($prod->descripcion); ?></textarea>
          </div>
          
          <div class="mb-3">
            <!-- Precio -->
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" name="precio" id="precio" value="<?php echo e($prod->precio); ?>" step="0.01" min="0" required>
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
              <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($categoria->id_categoria); ?>" <?php echo e($categoria->id_categoria == $prod->id_categoria ? 'selected' : ''); ?>>
                  <?php echo e($categoria->nombre_cat); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<div class="modal fade" id="delete<?php echo e($prod->id_producto); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"> <!-- Centrado verticalmente -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <p>¿Quieres eliminar el producto <strong><?php echo e($prod->nombre); ?></strong> de forma permanente?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <form action="<?php echo e(route('productos.destroy', $prod->id_producto)); ?>" method="POST">
          <?php echo csrf_field(); ?>
          <?php echo method_field('DELETE'); ?>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\EcoMercado\resources\views/productos/modProducto.blade.php ENDPATH**/ ?>