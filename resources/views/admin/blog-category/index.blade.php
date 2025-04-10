@extends('layouts.admin')
@section('title')
    Danh sách danh mục Blog
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">

            <!-- Bắt đầu Nội dung Chính -->
            <div class="container-fluid">

                <!-- Tiêu đề Trang -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Danh mục Blog</b></h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.blog-category.create') }}"><i
                                    class="fas fa-plus"></i> Thêm</a>
                        </div>
                    </div>
                </div>

                <!-- DataTales -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="gd-responsive-table">
                            <table class="table table-bordered table-striped" id="admin-table" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($blog_categories as $category)
                                        <tr>

                                            <td>
                                                {{ $category->name }}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success btn-sm  dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{ $category->status == 1 ? 'Kích hoạt' : 'Vô hiệu hóa' }}
                                                    </button>
                                                    <div class="dropdown-menu animated--fade-in"
                                                        aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.blog-category.change.status', ['id' => $category->id]) }}">Kích hoạt</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.blog-category.change.status', ['id' => $category->id]) }}">Vô hiệu hóa</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="action-list">
                                                    <a class="btn btn-secondary btn-sm "
                                                        href="{{ route('admin.blog-category.edit', ['id' => $category->id]) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm " data-toggle="modal"
                                                        data-target="#confirm-delete" href="javascript:;"
                                                        data-href="{{ route('admin.blog-category.delete', ['id' => $category->id]) }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </td>

                                            <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"
                                                aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa?</h5>
                                                            <button class="close" type="button" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>

                                                        <!-- Modal Body -->
                                                        <div class="modal-body">
                                                            Bạn sắp xóa danh mục này. Tất cả nội dung liên quan đến danh mục này sẽ bị mất. Bạn có muốn xóa không?
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Hủy</button>
                                                            <form
                                                                action="{{ route('admin.category.delete', ['id' => $category->id]) }}"
                                                                class="d-inline btn-ok" method="get">
                                                                <button type="submit"
                                                                    class="btn btn-danger">Xóa</button>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
