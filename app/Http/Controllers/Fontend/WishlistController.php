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
    }
}
