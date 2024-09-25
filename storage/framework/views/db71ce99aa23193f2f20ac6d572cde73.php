 
<?php $__env->startSection('title', $viewData["title"]); ?> 
<?php $__env->startSection('subtitle', $viewData["subtitle"]); ?> 
<?php $__env->startSection('content'); ?> 
<div class="card"> 
  <div class="card-header"> 
    Products in Cart 
  </div> 
  <div class="card-body"> 
    <table class="table table-bordered table-striped text-center"> 
      <thead> 
        <tr> 
          <th scope="col">ID</th> 
          <th scope="col">Name</th> 
          <th scope="col">Price</th> 
          <th scope="col">Quantity</th> 
          <th scope="col">Actions</th>
        </tr> 
      </thead> 

      <tbody> 
        <?php $__currentLoopData = $viewData["products"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
        <tr> 
          <td><?php echo e($product->getId()); ?></td> 
          <td><?php echo e($product->getName()); ?></td> 
          <td>$<?php echo e($product->getPrice()); ?></td> 
          <td>
          <form action="<?php echo e(route('cart.subtract', ['id' => $product->getId()])); ?>" method="POST" style="display:inline;">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-sm btn-secondary">-</button>
          </form>
          <?php echo e(session('products')[$product->getId()]); ?>

          <form action="<?php echo e(route('cart.add', ['id' => $product->getId()])); ?>" method="POST" style="display:inline;">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-sm btn-secondary">+</button>
          </form>
          </td>
          <td>
            <a href="<?php echo e(route('cart.remove', ['id' => $product->getId()])); ?>" class="btn btn-danger">
              Remove
            </a>
          </td>
        </tr> 
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
      </tbody> 
    </table> 
    <div class="row"> 
      <div class="text-end"> 
        <a class="btn btn-outline-secondary mb-2"><b>Total to pay:</b> $<?php echo e($viewData["total"]); ?></a> 
        <a href="<?php echo e(route('order.create')); ?>" class="btn bg-primary text-white mb-2">Purchase</a> 
        <a href="<?php echo e(route('cart.delete')); ?>"> 
          <button class="btn btn-danger mb-2"> 
            Remove all products from Cart 
          </button> 
        </a>  

      </div> 
    </div> 
  </div> 
</div> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Zuca\resources\views/cart/index.blade.php ENDPATH**/ ?>