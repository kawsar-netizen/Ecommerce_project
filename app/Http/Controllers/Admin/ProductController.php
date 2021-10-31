<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
//=============================== add product =========================
    public function add_product(){
        $categories = Category::latest()->get();
        $brands     = Brand::latest()->get();
        return view('admin.product.add_product',compact('categories','brands'));
    }
//=============================== store product =========================
    public function store_products(Request $request){

        $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required|max:255',
            'price' => 'required|max:255',
            'product_quantity' => 'required|max:255',
            'category_id' => 'required|max:255',
            'brand_id' => 'required|max:255',
            'image_one' => 'mimes:jpeg,jpg,png,gif|required',
            'image_two' => 'mimes:jpeg,jpg,png,gif|required',
            'image_three' => 'mimes:jpeg,jpg,png,gif|required',
            'short_description' => 'required',
            'long_description' => 'required',
        ],[
            'category_id.required' => 'Select cagegory name',
            'brand_id.required' => 'Select brand name',
        ]);

        $img_one = $request->file('image_one');
        $img_name = hexdec(uniqid()) . '.' . $img_one->getClientOriginalExtension();
        Image::make($img_one)->resize(270,270)->save('forntend/img/product/upload/'. $img_name);
        $img_url1 = 'forntend/img/product/upload/'.$img_name;

        $img_two = $request->file('image_two');
        $img_name = hexdec(uniqid()) . '.' . $img_two->getClientOriginalExtension();
        Image::make($img_two)->resize(270,270)->save('forntend/img/product/upload/'. $img_name);
        $img_url2 = 'forntend/img/product/upload/'. $img_name;

        $img_three = $request->file('image_three');
        $img_name = hexdec(uniqid()) . '.' . $img_three->getClientOriginalExtension();
        Image::make($img_three)->resize(270,270)->save('forntend/img/product/upload/'. $img_name);
        $img_url3 = 'forntend/img/product/upload/'.$img_name;

        Product::insert([
            'category_id' =>$request->category_id,
            'brand_id' =>$request->brand_id,
            'product_name' =>$request->product_name,
            'product_slug' => strtolower(str_replace('','-',$request->product_name)),
            'price' =>$request->price,
            'product_quantity' =>$request->product_quantity,
            'short_description' =>$request->short_description,
            'long_description' =>$request->long_description,
            'product_code' =>$request->product_code,
            'image_one' =>$img_url1,
            'image_two' =>$img_url2,
            'image_three' =>$img_url3,
            'created_at' => Carbon::now(),

        ]);

        return redirect()->back()->with('success','Product Updated Successfully!');

    }
    
    //=============================== manage product =========================

    public function manage_product(){
        $products = Product::orderBy('id','DESC')->get();
        return view('admin.product.manage_product',compact('products'));
    }
}
