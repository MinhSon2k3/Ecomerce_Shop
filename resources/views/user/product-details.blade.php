@extends('layouts.app')

@section('title')
    {{ $product->name }}
@endsection

@section('content')
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li><a href="/">Trang chủ</a></li>
                        <li class="separator"></li>
                        <li><a href="/shop">Sản phẩm</a></li>
                        <li class="separator"></li>
                        <li>{{ $product->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container padding-bottom-1x mb-1">
        <div class="row">
            <!-- Hình ảnh sản phẩm -->
            <div class="col-xxl-5 col-lg-6 col-md-6">
                <div class="product-gallery">
                    <div class="product-thumbnails insize">
                        <div class="">
                            <div class="item" style="position: relative; overflow: hidden;">
                                <img src="{{ asset('storage') }}/{{ $product->featured_image }}" alt="zoom">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="col-xxl-7 col-lg-6 col-md-6">
                <div class="details-page-top-right-content d-flex align-items-center">
                    <div class="div w-100">
                        <h4 class="mb-2 p-title-main">{{ $product->name }}</h4>

                        <div class="mb-3">
                            <span class="text-success  d-inline-block">Còn hàng</span>
                        </div>

                        <span class="h3 d-block price-area">
                            <small class="d-inline-block"><del>{{ $product->previous_price }}VNĐ</del></small>
                            <span id="main_price" class="main-price">${{ $product->current_price }}VNĐ</span>
                        </span>

                        <p class="text-muted">{{ $product->short_description }} <a href="#details" class="scroll-to">Xem thêm</a></p>

                        <form action="">
                            <div class="row align-items-end pb-4">
                                <div class="col-sm-12">
                                    <div class="p-action-button">
                                        <a href="{{ route('user.add_to_cart', ['id' => $product->id]) }}"
                                            class="btn btn-primary m-0 a-t-c-mr" id="">
                                            <i class="icon-bag"></i><span>Thêm vào giỏ</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="div">
                            <div class="t-c-b-area">
                                <div class="pt-1 mb-1"><span class="text-medium">Danh mục:</span>
                                    <a href="{{ route('user.category.product', ['slug' => $product->categories->slug]) }}">
                                        {{ $product->categories->name }}
                                    </a>
                                    /
                                    <a href="{{ route('user.category.product', ['slug' => $product->sub_categories->slug]) }}">
                                        {{ $product->sub_categories->name }}
                                    </a>
                                </div>
                                <div class="pt-1 mb-1"><span class="text-medium">Thẻ:</span>
                                    @php
                                        $tags = json_encode($product->tags);
                                        $tags = json_decode($tags);
                                        $tags = json_decode($tags);
                                    @endphp
                                    @foreach ($tags as $tag)
                                        <a href="">{{ $tag->value }}</a>,
                                    @endforeach
                                </div>
                            </div>

                            <div class="mt-4 p-d-f-area">
                                <div class="left">
                                    <a class="btn btn-primary btn-sm wishlist_store wishlist_text"
                                        href="{{ route('user.add_to_wishlist', ['id' => $product->id]) }}">
                                        <span><i class="icon-heart"></i></span>
                                        <span class="wishlist1">Thêm vào yêu thích</span>
                                        <span class="wishlist2 d-none">Đã thêm vào yêu thích</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mô tả sản phẩm -->
            <div class="padding-top-3x mb-3" id="details">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                data-bs-target="#description" type="button" role="tab" aria-controls="description"
                                aria-selected="true">Mô tả</a>
                        </li>
                    </ul>
                    <div class="tab-content card">
                        <div class="tab-pane fade show active" id="description" role="tabpanel"
                            aria-labelledby="description-tab">
                            {{ $product->description }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sản phẩm liên quan -->
    <div class="relatedproduct-section container padding-bottom-3x mb-1 s-pt-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2 class="h3">Có thể bạn sẽ thích</h2>
                </div>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-lg-12">
                <div class="popular-category-slider owl-carousel">
                    @foreach ($products as $product1)
                        <div class="slider-item">
                            <div class="product-card">
                                <div class="product-thumb">
                                    <img class="lazy"
                                        data-src="{{ asset('storage') }}/{{ $product1->featured_image }}"
                                        alt="Sản phẩm">
                                    <div class="product-button-group">
                                        @if (Auth::user() && Auth::user()->id)
                                            <a class="product-button wishlist_store"
                                                href="{{ route('user.add_to_wishlist', ['id' => $product1->id]) }}"
                                                title="Yêu thích"><i class="icon-heart"></i></a>
                                        @else
                                            <a class="product-button wishlist_store" href="{{ route('user.register') }}"
                                                title="Yêu thích"><i class="icon-heart"></i></a>
                                        @endif

                                        @if (Auth::user() && Auth::user()->id)
                                            <a class="product-button add_to_single_cart" data-target="563"
                                                href="{{ route('user.add_to_cart', ['id' => $product1->id]) }}"
                                                title="Thêm vào giỏ"><i class="icon-shopping-cart"></i>
                                            </a>
                                        @else
                                            <a class="product-button add_to_single_cart" data-target="563"
                                                href="{{ route('user.register') }}" title="Thêm vào giỏ"><i
                                                    class="icon-shopping-cart"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="product-card-body">
                                    <div class="product-category"><a href="">{{ $product->categories->name }}</a></div>
                                    <h3 class="product-title"><a
                                            href="{{ route('user.product_details', ['slug' => $product1->slug]) }}">
                                            {{ \Illuminate\Support\Str::substr($product1->name, 0, 50) }}
                                        </a></h3>

                                    <h4 class="product-price">
                                        <del>${{ $product1->previous_price }}</del>
                                        ${{ $product1->current_price }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
