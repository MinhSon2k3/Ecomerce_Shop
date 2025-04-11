@extends('layouts.app')
@section('title')
    Đăng ký
@endsection
@section('content')
<div class="page-title">
    <div class="container">
      <div class="row">
          <div class="col-lg-12">
            <ul class="breadcrumbs">
                <li><a href="/">Trang chủ</a> </li>
                <li class="separator"></li>
                <li>Đăng nhập/Đăng ký</li> 
              </ul>
          </div>
      </div>
    </div>
</div>

<div class="container padding-bottom-3x mb-1">
    <div class="row">
        <!-- Form Đăng nhập -->
        <div class="col-md-6">
            <div class="card register-area">
                <div class="card-body">
                    <h4 class="margin-bottom-1x text-center">Đăng nhập</h4>
                    <form class="row" action="{{ route('user.make.login') }}" method="POST">
                        @csrf
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="reg-email">E-mail</label>
                                <input class="form-control" type="email" name="email_login" placeholder="Địa chỉ E-mail"
                                    id="reg-email" value="{{ old('email_login') }}">
                                @error('email_login')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="reg-pass">Mật khẩu</label>
                                <input class="form-control" type="password" name="password_login" placeholder="Mật khẩu"
                                    id="login-pass">
                                @error('password_login')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <input type="checkbox" class="checkbox" name="" id="show-password-checkbox"> <label for="show-password-checkbox">Hiện mật khẩu</label> --}}
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary margin-bottom-none" type="submit"><span>Đăng nhập</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Form Đăng ký -->
        <div class="col-md-6">
            <div class="card register-area">
                <div class="card-body">
                    <h4 class="margin-bottom-1x text-center">Đăng ký</h4>
                    <form class="row" action="{{ route('user.make.register') }}" method="POST">
                        @csrf
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-fn">Tên</label>
                                <input class="form-control" type="text" name="first_name" placeholder="Tên"
                                    id="reg-fn" value="{{ old('first_name') }}">
                                @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-ln">Họ</label>
                                <input class="form-control" type="text" name="last_name" placeholder="Họ"
                                    id="reg-ln" value="{{ old('last_name') }}">
                                @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-email">E-mail</label>
                                <input class="form-control" type="email" name="email" placeholder="Địa chỉ E-mail"
                                    id="reg-email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-phone">Số điện thoại</label>
                                <input class="form-control" name="phone" type="text" placeholder="Số điện thoại"
                                    id="reg-phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-pass">Mật khẩu</label>
                                <input class="form-control" type="password" name="password" placeholder="Mật khẩu"
                                    id="reg-pass">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-pass-confirm">Xác nhận mật khẩu</label>
                                <input class="form-control" type="password" name="password_confirmation"
                                    placeholder="Xác nhận mật khẩu" id="reg-pass-confirm">
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary margin-bottom-none" type="submit"><span>Đăng ký</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const passwordInput = document.getElementById('login-pass');
    const showPasswordCheckbox = document.getElementById('show-password-checkbox');

    showPasswordCheckbox?.addEventListener('change', function () {
        passwordInput.type = this.checked ? 'text' : 'password';
    });
</script>
@endsection
