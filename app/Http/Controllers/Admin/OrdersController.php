<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Shipping;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $orders = Order::latest()->get();
        return view('admin.order.index',compact('orders'));
    }

    public function orderView($order_id){
        $order = Order::findOrFail($order_id);
        $orderItem = OrderItem::where('order_id',$order_id)->get();
        $shipping = Shipping::where('order_id',$order_id)->first();
        return view('admin.order.view',compact('order','orderItem','shipping'));
        
    }
}
