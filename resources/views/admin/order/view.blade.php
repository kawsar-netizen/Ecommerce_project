@extends('admin.admin_master')
@section('orders')
    active 
@endsection
@section('admin_content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Admin</a>
        <span class="breadcrumb-item active">Order View</span>
      </nav>

      <div class="sl-pagebody">
        <div class="row row-sm">
            <div class="col-md-12">
        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Order View</h6>
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
                  <label class="form-control-label">Invoice No:</label>
                  <input class="form-control" type="text" value="#{{$order->invoice_no}}"readonly>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Payment Type</label>
                  <input class="form-control" type="text" name="product_code" value="{{$order->payment_type}}"readonly>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Total</label>
                  <input class="form-control" type="text" value="{{$order->total}}"readonly>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Subtotal</label>
                  <input class="form-control" type="text" value="{{$order->subtotal}}"readonly>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Coupon Discount</label>
                  @if($order->coupon_discount == NULL)
                  <span class="badge badge-pill badge-danger">No</span>
                  @else
                  <span class="badge badge-pill badge-danger">{{$order->coupon_discount}}%</span>
                  @endif
                </div>
              </div><!-- col-4 -->
              </div>
            </div><!-- row -->
          </div><!-- form-layout -->
          </form>
        </div>
        </div>
    </div>
    <hr>
    <div class="sl-pagebody">
        <div class="row row-sm">
            <div class="col-md-12">
        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Shipping Address</h6>
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
                  <label class="form-control-label">Shipping First Name</label>
                  <input class="form-control" type="text" value="{{$shipping->shipping_first_name}}"readonly>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Shipping Last Name</label>
                  <input class="form-control" type="text"value="{{$shipping->shipping_last_name}}"readonly>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Shipping Email</label>
                  <input class="form-control" type="text" value="{{$shipping->shipping_email}}"readonly>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Shipping Phone</label>
                  <input class="form-control" type="text" value="{{$shipping->shipping_phone}}"readonly>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Shipping Address</label>
                  <input class="form-control" type="text" value="{{$shipping->address}}"readonly>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">State</label>
                  <input class="form-control" type="text" value="{{$shipping->state}}"readonly>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Post Code</label>
                  <input class="form-control" type="text" value="{{$shipping->post_code}}"readonly>
                </div>
              </div><!-- col-4 -->
              </div>
            </div><!-- row -->
          </div><!-- form-layout -->
          </form>
        </div>
        </div>
    </div>
    <hr>
    <div class="sl-pagebody">
        <div class="row row-sm">
            <div class="col-md-12">
        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Order Items</h6>
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
              <div class="col-lg-12">
                <div class="form-group">
                  <table class="table display responsive nowrap">
                      <thead>
                          <tr>
                              <th class="wd-15p">Image</th>
                              <th class="wd-15p">Product Name</th>
                              <th class="wd-15p">Quantity</th>
                          </tr>
                      </thead>
                      <tbody>
                          
                              @foreach($orderItem as $row)
                              <tr>
                                <td>
                                    <img src="{{asset($row->product->image_one)}}" alt="img" height="50px" width="50px">
                                </td>
                                <td>{{$row->product->product_name}}</td>
                                <td>{{$row->product_qty}}</td>
                                </tr>
                              @endforeach
                         
                      </tbody>
                  </table>
                </div>
              </div><!-- col-4 -->
              </div>
            </div><!-- row -->
          </div><!-- form-layout -->
          </form>
        </div>
        </div>
    </div>
</div>
@stop