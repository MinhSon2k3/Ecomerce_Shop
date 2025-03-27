@extends('layouts.admin')
@section('title')
    Category Create
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Tạo danh mục</b> </h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.category.index') }}"><i
                                    class="fas fa-chevron-left"></i> Quay lại</a>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12">

                        <div class="card o-hidden border-0 shadow-lg">
                            <div class="card-body ">
                                <!-- Nested Row within Card Body -->
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <form class="admin-form" action="{{ route('admin.category.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Chọn ảnh *</label>
                                                <br>
                                                <img class="admin-img"
                                                    src="https://geniusdevs.com/codecanyon/omnimart40/assets/images/placeholder.png"
                                                    alt="No Image Found">
                                                <br>
                                            </div>

                                            <div class="form-group position-relative">
                                                <label class="file">
                                                    <input type="file" accept="image/*" class="upload-photo"
                                                        name="image" id="file" aria-label="File browser example">
                                                    <span class="file-custom text-left">Upload Image...</span>
                                                </label>
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Tên *</label>
                                                <input type="text" name="name" class="form-control item-name"
                                                    id="name" placeholder="Nhập tên" value="">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="meta_keywords">Từ khóa keyword
                                                </label>
                                                <input type="text" name="meta_keyword" class="tags" id="meta_keywords"
                                                    placeholder="Nhập từ khóa" value="">
                                                @error('meta_keyword')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="meta_description">Mô tả
                                                </label>
                                                <textarea name="meta_description" id="meta_description" class="form-control" rows="5"
                                                    placeholder="Nhập mô tả"></textarea>
                                                @error('meta_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="serial">Serial *</label>
                                                <input type="number" name="serial" class="form-control" id="serial"
                                                    placeholder="Enter Serial Number" value="0">
                                                @error('serial')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-secondary ">Lưu</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
