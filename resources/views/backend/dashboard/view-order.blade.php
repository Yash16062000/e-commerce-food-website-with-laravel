
<h4>Personal details:</h4><br>
<table class="table">  
<tbody> 
<tr> 
<th scope="row">Name</th> 
@if(!empty($orderinfo->name))
<td>{{$orderinfo->name}}</td> 
@endif 
</tr> 
<tr> 
<th scope="row">Email</th>
@if(!empty($orderinfo->email)) 
<td>{{$orderinfo->email}}</td>
@endif 
</tr>
<tr> 
<th scope="row">Contact No.</th>
@if(!empty($orderinfo->mobile_number)) 
<td>{{$orderinfo->mobile_number}}</td>
@endif  
</tr>
<tr> 
<th scope="row">Landmark</th>
@if(!empty($orderinfo->landmark)) 
<td>{{$orderinfo->landmark}}</td>
@endif   
</tr>
<tr> 
<th scope="row">City</th> 
@if(!empty($orderinfo->city))
<td>{{$orderinfo->city}}</td>
@endif   
</tr> 
<tr> 
<th scope="row">Payment Status</th> 
@if(!empty($orderinfo->payment_status))
<td>{{$orderinfo->payment_status}}</td>
@endif   
</tr> 
<tr> 
<th scope="row">Order status</th> 
@if(!empty($orderinfo->order_status))
<td>{{$orderinfo->order_status}}</td>
@endif   
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
@if(!empty($orderdetails))
@foreach($orderdetails as $orderDetails)
@php 
$product_id = $orderDetails->dish_id;
@endphp
<tr>
@if(!empty($orderDetails->image))
<td><img src="{{url('uploads/'.$orderDetails->image)}}" width="50" height="50"></td>
@endif
@if(!empty($orderDetails->title))
<td>{{$orderDetails->title}}</td>
@endif
@if(!empty($orderDetails->price))
<td>{{$orderDetails->price}}</td>
@endif
@if(!empty($orderDetails->quantity))
<td>{{$orderDetails->quantity}}</td>
@endif
@if(!empty($orderDetails->total))
<td>{{$orderDetails->total}}</td>
@endif
<td><a onclick="RemoveProduct('{{$product_id}}');" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
</tr>
@endforeach
@endif
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
		url: "{{ route('admin.remove_product') }}",			  
		data:data,              
		success: (response) => {
		window.location.reload();
		}
	});
	}
</script>
