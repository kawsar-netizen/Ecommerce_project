<?php

namespace App\Http\Controllers\Fontend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function order(){
        $orders = Order::where('user_id',Auth::id())->latest()->get();
        return view ('pages.profile.order',compact('orders'));
    }
}
