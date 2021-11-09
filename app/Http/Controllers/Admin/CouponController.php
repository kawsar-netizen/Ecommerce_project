<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
//=================================== All Coupon =====================================
    public function index(){
        $coupons = Coupon::latest()->get();
        return view('admin.coupon.index',compact('coupons'));
    }

//=================================== Add Coupon =====================================

    public function store(Request $request){
        $request->validate([
            'coupon_name' => 'required|unique:coupons,coupon_name',
            'discount' => 'required|unique:coupons,discount',
        ]);
        Coupon::insert([
            'coupon_name' =>strtoupper($request->coupon_name),
            'discount' =>$request->discount,
            'created_at'  =>Carbon::now(),

        ]);
        return redirect()->back()->with('coupon','Coupon Added Successfully!');
    }

//=================================== Edit Coupon =====================================

    public function edit_coupon($id){
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit',compact('coupon'));
    }

//=================================== Edit Coupon =====================================

    public function update_coupon(Request $request){
        $coupon_id = $request->id;
        Coupon::findOrFail($coupon_id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'discount' =>$request->discount,
            'updated_at'  => Carbon::now()
        ]);

        return redirect()->route('admin.coupon')->with('success','Coupon Updated Successfully!');

    }

//=================================== Delete Coupon =====================================

    public function delete_coupon($id){
        Coupon::findOrFail($id)->delete();
        return redirect()->back()->with('deleted','Coupon Deleted Successfully!');
    }

//=================================== Status Coupon =====================================
    public function inactive($id){
        Coupon::find($id)->update(['status'=>0]);
        return redirect()->back()->with('inactive','Coupon Inactive');
    }
    public function active($id){
        Coupon::find($id)->update(['status'=>1]);
        return redirect()->back()->with('updated','Coupon Active');
    }

}
