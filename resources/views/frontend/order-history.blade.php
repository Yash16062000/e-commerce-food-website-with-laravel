@extends('frontend.app')

@section('main')
<div class="w3l_banner_nav_right">
    <div class="privacy about">
        <h3>Order<span> History</span></h3>
        <div class="checkout-right">
					<h4>Your Previous Orders:</h4>
				<table class="timetable_sub">
					<thead>
						<tr>
							<th>SL No.</th>	
							<th>order Id</th>
							<th>Date</th>
							<th>Total Amount</th>
							<th>View</th>
						</tr>
					</thead>
					<tbody>
					@php 
					$k=1;
					@endphp
					@if(!empty($historyList))
					@foreach($historyList as $history)
					@php 
                    $order_id = $history->id;
                    @endphp
						<tr class="rem1">
						<td class="invert">{{$k;}}</td>
						<td class="invert">{{$history->id;}}</td>						
						<td class="invert">{{$history->created_at;}}</td>						
						<td class="invert">{{$history->price;}}</td>
						<td class="invert">
							<div class="rem">
							  <a data-toggle="modal" data-target="#viewOrderInfo" onclick="ViewOrderDeatils('{{$order_id}}');"><i class="fa fa-eye"></i></a>
							</div>	
						</td>
					    </tr>
						@php 
						$k++;
						@endphp
						@endforeach
						@endif
						
				    </tbody>
            </table>
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
			<div id="orderHistory">

			</div>
      
    	</div>
  	</div>
  	</div>
  </div>
  </div>
<div class="clearfix"></div>
<script type="text/javascript">


	function ViewOrderDeatils(order_id){   
	var data = "order_id="+order_id;
    //alert(data);
	$.ajax({
	headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type:'GET',
		url: "{{ route('view-order-history') }}",			  
		data:data,              
		success:  function (response) {       
           $('#orderHistory').html(response);        
        }  
	});
	}
	</script>
@endsection