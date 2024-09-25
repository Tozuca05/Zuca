
<?php $__env->startSection('title', $viewData["title"]); ?>
<?php $__env->startSection('subtitle', $viewData["subtitle"]); ?>
<?php $__env->startSection('content'); ?>
<div class="search-container">
    <form class="search-form" method="GET" action="<?php echo e(route('product.search')); ?>">
        <div class="input-group">
            <input type="text" class="form-control" name="query" placeholder="<?php echo e(__('Search for products...')); ?>">
            <div class="input-group-append">
                <button class="btn btn-search" type="submit"><?php echo e(__('Search')); ?></button>
            </div>
        </div>
    </form>
</div>
<div class="row">
    <?php $__currentLoopData = $viewData["products"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4 col-lg-3 mb-2">
            <div class="card product-card">
                <img src="<?php echo e(asset('/storage/'.$product->getImage())); ?>" class="card-img-top">
                <div class="card-body text-center">
                    <a href="<?php echo e(route('product.show', ['id'=> $product->getId()])); ?>"
                       class="btn bg-primary text-white"><?php echo e($product->getName()); ?></a>
                </div>
                <div class="card-footer text-center">
                    <form id="add-to-cart-<?php echo e($product->getId()); ?>" method="POST" action="<?php echo e(route('cart.add', ['id'=> $product->getId()])); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="btn btn-primary btn-sm add-to-cart" data-product-id="<?php echo e($product->getId()); ?>">
                            <?php echo e(__('Add to Cart')); ?>

                        </button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.add-to-cart').click(function(e) {
        e.preventDefault();
        var productId = $(this).data('product-id');
        var form = $('#add-to-cart-' + productId);
        
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                Swal.fire({
                    title: '<?php echo e(__("Success!")); ?>',
                    text: '<?php echo e(__("Product added to cart successfully")); ?>',
                    icon: 'success',
                    confirmButtonText: '<?php echo e(__("OK")); ?>'
                });
            },
            error: function() {
                Swal.fire({
                    title: '<?php echo e(__("Error!")); ?>',
                    text: '<?php echo e(__("Error adding product to cart")); ?>',
                    icon: 'error',
                    confirmButtonText: '<?php echo e(__("OK")); ?>'
                });
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Zuca\resources\views/product/index.blade.php ENDPATH**/ ?>