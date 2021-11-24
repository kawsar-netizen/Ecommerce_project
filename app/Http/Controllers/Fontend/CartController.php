<?php

namespace App\Http\Controllers\Fontend;

use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;


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
       return redirect()->back()->with('cart','Product Add To Cart Successfully!');
   }
   //=========================== Cart Pages =====================================

   public function cartPage(){
     
       $carts = Cart::where('user_ip',request()->ip())->latest()->get();

       $total = Cart::all()->where('user_ip',request()->ip())->sum(
        function($t){
          return  $t->price*$t->qty;
        });

       $quantity = Cart::where('user_ip',request()->ip())->sum('qty');

       $subTotal = Cart::all()->where('user_ip',request()->ip())->sum(
        function($t){
          return  $t->price*$t->qty;
        });

       return view('pages.cart',compact('carts','total','quantity','subTotal'));
        }

        //=========================== Cart Destory =====================================

        public function destroy($cart_id){
          Cart::where('id',$cart_id)->where('user_ip',request()->ip())->delete();

          return redirect()->back()->with('cart_destroy','Cart Product Removed Successfully!');

        }

        //=========================== Cart  Quantity Update =================================

        public function quantity_update(Request $request,$cart_id){

            Cart::where('id',$cart_id)->where('user_ip',request()->ip())->update([
               'qty' => $request->qty,
            ]);
            return redirect()->back()->with('quantity_update','Cart Quantity Update Successfully!');
        }

        //=========================== Coupon Applied =================================

        public function coupon_apply(Request $request){

          $check = Coupon::where('coupon_name',$request->coupon_name)->first();
          if($check){
            $subTotal = Cart::all()->where('user_ip',request()->ip())->sum(
              function($t){
                return  $t->price*$t->qty;
              });
            Session::put('coupon',[
              'coupon_name' => $check->coupon_name,
              'discount'    => $check->discount,
              'discount_amount'    => $subTotal * ($check->discount/100),
            ]);
            return redirect()->back()->with('quantity_update','Successfully Coupon Applied');
          }
          else{
            return redirect()->back()->with('cart_destroy','Invalid Coupon');
          }
        }
        //=========================== Coupon Destroy =================================
        public function coupon_destroy(){
          if(Session::has('coupon')){
            session()->forget('coupon');
            return redirect()->back()->with('cart_destroy', 'Coupon Removed Successfully!');
          }
        }

}
