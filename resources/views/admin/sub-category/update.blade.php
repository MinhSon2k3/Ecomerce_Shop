@extends('layouts.admin')
@section('title')
    Sub Category Update
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Cập nhật danh mục phụ</b> </h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.sub-category.index') }}"><i
                                    class="fas fa-chevron-left"></i>Quay lại</a>
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
                                        <form class="admin-form" action="{{ route('admin.sub-category.update',['id'=>$sub_category->id]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Tên *</label>
                                                <input type="text" name="name" class="form-control item-name"
                                                    id="name" placeholder="Nhập tên" value="{{ $sub_category->name }}">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="slug">Danh mục cha *</label>
                                                <select name="cat_id" id="cat_id" class="form-control">
                                                    <option value="">Chọn danh mục cha</option>
                                                    @foreach ($categories as $category)
                                                        <option @selected($category->id == $sub_category->cat_id)  value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('cat_id')
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
