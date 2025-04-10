<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ManageController extends Controller
{
    function index(): View
    {
        $orders = Order::latest()->get();
        return view('admin.order.all-order', compact('orders'));
    }
    function pending_order(): View
    {
        $orders = Order::whereOrderStatus('pending')->latest()->get();
        return view('admin.order.pending-order', compact('orders'));
    }
    function progress_order(): View
    {
        $orders = Order::whereOrderStatus('progress')->latest()->get();
        return view('admin.order.progress-order', compact('orders'));
    }
    function delivered_order(): View
    {
        $orders = Order::whereOrderStatus('delivered')->latest()->get();
        return view('admin.order.delivered-order', compact('orders'));
    }
    function canceled_order(): View
    {
        $orders = Order::whereOrderStatus('canceled')->latest()->get();
        return view('admin.order.canceled-order', compact('orders'));
    }

    function change_payment_status($id)
    {
        $order = Order::findOrFail($id);
        $transaction = Transaction::whereOrderId($order->uuid)->first();

        if ($order->payment_status == 'Chưa thanh toán') {
            $order->payment_status = "Đã thanh toán";
            $order->save();

            $transaction->payment_status = 'Đã thanh toán';
            $transaction->save();
            return redirect()->back()->with('success', 'Status is in Đã thanh toán');
        } else {
            $order->payment_status = "Chưa thanh toán";
            $order->save();
            $transaction->payment_status = 'Chưa thanh toán';
            $transaction->save();
            return redirect()->back()->with('success', 'Status is in Chưa thanh toán');
        }
    }
    function pending_status($id)
    {
        $order = Order::findOrFail($id);
        $order->order_status = 'Chưa xử lý';
        $order->save();
        $transaction = Transaction::whereOrderId($order->uuid)->first();
        $transaction->payment_status = 'Chưa xử lý';
        $transaction->save();
        return redirect()->back()->with('success', 'Đang xử lý');
    }
    function progress_status($id)
    {
        $order = Order::findOrFail($id);
        $order->order_status = 'Đang vận chuyển';
        $order->save();
        $transaction=Transaction::whereOrderId($order->uuid)->first();
        $transaction->payment_status='Đang vận chuyển';
            $transaction->save();
        return redirect()->back()->with('success', 'Đơn hàng đang vận chuyển');
    }
    function delivered_status($id)
    {
        $order = Order::findOrFail($id);
        $order->order_status = 'Đã giao';
        $order->save();
        $transaction=Transaction::whereOrderId($order->uuid)->first();
        $transaction->payment_status='Đã giao';
            $transaction->save();
        return redirect()->back()->with('success', 'Đơn hơn đã giao');
    }
    function canceled_status($id)
    {
        $order = Order::findOrFail($id);
        $order->order_status = 'Hủy';
        $order->save();
        $transaction=Transaction::whereOrderId($order->uuid)->first();
        $transaction->payment_status='Hủy';
            $transaction->save();
        return redirect()->back()->with('success', 'Đơn hàng đã bị hủy');
    }

    function transactions()
    {
        $transactions = Transaction::latest()->get();
        return view('admin.transactions', compact('transactions'));
    }

    function transactions_delete($id)
    {
        $transactions = Transaction::findOrFail($id);
        Order::whereOrderId($transactions->order_id)->delete();
        $transactions->delete();
        return redirect()->route('admin.transactions')->with('success', 'Transaction delete successfully');
    }
}
