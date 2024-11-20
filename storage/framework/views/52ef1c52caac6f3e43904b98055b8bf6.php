<?php $__env->startSection('title', $viewData['title']); ?>
<?php $__env->startSection('subtitle', $viewData['subtitle']); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="row">
        <?php if(count($viewData['orders']) > 0): ?>
            <?php $__currentLoopData = $viewData['orders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span><strong>Order ID:</strong> <?php echo e($order->getId()); ?></span>
                            <span class="text-muted"><?php echo e($order->getCreatedAt()); ?></span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Order Summary</h5>
                            <ul class="list-group list-group-flush">
                                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?php echo e($item->product->getName()); ?> 
                                        <span>(x<?php echo e($item->getQuantity()); ?>) - $<?php echo e(number_format($item->getPrice() * $item->getQuantity(), 2)); ?></span>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="mt-3 text-end">
                                <strong>Total:</strong> $<?php echo e(number_format($order->getTotal(), 2)); ?>

                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <?php if($order->getStatus() == "Pending"): ?>
                                <form method="POST" action="<?php echo e(route('order.pay', ['id' => $order->getId()])); ?>">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="order_id" value="<?php echo e($order->getId()); ?>">
                                    <div class="form-group">
                                        <label for="payment_method">Select Payment Method:</label>
                                        <select id="payment_method" name="payment_method" class="form-control">
                                            <option value="paypal">PayPal</option>
                                            <option value="balance">Balance</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success mt-3">Pay</button>
                                </form>
                            <?php else: ?>
                                <p class="text-success mb-0"><strong>Status:</strong> Paid</p>
                            <?php endif; ?>
                            <?php
                                $playlistToShow = $order->getAssociatedPlaylist();
                            ?>
                            <?php if($playlistToShow): ?> 
                                <a href="<?php echo e(route('playlists.show', ['id' => $playlistToShow->getId()])); ?>" class="btn btn-primary mt-2" target="_blank">
                                    Check Playlist
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <p>You have no orders.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Zuca\resources\views/order/index.blade.php ENDPATH**/ ?>