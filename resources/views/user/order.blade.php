@extends('layouts.app')
@section('title')
    Order
@endsection
@section('content')
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li><a href="/">Trang chủ</a> </li>
                        <li class="separator"></li>
                        <li>Đơn hàng</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container padding-bottom-3x mb-1">
        <div class="row">
            @include('includes.user-sidebar')
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="u-table-res">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>Đơn hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái đơn hàng</th>
                                        <th>Trạng thái thanh toán</th>
                                        <th>Ngày mua</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    
                                    <tr>
                                        <td><a class="navi-link" href="#" data-toggle="modal"
                                                data-target="#orderDetails">{{ $order->uuid }}</a></td>
                                        <td>
                                            ${{ $order->total_amount }}
                                        </td>
                                        <td>
                                            <span class="text-info">{{ $order->order_status }}</span>
                                        </td>
                                        <td>
                                            <span class="text-success">{{ $order->payment_status }}</span>
                                        </td>

                                        <td>{{ \Carbon\Carbon::now()->format('D/M/Y',strtotime($order->created_at)) }}</td>
                                        {{-- <td>
                                            <a href="https://geniusdevs.com/codecanyon/omnimart40/user/order/invoice/155"
                                                class="btn btn-info btn-sm">Invoice</a>
                                        </td> --}}
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
