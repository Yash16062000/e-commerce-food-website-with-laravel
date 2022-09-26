@extends('frontend.app')

@section('main')

<div class="w3l_banner_nav_right">
<!-- about -->
		<div class="privacy about">
			<h3>Chec<span>kout</span></h3>
			@if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div> 
    @endif
	      <div class="checkout-right">
					<h4>Your shopping cart contains:</h4>
				<table class="timetable_sub">
					<thead>
						<tr>
							<th>SL No.</th>	
							<th>Product</th>
							<th>Quantity</th>
							<th>Product Name</th>
						
							<th>Price</th>
							<th>Remove</th>
						</tr>
					</thead>
					<tbody>
					@if(!empty(session()->get('cart')))
					@php
					$k=1;
					@endphp
               @foreach(session()->get('cart') as $cartList)
			   @php 
                $product_id = $cartList['id'];
				
				@endphp
			           @if(!empty($cartList))
						<tr class="rem1">
						<td class="invert">{{$k;}}</td>
						<td class="invert-image"><a href="single.html">
						@if(!empty($cartList['image']))
							<img src="{{url('uploads/'.$cartList['image'])}}"  width="150" height="50"></a></td>
						@endif
						<td class="invert">
							 <div class="quantity"> 
								<div class="quantity-select">                           
									@if(!empty($cartList['quantity']))
									<input type="number" value="{{$cartList['quantity'];}}" class="entry value" style="background-color: white;">
									<input type="hidden" value="{{$product_id}}" class="product_id">
									@endif
								</div>
							</div>
						</td>
						@if(!empty($cartList['dishname']))
						<td class="invert">{{$cartList['dishname'];}}</td>
						@endif

						@if(!empty($cartList['price']))
						<td class="invert">{{$cartList['price'];}}</td>
						@endif
						<td class="invert">
							<div class="rem">
							  <a class="close" onclick="RemoveFromCart('{{ $product_id}}')"></a>
							</div>
							
						</td>
					</tr>
					@endif
					@php 
                  $k++;
                  @endphp
               @endforeach
               @endif
				</tbody></table>
			</div>
			<div class="checkout-left">	
				<div class="col-md-4 checkout-left-basket">
					<h4>Continue to basket</h4>
					<ul>
					@if(!empty(session()->get('cart')))
					@php 
					$totalPrice=0;
					$netPrice=0;
					@endphp
               		@foreach(session()->get('cart') as $cartList)
			           @if(!empty($cartList))
					   <?php
					    $price=$cartList['price'] * $cartList['quantity'];
						$netPrice += $cartList['price'] * $cartList['quantity'];
						$gst=0.18 * $netPrice;
						$totalPrice = $netPrice + $gst;
						?>
						<li>@if(!empty($cartList['dishname']))
							{{$cartList['dishname']}}
							@endif <b>X</b>
						<i>@if(!empty($cartList['quantity']))
							{{$cartList['quantity']}}
							@endif</i> 
						<span>@if(!empty($price))
							{{$price}}
							@endif
						</span></li>
						
						@endif
               		@endforeach
			   <li>GST(18%) <i>-</i> <span>
				@if(!empty($gst))
				{{$gst}}
				@endif
				</span></li>
				<hr><li><b>Total <i>-</i> <span>
					@if(!empty($totalPrice))
					{{$totalPrice}}
					@endif
					</span></b></li><hr>
               @endif
					</ul>
				</div>
				<div class="col-md-8 address_form_agile">
					  <h4>Add Details</h4>
				<form method="post" class="creditly-card-form agileinfo_form" enctype="multipart/form-data" id="orderDetails">
				@if(!empty($totalPrice))
		        <input type="hidden" value="{{$totalPrice}}" name="order_total">
				@endif			
				@csrf 
					<section class="creditly-wrapper wthree, w3_agileits_wrapper">
						<div class="information-wrapper">
							<div class="first-row form-group">
								<div class="w3_agileits_card_number_grids">
									<div class="w3_agileits_card_number_grid_left">
										<div class="controls">
											<label class="control-label">Mobile number:</label>
											<input class="form-control" type="text" name="mobile_number" placeholder="Mobile number" required>
										</div>
									</div>
									<div class="w3_agileits_card_number_grid_right">
										<div class="controls">
											<label class="control-label">Landmark: </label>
											<input class="form-control" type="text" name="landmark" placeholder="Landmark" required>
										</div>
									</div>
									<div class="clear"> </div>
								</div>
								<div class="controls">
									<label class="control-label">Town/City: </label>
									<input class="form-control" type="text" name="city" placeholder="Town/City" required>
								</div>
							</div>
						
				@if(route('login_user'))
				@auth
				<div class="checkout-right-basket">
					<button type="submit">Make a Payment <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></button>
				</div>
				@else
				<div class="checkout-right-basket">
					<a href="{{ route('login_user') }}" style="opacity: 0.5;" onclick="login_user()">Make a Payment <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
				</div>
				@endauth
				@endif

				</div>
				</section>
				</form>
			</div>
			
			<div class="clearfix"> </div>
				
			</div>

		</div>
<!-- //about --> 
		</div>
		<div class="clearfix"></div>

<script type="text/javascript">
	$(".value").change(function (e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: "{{ route('update_cart') }}",
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("td").find(".product_id").val(), 
                quantity: ele.parents("td").find(".entry").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });
          
	function RemoveFromCart(product_id){
	var data = "product_id="+product_id;
	$.ajax({
	headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type:'DELETE',
		url: "{{ route('remove_cart') }}",			  
		data:data,              
		success: (response) => {
		window.location.reload();
		}
	});
	}

	function login_user(){
	alert('Please Login First');
	}

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('#orderDetails').submit(function(e) {
	e.preventDefault();
	let formData = new FormData(this);
	$.ajax({
		type:'POST',
		url: "{{ route('placeOrder') }}",
		data: formData,
		contentType: false,
		processData: false,
		success: (response) => {
		window.location.reload();
		}
	});
    });
	  
</script>

@endsection