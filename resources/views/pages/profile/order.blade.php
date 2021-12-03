@extends('layouts.forntend_master')
@section('forntend_content')
    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All Categories</span>
                        </div>
                        @php 

                            $categories = App\Models\Category::where('status',1)->latest()->get();

                        @endphp
                        <ul>
                        @foreach($categories as $row)
                            <li><a href="#">{{$row->category_name}}</a></li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('forntend')}}/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>My Profile</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>My Profile</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
<section class="shoping-cart spad">
    <div class="container">
    <div class="row">
    <div class="col-sm-4">
            <div class="card" style="width: 18rem;">
        <img src="" class="card-img-top" height="100%" width="100%" alt="card-img-cap">
            <ul class="list-group list-group-flush">
            <a href="{{route('home')}}" class="btn btn-primary btn-sm btn-block">Home</a>
            <a href="{{route('user.order')}}" class="btn btn-primary btn-sm btn-block">My Orders</a>
            <a  class="btn btn-danger btn-sm btn-block" href="{{ route('logout')}}" onclick="return confirm('Are You Sure To Delete?')"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
            </ul>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="card">
        <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col">Invioce No.</th>
                <th scope="col">Payment Type</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Total</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                <td>{{$order->invoice_no}}</td>
                <td>{{$order->payment_type}}</td>
                <td>{{$order->subtotal}}</td>
                <td>{{$order->total}}</td>
                <td>
                    <a href="" class='btn btn-danger btn-sm'>View</a>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
</section>
@endsection
