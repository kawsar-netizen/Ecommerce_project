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

        return redirect()->back()->with('success','Product Created Successfully!');

    }
    
    //=============================== manage product =========================

    public function manage_product(){
        $products = Product::orderBy('id','DESC')->get();
        return view('admin.product.manage_product',compact('products'));
    }

      //=============================== edit product =========================

      public function product_edit($id){
        $product = Product::find($id);
        $categories = Category::latest()->get();
        $brands     = Brand::latest()->get();
          return view('admin.product.product_edit',compact('product','categories','brands'));
      }
//=============================== update product =========================
      public function update_product(Request $request){
        $product_id = $request->id;
        Product::findOrFail($product_id)->update([
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_slug' => strtolower(str_replace('','-',$request->product_name)),
            'price' => $request->price,
            'product_quantity' => $request->product_quantity,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'update_at' =>Carbon::now()
        ]);
        return redirect()->route('admin.manage.product')->with('success','Product Update Successfully!');
      }

      //=============================== update image =========================

      public function update_image(Request $request){
          $image_id = $request->id;
          $old_one = $request->img_one;
          $old_two = $request->img_two;
          $old_three = $request->img_three;

          if($request->has('image_one') && $request->has('image_two') && $request->has('image_three')){
            unlink($old_one);
            unlink($old_two);
            unlink($old_three);
            $img_one = $request->file('image_one');
            $img_name = hexdec(uniqid()) . '.' . $img_one->getClientOriginalExtension();
            Image::make($img_one)->resize(270,270)->save('forntend/img/product/upload/'. $img_name);
            $img_url1 = 'forntend/img/product/upload/'.$img_name;
            Product::findOrFail($image_id)->update([
              'image_one' =>$img_url1,
              'update_at' =>Carbon::now()
          ]);
            $img_one = $request->file('image_two');
            $img_name = hexdec(uniqid()) . '.' . $img_one->getClientOriginalExtension();
            Image::make($img_one)->resize(270,270)->save('forntend/img/product/upload/'. $img_name);
            $img_url2 = 'forntend/img/product/upload/'.$img_name;
            Product::findOrFail($image_id)->update([
                'image_two' =>$img_url2,
                'update_at' =>Carbon::now()
            ]);
            $img_one = $request->file('image_three');
            $img_name = hexdec(uniqid()) . '.' . $img_one->getClientOriginalExtension();
            Image::make($img_one)->resize(270,270)->save('forntend/img/product/upload/'. $img_name);
            $img_url3 = 'forntend/img/product/upload/'.$img_name;
            Product::findOrFail($image_id)->update([
            'image_three' =>$img_url3,
            'update_at' =>Carbon::now()
      ]);
          return redirect()->route('admin.manage.product')->with('success','Image Updated Successfully!');
        }

          if($request->has('image_one')){
              unlink($old_one);
              $img_one = $request->file('image_one');
              $img_name = hexdec(uniqid()) . '.' . $img_one->getClientOriginalExtension();
              Image::make($img_one)->resize(270,270)->save('forntend/img/product/upload/'. $img_name);
              $img_url1 = 'forntend/img/product/upload/'.$img_name;
              Product::findOrFail($image_id)->update([
                'image_one' =>$img_url1,
                'update_at' =>Carbon::now()
            ]);
            return redirect()->route('admin.manage.product')->with('success','Image Updated Successfully!');
          }
          if($request->has('image_two')){
              unlink($old_two);
              $img_one = $request->file('image_two');
              $img_name = hexdec(uniqid()) . '.' . $img_one->getClientOriginalExtension();
              Image::make($img_one)->resize(270,270)->save('forntend/img/product/upload/'. $img_name);
              $img_url2 = 'forntend/img/product/upload/'.$img_name;
              Product::findOrFail($image_id)->update([
                'image_two' =>$img_url2,
                'update_at' =>Carbon::now()
            ]);
            return redirect()->route('admin.manage.product')->with('success','Image Updated Successfully!');
          }
          if($request->has('image_three')){
              unlink($old_three);
              $img_one = $request->file('image_three');
              $img_name = hexdec(uniqid()) . '.' . $img_one->getClientOriginalExtension();
              Image::make($img_one)->resize(270,270)->save('forntend/img/product/upload/'. $img_name);
              $img_url3 = 'forntend/img/product/upload/'.$img_name;
              Product::findOrFail($image_id)->update([
                'image_three' =>$img_url3,
                'update_at' =>Carbon::now()
            ]);
            return redirect()->route('admin.manage.product')->with('success','Image Updated Successfully!');
          }

      }

       //=============================== Product Delete =========================

       public function delete($id){
           $image = Product::findOrFail($id);
           $img_one = $image->image_one;
           $img_two = $image->image_two;
           $img_three = $image->image_three;
           unlink($img_one);
           unlink($img_two);
           unlink($img_three);
           Product::findOrFail($id)->delete();
           return redirect()->back()->with('deleted','Product Deleted Successfully!');
       }

       //=============================== Product Inactive =========================

       public function inactive($id){
           Product::findOrFail($id)->update(['status'=>0]);
           return redirect()->back()->with('inactive','Product Inactive Successfully!');
       }
       //=============================== Product Active =========================

       public function active($id){
        Product::findOrFail($id)->update(['status'=>1]);
        return redirect()->back()->with('active','Product Active Successfully!');
    }
}
