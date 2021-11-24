@extends('admin.admin_master')
@section('orders')
    active
@endsection
@section('admin_content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Admin</a>
        <span class="breadcrumb-item active">Order</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
            <div class="col-md-12">
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
          <h6 class="card-body-title">Order List</h6>
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
                  <th class="wd-15p">Invoice No</th>
                  <th class="wd-15p">Payment Type</th>
                  <th class="wd-20p">Total</th>
                  <th class="wd-20p">Subtotal</th>
                  <th class="wd-20p">Status</th>
                  <th class="wd-15p">Action</th>
                </tr>
              </thead>
              <tbody>
              @php
                    $i = 1;
                @endphp
                @foreach($orders as $row)
                    <tr>
                    <td>{{$i++}}</td>
                    <td>#{{$row->invoice_no}}</td>
                    <td>{{$row->payment_type}}%</td>
                    <td>{{$row->total}}$</td>
                    <td>{{$row->subtotal}}$</td>
                    <td>
                        @if($row->coupon_discount == NULL)
                        <span class="badg badge-danger">No</span>
                        @else
                        <span class="badg badge-success">Yes</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{url('admin/orders/view/'.$row->id)}}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                        <a href="{{url('admin/order/delete/'.$row->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure To Deleted ?')"><i class="fa fa-trash"></i></a>
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
</div>
@stop