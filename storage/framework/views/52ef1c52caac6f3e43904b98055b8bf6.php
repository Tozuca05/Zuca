<?php $__env->startSection('title', $viewData["title"]); ?>
<?php $__env->startSection('subtitle',$viewData["subtitle"]); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <?php if(count($viewData['orders']) > 0): ?>
        <?php $__currentLoopData = $viewData['orders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>Order ID: <?php echo e($order->getId()); ?></span>
                        <span><?php echo e($order->getCreatedAt()); ?></span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Order Summary</h5>
                        <ul class="list-group list-group-flush">
                            <?php $__currentLoopData = $order->getItems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item">
                                    <?php echo e($item->getProduct()->getName()); ?> 
                                    (x<?php echo e($item->getQuantity()); ?>): $<?php echo e($item->getPrice() * $item->getQuantity()); ?>

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <div class="mt-3">
                            <strong>Total: $<?php echo e($order->getTotal()); ?></strong>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <?php if($order->getStatus() == "Pending"): ?>
                            <form method="POST" action="<?php echo e(route('order.pay', ['id' => $order->getId()])); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-success">Pay</button>
                            </form>
                        <?php else: ?>
                            <p class="text-success mb-2">Order is paid</p>
                        <?php endif; ?>
                        <?php
                            $playlistToShow = $order->getAssociatedPlaylist();
                        ?>
                        <?php if($playlistToShow): ?>
                            <a href="<?php echo e($playlistToShow->getLink()); ?>" class="btn btn-primary" target="_blank">
                                Check your playlist
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <div class="col-12">
            <p class="text-center">You have no orders.</p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Zuca\resources\views/order/index.blade.php ENDPATH**/ ?>