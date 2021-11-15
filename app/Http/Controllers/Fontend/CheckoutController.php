<?php

namespace App\Http\Controllers\Fontend;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(){
        if(Auth::check()){
            $carts = Cart::where('user_ip',request()->ip())->latest()->get();

            $subTotal = Cart::all()->where('user_ip',request()->ip())->sum(
                function($t){
                  return  $t->price*$t->qty;
                });
            
            return view('pages.checkout',compact('carts','subTotal'));
        }else{
            return redirect()->route('login');
        }
    }
}
