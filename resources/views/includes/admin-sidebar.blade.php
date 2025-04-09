<div class="sidebar">
    @php
    $settings=\App\Models\ManageSite::where('key','media')->first();
    $setting_value=json_decode($settings->value);
    @endphp

    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('storage') }}/{{ $setting_value->logo }}" alt="..."
                        class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            Quản trị viên
                            <span class="user-level">Người quản trị</span>
                        </span>
                    </a>
                </div>
            </div>

            <ul class="nav">

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Tổng quan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#category">
                        <i class="fas fa-list-alt"></i>
                        <p>Quản lý danh mục</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="category">
                        <ul class="nav nav-collapse">
                            <li>
                                <a class="sub-link" href="{{ route('admin.category.index') }}">
                                    <span class="sub-item">Danh mục</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-link" href="{{ route('admin.sub-category.index') }}">
                                    <span class="sub-item">Danh mục phụ</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#items">
                        <i class="fab fa-product-hunt"></i>
                        <p>Quản lý sản phẩm</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="items">
                        <ul class="nav nav-collapse">
                            <li>
                                <a class="sub-link" href="{{ route('admin.brand.index') }}">
                                    <span class="sub-item">Thương hiệu</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-link" href="{{ route('admin.product.create') }}">
                                    <span class="sub-item">Thêm sản phẩm</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-link" href="{{ route('admin.product.index') }}">
                                    <span class="sub-item">Tất cả sản phẩm</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item ">
                    <a data-toggle="collapse" href="#order">
                        <i class="fab fa-first-order"></i>
                        <p>Quản lý đơn hàng</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="order">
                        <ul class="nav nav-collapse">
                            <li class="">
                                <a class="sub-link" href="{{ route('admin.all.order') }}">
                                    <span class="sub-item">Tất cả đơn hàng</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sub-link" href="{{ route('admin.pending.order') }}">
                                    <span class="sub-item">Đơn hàng chờ xử lý</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sub-link" href="{{ route('admin.progress.order') }}">
                                    <span class="sub-item">Đơn hàng đang xử lý</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sub-link" href="{{ route('admin.delivered.order') }}">
                                    <span class="sub-item">Đơn hàng đã giao</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sub-link" href="{{ route('admin.canceled.order') }}">
                                    <span class="sub-item">Đơn hàng bị hủy</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.transactions') }}">
                        <i class="fas fa-random"></i>
                        <p>Giao dịch</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.customer') }}">
                        <i class="fas fa-users"></i>
                        <p>Danh sách khách hàng</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="https://geniusdevs.com/codecanyon/omnimart40/admin/ticket">
                        <i class="fas fa-comments"></i>
                        <p>Manages Tickets</p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a data-toggle="collapse" href="#content">
                        <i class="fas fa-tasks"></i>
                        <p>Quản lý trang web</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="content">
                        <ul class="nav nav-collapse">
                            <li>
                                <a class="sub-link" href="{{ route('admin.manage-site.index') }}">
                                    <span class="sub-item">Cài đặt chung</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-link" href="{{ route('admin.slider.index') }}">
                                    <span class="sub-item">Sliders</span>
                                </a>
                            </li>

                            <li>
                                <a class="sub-link" href="{{ route('admin.service.index') }}">
                                    <span class="sub-item">Services</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#faqs">
                        <i class="fas fa-question-circle"></i>
                        <p> Quản lý FAQs</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="faqs">
                        <ul class="nav nav-collapse">
                            <li>
                                <a class="sub-link" href="{{ route('admin.faq-category.index') }}">
                                    <span class="sub-item">Thể loại</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-link" href="{{ route('admin.faq.index') }}">
                                    <span class="sub-item">Hỏi & Đáp</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#post">
                        <i class="fas fa-rss-square"></i>
                        <p>Quản lý blog</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="post">
                        <ul class="nav nav-collapse">
                            <li>
                                <a class="sub-link" href="{{ route('admin.blog-category.index') }}">
                                    <span class="sub-item">Thể loại</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-link" href="{{ route('admin.blog.index') }}">
                                    <span class="sub-item">Blogs</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>