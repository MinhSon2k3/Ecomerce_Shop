@extends('layouts.admin')
@section('title')
    Tạo Câu Hỏi Thường Gặp
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Tiêu đề trang -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Thêm Câu Hỏi Mới</b></h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.faq.index') }}">
                                <i class="fas fa-chevron-left"></i> Quay lại
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Form nhập liệu -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card o-hidden border-0 shadow-lg">
                            <div class="card-body">
                                <!-- Nội dung form -->
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <form class="admin-form" action="{{ route('admin.faq.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Tiêu đề *</label>
                                                <input type="text" name="title" class="form-control item-name"
                                                    id="name" placeholder="Nhập tiêu đề" value="">
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="details">Chi tiết</label>
                                                <textarea name="details" id="details" class="form-control" rows="5"
                                                    placeholder="Nhập nội dung chi tiết"></textarea>
                                                @error('details')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="slug">Chọn danh mục *</label>
                                                <select name="cat_id" id="cat_id" class="form-control">
                                                    <option value="">-- Chọn danh mục --</option>
                                                    @foreach ($faq_categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('cat_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-secondary">Lưu</button>
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
