
Route::group(['middleware'=>'guest'],function(){});
Route::group(['middleware'=>'auth'],function(){});


        @if(route('login_user'))
   @auth
      <!-- <li><a href="{{ url('/home') }}"><span class="glyphicon glyphicon-log-out"></span>Home</a></li> -->
      <li><a type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">HTML</a></li>
          <li><a href="#">CSS</a></li>
          <li><a href="#">JavaScript</a></li>
        </ul>
      </li>
      <li><a href="{{ route('logout_user') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    @else
      <li><a href="{{ route('login_user') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>

    @if(route('register'))
      <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
    @endif
   @endauth
  @endif


  <tbody>
                    @foreach($orderList as $orders)
                    @php 
                    $order_id = $orders->id;
                    @endphp
                        <tr>
                        @if(!empty($orders))
                            <th scope="row">{{ date('d-m-Y', strtotime($orders->created_at))}}</th>
                            <td>{{ $orders->name }}</td>
                            <td>{{ $orders->mobile_number }}</td>
                            <td>{{ $orders->email }}</td>
                            <td>{{ $orders->order_status }}</td>
                            <td>{{ $orders->payment_status }}</td>
                            <td>
                        <!-- permission checker for view order starts -->
                            @if(Auth::user()->user_type!=1)
                                @php 
                                $check = Helper::checkOperation(Auth::user()->user_type,4,4);
                                if(!empty($check)) {
                                @endphp
                                <a data-toggle="modal" data-target="#viewOrderInfo" class="btn btn-info" onclick="ViewOrderDeatils('{{$order_id}}');"><i class="fa fa-eye"></i></a>
                                @php
                                }
                                @endphp

                                @else
                                <a data-toggle="modal" data-target="#viewOrderInfo" class="btn btn-info" onclick="ViewOrderDeatils('{{$order_id}}');"><i class="fa fa-eye"></i></a>
                            @endif
                        <!-- permission checker for view order ends -->

                            <!-- permission checker for delete order starts -->
                            @if(Auth::user()->user_type!=1)
                                @php 
                                $check = Helper::checkOperation(Auth::user()->user_type,4,3);
                                if(!empty($check)) {
                                @endphp
                                <a onclick="RemoveOrder('{{$order_id}}');" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                @php
                                }
                                @endphp

                                @else
                                <a onclick="RemoveOrder('{{$order_id}}');" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            @endif
                            <!-- permission checker for delete order ends -->

                            </td>
                        @endif
                        </tr>
                    @endforeach
                    </tbody>


					$orderList = order::select('orders.id','users.name','users.email','orders.mobile_number','orders.landmark','orders.city','orders.created_at','orders.payment_status','orders.order_status')
        ->leftjoin('users','orders.user_id','=','users.id')->orderBy('orders.id', 'desc')->get();
		,['orderList'=>$orderList]