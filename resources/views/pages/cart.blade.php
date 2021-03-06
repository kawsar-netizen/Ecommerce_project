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
                        <!-- @php 

                            $categories = App\Models\Category::where('status',1)->latest()->get();

                        @endphp -->
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
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->

    <section class="shoping-cart spad">
        <div class="container">
        @if(Session::has('cart_destroy'))
                    <div>
                        <p class="alert alert-danger">{{ Session::get('cart_destroy') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="font-size:20px">??</span>
                            </button>
                        </p>
                    </div>

                @endif
        @if(Session::has('quantity_update'))
                    <div>
                        <p class="alert alert-success">{{ Session::get('quantity_update') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="font-size:20px">??</span>
                            </button>
                        </p>
                    </div>

                @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($carts as $cart)
                                <tr>
                                <td class="shoping__cart__item">
                                        <img src="{{asset($cart->product_cart->image_one)}}" style = "height:70px; width:70px" alt="">
                                        <h5>{{$cart->product_cart->product_name}}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        ${{$cart->product_cart->price}}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <form action="{{url('cart/quantity/update/'.$cart->id)}}"method="post">
                                            @csrf
                                            <div class="pro-qty">
                                                <input type="text" name="qty" value="{{$cart->qty}}">
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-success" onclick ="return confirm('Are You Sure Quantity Updated')" >Update</button>
                                            </form>
                                        </div>
                                       
                                    </td>
                                    <td class="shoping__cart__total">
                                        ${{$cart->price * $cart->qty}}
                                    </td>
                                    <td class="shoping__cart__item__close">                                        
                                            <a href="{{url('cart/destroy/'.$cart->id)}}" onclick="return confirm('Are You Sure To Delete?')">
                                                <span class="icon_close"></span>
                                            </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{url('/')}}" class="btn btn-success cart-btn">CONTINUE SHOPPING</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    @if(Session::has('coupon'))
                    @else
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="{{url('coupon/apply')}}" method="post">
                                @csrf
                                <input type="text" name="coupon_name" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            @if(Session::has('coupon'))
                            <li>Subtotal <span>${{$subTotal}}</span></li>
                            <li>Coupon <span>{{Session()->get('coupon')['coupon_name']}} <a href="{{url('coupon/destroy')}}"><i class="fa fa-times"></i></a></span></li>
                            <li>Discount<span>{{Session()->get('coupon')['discount']}}%
                                (${{Session()->get('coupon')['discount_amount']}})
                                <li>Total <span>${{$subTotal - Session()->get('coupon')['discount_amount']}} </span></li>
                            </span></li>
                            @else
                            <li>Subtotal <span>${{$subTotal}}</span></li>
                            @endif
                        </ul>
                        <a href="{{route('checkout')}}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->    

@stop