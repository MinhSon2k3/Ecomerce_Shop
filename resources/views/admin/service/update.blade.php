@extends('layouts.admin')
@section('title')
    Cập nhật Dịch Vụ
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Tiêu đề trang -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0"><b>Cập nhật Dịch Vụ</b></h3>
                            <a class="btn btn-primary btn-sm" href="/">
                                <i class="fas fa-chevron-left"></i> Quay lại
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card o-hidden border-0 shadow-lg">
                            <div class="card-body">
                                <!-- Form chính -->
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <form class="admin-form"
                                            action="{{ route('admin.service.update', ['id' => $service->id]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Ảnh hiện tại *</label>
                                                <br>
                                                <img class="admin-img"
                                                    src="{{ asset('storage') }}/{{ $service->image }}"
                                                    alt="Không tìm thấy ảnh">
                                                <br>
                                                <span class="mt-1">Kích thước ảnh nên là 65 x 65.</span>
                                            </div>

                                            <div class="form-group position-relative">
                                                <label class="file">
                                                    <input type="file" accept="image/*" class="upload-photo"
                                                        name="image" id="file" aria-label="Chọn tệp">
                                                    <span class="file-custom text-left">Tải ảnh lên...</span>
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <label for="title">Tiêu đề *</label>
                                                <input type="text" name="title" class="form-control" id="title"
                                                    placeholder="Nhập tiêu đề" value="{{ $service->title }}">
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="details">Chi tiết *</label>
                                                <textarea name="details" id="details" class="form-control" rows="5" placeholder="Nhập chi tiết">{{ $service->details }}</textarea>
                                                @error('details')
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
