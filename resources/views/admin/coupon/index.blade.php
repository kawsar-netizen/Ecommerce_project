@extends('admin.admin_master')
@section('coupon')
    active
@endsection
@section('admin_content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">Coupon</span>
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
          <h6 class="card-body-title">Coupon List</h6>
          <div class="table-wrapper">
          @if(Session::has('success'))
              <div>
                  <P class="alert alert-primary">{{ Session::get('success') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true" style="font-size:20px">×</span>
                      </button>
                  </P>
              </div>

            @endif
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">Sl</th>
                  <th class="wd-15p">Coupon Name</th>
                  <th class="wd-15p">Coupon Discount</th>
                  <th class="wd-20p">Status</th>
                  <th class="wd-15p">Action</th>
                </tr>
              </thead>
              <tbody>
              @php
                    $i = 1;
                @endphp
                @foreach($coupons as $row)
                    <tr>
                    <td>{{$i++}}</td>
                    <td>{{$row->coupon_name}}</td>
                    <td>{{$row->discount}}</td>
                    <td>
                        @if($row->status == 1)
                        <span class="badg badge-success">Active</span>
                        @else
                        <span class="badg badge-danger">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{url('admin/coupons/edit/'.$row->id)}}" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                        @if($row->status == 1)
                        <a href="{{url('admin/coupons/inactive/'.$row->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-arrow-down"></i></a>
                        @else
                        <a href="{{url('admin/coupons/active/'.$row->id)}}" class="btn btn-sm btn-success"><i class="fa fa-arrow-up"></i></a>
                        @endif
                        <a href="{{url('admin/coupons/delete/'.$row->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure To Deleted ?')"><i class="fa fa-trash"></i></a>
                    </td>
                    </tr>
                @endforeach

              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div>
            </div>
            <div class="col-md-4">
            @if(Session::has('coupon'))
            <div>
                <P class="alert alert-primary">{{ Session::get('coupon') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="font-size:20px">×</span>
                    </button>
                </P>
            </div>

        @endif
                <div class="card">
                    <div class="card-header">
                        Add Coupon
                    </div>
                    <div class="card-body">
                        <form action="{{route('store.coupon')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="CategoryId">Coupon Name</label>
                                    <input type="text" name='coupon_name' value="{{old('coupon_name')}}" class="form-control @error('coupon_name') is-invalid @enderror" pleasholder="Enter Coupon" id="CategoryId">
                                    @error("coupon_name")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="CategoryId">Coupon Discount</label>
                                    <input type="text" name='discount'value="{{old('discount')}}"class="form-control @error('discount') is-invalid @enderror" pleasholder="Enter Coupon Discount" id="CategoryId">
                                    @error("discount")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add Coupon</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>
@stop