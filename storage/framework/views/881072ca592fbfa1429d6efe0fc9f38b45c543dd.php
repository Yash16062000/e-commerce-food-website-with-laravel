
<h4>Personal details:</h4><br>
<table class="table">  
<tbody> 
<tr> 
<th scope="row">Name</th> 
<?php if(!empty($orderinfo->name)): ?>
<td><?php echo e($orderinfo->name); ?></td> 
<?php endif; ?> 
</tr> 
<tr> 
<th scope="row">Email</th>
<?php if(!empty($orderinfo->email)): ?> 
<td><?php echo e($orderinfo->email); ?></td>
<?php endif; ?> 
</tr>
<tr> 
<th scope="row">Contact No.</th>
<?php if(!empty($orderinfo->mobile_number)): ?> 
<td><?php echo e($orderinfo->mobile_number); ?></td>
<?php endif; ?>  
</tr>
<tr> 
<th scope="row">Landmark</th>
<?php if(!empty($orderinfo->landmark)): ?> 
<td><?php echo e($orderinfo->landmark); ?></td>
<?php endif; ?>   
</tr>
<tr> 
<th scope="row">City</th> 
<?php if(!empty($orderinfo->city)): ?>
<td><?php echo e($orderinfo->city); ?></td>
<?php endif; ?>   
</tr> 
<tr> 
<th scope="row">Payment Status</th> 
<?php if(!empty($orderinfo->payment_status)): ?>
<td><?php echo e($orderinfo->payment_status); ?></td>
<?php endif; ?>   
</tr> 
<tr> 
<th scope="row">Order status</th> 
<?php if(!empty($orderinfo->order_status)): ?>
<td><?php echo e($orderinfo->order_status); ?></td>
<?php endif; ?>   
</tr> 
</tbody>
</table>
</div><br>

<h4>Product details:</h4>
<table class="table table-hover">
<thead>
<tr>
<th>Item Image</th>
<th>Item Name</th>
<th>Price </th>
<th>Quantity</th>
<th>Total</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php if(!empty($orderdetails)): ?>
<?php $__currentLoopData = $orderdetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php 
$product_id = $orderDetails->dish_id;
?>
<tr>
<?php if(!empty($orderDetails->image)): ?>
<td><img src="<?php echo e(url('uploads/'.$orderDetails->image)); ?>" width="50" height="50"></td>
<?php endif; ?>
<?php if(!empty($orderDetails->title)): ?>
<td><?php echo e($orderDetails->title); ?></td>
<?php endif; ?>
<?php if(!empty($orderDetails->price)): ?>
<td><?php echo e($orderDetails->price); ?></td>
<?php endif; ?>
<?php if(!empty($orderDetails->quantity)): ?>
<td><?php echo e($orderDetails->quantity); ?></td>
<?php endif; ?>
<?php if(!empty($orderDetails->total)): ?>
<td><?php echo e($orderDetails->total); ?></td>
<?php endif; ?>
<td><a onclick="RemoveProduct('<?php echo e($product_id); ?>');" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
</tbody>
</table> 


<script>
    function RemoveProduct(product_id){
    alert("Are you Sure You want to delete this product?");
	var data = "product_id="+product_id;
	$.ajax({
	headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type:'GET',
		url: "<?php echo e(route('admin.remove_product')); ?>",			  
		data:data,              
		success: (response) => {
		window.location.reload();
		}
	});
	}
</script>
<?php /**PATH C:\xampp\htdocs\e-commerce\resources\views/backend/dashboard/view-order.blade.php ENDPATH**/ ?>