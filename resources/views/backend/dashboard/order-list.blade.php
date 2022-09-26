@extends('backend.dashboard.app')

@section('main')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<div id="page-wrapper">
	<div class="main-page">
		<div class="tables">
            @if(session()->has('success'))
            <div class="alert alert-info" role="alert"><strong>{{ session()->get('success') }}</strong></div>
            @endif 
            <h2 class="title1">Order List</h2>
            <div class="panel-body widget-shadow">
                <table class="table table-hover order-datatable">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Date</th>
                            <th>Customer Name</th>
                            <th>Phone </th>
                            <th>Email</th>
                            <th>Order Status</th>
                            <th>Payment Status</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table><br>
            </div>
		</div>
	</div>
</div>

<!-- view modal starts -->
<div id="viewOrderInfo" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Order Details</h4>
      </div>
      <div class="modal-body">
        <div class="panel-body widget-shadow"> 
           
        <div id="orderDetails"></div>
      
    </div>
  </div>
  </div>
  </div>
  </div>

<!-- datatable scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
$(function () {
    
    var table = $('.order-datatable').DataTable({
        processing: true,
        serverSide: true,		
        ajax: "{{ route('admin.getorder-list') }}",
        columns: [
			{data: 'id', name: 'id',orderable: true, searchable: true},
			{data: 'created_at', name: 'created_at',orderable: true, searchable: true},
            {data: 'name', name: 'name',orderable: true, searchable: true},
            {data: 'mobile_number', name: 'mobile_number',orderable: true, searchable: true},
            {data: 'email', name: 'email',orderable: true, searchable: true},
            {data: 'payment_status', name: 'payment_status',orderable: true, searchable: true},
            {data: 'order_status', name: 'order_status',orderable: true, searchable: true},
			{data: 'action', name: 'action' }
        ]
    });
});

	function ViewOrderDeatils(order_id){   
	var data = "order_id="+order_id;
    //alert(data);
	$.ajax({
	headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type:'GET',
		url: "{{ route('admin.view-order-details') }}",			  
		data:data,              
		success:  function (response) {       
           $('#orderDetails').html(response);        
        }  
	});
	}

  function RemoveOrder(order_id){
    alert("Are you Sure You want to delete this order?");
	var data = "order_id="+order_id;
	$.ajax({
	headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type:'GET',
		url: "{{ route('admin.remove_order') }}",			  
		data:data,              
		success: (response) => {
		window.location.reload();
		}
	});
	}

</script>


@endsection