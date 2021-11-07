@extends('admin.admin_master')
@section('products')
    active show-sub
@endsection
@section('manage_product')
    active 
@endsection
@section('admin_content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">Products</span>
      </nav>
      <div class="sl-pagebody">
        <div class="row row-sm">
            <div class="col-md-12">
            @if(Session::has('success'))
              <div>
                  <P class="alert alert-primary">{{ Session::get('success') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true" style="font-size:20px">×</span>
                      </button>
                  </P>
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
            @if(Session::has('active'))
            <div>
                <p class="alert alert-primary">{{ Session::get('active') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="font-size:20px">×</span>
                    </button>
                </p>
            </div>

        @endif
            @if(Session::has('deleted'))
              <div>
                  <P class="alert alert-danger">{{ Session::get('deleted') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true" style="font-size:20px">×</span>
                      </button>
                  </P>
              </div>

            @endif
            <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Product List</h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p"> Image</th>
                  <th class="wd-20p">Product Name</th>
                  <th class="wd-15p">Product Quantity</th>
                  <th class="wd-15p">Product Price</th>
                  <th class="wd-15p"> Categroy</th>
                  <th class="wd-20p">Status</th>
                  <th class="wd-15p">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($products as $row)
                    <tr>
                    <td>
                        <img src="{{asset($row->image_one)}}" height="50px",width='50px' alt="">
                    </td>
                    <td>{{$row->product_name}}</td>
                    <td>{{$row->product_quantity}}</td>
                    <td>{{$row->price}}</td>
                    <td>{{$row->category->category_name}}</td>
                    <td>
                        @if($row->status == 1)
                        <span class="badg badge-success">Active</span>
                        @else
                        <span class="badg badge-danger">Inactive</span>
                        @endif
                    </td>
                    <td>
                    <a href="{{url('admin/product/edit/'.$row->id)}}" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                        @if($row->status == 1)
                        <a href="{{url('admin/product/inactive/'.$row->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-arrow-down"></i></a>
                        @else
                        <a href="{{url('admin/product/active/'.$row->id)}}" class="btn btn-sm btn-success"><i class="fa fa-arrow-up"></i></a>
                        @endif
                        <a href="{{url('admin/product/delete/'.$row->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure To Delete?')"><i class="fa fa-trash"></i></a>
                    </td>
                    </tr>
                @endforeach

              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div>
    </div>
</div>
</div>
@stop