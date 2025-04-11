@extends('layouts.admin')

@section('title')
    Cập nhật sản phẩm
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Cập nhật sản phẩm</b> </h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.product.index') }}">
                                <i class="fas fa-chevron-left"></i> Quay lại
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form class="admin-form tab-form" action="{{ route('admin.product.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-lg-8">
                            <!-- Tên sản phẩm -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Tên sản phẩm *</label>
                                        <input type="text" name="name" class="form-control item-name" id="name" placeholder="Nhập tên sản phẩm" value="{{ $product->name }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group pb-0  mb-0">
                                        <label class="d-block">Hình ảnh đại diện *</label>
                                    </div>
                                    <div class="form-group pb-0 pt-0 mt-0 mb-0">
                                        <img class="admin-img lg" src="{{ asset('storage') }}/{{ $product->featured_image }}">
                                    </div>
                                    <div class="form-group position-relative ">
                                        <label class="file">
                                            <input type="file" accept="image/*" class="upload-photo"
                                                name="featured_image" id="file" aria-label="File browser example">
                                            <span class="file-custom text-left">Tải lên hình ảnh...</span>
                                        </label>
                                        <br>
                                        <span class="mt-1 text-info">Kích thước hình ảnh nên là 800 x 800 hoặc kích thước vuông</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Mô tả ngắn -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="short_description">Mô tả ngắn *</label>
                                        <textarea name="short_description" id="short_description" class="form-control" placeholder="Mô tả ngắn">{{ $product->short_description }}</textarea>
                                        @error('short_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Mô tả chi tiết -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="description">Mô tả chi tiết *</label>
                                        <textarea name="description" id="description" class="form-control text-editor" rows="6" placeholder="Nhập mô tả chi tiết">{{ $product->description }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Thẻ sản phẩm -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="tags">Thẻ sản phẩm</label>
                                        <input type="text" name="tags" class="tags" id="tags" placeholder="Nhập thẻ" value="{{ $product->tags }}">
                                        @error('tags')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Từ khóa meta -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="meta_keywords">Từ khóa meta</label>
                                        <input type="text" name="meta_keyword" class="tags" id="meta_keywords" placeholder="Nhập từ khóa meta" value="{{ $product->meta_keyword }}">
                                        @error('meta_keyword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Mô tả meta -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="meta_description">Mô tả meta</label>
                                        <textarea name="meta_description" id="meta_description" class="form-control" rows="5" placeholder="Nhập mô tả meta">{{ $product->meta_description }}</textarea>
                                        @error('meta_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <!-- Lưu sản phẩm -->
                            <div class="card">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-secondary mr-2">Lưu</button>
                                </div>
                            </div>

                            <!-- Giá hiện tại -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="current_price">Giá hiện tại *</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" id="current_price" name="current_price" class="form-control" placeholder="Nhập giá hiện tại" value="{{ $product->current_price }}">
                                            @error('current_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Giá trước đó -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="previous_price">Giá trước đó</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" id="previous_price" name="previous_price" class="form-control" placeholder="Nhập giá trước đó" value="{{ $product->previous_price }}">
                                            @error('previous_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Danh mục cha -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="category_id">Chọn danh mục *</label>
                                        <select name="cat_id" id="category_id" class="form-control">
                                            <option value="" selected>Chọn một</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @selected($product->cat_id == $category->id)>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('cat_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Danh mục con -->
                                    <div class="form-group">
                                        <label for="subcategory_id">Chọn danh mục con</label>
                                        <select name="sub_cat_id" id="subcategory_id" class="form-control">
                                            <option value="">Chọn một</option>
                                            @foreach ($subCategories as $subCategory)
                                                <option value="{{ $subCategory->id }}" @selected($product->sub_cat_id == $subCategory->id)>{{ $subCategory->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('sub_cat_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Thương hiệu -->
                                    <div class="form-group">
                                        <label for="brand_id">Chọn thương hiệu</label>
                                        <select name="brand_id" id="brand_id" class="form-control">
                                            <option value="" selected>Chọn thương hiệu</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}" @selected($product->brand_id == $brand->id) >{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Số lượng trong kho -->
                                    <div class="form-group">
                                        <label for="stock">Tổng số trong kho *</label>
                                        <input type="number" id="stock" name="total_stock" class="form-control" placeholder="Tổng số trong kho" value="{{ $product->total_stock }}">
                                        @error('total_stock')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
