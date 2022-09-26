<?php

namespace App\Http\Controllers;
use Illuminate\support\Facades\Session;
use App\Models\User;
use App\Models\Order;
use App\Models\Dish;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\Helper;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function placeOrder(Request $request){
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->price = $request->order_total;
        $order->mobile_number = $request->mobile_number;
        $order->landmark = $request->landmark;
        $order->city = $request->city;
        $order->payment_status = 'Paid';
        $order->order_status = 'Processed';
        $order->save();
        if(!empty($order->id)){
            foreach(session()->get('cart') as $cartList){
                $orderdetails = new OrderDetails();
                $orderdetails->order_id = $order->id;
                $orderdetails->dish_id = $cartList['id'];
                $orderdetails->price = $cartList['price'] * $cartList['quantity'];
                $orderdetails->quantity = $cartList['quantity'];
                $orderdetails->save();
            }
        }
        session()->forget('cart'); 
        session()->flash('success', 'Order Placed successfully');
    }

    public function list(){
       
        return view('backend.dashboard.order-list');
    }

    public function getlist(Request $request){
        if ($request->ajax()) {
            $data = order::select('orders.id','users.name','users.email','orders.mobile_number','orders.landmark','orders.city','orders.created_at','orders.payment_status','orders.order_status')->leftjoin('users','orders.user_id','=','users.id')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at',function($data){
                    
                    return date("d-m-Y", strtotime($data->created_at));
                })
                
                ->addColumn('action', function($data){
                    $actionBtn='';
                    
                    if(Auth::user()->user_type!=1){
                        $check = Helper::checkOperation(Auth::user()->user_type,4,2);
                        if(!empty($check)) {
                            $actionBtn = ' <a onclick="RemoveOrder('.$data->id.');" class="btn btn-danger"><i class="fa fa-trash"></i></a>';
                        }
                        $check1 = Helper::checkOperation(Auth::user()->user_type,4,4);
                        if(!empty($check1)) {
                            $actionBtn = '<a data-toggle="modal" data-target="#viewOrderInfo" class="btn btn-info" onclick="ViewOrderDeatils('.$data->id.');"><i class="fa fa-eye"></i></a>';
                        }
                        if(!empty($check && $check1)){
                            $actionBtn = '<a data-toggle="modal" data-target="#viewOrderInfo" class="btn btn-info" onclick="ViewOrderDeatils('.$data->id.');"><i class="fa fa-eye"></i></a>
                            <a onclick="RemoveOrder('.$data->id.');" class="btn btn-danger"><i class="fa fa-trash"></i></a>';
                        }
                    }else{
                    $actionBtn = '<a data-toggle="modal" data-target="#viewOrderInfo" class="btn btn-info" onclick="ViewOrderDeatils('.$data->id.');"><i class="fa fa-eye"></i></a>
                    <a onclick="RemoveOrder('.$data->id.');" class="btn btn-danger"><i class="fa fa-trash"></i></a>';
                    }
                    return $actionBtn; 
                })
                
                ->rawColumns(['action'])
                ->make(true);           
        }
    }

    public function order_view(Request $request){
        $orderdetails = Dish::select('order_details.dish_id','dishes.image','dishes.title','dishes.price','order_details.quantity','order_details.price as total')
        ->leftjoin('order_details','order_details.dish_id','=','dishes.id')
        ->where('order_details.order_id',$request->order_id)->get();
        $orderinfo = order::select('orders.id','users.name','users.email','orders.mobile_number','orders.landmark','orders.city','orders.created_at','orders.payment_status','orders.order_status')
        ->leftjoin('users','orders.user_id','=','users.id')
        ->where('orders.id',$request->order_id)->first();
       // print_r($orderdetails);die();
        return view('backend.dashboard.view-order',compact('orderdetails','orderinfo'));
    }

    public function remove_order(Request $request)
    {
        $order = Order::where('id',$request->order_id)->first();
        $orderdetails = OrderDetails::where('order_id',$request->order_id)->first();
        $order->delete();
        $orderdetails->delete();
        return back()->with('success', 'Order removed successfully.');
    }

    public function remove_product(Request $request)
    {
        $orderdetails = OrderDetails::where('dish_id',$request->product_id)->first();
        $orderdetails->delete();
        return back()->with('success', 'Order removed successfully.');
    }
}
