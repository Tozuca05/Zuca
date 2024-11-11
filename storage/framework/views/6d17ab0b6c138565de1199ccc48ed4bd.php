<?php $__env->startSection('title', $viewData["title"]); ?>
<?php $__env->startSection('content'); ?>
<div class="card mb-4">
    <div class="card-header">
        Create Product
    </div>
    <div class="card-body">
        <?php if($errors->any()): ?>
        <ul class="alert alert-danger list-unstyled">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>- <?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('admin.product.store')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Name:</label>
                        <input name="name" value="<?php echo e(old('name')); ?>" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Price:</label>
                        <input name="price" value="<?php echo e(old('price')); ?>" type="number" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Image:</label>
                        <input class="form-control" type="file" name="image" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Stock:</label>
                        <input name="stock" value="<?php echo e(old('stock')); ?>" type="number" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Tag:</label>
                        <select name="tag_id" class="form-control" required>
                            <option value="">Select a tag</option>
                            <?php $__currentLoopData = $viewData["tags"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tag->getId()); ?>"><?php echo e($tag->getName()); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Description:</label>
                <textarea class="form-control" name="description" rows="3" required><?php echo e(old('description')); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Manage Products
    </div>
    <div class="card-body">
        <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Tag</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $viewData["products"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($product->getId()); ?></td>
                    <td><?php echo e($product->getName()); ?></td>
                    <td>$<?php echo e($product->getPrice()); ?></td>
                    <td><?php echo e($product->getStock()); ?></td>
                    <td><?php echo e($product->tag ? $product->tag->getName() : 'No Tag'); ?></td>
                    <td>
                        <a class="btn btn-primary" href="<?php echo e(route('admin.product.edit', ['id'=> $product->getId()])); ?>">
                            <i class="bi-pencil"></i>
                        </a>
                    </td>
                    <td>
                        <form action="<?php echo e(route('admin.product.delete', $product->getId())); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-danger">
                                <i class="bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Zuca\resources\views/admin/product/index.blade.php ENDPATH**/ ?>