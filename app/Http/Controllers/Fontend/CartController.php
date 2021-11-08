<?php

namespace App\Http\Controllers\Fontend;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
   public function AddtoCart(Request $request,$product_id){
       $check = Cart::where('product_id',$product_id)->where('user_ip',request()->ip())->first();
        if($check){
            Cart::where('product_id',$product_id)->where('user_ip',request()->ip())->increment('qty');
            return redirect()->back()->with('cart','Product Add To Cart Successfully!');
        }else{
            Cart::insert([
                'product_id' => $product_id,
                'qty'        => '1',
                'price'      => $request->price,
                'user_ip'    => request()->ip(),
                'created_at' => Carbon::now()
               ]);
        }
       return redirect()->back()->with('cart','Product Add To Cart Successfully!');;
   }
   //=========================== Cart Page =====================================

   public function cartPage(){
       $carts = Cart::where('user_ip',request()->ip())->latest()->get();
       $subTotal = Cart::all()->where('user_ip',request()->ip())->sum(
        function($t){
          return  $t->price*$t->qty;
        });
       return view('pages.cart',compact('carts','subTotal'));
   }
}
