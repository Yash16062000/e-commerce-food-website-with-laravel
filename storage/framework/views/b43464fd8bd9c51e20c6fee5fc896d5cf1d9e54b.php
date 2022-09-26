<!DOCTYPE html>
<html lang="en">
<head>
  <?php echo $__env->make('frontend/_head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('frontend/_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('frontend/_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div>
<?php echo $__env->yieldContent('main'); ?>
</div>
<br>
<?php echo $__env->make('frontend/_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend/_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldContent('script'); ?>


</body>
</html> <?php /**PATH C:\xampp\htdocs\e-commerce\resources\views/frontend/app.blade.php ENDPATH**/ ?>