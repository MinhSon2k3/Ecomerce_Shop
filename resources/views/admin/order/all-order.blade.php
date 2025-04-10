@extends('layouts.admin')
@section('title')
    Tất cả Đơn Hàng
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="container-fluid">

                <!-- Tiêu đề trang -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class=" mb-0 bc-title"><b>Tất cả Đơn Hàng</b></h3>
                            {{-- <div class="right">
                                <a href="https://geniusdevs.com/codecanyon/omnimart40/admin/order/csv/export"
                                    class="btn btn-info btn-sm d-inline-block">Xuất CSV</a>
                                <form class="d-inline-block"
                                    action="https://geniusdevs.com/codecanyon/omnimart40/admin/bulk/deletes" method="get">
                                    <input type="hidden" value="" name="ids[]" id="bulk_delete">
                                    <input type="hidden" value="orders" name="table">
                                    <button class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <!-- Bảng dữ liệu -->
                <div class="card shadow mb-4">
                    <div class="card-body">

                        {{-- <form action="https://geniusdevs.com/codecanyon/omnimart40/admin/orders" method="GET">
                            <div class="row mb-4 justify-content-center">
                                <div class="col-md-6 col-sm-6 col-lg-4">
                                    <div class="form-group p-0">
                                        <label for="start_date">Ngày bắt đầu *</label>
                                        <input type="text" name="start_date" id="datepicker"
                                            class="form-control datepicker" id="start_date" placeholder="Ngày bắt đầu"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-4">
                                    <div class="form-group  p-0">
                                        <label for="end_date">Ngày kết thúc *</label>
                                        <input type="text" name="end_date" id="datepicker1"
                                            class="form-control datepicker" id="end_date" placeholder="Ngày kết thúc"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center mt-3">
                                    <button class="btn btn-success py-1 mr-2">Lọc</button>
                                    <a href="https://geniusdevs.com/codecanyon/omnimart40/admin/orders"
                                        class="btn btn-info py-1">Đặt lại</a>
                                </div>
                            </div>
                        </form> --}}

                        <div class="gd-responsive-table">
                            <table class="table table-bordered table-striped" id="admin-table" width="100%"
                                cellspacing="0">

                                <thead>
                                    <tr>
                                        
                                        <th>Mã Đơn Hàng</th>
                                        <th>Tổng Số Tiền</th>
                                        <th>Tình Trạng Thanh Toán</th>
                                        <th>Tình Trạng Đơn Hàng</th>
                                        {{-- <th>Hành Động</th> --}}
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
                                            <div class="dropdown">
                                                <button class="btn btn-success btn-sm dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    {{ $order->payment_status }}
                                                </button>
                                                <div class="dropdown-menu animated--fade-in"
                                                    aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#statusModal"
                                                        href="javascript:;"
                                                        data-href="{{ route('admin.order.change.status',['id'=>$order->id]) }}">Đã thanh toán</a>
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#statusModal"
                                                        href="javascript:;"
                                                        data-href="{{ route('admin.order.change.status',['id'=>$order->id]) }}">Chưa thanh toán</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn Pending  btn-sm btn-success dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    {{ $order->order_status }}
                                                </button>
                                                <div class="dropdown-menu animated--fade-in"
                                                    aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#statusModal"
                                                        href="javascript:;"
                                                        data-href="{{ route('admin.order.change.pending.status', ['id'=>$order->id]) }}">Chưa xử lý</a>
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#statusModal"
                                                        href="javascript:;"
                                                        data-href="{{ route('admin.order.change.progress.status', ['id'=>$order->id]) }}">Đang vận chuyển</a>
                                                    <a class="dropdown-item" data-toggle="modal"
                                                        data-target="#statusModal" href="javascript:;"
                                                        data-href="{{ route('admin.order.change.delivered.status', ['id'=>$order->id]) }}">Đã giao</a>
                                                    <a class="dropdown-item" data-toggle="modal"
                                                        data-target="#statusModal" href="javascript:;"
                                                        data-href="{{ route('admin.order.change.canceled.status', ['id'=>$order->id]) }}">Hủy</a>
                                                </div>
                                            </div>
                                        </td>
                                        {{-- <td>
                                            <div class="action-list">   
                                                <a class="btn btn-secondary btn-sm"
                                                    href="https://geniusdevs.com/codecanyon/omnimart40/admin/order/invoice/156">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a class="btn btn-danger btn-sm " data-toggle="modal"
                                                    data-target="#confirm-delete" href="javascript:;"
                                                    data-href="https://geniusdevs.com/codecanyon/omnimart40/admin/order/delete/156">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        </td> --}}
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="statusModal" tabindex="-1" role="dialog"
                aria-labelledby="statusModalModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cập nhật trạng thái?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            Bạn sắp cập nhật trạng thái. Bạn có muốn tiếp tục không?
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <a href="" class="btn btn-ok btn-success">Cập nhật</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"
                aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            Bạn sắp xóa đơn hàng này. Tất cả các nội dung liên quan đến đơn hàng sẽ bị mất. Bạn có muốn xóa không?
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <form action="" class="d-inline btn-ok" method="POST">

                                <input type="hidden" name="_token" value="5G7KJnWZJiKt6I6pMExOheNmLtALmb20am98At1S">
                                <input type="hidden" name="_method" value="DELETE"> <button type="submit"
                                    class="btn btn-danger">Xóa</button>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
