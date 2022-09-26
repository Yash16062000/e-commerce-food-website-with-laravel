

<?php $__env->startSection('main'); ?>

    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
                    <?php if(session()->has('success')): ?>
                      <div class="alert alert-info" role="alert"><strong><?php echo e(session()->get('success')); ?></strong></div>
                    <?php endif; ?> 
					<h2 class="title1">Category List</h2>
					<div class="panel-body widget-shadow">
<!-- permission checker for add category starts -->
					<?php if(Auth::user()->user_type!=1): ?>
                    <?php 
                    $check = Helper::checkOperation(Auth::user()->user_type,3,1);
                    if(!empty($check)) {
                    ?>
						<a class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add New Category</a><br>
					<?php
                    }
                    ?>

                    <?php else: ?>
					<a class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add New Category</a><br>
					<?php endif; ?>
<!-- permission checker for add category ends -->

						<div class="modal fade" id="addCategoryModal" role="dialog" >
							<div class="modal-dialog">
								<div class="modal-content modal-lg">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" >&times;</button>
										<h4 class="modal-title">Add Category :</h4>
									</div>
									<div class="modal-body">
									<form id="addCategory" method="POST"> 
										<?php echo csrf_field(); ?> 
										<div class="form-group"> <label for="title">Select Category &nbsp;</label>
									    <select name="parent_id" class="form-group">
											<option value="0">Parent</option>
											<?php if($categoryList): ?>
											<?php $__currentLoopData = $categoryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php endif; ?>
										</select>
									    </div>
										<div class="form-group"> 
											<label for="title">Dish Name&nbsp;</label>
											<input type="text" name="title"  class="form-control" value="<?php echo e(old('title')); ?>" /> 
										</div>
										<button type="submit" class="btn btn-success">Add </button> 
								    </form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>	
									</div>
								</div>
							</div>
						</div>
                        <br>
						<table class="table table-hover category-datatable">
							<thead>
								<tr>
								  <th>S.No</th>
								  <th>Item List</th>
								  <th>Category</th>
								  <th>Create At</th>
								  <th >Action</th>
								</tr>
							</thead>
							<tbody>
							
							</tbody>
						</table>
					</div><br>
                    
				</div>
			</div>
		</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
   <script type="text/javascript">
  $(function () {
    
    var table = $('.category-datatable').DataTable({
        processing: true,
        serverSide: true,		
        ajax: "<?php echo e(route('admin.getcategory-list')); ?>",
        columns: [
			{data: 'id', name: 'id',orderable: true, searchable: true},
            {data: 'title', name: 'title',orderable: true, searchable: true},
            {data: 'parent_id', name: 'parent_id',orderable: true, searchable: true},
			{data: 'created_at', name: 'created_at',orderable: true, searchable: true},
			{data: 'action', name: 'action' }
        ]
    });
    
  });
  $('#addCategory').submit(function(e) {
           e.preventDefault();
           let formData = new FormData(this);
           $.ajax({
              type:'POST',
              url: " <?php echo e(route('admin.category-store')); ?>" ,
              data: formData,
              contentType: false,
              processData: false,
              success: (response) => {
                if (response) {
                this.reset();
                window.location.href="<?php echo e(route('admin.category-list')); ?>"
                }
               }
           });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-commerce\resources\views/backend/dashboard/category-list.blade.php ENDPATH**/ ?>