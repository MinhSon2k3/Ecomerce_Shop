<div class="col-lg-4">
    <aside class="user-info-wrapper">
        <div class="user-info">
            <div class="user-avatar">
               
                @if (Auth::user()->photo != "null")
                <img id="avater_photo_view"
                src="{{ asset('storage') }}/{{ Auth::user()->photo }}"
                />
                @else
                       <img id="avater_photo_view"
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png"
                    alt="User">
                @endif
                
             
            </div>

            <div class="user-data">
                <h4 class="h5">{{ Auth::user()->name }} </h4><span>Joined {{ date('M d, Y',strtotime(Auth::user()->created_at)) }}</span>
            </div>
        </div>
        <nav class="list-group">
            <a class="list-group-item {{ Request::routeIs('user.dashboard') ? 'active':''}} " href="{{ route('user.dashboard') }}"><i
                    class="icon-command"></i>Tổng quan</a>
            <a class="list-group-item {{ Request::routeIs('user.profile') ? 'active':''}}" href="{{ route('user.dashboard.profile') }}"><i
                    class="icon-user"></i>Thông tin</a>
            <a class="list-group-item with-badge {{ Request::routeIs('user.order') ? 'active':''}}"
                href="{{ route('user.order') }}"><i
                    class="icon-shopping-bag"></i>Đơn hàng<span
                    class="badge badge-default badge-pill">{{ count(Auth::user()->orders) }}</span></a>
            <a class="list-group-item " href="{{ route('user.dashboard.address') }}"><i
                    class="icon-map-pin"></i>Địa chỉ</a>
            <a class="list-group-item  with-badge {{ Request::routeIs('user.wishlist') ? 'active':''}}"
                href="{{ route('user.wishlist') }}"><i
                    class="icon-heart"></i>Danh sách yêu thích<span class="badge badge-default badge-pill">{{ count(Auth::user()->wishlists) }}</span></a>
            <a class="list-group-item with-badge"
                href="{{ route('user.logout') }}"><i class="icon-log-out"></i>Đăng xuất</a>
        </nav>
    </aside>
</div>