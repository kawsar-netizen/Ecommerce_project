@extends('admin.admin_master')
@section('products')
    active show-sub
@endsection
@section('add_product')
    active 
@endsection
@section('admin_content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">Edit Product</span>
      </nav>

      <div class="sl-pagebody">
        <div class="row row-sm">
        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Edit Products</h6>
          <form action="{{route('update.product')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{$product->id}}" name="id">
          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Product Name<span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="product_name" value="{{$product->product_name}}" placeholder="Product name">
                  @error('product_name')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Product Code <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="product_code" value="{{$product->product_code}}" placeholder=" Product code">
                  @error('product_code')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Price<span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="price" value="{{$product->price}}" placeholder="Price">
                  @error('price')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Product Quantity<span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="product_quantity" value="{{$product->product_quantity}}" placeholder="Product quantity">
                </div>
                @error('product_quantity')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Category<span class="tx-danger">*</span></label>
                  <select class="form-control select2" name="category_id" data-placeholder="Choose category">
                    <option label="Choose category"></option>
                    @foreach($categories as $category){
                    <option value="{{$category->id}}" {{ $category->id == $product->category_id ?"selected":""}}>{{$category->category_name}}</option>}
                    @endforeach
                  </select>
                </div>
                @error('category_id')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Brand<span class="tx-danger">*</span></label>
                  <select class="form-control select2" name="brand_id" data-placeholder="Choose brand">
                    <option label="Choose brand"></option>
                    @foreach($brands as $brand)
                    <option value="{{$brand->id}}"{{ $brand->id == $product->brand_id?"selected":""}}>{{$brand->brand_name}}</option>
                    @endforeach
                  </select>
                </div>
                @error('brand_id')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
                </div><!-- col-4 -->
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Short Description<span class="tx-danger">*</span></label>
                  <textarea name="short_description" id="short_description" cols="15" rows="4">{{$product->short_description}}</textarea>
                </div>
                @error('short_description')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
              </div><!-- col-12 -->
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Long Description<span class="tx-danger">*</span></label>
                  <textarea name="long_description" id="long_description" cols="40" rows="10">{{$product->long_description}}</textarea>
                </div>
                @error('long_description')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
              </div><!-- col-12 -->
            </div><!-- row -->
            <button class="btn btn-info mg-r-5" type="submint">Update Date</button>
            </form>
  
            <form action="{{route('update.image')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$product->id}}">
            <input type="hidden" name="img_one" value="{{$product->image_one}}">
            <input type="hidden" name="img_two" value="{{$product->image_two}}">
            <input type="hidden" name="img_three" value="{{$product->image_three}}">
            <div class="row row-sm mt-5">
            <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Main Thumbnail<span class="tx-danger">*</span></label>
                  <img src="{{asset($product->image_one)}}" alt="" width="100px" hieght="100px">
                </div>
                @error('image_one')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Image Two<span class="tx-danger">*</span></label>
                  <img src="{{asset($product->image_two)}}" alt="" width="100px" hieght="100px">
                </div>
                @error('image_two')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Image Three<span class="tx-danger">*</span></label>
                  <img src="{{asset($product->image_three)}}" alt="" width="100px" hieght="100px">
                </div>
                @error('image_three')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Main Thumbnail<span class="tx-danger">*</span></label>
                  <input class="form-control" type="file" name="image_one">                </div>
                @error('image_one')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Image Two<span class="tx-danger">*</span></label>
                  <input class="form-control" type="file" name="image_two">                </div>
                @error('image_one')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Image Three<span class="tx-danger">*</span></label>
                  <input class="form-control" type="file" name="image_three">                </div>
                @error('image_one')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
              </div><!-- col-4 -->
            <div class="form-layout-footer">
              <button class="btn btn-info mg-r-5" type="submit">Update Image</button>
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
          </form>
        </div>
        </div>
        </div>
    </div>
</div>
@stop