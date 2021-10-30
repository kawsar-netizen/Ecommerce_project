@extends('admin.admin_master')
@section('brand')
    active
@endsection
@section('admin_content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">Brand</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
            <div class="col-md-8">
            <div class="card pd-20 pd-sm-40">
            @if(Session::has('updated'))
            <div>
                <p class="alert alert-primary">{{ Session::get('updated') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="font-size:20px">×</span>
                    </button>
                </p>
            </div>

        @endif
            @if(Session::has('inactive'))
            <div>
                <p class="alert alert-danger">{{ Session::get('inactive') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="font-size:20px">×</span>
                    </button>
                </p>
            </div>

        @endif
          @if(Session::has('deleted'))
            <div>
                <p class="alert alert-danger">{{ Session::get('deleted') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="font-size:20px">×</span>
                    </button>
                </p>
            </div>

        @endif
          <h6 class="card-body-title">Brand List</h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">Sl</th>
                  <th class="wd-15p">Brand Name</th>
                  <th class="wd-20p">Status</th>
                  <th class="wd-15p">Action</th>
                </tr>
              </thead>
              <tbody>
              @php
                    $i = 1;
                @endphp
                @foreach($brands as $brand)
                    <tr>
                    <td>{{$i++}}</td>
                    <td>{{$brand->brand_name}}</td>
                    <td>
                        @if($brand->status == 1)
                        <span class="badg badge-success">Active</span>
                        @else
                        <span class="badg badge-danger">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{url('admin/brands/edit/'.$brand->id)}}" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                        @if($brand->status == 1)
                        <a href="{{url('admin/brands/inactive/'.$brand->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-arrow-down"></i></a>
                        @else
                        <a href="{{url('admin/brands/active/'.$brand->id)}}" class="btn btn-sm btn-success"><i class="fa fa-arrow-up"></i></a>
                        @endif
                        <a href="{{url('admin/brands/delete/'.$brand->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                    </tr>
                @endforeach

              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div>
            </div>
            <div class="col-md-4">
            @if(Session::has('brand'))
            <div>
                <P class="alert alert-primary">{{ Session::get('brand') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="font-size:20px">×</span>
                    </button>
                </P>
            </div>

        @endif
                <div class="card">
                    <div class="card-header">
                        Add Brand
                    </div>
                    <div class="card-body">
                        <form action="{{route('store.brand')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="CategoryId">New Brand</label>
                                    <input type="text" name='brand_name'class="form-control @error('brand_name') is-invalid @enderror" pleasholder="Enter Brand"id="CategoryId">
                                    @error("brand_name")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>
@stop