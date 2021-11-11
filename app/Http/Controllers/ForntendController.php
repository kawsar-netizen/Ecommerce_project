<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ForntendController extends Controller
{
    public function index(){
        $products = Product::where('status',1)->latest()->get();

        $lts_p = Product::where('status',1)->latest()->limit(3)->get();

        $categories = Category::where('status',1)->latest()->get();
        
        return view('pages.index',compact('products','categories','lts_p'));
    }

    public function product_details($product_id){

        $product = Product::findOrFail($product_id);

        $related_categoryId = $product->category_id;

        $related_product = Product::where('category_id',$related_categoryId)->where('id','!=',$product_id)->latest()->get();

        return view('pages.product_details',compact('product','related_product'));
    }
}
