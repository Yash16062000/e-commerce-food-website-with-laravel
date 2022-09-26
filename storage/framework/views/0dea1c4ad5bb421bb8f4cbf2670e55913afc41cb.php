
<?php $__env->startSection('title','| Login Page '); ?>
<?php $__env->startSection('main'); ?>

<div class="container pt-5">
  <h2>Login</h2> 
  <?php if(session()->has('error')): ?>
  <div class="alert alert-danger" role="alert"><strong><?php echo e(session()->get('error')); ?></strong></div>
  <?php endif; ?>   
  <!-- <?php if(Session::has('success')): ?>
  <div class="alert alert-info" role="alert"><strong><?php echo e(Session::get('success')); ?></strong></div>
  <?php endif; ?>          -->
  <div class="row">
    <div class="col-sm-4">
      <form action="/user-login" method="post">
        <?php echo csrf_field(); ?>
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" /><br>
        <?php if($errors->has('email')): ?>
          <p class="text-danger"><?php echo e($errors->first('email')); ?></p>
        <?php endif; ?>
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control"/><br>
        <?php if($errors->has('password')): ?>
          <p class="text-danger"><?php echo e($errors->first('password')); ?></p>
        <?php endif; ?>
        <input type="submit" class="btn btn-info mt-4" value="Login">
        <div class="row">
          <div class="col-8 text-left">
          <a href="" class="btn btn-link">Forgot Password?</a>or<a href="/user-registration" class="btn btn-link">New User</a>
          </div>
         
        
        </div>
        
        
        
      </form>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-commerce\resources\views/frontend/auth/login.blade.php ENDPATH**/ ?>