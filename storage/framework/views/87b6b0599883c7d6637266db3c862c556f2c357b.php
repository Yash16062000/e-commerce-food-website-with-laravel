<!DOCTYPE html>
<html lang="en">
<head>
  <?php echo $__env->make('backend/dashboard/_head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('backend/dashboard/_style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body class="cbp-spmenu-push">
<div class="main-content">
<?php echo $__env->make('backend/dashboard/_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('main'); ?>
<?php echo $__env->make('backend/dashboard/_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->make('backend/dashboard/_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>


<?php echo $__env->yieldContent('script'); ?>



</body>
</html> <?php /**PATH C:\xampp\htdocs\e-commerce\resources\views/backend/dashboard/app.blade.php ENDPATH**/ ?>