
<?php $__env->startSection('title', $viewData["title"]); ?>
<?php $__env->startSection('subtitle', $viewData["subtitle"]); ?>
<?php $__env->startSection('content'); ?>
    <div class="card mb-3 shadow-sm">
        <div class="row g-0">
            <div class="col-md-4">
            <img src="<?php echo e(asset('storage/'.$viewData['product']->getImage())); ?>" class="img-fluid rounded-start" alt="<?php echo e($viewData['product']->getName()); ?>">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h3 class="card-title">
                        <?php echo e($viewData["product"]->getName()); ?>

                        <span class="text-muted">($<?php echo e(number_format($viewData["product"]->getPrice(), 2)); ?>)</span>
                    </h3>
                    <p class="card-text mt-3"><?php echo e($viewData["product"]->getDescription()); ?></p>
                    <div class="mb-3">
                        <p class="card-text">
                            <small class="text-muted">
                                Created at: <?php echo e($viewData["product"]->created_at->format('Y-m-d H:i')); ?>

                            </small><br>
                            <small class="text-muted">
                                Updated at: <?php echo e($viewData["product"]->updated_at->format('Y-m-d H:i')); ?>

                            </small>
                        </p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <form method="POST" action="<?php echo e(route('admin.product.delete', ['id'=> $viewData['product']->getId()])); ?>">
                            <?php echo csrf_field(); ?>
                            <?php if(Auth::user()->getRole() === 'admin'): ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Delete Product
                            </button>
                            <?php endif; ?>
                            <a href="<?php echo e(route('product.index')); ?>" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Back to Products
                            </a>
                        </form>
                        <form id="add-to-cart-<?php echo e($viewData['product']->getId()); ?>" method="POST" action="<?php echo e(route('cart.add', ['id'=> $viewData['product']->getId()])); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-success add-to-cart" data-product-id="<?php echo e($viewData['product']->getId()); ?>">
                                <i class="bi bi-cart-plus"></i> Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Zuca\resources\views/product/show.blade.php ENDPATH**/ ?>