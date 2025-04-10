@extends('layouts.admin')
@section('title')
    Danh sách sản phẩm
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <!-- Start of Main Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Tất cả sản phẩm</b></h3>
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
                                        <th>Hình ảnh</th>
                                        <th width="30%">Tên sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Trạng thái</th>
                                        <th>Tùy chọn</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($products as $product)
                                        <tr id="product-bulk-delete">
                                            <td>
                                                <img src="{{ asset('storage') }}/{{ $product->featured_image }}"
                                                    alt="Không tìm thấy hình ảnh">
                                            </td>
                                            <td>
                                                {{ $product->name }}
                                            </td>
                                            <td>
                                                {{ $product->current_price }}
                                            </td>
                                            <td>
                                            <div class="dropdown">
                                                <!-- Nút hiển thị trạng thái hiện tại -->
                                                <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{ $product->status == 1 ? 'Hiện' : 'Ẩn' }}
                                                </button>
                                                <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                                    <!-- Nếu là 1 (Hiện), hiển thị "Ẩn" và ngược lại -->
                                                    <a class="dropdown-item" href="{{ route('admin.product.change.status', ['id' => $product->id, 'status' => $product->status == 1 ? 0 : 1]) }}">
                                                        {{ $product->status == 1 ? 'Ẩn' : 'Hiện' }}
                                                    </a>
                                                </div>
                                            </div>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary btn-sm  dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        Tùy chọn
                                                    </button>
                                                    <div class="dropdown-menu animated--fade-in"
                                                        aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.product.edit', ['id'=>$product->id]) }}"><i
                                                                class="fas fa-angle-double-right"></i>Sửa</a>
                                                        <a class="dropdown-item" target="_blank"
                                                            href="{{ route('admin.product.edit', ['id'=>$product->id]) }}"><i
                                                                class="fas fa-angle-double-right"></i>Xem</a>
                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#confirm-delete" href="javascript:;"
                                                            data-href="{{ route('admin.product.delete', ['id' => $product->id]) }}"><i
                                                                class="fas fa-angle-double-right"></i>Xóa</a>
                                                    </div>
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
    </div>

    <!-- Modal xác nhận xóa -->
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"
        aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa sản phẩm?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    Bạn sắp xóa sản phẩm này. Tất cả nội dung liên quan đến sản phẩm này sẽ bị mất. Bạn có muốn xóa nó không?
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <form action="{{ route('admin.product.delete', ['id' => $product->id]) }}" method="POST" class="d-inline btn-ok">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
