<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
       $brands =  Brand::latest()->get();
       return view('admin.brand.index',compact('brands'));
    }

    public function store(Request $request){
        $request->validate([
            'brand_name' => 'required|unique:brands,brand_name',

        ]);
        Brand::insert([
            'brand_name' => $request->brand_name,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->back()->with('brand','Brand Added Successfully!');
    }

    public function edit($id){
        $brand = Brand::find($id);
        return view ('admin.brand.edit',compact('brand'));

    }

    public function update(Request $request){
        $brn_id = $request->id;
        Brand::find($brn_id)->update([
            'brand_name' => $request->brand_name,
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->route('admin.brand')->with('updated','Brand Updated Successfully!');
    }

    public function delete($id){
        Brand::find($id)->delete();
        return redirect()->back()->with('deleted','Brand Deleted Successfully!');
    }
    public function inactive($id){
        Brand::find($id)->update(['status'=>0]);
        return redirect()->back()->with('inactive','Brand Inactive');
    }
    public function active($id){
        Brand::find($id)->update(['status'=>1]);
        return redirect()->back()->with('updated','Brand Active');
    }
}
