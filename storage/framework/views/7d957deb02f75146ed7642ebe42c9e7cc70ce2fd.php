

<?php $__env->startSection('main'); ?>
<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
					<h2 class="title1">Edit Category</h2>
					
					<div class="form-two widget-shadow">
						<div class="form-body" data-example-id="simple-form-inline">
							<form class="form-inline" action="<?php echo e(route('admin.category-update',[$category->id])); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('put'); ?>
                            <div class="form-group"> <label for="title">Dish Name</label><input type="text" name="title" id="" class="form-control" value="<?php echo e($category->title); ?>" /> </div>
                            <button type="submit" class="btn btn-success">Update</button> </form> 
						</div>
					</div>
					
					
				</div>
			</div>
		</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-commerce\resources\views/backend/dashboard/category-edit.blade.php ENDPATH**/ ?>