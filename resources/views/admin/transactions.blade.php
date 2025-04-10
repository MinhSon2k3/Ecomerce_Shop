@extends('layouts.admin')
@section('title')
    Giao Dịch
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">

            <!-- Bắt Đầu Nội Dung Chính -->
            <div class="container-fluid">

                <!-- Tiêu Đề Trang -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class=" mb-0 bc-title"><b>Danh Sách Giao Dịch</b></h3>
                        </div>
                    </div>
                </div>

                <!-- Bảng Dữ Liệu -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="gd-responsive-table">
                            <table class="table table-bordered table-striped" id="admin-table" width="100%"
                                cellspacing="0">

                                <thead>
                                    <tr>
                                        <th>Email Khách Hàng</th>
                                        <th>ID Giao Dịch</th>
                                        <th>Tình Trạng Thanh Toán</th>
                                        <th>Tình Trạng Đơn Hàng</th>
                                        <th>Tổng Số Tiền</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr id="transaction-bulk-delete">
                                            <td>
                                                {{ $transaction->users->email }}
                                            </td>
                                            <td>
                                                {{ $transaction->order_id }}
                                            </td>
                                            <td>
                                                <p class="badge badge-primary">{{ $transaction->payment_status }}</p>
                                            </td>
                                            <td>
                                                <p class="badge badge-dark">{{ $transaction->order_status }}</p>
                                            </td>
                                            <td>
                                                ${{ number_format($transaction->total_amount,2) }}
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

                    <!-- Tiêu Đề Modal -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xác Nhận Xóa?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <!-- Nội Dung Modal -->
                    <div class="modal-body">
                        Bạn có chắc chắn muốn xóa không?
                    </div>

                    <!-- Chân Modal -->
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
