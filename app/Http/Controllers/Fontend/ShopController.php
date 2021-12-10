<?php

namespace App\Http\Controllers\Fontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index(){
        $products = Product::latest()->get();
        $productsP = Product::latest()->paginate('10');
        $categories = Category::where('status',1)->latest()->get();
       return view('pages.shop',compact('products','productsP','categories'));
    }
}
