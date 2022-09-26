

<?php $__env->startSection('main'); ?>
<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
                    <?php if(session()->has('success')): ?>
                      <div class="alert alert-info" role="alert"><strong><?php echo e(session()->get('success')); ?></strong></div>
                    <?php endif; ?> 
					<h2 class="title1">Roles</h2>
					<div class="panel-body widget-shadow">
              <!-- permission checker for add role permission starts -->
              <?php if(Auth::user()->user_type!=1): ?>
                <?php 
                $check = Helper::checkOperation(Auth::user()->user_type,5,1);
                if(!empty($check)) {
                ?>
                <a class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add New Role</a>
                <?php
                }
                ?>

                <?php else: ?>
                <a class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add New Role</a>
                
              <?php endif; ?>
              <!-- permission checker for add role permission ends -->

						<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="exampleModalLabel">Add Role :</h4>
									</div>
									<div class="modal-body">
									<form id="addRole" method="POST"> 
										<?php echo csrf_field(); ?> 
										<div class="form-group"> 
                      <label for="title">Role&nbsp;</label>
                      <input type="text" name="role_type" class="form-control"/> 
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
                        
						<table class="table table-hover">
							<thead>
								<tr>
								  <th>S.No</th>
								  <th>Role Type</th>
								  <th colspan="2">Action</th>
								</tr>
							</thead>
							<tbody>
              <?php $__currentLoopData = $roleList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
								  <th scope="row"><?php echo e($loop->index +1); ?></th>
								  <td><?php echo e($role->role_type); ?></td>
								  <td>
                  <!-- permission checker for view role permission starts -->
                  <?php if(Auth::user()->user_type!=1): ?>
                    <?php 
                    $check = Helper::checkOperation(Auth::user()->user_type,5,4);
                    if(!empty($check)) {
                    ?>
                    <a class="btn btn-info" data-toggle="modal" data-target="#viewPermissionInfo" onclick="ViewPermission('<?php echo e($role->id); ?>');"><i class="fa fa-eye"></i></a>
                    <?php
                    }
                    ?>

                    <?php else: ?>
                    <a class="btn btn-info" data-toggle="modal" data-target="#viewPermissionInfo" onclick="ViewPermission('<?php echo e($role->id); ?>');"><i class="fa fa-eye"></i></a>
                  <?php endif; ?>
                  <!-- permission checker for view role permission ends -->

                  <!-- permission checker for edit role permission starts -->
                  <?php if(Auth::user()->user_type!=1): ?>
                    <?php 
                    $check = Helper::checkOperation(Auth::user()->user_type,5,2);
                    if(!empty($check)) {
                    ?>
                    <a class="btn btn-success" data-toggle="modal" data-target="#editPermissionInfo" onclick="EditPermission('<?php echo e($role->id); ?>');"><i class="fa fa-pencil"></i></a>
                    <?php
                    }
                    ?>

                    <?php else: ?>
                    <a class="btn btn-success" data-toggle="modal" data-target="#editPermissionInfo" onclick="EditPermission('<?php echo e($role->id); ?>');"><i class="fa fa-pencil"></i></a>
                  <?php endif; ?>
                  <!-- permission checker for edit role permission ends -->

                  <!-- permission checker for edit role permission starts -->
                  <?php if(Auth::user()->user_type!=1): ?>
                    <?php 
                    $check = Helper::checkOperation(Auth::user()->user_type,5,3);
                    if(!empty($check)) {
                    ?>
                    <a onclick="RemoveRole('<?php echo e($role->id); ?>');" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    <?php
                    }
                    ?>

                    <?php else: ?>
                    <a onclick="RemoveRole('<?php echo e($role->id); ?>');" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    <a data-toggle="modal" data-target="#addAdminCredentials" onclick="AddAdminUser('<?php echo e($role->id); ?>');" class="btn btn-primary"><i class="fa fa-user"></i></a>
                  <?php endif; ?>
                  <!-- permission checker for edit role permission ends -->
                  </td>
								</tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
                        
					</div><br>
                    
				</div>
			</div>
		</div>
<!-- view permission modal starts -->
    <div id="viewPermissionInfo" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> View Permission</h4>
      </div>
      <div class="modal-body">
        <div class="panel-body widget-shadow"> 
           
        <div id="permissionDetails"></div>
      
    </div>
  </div>
  </div>
  </div>
  </div>

  <!-- view permission modal ends -->


  <!-- edit permission modal starts -->
  <div id="editPermissionInfo" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Edit Permission</h4>
      </div>
      <div class="modal-body">
        <div class="panel-body widget-shadow"> 
           
        <div id="editpermissionDetails"></div>
      
    </div>
  </div>
  </div>
  </div>
  </div>

  <!-- edit permission modal ends -->

  <!-- add admin id modal starts -->
  <div id="addAdminCredentials" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create User </h4>
      </div>
      <div class="modal-body">
        <div class="panel-body widget-shadow"> 
           
        <div id="loginAdmin"></div>
      
    </div>
  </div>
  </div>
  </div>
  </div>

  <!-- add admin id modal ends -->

  <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#addRole').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
          type:'POST',
          url: "<?php echo e(route('admin.role_store')); ?>",
          data: formData,
          contentType: false,
          processData: false,
          success: (response) => {
            if (response) {
            this.reset();
            window.location.href="<?php echo e(route('admin.all-roles')); ?>"
            }
            }
        });
        });

        function RemoveRole(role_id){
        alert("Are you Sure You want to delete this role?");
        var data = "role_id="+role_id;
        $.ajax({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'GET',
            url: "<?php echo e(route('admin.remove_role')); ?>",			  
            data:data,              
            success: (response) => {
            window.location.reload();
            }
        });
      }

      function ViewPermission(role_id){   
      var data = "role_id="+role_id;
      //alert(data);
      $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'GET',
        url: "<?php echo e(route('admin.view-permission-details')); ?>",			  
        data:data,              
        success:  function (response) {       
          $('#permissionDetails').html(response);        
        }  
      });
    }

    
    function EditPermission(role_id){   
      var data = "role_id="+role_id;
      //alert(data);
      $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'GET',
        url: "<?php echo e(route('admin.edit-permission-details')); ?>",			  
        data:data,              
        success:  function (response) {       
          $('#editpermissionDetails').html(response);        
        }  
      });
    }

    function AddAdminUser(role_id){
      var data = "role_id="+role_id;
      //alert(data);
      $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'GET',
        url: "<?php echo e(route('admin.admin-register')); ?>",			  
        data:data,              
        success:  function (response) {       
          $('#loginAdmin').html(response);        
        }  
      });
    }

  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-commerce\resources\views/backend/dashboard/role.blade.php ENDPATH**/ ?>