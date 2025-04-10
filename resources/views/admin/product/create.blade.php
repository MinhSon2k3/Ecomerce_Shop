@extends('layouts.admin')

@section('title')
Thêm sản phẩm
@endsection

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="container-fluid">

            <!-- Tiêu đề trang -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h3 class="mb-0 bc-title"><b>Thêm sản phẩm</b></h3>
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.product.index') }}">
                            <i class="fas fa-chevron-left"></i> Trở lại
                        </a>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="row">
                <div class="col-lg-12"></div>
            </div>

            <form class="admin-form tab-form" action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Tên *</label>
                                    <input type="text" name="name" class="form-control item-name" id="name" placeholder="Nhập tên" value="">
                                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="form-group pb-0 mb-0">
                                    <label class="d-block">Ảnh đại diện *</label>
                                </div>
                                <div class="form-group pb-0 pt-0 mt-0 mb-0">
                                    <img class="admin-img lg" src="">
                                </div>
                                <div class="form-group position-relative">
                                    <label class="file">
                                        <input type="file" accept="image/*" class="upload-photo" name="featured_image" id="file" aria-label="File browser example">
                                        <span class="file-custom text-left">Tải ảnh lên...</span>
                                    </label>
                                    <br>
                                    <span class="mt-1 text-info">Kích thước ảnh nên là 800 x 800 hoặc hình vuông</span>
                                </div>
                                @error('featured_image')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="sort_details">Mô tả ngắn *</label>
                                    <textarea name="short_description" id="sort_details" class="form-control" placeholder="Nhập mô tả ngắn"></textarea>
                                    @error('short_description')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Mô tả chi tiết *</label>
                                    <textarea name="description" id="description" class="form-control text-editor" rows="6" placeholder="Nhập mô tả chi tiết"></textarea>
                                    @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="form-group mb-2">
                                    <label for="tags">Thẻ sản phẩm</label>
                                    <input type="text" name="tags" class="tags" id="tags" placeholder="Nhập thẻ sản phẩm" value="">
                                    @error('tags')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="meta_keywords">Từ khóa SEO</label>
                                    <input type="text" name="meta_keyword" class="tags" id="meta_keywords" placeholder="Nhập từ khóa SEO" value="">
                                    @error('meta_keyword')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="form-group">
                                    <label for="meta_description">Mô tả SEO</label>
                                    <textarea name="meta_description" id="meta_description" class="form-control" rows="5" placeholder="Nhập mô tả SEO"></textarea>
                                    @error('meta_description')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <button type="submit" class="btn btn-secondary mr-2">Lưu</button>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="discount_price">Giá hiện tại *</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                        <input type="text" id="current_price" name="current_price" class="form-control" placeholder="Nhập giá hiện tại" min="1" step="0.1" value="">
                                        @error('current_price')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="previous_price">Giá trước đó</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                        <input type="text" id="previous_price" name="previous_price" class="form-control" placeholder="Nhập giá trước đó" min="1" step="0.1" value="">
                                        @error('previous_price')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category_id">Chọn danh mục *</label>
                                    <select name="cat_id" id="category_id" data-href="https://geniusdevs.com/codecanyon/omnimart40/admin/get/subcategory" class="form-control">
                                        <option value="" selected>Chọn một mục</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('cat_id')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="subcategory_id">Chọn danh mục phụ</label>
                                    <select name="sub_cat_id" id="subcategory_id" data-href="https://geniusdevs.com/codecanyon/omnimart40/admin/get/childcategory" class="form-control">
                                        <option value="">Chọn một mục</option>
                                    </select>
                                    @error('sub_cat_id')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="form-group">
                                    <label for="brand_id">Chọn thương hiệu</label>
                                    <select name="brand_id" id="brand_id" class="form-control">
                                        <option value="" selected>Chọn thương hiệu</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="stock">Tổng số lượng trong kho *</label>
                                    <div class="input-group mb-3">
                                        <input type="number" id="stock" name="total_stock" class="form-control" placeholder="Nhập số lượng" value="">
                                        @error('total_stock')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
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

@section('footer')
<script>
    $("#category_id").on('change', function() {
        const cat_id = $(this).val();
        $.ajax({
            type: 'POST',
            url: "{{ route('admin.product.get.sub-category') }}",
            data: {
                cat_id,
                "_token": "{{ csrf_token() }}",
            },
            success: (data) => {
                $("#subcategory_id").html(data);
            }
        })
    })
</script>
@endsection
