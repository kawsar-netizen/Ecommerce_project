<?php

namespace App\Http\Controllers\Fontend;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function AddWishlist($product_id){

        if(Auth::check()){
            Wishlist::insert([

                'user_id' => Auth::id(),
                'product_id'=>$product_id,
    
            ]);
            return redirect()->back()->with('wishlist','Product Add To Wishlist Successfully!');
        }else
        {
            return redirect()->route('login')->with('loginError','At First Login Your Account Successfully!');
        }

        $check = Wishlist::where('user_id',Auth::id())->first();
        if($check){
            Wishlist::where('user_id',Auth::id())->increment('wishlistQty');
            return redirect()->back()->with('Wishlist','Product Add To Wishlist Successfully!');
        }else

        Wishlist::insert([

            'user_id' => Auth::id(),
            'product_id'=>$product_id,

        ]);
        return redirect()->back()->with('wishlist','Product Add To Wishlist Successfully!');
    }
//===================================== Wishlist Pages ============================================
    public function wishlistpage(){
        $wishlistQty = Wishlist::where('user_id',Auth::id())->latest('id')->get();
        return view('pages.wishlist',compact('wishlistQty'));
    }
//=========================== Wishlist Destory =====================================
    public function destroy($wishlist_id){
        Wishlist::where('id',$wishlist_id)->where('user_id',Auth::id())->delete();
        return redirect()->back()->with('wishlist_destroy','Wishlist Product Removed Successfully!');
    }
}
