@extends('layouts.admin')
@section('title')
    Child Category Update
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Cập nhật danh mục con</b> </h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.child-category.index') }}"><i
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
                                        <form class="admin-form"
                                            action="{{ route('admin.child-category.update', ['id' => $child_category->id]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Tên *</label>
                                                <input type="text" name="name" class="form-control item-name"
                                                    id="name" placeholder="Enter Name"
                                                    value="{{ $child_category->name }}">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="slug">Slug *</label>
                                                <input type="text" name="slug" class="form-control" id="slug"
                                                    placeholder="Enter Slug" value="{{ $child_category->slug }}">
                                                @error('slug')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                           <!-- Chọn danh mục -->
                                            <div class="form-group">
                                                <label for="cat_id">Danh mục *</label>
                                                <select name="cat_id" id="cat_id" class="form-control">
                                                    <option value="">Chọn danh mục</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" @selected($category->id == $child_category->cat_id)>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('cat_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Chọn danh mục phụ -->
                                            <div class="form-group">
                                                <label for="sub_cat_id">Danh mục phụ *</label>
                                                <select name="sub_cat_id" id="sub_cat_id" class="form-control">
                                                    <option value="">Chọn danh mục phụ</option>
                                                    @foreach ($sub_categories as $subCategory)
                                                        <option value="{{ $subCategory->id }}" @selected($subCategory->id == $child_category->sub_cat_id)>
                                                            {{ $subCategory->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('sub_cat_id')
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

@section('footer')
    <script>
        $(document).ready(function() {
            const cat_id = $("#cat_id").val();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.child-category.update.sub-category') }}",
                    data: {
                        cat_id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        console.log(data);
                        $("#sub_cat_id").html(data);
                    }
                })
        })
    </script>
@endsection
