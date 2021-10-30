<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $categories = Category::latest()->get();
        return view('admin.category.index',compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'category_name' => 'required|unique:categories,category_name',
        ]);
        Category::insert([

            'category_name' => $request->category_name,
            'created_at'    => Carbon::now(),

        ]);

        return Redirect()->back()->with('success','Category Added Successfully!');

    }

    public function edit($id){
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    public function update(Request $request){
        $cat_id = $request->id;
        Category::find($cat_id)->update([
            'category_name' => $request->category_name,
            'updated_at'    =>  Carbon::now(),

        ]);
        return redirect()->route('admin.category')->with('updated','Category Updated Successfully!');

    }

    public function delete($id){
        Category::find($id)->delete();
        return redirect()->back()->with('deleted','Category Deleted Successfully!');
    }

    public function inactive($id){
        Category::find($id)->update(['status'=>0]);
        return redirect()->back()->with('updated','Category Inactive');
    }
    public function active($id){
        Category::find($id)->update(['status'=>1]);
        return redirect()->back()->with('updated','Category Active');
    }
    
}
