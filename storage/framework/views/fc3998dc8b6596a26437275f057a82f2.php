<?php $__env->startSection('title', $viewData["title"]); ?>
<?php $__env->startSection('content'); ?>
    <div class="card mb-4">
        <div class="card-header">
            Edit Product
        </div>
        <div class="card-body">
            <?php if($errors->any()): ?>
                <ul class="alert alert-danger list-unstyled">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>- <?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>
            <form method="POST" action="<?php echo e(route('admin.product.update', ['id'=> $viewData['product']->getId()])); ?>"
                  enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Name:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="name" value="<?php echo e($viewData['product']->getName()); ?>" type="text"
                                       class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Price:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="price" value="<?php echo e($viewData['product']->getPrice()); ?>" type="number"
                                       class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Image:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input class="form-control" type="file" name="image">
                            </d|iv>
                        </div>
                    </div>
                </div>
                <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Stock:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="stock" value="<?php echo e(old('stock')); ?>" type="number" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tag:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <select name="tag_id" class="form-control" required>
                                    <option value="">Select a tag</option>
                                    <?php $__currentLoopData = $viewData["tags"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($tag->getId()); ?>" <?php echo e($viewData['product']->tag && $viewData['product']->tag->getId() == $tag->getId() ? 'selected' : ''); ?>>
                                        <?php echo e($tag->getName()); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="3" required><?php echo e($viewData['product']->getDescription()); ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Zuca\resources\views/admin/product/edit.blade.php ENDPATH**/ ?>