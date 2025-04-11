@extends('layouts.app')
@section('title')
    Thanh toán
@endsection
@section('content')
    <div class="page-title">
        <div class="container">
            <div class="column">
                <ul class="breadcrumbs">
                    <li><a href="/">Trang chủ</a></li>
                    <li class="separator"></li>
                    <li>Kiểm tra đơn hàng và thanh toán</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container padding-bottom-3x mb-1 checkut-page">
        <div class="row">
            <!-- Phương thức thanh toán -->
            <div class="col-xl-9 col-lg-8">
                @include('includes.steps')
                <div class="card">
                    <div class="card-body">
                        <h6 class="pb-2">Xem lại đơn hàng của bạn:</h6>
                        <hr>
                        <div class="row padding-top-1x mb-4">
                            <div class="col-sm-12">
                                <h6>Địa chỉ giao hàng:</h6>
                                <ul class="list-unstyled">
                                    <li><span class="text-muted">Họ tên: </span>{{ Auth::user()->name }}</li>
                                    <li><span class="text-muted">Số điện thoại: </span>{{ $billing_address->phone }}</li>
                                    <li><span class="text-muted">Địa chỉ 1: </span>{{ $billing_address->address1 }}</li>
                                    <li><span class="text-muted">Địa chỉ 2: </span>{{ $billing_address->address2 }}</li>
                                </ul>
                            </div>
                        </div>

                        <h6>Thanh toán bằng:</h6>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="payment-methods">
                                    <div class="single-payment-method">
                                        <a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#stripe">
                                            <img src="https://geniusdevs.com/codecanyon/omnimart40/assets/images/1601930611stripe-logo-blue.png"
                                                alt="Stripe" title="Stripe">
                                            <p>Stripe</p>
                                        </a>
                                    </div>
                                    <div class="single-payment-method">
                                        <a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#bank">
                                            <img src="https://geniusdevs.com/codecanyon/omnimart40/assets/images/1638530860pngwing.com (1).png"
                                                alt="Chuyển khoản ngân hàng" title="Chuyển khoản ngân hàng">
                                            <p>Chuyển khoản ngân hàng</p>
                                        </a>
                                    </div>

                                    <div class="single-payment-method">
                                        <a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#cod">
                                            <img src="https://support.sitegiant.com/wp-content/uploads/2022/08/cash-on-delivery-banner.png"
                                                alt="Thanh toán khi nhận hàng" title="Thanh toán khi nhận hàng">
                                            <p>Thanh toán khi nhận hàng</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Thanh toán khi nhận hàng -->
                <div class="modal fade" id="cod" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title">Giao dịch thanh toán khi nhận hàng</h6>
                                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <form action="{{ route('user.checkout.cash.on.delivery') }}" method="POST">
                                @csrf
                                <input type="hidden" name="payment_method" value="Cash On Delivery">
                                <div class="card-body">
                                    <p>Thanh toán khi nhận hàng có nghĩa là bạn sẽ thanh toán khi nhận được sản phẩm.</p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal">Hủy</button>
                                    <button class="btn btn-primary btn-sm" type="submit">Thanh toán khi nhận hàng</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Stripe -->
                <div class="modal fade" id="stripe" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title">Giao dịch qua Stripe</h6>
                                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="card-wrapper"></div>
                                    <form role="form" action="{{ route('user.checkout.stripe') }}" method="post" class="require-validation"
                                        data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                                        @csrf
                                        <div class="form-group col-sm-12">
                                            <input class="form-control card-number" type="text" name="card" placeholder="Số thẻ" required="">
                                        </div>
                                        <input type="hidden" name="payment_method" value="Stripe">
                                        <div class="form-group col-sm-12">
                                            <input class="form-control card-expiry-month" type="text" name="month" placeholder="Tháng hết hạn" required="">
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <input class="form-control card-expiry-year" type="text" name="year" placeholder="Năm hết hạn" required="">
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <input class="form-control card-cvc" type="text" name="cvc" placeholder="Mã bảo mật (CVV)" required="">
                                        </div>
                                        <p class="p-3">Stripe là cách nhanh chóng và an toàn để thanh toán trực tuyến.</p>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal">Hủy</button>
                                            <button class="btn btn-primary btn-sm" type="submit">Thanh toán qua Stripe</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Flutterwave -->
                <div class="modal fade" id="flutterwave" tabindex="-1" aria-hidden="true">
                    <form class="interactive-credit-card row" action="https://geniusdevs.com/codecanyon/omnimart40/flutterwave/submit" method="POST">
                        <input type="hidden" name="_token" value="sXahNV8HiLbT9glsyMxedbtDGJmeA8qZf5UfwM7k">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title">Giao dịch qua Flutterwave</h6>
                                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body">
                                        <p>Flutterwave là phương thức thanh toán nhanh và an toàn. Thanh toán trực tuyến qua Flutterwave.</p>
                                    </div>
                                </div>
                                <input type="hidden" name="payment_method" value="Flutterwave">
                                <input type="hidden" name="state_id" value="" class="state_id_setup">
                                <div class="modal-footer">
                                    <button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal">Hủy</button>
                                    <button class="btn btn-primary btn-sm" type="submit">Thanh toán qua Flutterwave</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal chuyển khoản ngân hàng -->
                <div class="modal fade" id="bank" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title">Giao dịch qua chuyển khoản ngân hàng</h6>
                                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <form action="{{ route('user.checkout.bank.transfer') }}" method="POST">
                                <div class="modal-body">
                                    <div class="col-lg-12 form-group">
                                        <label for="transaction">Mã giao dịch</label>
                                        <input class="form-control" name="transaction" id="transaction" placeholder="Nhập mã giao dịch của bạn" required="">
                                    </div>
                                    <p>Số tài khoản: 434 3434 3334</p>
                                    <p>Tên tài khoản: Jhon Due</p>
                                    <p>Email: demo@gmail.com</p>
                                </div>
                                <div class="modal-footer">
                                    @csrf
                                    <input type="hidden" name="payment_method" value="Bank">
                                    <button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal">Hủy</button>
                                    <button class="btn btn-primary btn-sm" type="submit">Thanh toán bằng chuyển khoản ngân hàng</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @include('includes.order-summary')
        </div>
    </div>
@endsection

@section('footer')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
    // Giữ nguyên phần xử lý JavaScript Stripe
</script>
@endsection
