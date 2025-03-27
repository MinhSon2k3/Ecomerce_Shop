<div class="steps flex-sm-nowrap mb-5"><a class="step {{ Request::routeIs('user.checkout') ? 'active':''}}"
    href="{{ route('user.checkout') }}">
    <h4 class="step-title">1. Địa chỉ thanh toán:</h4>
</a>
<a class="step {{ Request::routeIs('user.payment') ? 'active':''}}" href="{{ route('user.payment') }}">
    <h4 class="step-title">2. Xem xét và thanh toán</h4>
</a>
</div>