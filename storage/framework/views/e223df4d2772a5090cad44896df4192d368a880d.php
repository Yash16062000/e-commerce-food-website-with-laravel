<form id="editCustomer" method="POST"> 
<?php echo csrf_field(); ?> 

<div class="form-group">
    <label for="username">Username</label>
    <input type="text" name="name" value="<?php echo e($info->name); ?>" class="form-control" /><br>
</div>
<div class="form-group">
        <label for="title">Email&nbsp;</label>
        <input type="email" name="email"  value="<?php echo e($info->email); ?>" class="form-control" />
</div>

<input type="hidden" name="user_id" value="<?php echo e($info->id); ?>">
<button type="submit" class="btn btn-success">Update</button> 
</form>


<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#editCustomer').submit(function(e) {
    e.preventDefault();
    let formData = new FormData(this);
    $.ajax({
        type:'POST',
        url: "<?php echo e(route('admin.update-user-details')); ?>",
        data: formData,
        contentType: false,
        processData: false,
        success: (response) => {
        this.reset();
        window.location.href="<?php echo e(route('admin.user-list')); ?>"
        }
    });
    });
</script><?php /**PATH C:\xampp\htdocs\e-commerce\resources\views/backend/dashboard/edit-customer.blade.php ENDPATH**/ ?>