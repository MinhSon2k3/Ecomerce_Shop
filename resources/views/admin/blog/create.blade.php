@extends('layouts.admin')
@section('title')
    Blog
@endsection
@section('content')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <div class="content">
        <div class="page-inner">
            <div class="container-fluid">
                <!-- Tiêu đề trang -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class=" mb-0 bc-title"><b>Tạo Blog</b> </h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.blog.index') }}"><i
                                    class="fas fa-chevron-left"></i> Quay lại</a>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12">

                        <div class="card o-hidden border-0 shadow-lg">
                            <div class="card-body ">
                                <!-- Row lồng trong Card Body -->
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <form class="admin-form" action="{{ route('admin.blog.store') }}" method="POST"
                                            enctype="multipart/form-data">

                                            @csrf

                                            <div class="form-group">
                                                <label for="name">Chọn hình ảnh *</label>
                                                <br>
                                                <img class="admin-img"
                                                    src="https://geniusdevs.com/codecanyon/omnimart40/assets/images/placeholder.png"
                                                    alt="Không tìm thấy hình ảnh">
                                                <br>
                                                <span class="mt-1">Kích thước hình ảnh phải là 708 x 277.</span>
                                            </div>

                                            <div class="form-group position-relative ">
                                                <label class="file">
                                                    <input type="file" accept="image/*" class="upload-photo"
                                                        name="image" multiple id="file"
                                                        aria-label="Chọn tệp ví dụ">
                                                    <span class="file-custom text-left">Tải lên hình ảnh...</span>
                                                </label>
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="title">Tiêu đề *</label>
                                                <input type="text" name="title" class="form-control" id="title"
                                                    placeholder="Nhập Tiêu đề" value="">
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="category_id">Chọn Danh mục *</label>
                                                <select name="cat_id" id="cat_id" class="form-control">
                                                    <option value="" selected disabled>Chọn Danh mục</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="details">Chi tiết *</label>
                                                <textarea name="description" id="details" class="form-control text-editor" rows="5" placeholder="Nhập chi tiết"></textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <script>
                                                    ClassicEditor
                                                        .create(document.querySelector('#details'), {
                                                            // Thêm cấu hình tải lên hình ảnh
                                                            ckfinder: {
                                                                uploadUrl: '{{ route('admin.blog.uploadImage') . '?_token=' . csrf_token() }}',
                                                            },
                                                        })
                                                        .then(editor => {
                                                            console.log(editor);
                                                        })
                                                        .catch(error => {
                                                            console.error(error);
                                                        });
                                                </script>

                                            </div>

                                            <div class="form-group">
                                                <label for="tags">Thẻ Tag
                                                </label>
                                                <input type="text" name="tags" class="tags" id="tags"
                                                    placeholder="Nhập thẻ Tag" value="">
                                                @error('tags')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="meta_keywords">Meta Keywords
                                                </label>
                                                <input type="text" name="meta_keywords" class="tags" id="meta_keywords"
                                                    placeholder="Nhập Meta Keywords" value="">
                                                @error('meta_keywords')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="meta_description">Meta Description
                                                </label>
                                                <textarea name="meta_description" id="meta_description" class="form-control" rows="5"
                                                    placeholder="Nhập Meta Description"></textarea>
                                                @error('meta_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-secondary ">Gửi</button>
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
