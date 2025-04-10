@extends('layouts.admin')
@section('title')
    Slider
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">
                <!-- Tiêu đề trang -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Thêm trình chiếu</b></h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.slider.create') }}">
                                Mới <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="gd-responsive-table">
                            <table class="table table-bordered table-striped" id="admin-table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <th width="25%">Tiêu đề</th>
                                        <th width="25%">Chi tiết</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($sliders as $slider)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage') }}/{{ $slider->image }}" alt="Không tìm thấy hình ảnh">
                                            </td>
                                            <td>
                                                {{ $slider->title }}
                                            </td>
                                            <td>
                                                {{ $slider->details }}
                                            </td>

                                            <td>
                                                <div class="action-list">
                                                    <a class="btn btn-secondary btn-sm"
                                                        href="{{ route('admin.slider.edit', ['id' => $slider->id]) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#confirm-delete" href="javascript:;"
                                                        data-href="{{ route('admin.slider.delete', ['id' => $slider->id]) }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal xác nhận xóa -->
                                        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"
                                            aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">

                                                    <!-- Header -->
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa?</h5>
                                                        <button class="close" type="button" data-dismiss="modal"
                                                            aria-label="Đóng">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>

                                                    <!-- Body -->
                                                    <div class="modal-body">
                                                        Bạn sắp xóa mục này. Tất cả nội dung liên quan sẽ bị mất. Bạn có chắc chắn muốn xóa không?
                                                    </div>

                                                    <!-- Footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Hủy</button>
                                                        <form action="{{ route('admin.slider.delete', ['id' => $slider->id]) }}"
                                                            class="d-inline btn-ok" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Xóa</button>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
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
