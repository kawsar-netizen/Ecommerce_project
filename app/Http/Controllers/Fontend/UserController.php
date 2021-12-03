<?php

namespace App\Http\Controllers\Fontend;

use App\Models\Order;
use App\Models\Shipping;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function order(){
        $orders = Order::where('user_id',Auth::id())->latest()->get();
        return view ('pages.profile.order',compact('orders'));
    }
    public function orderView($order_id){
        $order = Order::findOrFail($order_id);
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->get();
        $shipping = Shipping::where('order_id',$order_id)->first();
        return view('pages.profile.orderView',compact('order','orderItem','shipping'));
    }
}
