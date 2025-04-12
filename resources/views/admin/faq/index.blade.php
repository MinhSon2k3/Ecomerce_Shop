@extends('layouts.admin')
@section('title')
    Danh Sách Câu Hỏi Thường Gặp
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">

            <!-- Bắt đầu nội dung chính -->
            <div class="container-fluid">

                <!-- Tiêu đề trang -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Câu Hỏi Thường Gặp</b></h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.faq.create') }}">
                                <i class="fas fa-plus"></i> Thêm mới
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Bảng dữ liệu -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="gd-responsive-table">
                            <table class="table table-bordered table-striped" id="admin-table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Tiêu đề</th>
                                        <th>Danh mục</th>
                                        <!-- <th>Chi tiết</th> -->
                                        <th>Hành động</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($faqs as $faq)
                                        <tr>
                                            <td>{{ $faq->title }}</td>
                                            <td>{{ $faq->category->name }}</td>
                                            <!-- <td>{{ $faq->details }}</td> -->
                                            <td>
                                                <div class="action-list">
                                                    <a class="btn btn-secondary btn-sm"
                                                        href="{{ route('admin.faq.edit', ['id' => $faq->id]) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#confirm-delete" href="javascript:;"
                                                        data-href="{{ route('admin.faq.delete', ['id' => $faq->id]) }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </td>

                                            <!-- Modal xác nhận xóa -->
                                            <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"
                                                aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <!-- Tiêu đề modal -->
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa?</h5>
                                                            <button class="close" type="button" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>

                                                        <!-- Nội dung modal -->
                                                        <div class="modal-body">
                                                            Bạn có chắc chắn muốn xóa mục này không? Tất cả nội dung liên quan sẽ bị mất.
                                                        </div>

                                                        <!-- Footer modal -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                                            <form action="{{ route('admin.faq.delete', ['id' => $faq->id]) }}" class="d-inline btn-ok" method="get">
                                                                <button type="submit" class="btn btn-danger">Xóa</button>
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
