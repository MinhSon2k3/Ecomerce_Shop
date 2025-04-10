@extends('layouts.admin')
@section('title')
    Danh sách dịch vụ
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
                            <h3 class="mb-0"><b>Dịch vụ</b></h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.service.create') }}">
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
                                        <th width="20%">Hình ảnh</th>
                                        <th width="20%">Tiêu đề</th>
                                        <th width="15%">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $service)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage') }}/{{ $service->image }}" alt="Không tìm thấy ảnh">
                                            </td>
                                            <td>
                                                {{ $service->title }}
                                            </td>
                                            <td>
                                                <div class="action-list">
                                                    <a class="btn btn-secondary btn-sm"
                                                        href="{{ route('admin.service.edit', ['id' => $service->id]) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#confirm-delete" href="javascript:;"
                                                        data-href="{{ route('admin.service.delete', ['id' => $service->id]) }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Kết thúc nội dung chính -->

            <!-- Modal xác nhận xóa -->
            <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"
                aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <!-- Header -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Đóng">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <!-- Body -->
                        <div class="modal-body">
                            Bạn sắp xóa dịch vụ này. Tất cả nội dung liên quan đến dịch vụ cũng sẽ bị xóa. Bạn có chắc chắn muốn xóa không?
                        </div>

                        <!-- Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <form action="" class="d-inline btn-ok" method="get">
                                @csrf
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
