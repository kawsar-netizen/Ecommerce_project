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
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Checkout Page</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

        <!-- Checkout Section Begin -->
        <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Shipping Details</h4>
                <form action="{{route('place_order')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>First Name<span>*</span></p>
                                        <input type="text"class="@error('shipping_first_name') is-invalid @enderror" name="shipping_first_name" value="{{Auth::user()->name}}">
                                        @error("shipping_first_name")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text"class="@error('shipping_last_name') is-invalid @enderror" name="shipping_last_name">
                                        @error("shipping_last_name")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text"class="@error('shipping_phone') is-invalid @enderror" name="shipping_phone">
                                        @error("shipping_phone")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text"class="@error('shipping_email') is-invalid @enderror" name="shipping_email" value="{{Auth::user()->email}}">
                                        @error("shipping_email")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text"class="@error('address') is-invalid @enderror" name="address" placeholder="Street Address" class="checkout__input__add">
                                @error("address")
                                            <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Country/State<span>*</span></p>
                                <input type="text"class="@error('state') is-invalid @enderror" name="state">
                                @error("state")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text"class="@error('post_code') is-invalid @enderror" name="post_code">
                                @error("post_code")
                                            <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @foreach($carts as $cart)
                                    <li>{{$cart->product_cart->product_name}} ({{$cart->qty}})<span>${{$cart->price * $cart->qty}}</span></li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>${{$subTotal}}</span></div>

                                @if(Session::has('coupon'))
                                <div class="checkout__order__total">Total <span>${{$subTotal - Session()->get('coupon')['discount_amount']}}</span></div>
                                <input type="hidden" name="coupon_discount" value="{{Session()->get('coupon')['discount']}}">
                                <input type="hidden" name="subtotal" value="{{$subTotal}}">
                                <input type="hidden" name="total" value="{{$subTotal - Session()->get('coupon')['discount_amount']}}">
                                @else
                                <div class="checkout__order__subtotal">Total <span>${{$subTotal}}</span></div>
                                <input type="hidden" name="subtotal" value="{{$subTotal}}">
                                <input type="hidden" name="total" value="{{$subTotal}}">
                                @endif
                                <h5>Select Payment Method</h5>
                                <hr>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Handcash
                                        <input type="checkbox" id="payment"name="payment_type"value="handcash">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="checkbox" id="paypal" name="payment_type"value="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    @stop