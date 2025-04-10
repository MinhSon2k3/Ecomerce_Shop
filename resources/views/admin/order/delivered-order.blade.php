@extends('layouts.admin')
@section('title')
    Đơn Hàng Đã Giao
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="container-fluid">

                <!-- Tiêu Đề Trang -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class=" mb-0 bc-title"><b>Danh Sách Đơn Hàng Đã Giao</b></h3>
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
                                        <th>ID Đơn Hàng</th>
                                        <th>Tổng Số Tiền</th>
                                        <th>Tình Trạng Thanh Toán</th>
                                        <th>Tình Trạng Đơn Hàng</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr id="order-bulk-delete">
                                        <td>
                                            {{ $order->uuid }}
                                        </td>

                                        <td>
                                            ${{ $order->total_amount }}
                                        </td>

                                        <td>
                                            {{ $order->payment_status }}
                                        </td>
                                        <td>
                                            {{ $order->order_status }}
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
    </div>
@endsection
