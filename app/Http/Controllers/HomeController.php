<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetails;
use Session;

class HomeController extends Controller
{
    public function index(){
        $dishSlider = Dish::select('dishes.image','dishes.title','dishes.description','categories.title as category_title') ->leftjoin('categories','dishes.category_id','=','categories.id')->orderBy('dishes.id','desc')->limit(3)->get();
        $menuList = Dish::select('dishes.id','dishes.title','dishes.image','dishes.description','categories.title as category_title','dishes.price') ->leftjoin('categories','dishes.category_id','=','categories.id')->orderBy('dishes.category_id','desc')->get();
        return view('frontend.index',['dishSlider'=>$dishSlider,'menuList'=>$menuList]);
    }

    public function about_us(){
        $aboutdish = Dish::select('dishes.image','dishes.title','dishes.description','categories.title as category_title') ->leftjoin('categories','dishes.category_id','=','categories.id')->orderBy('dishes.id','desc')->limit(2)->get();
        return view('frontend.about',['aboutdish'=>$aboutdish]);
    }

    public function addToCart(Request $request){
        $ft = Dish::where("id",$request->product_id)->first();
        $products=array("id"=>$ft->id,"price"=>$ft->price,"dishname"=>$ft->title,"image"=>$ft->image,"quantity"=>1);
        session()->push('cart', $products);
        session()->flash('success', 'Item added to cart successfully');
    }

    public function remove(Request $request)
    {
        if($request->product_id) {
            $cart = session()->get('cart');
            $index = array_search($request->product_id, array_column($cart, 'id'));
            unset($cart[$index]);
            session()->put('cart', $cart);
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function update(Request $request){
        if($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $index = array_search($request->id, array_column($cart, 'id'));
            $cart[$index]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        } 
    }

    public function checkout(){
        return view('frontend.checkout');
    }

    public function history(){
        $historyList=order::where('user_id',Auth::user()->id)->get();
        return view('frontend.order-history',compact('historyList'));
    }

    public function order_history(Request $request){
        $orderdetails = Dish::select('order_details.dish_id','dishes.image','dishes.title','dishes.price','order_details.quantity','order_details.price as total')
        ->leftjoin('order_details','order_details.dish_id','=','dishes.id')
        ->where('order_details.order_id',$request->order_id)->get();
        $orderinfo = order::select('orders.id','users.name','users.email','orders.mobile_number','orders.landmark','orders.city','orders.created_at','orders.payment_status','orders.order_status')
        ->leftjoin('users','orders.user_id','=','users.id')
        ->where('orders.id',$request->order_id)->first();
        return view('frontend.view-previous-order',compact('orderdetails','orderinfo'));
    }

}
