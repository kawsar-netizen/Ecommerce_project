@extends('admin.admin_master')

@section('admin_content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">Brand</span>
        <span class="breadcrumb-item active">Edit</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
            <div class="col-md-8 m-auto">
            @if(Session::has('success'))
                    <p class="alert alert-primary">{{ Session::get('success') }}</p>
            @endif
                <div class="card">
                    <div class="card-header">
                        Edit Brand
                    </div>
                    <div class="card-body">
                        <form action="{{route('update.brand')}}" method="post">
                                @csrf
                                <input type="hidden" value="{{$brand->id}}" name="id">
                                <div class="form-group">
                                    <label for="BrandID">Name</label>
                                    <input type="text" name='brand_name'class="form-control @error('brand_name') is-invalid @enderror" id="BrandID" value="{{$brand->brand_name}}">
                                    @error("category_name")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>
@stop