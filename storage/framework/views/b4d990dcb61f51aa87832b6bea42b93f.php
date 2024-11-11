<?php $__env->startSection('title', $viewData['title']); ?>

<?php $__env->startSection('content'); ?>
<div class="card mb-4">
    <div class="card-header">
        Top Selling Products
    </div>
    <div class="card-body">
        <?php if($viewData['topProducts']->isEmpty()): ?>
            <p>No sales data available.</p>
        <?php else: ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity Sold</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $viewData['topProducts']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->getProduct()->getName()); ?></td>
                            <td><?php echo e($item->getTotalSold()); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Zuca\resources\views/admin/item/top_sold.blade.php ENDPATH**/ ?>