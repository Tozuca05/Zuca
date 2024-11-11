<?php $__env->startSection('title',$viewData["title"]); ?>
<?php $__env->startSection('subtitle',$viewData["subtitle"]); ?>
<?php $__env->startSection('content'); ?>
<div class="text-center">

  Welcome to the application
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Zuca\resources\views/home/index.blade.php ENDPATH**/ ?>