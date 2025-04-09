@extends('layouts.app')
@section('title')
    Shop
@endsection
@section('content')
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li><a href="/">Home</a> </li>
                        <li class="separator"></li>
                        <li>Sản phẩm</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-1">
     
        <div class="row g-3">

            <div class="col-lg-9 order-lg-2" id="list_view_ajax">
                <!-- Shop Toolbar-->
                <div class="row g-3">
                    @foreach ($products as $product)
                        <div class="col-lg-4">
                            <div class="product-card">
                                <div class="product-thumb">
                                    <img class="lazy" data-src="{{ asset('storage') }}/{{ $product->featured_image }}"
                                        alt="Product">
                                    <div class="product-button-group">
                                        @if (Auth::user() && Auth::user()->id)
                                            <a class="product-button wishlist_store"
                                                href="{{ route('user.add_to_wishlist', ['id' => $product->id]) }}"
                                                title="Wishlist"><i class="icon-heart"></i></a>
                                        @else
                                            <a class="product-button wishlist_store" href="{{ route('user.register') }}"
                                                title="Wishlist"><i class="icon-heart"></i></a>
                                        @endif
                                        @if (Auth::user() && Auth::user()->id)
                                            <a class="product-button add_to_single_cart" data-target="563"
                                                href="{{ route('user.add_to_cart', ['id' => $product->id]) }}"
                                                title="To Cart"><i class="icon-shopping-cart"></i>
                                            </a>
                                        @else
                                            <a class="product-button add_to_single_cart" data-target="563"
                                                href="{{ route('user.register') }}" title="To Cart"><i
                                                    class="icon-shopping-cart"></i>
                                            </a>
                                        @endif



                                    </div>
                                </div>
                                <div class="product-card-body">
                                    <div class="product-category"><a href="">{{ $product->categories->name }}</a>
                                    </div>
                                    <h3 class="product-title"><a
                                            href="{{ route('user.product_details', ['slug' => $product->slug]) }}">
                                            {{ \Illuminate\Support\Str::substr($product->name, 0, 50) }}
                                        </a></h3>
                               
                                    <h4 class="product-price">
                                        <del>${{ $product->previous_price }}</del>

                                        ${{ $product->current_price }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination-->
                <div class="row mt-15" id="item_pagination">
                    <div class="col-lg-12 text-center">
                    </div>
                </div>
            </div>

            <!-- Sidebar          -->
            <div class="col-lg-3 order-lg-1">
                <div class="sidebar-toggle position-left"><i class="icon-filter"></i></div>
                <aside class="sidebar sidebar-offcanvas position-left"><span class="sidebar-close"><i
                            class="icon-x"></i></span>
                    <!-- Widget Categories-->
                    <section class="widget widget-categories card rounded p-4">
                        <h3 class="widget-title">Danh mục</h3>
                        <ul id="category_list" class="category-scroll">
                            @foreach ($categories as $category)
                                <li class="has-children">
                                    <a class="category_search" href="#" data-href="Women-Clothing">{{ $category->name }}</a>

                                    <ul id="subcategory_list">
                                        @foreach ($category->sub_category as $sub_category)
                                            <li class="">
                                                <a class="subcategory" href="{{ route('user.shop.sub.category', ['id' => $sub_category->id, 'cat_id' => $category->id]) }}" data-href="Womens-Underwear">
                                                    {{ $sub_category->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach 
                        </ul>
                    </section>             
                </aside>
            </div>
        </div>
    </div>
@endsection
