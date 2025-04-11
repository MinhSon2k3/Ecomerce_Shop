<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index(): View
    {
        $pending_orders = Order::whereOrderStatus('Chưa xử lý')->count();
        $progress_orders = Order::whereOrderStatus('Đang vận chuyển')->count();
        $delivered_orders = Order::whereOrderStatus('Đã giao')->count();
        $canceled_orders = Order::whereOrderStatus('Hủy')->count();
        $all_orders = Order::count();
        $total_earning = Order::whereUserId(auth()->id())->sum('total_amount');
        $total_products=Product::count();
        $total_customer=User::count();
        $total_category=Category::count();
        $total_brand=Brand::count();
        $total_transaction=Transaction::count();
        $total_blog=Blog::count();
        return view('admin.dashboard',compact(
            'pending_orders',
            'progress_orders',
            'delivered_orders',
            'canceled_orders',
            'all_orders',
            'total_earning',
            'total_products',
            'total_customer',
            'total_category',
            'total_brand',
            'total_transaction',
            'total_blog',
        ));
    }
}
