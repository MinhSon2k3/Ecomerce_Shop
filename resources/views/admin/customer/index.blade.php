@extends('layouts.admin')
@section('title')
    Danh Sách Khách Hàng
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
                            <h3 class=" mb-0 "><b>Danh Sách Khách Hàng</b></h3>
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
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            {{ $user->phone }}
                                        </td>

                                        <td>
                                            <div class="action-list">
                                                <a class="btn btn-secondary btn-sm "
                                                    href="{{ route('admin.customer.edit', ['id'=>$user->id]) }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a class="btn btn-danger btn-sm " data-toggle="modal"
                                                    data-target="#confirm-delete" href="javascript:;"
                                                    data-href="{{ route('admin.customer.delete', ['id'=>$user->id]) }}">
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

        </div>
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <!-- Tiêu đề modal -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <!-- Nội dung modal -->
                    <div class="modal-body">
                        Bạn sắp xóa Admin này. Tất cả các nội dung liên quan đến admin này sẽ bị mất. Bạn có muốn xóa không?
                    </div>

                    <!-- Footer modal -->
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
@endsection
