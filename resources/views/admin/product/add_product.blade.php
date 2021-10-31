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
        <span class="breadcrumb-item active">Add Product</span>
      </nav>

      <div class="sl-pagebody">
        <div class="row row-sm">
        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Add New Product</h6>
          <form action="{{route('store.products')}}" method="post" enctype="multipart/form-data">
            @csrf
            @if(Session::has('success'))
              <div>
                  <P class="alert alert-primary">{{ Session::get('success') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true" style="font-size:20px">×</span>
                      </button>
                  </P>
              </div>

            @endif
          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Product Name<span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="product_name" value="{{old('product_name')}}" placeholder="Product name">
                  @error('product_name')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Product Code <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="product_code" value="{{old('product_code')}}" placeholder=" Product code">
                  @error('product_code')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Price<span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="price" value="{{old('price')}}" placeholder="Price">
                  @error('price')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Product Quantity<span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="product_quantity" value="{{old('product_quantity')}}" placeholder="Product quantity">
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
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->category_name}}</option>
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
                    <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
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
                  <textarea name="short_description" id="short_description" cols="15" rows="4"></textarea>
                </div>
                @error('short_description')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
              </div><!-- col-12 -->
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Long Description<span class="tx-danger">*</span></label>
                  <textarea name="long_description" id="long_description" cols="40" rows="10"></textarea>
                </div>
                @error('long_description')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
              </div><!-- col-12 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Main Thumbnail<span class="tx-danger">*</span></label>
                  <input class="form-control" type="file" name="image_one">
                </div>
                @error('image_one')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Image Two<span class="tx-danger">*</span></label>
                  <input class="form-control" type="file" name="image_two">
                </div>
                @error('image_two')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Image Three<span class="tx-danger">*</span></label>
                  <input class="form-control" type="file" name="image_three">
                </div>
                @error('image_three')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
              </div><!-- col-4 -->

            </div><!-- row -->
            <div class="form-layout-footer">
              <button class="btn btn-info mg-r-5">Add Product</button>
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
          </form>
        </div>

        </div>
    </div>
</div>
@stop