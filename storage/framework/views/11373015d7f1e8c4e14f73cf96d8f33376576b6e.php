

<?php $__env->startSection('main'); ?>
<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
					<h2 class="title1">Edit Dish</h2>
					
					<div class="form-two widget-shadow">
						<div class="form-body" data-example-id="simple-form-inline">
							<form id="editDish" method="POST"  enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('put'); ?>
                                <div class="form-group">
                                    <label for="title">Select Category &nbsp;</label>
                                    <select name="category_id" class="form-group">
                                            <?php if($categoryList): ?>
                                            <?php $__currentLoopData = $categoryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($dish->category_id==$category->id): ?> selected  <?php endif; ?>  value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" value="<?php echo e($dish->title); ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="title">Image</label>
                                    <input type="file" name="image" value="<?php echo e($dish->image); ?>" /><br>
                                    <img title="<?php echo e($dish->image); ?>" alt="<?php echo e($dish->image); ?>" src="<?php echo e(url('uploads/'.$dish->image)); ?>" width="50" height="50">
                                    <span><?php echo e($dish->image); ?></span>
                                    <input type="hidden" name="old_image" value="<?php echo e($dish->image); ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="title">Description</label>
                                    <input type="text" name="description" class="form-control" value="<?php echo e($dish->description); ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="title">Price</label>
                                    <input type="text" name="price" class="form-control" value="<?php echo e($dish->price); ?>" />
                                </div>
                                <button type="submit" class="btn btn-success">Edit</button>
                            </form> 
						</div>
					</div>
					
					
				</div>
			</div>
		</div>

        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
           $('#editDish').submit(function(e) {
           e.preventDefault();
           let formData = new FormData(this);
           $.ajax({
              type:'POST',
              url: "<?php echo e(route('admin.dish-update',[$dish->id])); ?>",
              data: formData,
              contentType: false,
              processData: false,
              success: (response) => {
                if (response) {
                this.reset();
                window.location.href="<?php echo e(route('admin.all-dishes')); ?>"
                }
               }
           });
    });

        </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-commerce\resources\views/backend/dashboard/dish-edit.blade.php ENDPATH**/ ?>