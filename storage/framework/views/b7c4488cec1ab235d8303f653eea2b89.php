<!-- Modal salidas-->
<div class="modal fade" id="salidas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar salida</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="<?php echo e(route('salidas.store')); ?>" method="POST">
      <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="id_producto" class="form-label">Producto</label>
            <select id="id_producto " name="id_producto" class="form-control" required>
              <?php $__currentLoopData = $producto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($pd->id_producto); ?>"><?php echo e($pd->nombre); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <label for="cant" class="form-label">Cantidad</label>
            <input type="number" class="form-control" name="cant" id="cant" aria-describedby="helpId" required/>

            <label class="form-label" for="tipo">Tipo de salida</label>    
            <select id="tipo" name="tipo" class="form-control" required>
                <option value="venta">Seleccionar tipo</option>
                <option value="merma">Merma</option>
                <option value="venta">Venta</option>
            </select>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
      </div>
    </div>
    </form>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\EcoMercado\resources\views/productos/salidas.blade.php ENDPATH**/ ?>