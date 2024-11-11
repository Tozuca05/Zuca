<?php $__env->startSection('title', $viewData["title"]); ?>
<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <div class="card mb-4">
        <div class="card-header">
            Create Tag
        </div>
        <div class="card-body">
            <?php if($errors->any()): ?>
                <ul class="alert alert-danger list-unstyled">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>- <?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('admin.tag.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Name:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="name" value="<?php echo e(old('name')); ?>" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create Tag</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Manage Tags
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $viewData["tags"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($tag->getId()); ?></td>
                            <td><?php echo e($tag->getName()); ?></td>
                            <td>
                                <a class="btn btn-primary" href="<?php echo e(route('admin.tag.edit', ['id'=> $tag->getId()])); ?>">
                                    <i class="bi-pencil"></i>
                                </a>
                            </td>
                            <td>
                                <form action="<?php echo e(route('admin.tag.delete', $tag->getId())); ?>" method="POST">
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Zuca\resources\views/admin/tag/index.blade.php ENDPATH**/ ?>