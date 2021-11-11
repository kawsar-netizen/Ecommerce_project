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
                        <h2>Wishlist Pages</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Wishlist Pages</span>
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
        @if(Session::has('wishlist_destroy'))
                    <div>
                        <p class="alert alert-danger">{{ Session::get('wishlist_destroy') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="font-size:20px">×</span>
                            </button>
                        </p>
                    </div>

                @endif
        @if(Session::has('wishlist'))
                    <div>
                        <p class="alert alert-success">{{ Session::get('wishlist') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="font-size:20px">×</span>
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
                                    <th>Add Cart</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wishlistQty as $wishlist)
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="{{$wishlist->product_wishlist->image_one}}" style = "height:70px; width:70px" alt="">
                                        <h5>{{$wishlist->product_wishlist->product_name}}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        ${{$wishlist->product_wishlist->price}}
                                    </td>
                                    <td class="shoping__cart__price">
                                    <form action="{{url('add_cart/'.$wishlist->product_id)}}" method="post">
                                        @csrf
                                        <input type="hidden" name="price" value="{{$wishlist->product_wishlist->price}}">
                                        <button class="btn btn-sm btn-danger">
                                            Add To Cart
                                        </button>
                                    </form>
                                    </td>
                                    <td class="shoping__cart__item__close">                                        
                                            <a href="{{url('wishlist/destroy/'.$wishlist->id)}}" onclick="return confirm('Are You Sure To Delete?')">
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
        </div>
    </section>
    <!-- Shoping Cart Section End -->    

@stop