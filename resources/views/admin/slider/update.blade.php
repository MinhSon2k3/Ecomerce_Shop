@extends('layouts.admin')
@section('title')
    Cập nhật trình chiếu
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="container-fluid">
                <!-- Tiêu đề trang -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Cập nhật trình chiếu</b></h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.slider.index') }}">
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
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" aria-labelledby="pills-home-tab">
                                                <form action="{{ route('admin.slider.update', ['id' => $slider->id]) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="form-group">
                                                        <label for="title">Tiêu đề *</label>
                                                        <input type="text" name="title" class="form-control"
                                                            id="title" placeholder="Nhập tiêu đề"
                                                            value="{{ $slider->title }}">
                                                        @error('title')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="slider-link">Liên kết *</label>
                                                        <input type="text" name="url" class="form-control"
                                                            id="slider-link" placeholder="Nhập đường dẫn"
                                                            value="{{ $slider->url }}">
                                                        @error('url')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="details">Chi tiết *</label>
                                                        <textarea name="details" id="details" class="form-control" rows="5"
                                                            placeholder="Nhập chi tiết">{{ $slider->details }}</textarea>
                                                        @error('details')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label id="slider_text" for="name">Ảnh trình chiếu hiện tại *</label>
                                                        <br>
                                                        <img class="admin-img"
                                                            src="{{ asset('storage') }}/{{ $slider->image }}"
                                                            alt="Không tìm thấy hình ảnh">
                                                        <br>
                                                        <span id="chenge_label2" class="mt-1">Kích thước ảnh nên là 968 x 530</span>
                                                    </div>

                                                    <div class="form-group position-relative">
                                                        <label class="file">
                                                            <input type="file" accept="image/*" class="upload-photo"
                                                                name="image" id="file"
                                                                aria-label="File browser example">
                                                            <span class="file-custom text-left">Tải ảnh lên...</span>
                                                        </label>
                                                    </div>
                                                    @error('image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-secondary">Cập nhật</button>
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
        </div>
    </div>
@endsection
