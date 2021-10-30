@extends('admin.admin_master')

@section('admin_content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">Category</span>
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
                        Edit Category
                    </div>
                    <div class="card-body">
                        <form action="{{route('update.category')}}" method="post">
                                @csrf
                                <input type="hidden" value="{{$category->id}}" name="id">
                                <div class="form-group">
                                    <label for="CategoryId">Name</label>
                                    <input type="text" name='category_name'class="form-control @error('category_name') is-invalid @enderror" id="CategoryId" value="{{$category->category_name}}">
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