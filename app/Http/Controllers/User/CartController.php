<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    function index()
    {
        $carts = Cart::whereUserId(auth()->id())->latest()->get();
        $total_cart=Cart::where('user_id',auth()->id())->sum('sub_total');
        return view('user.cart', compact('carts','total_cart'));
    }

    function clearCart()
    {
        Cart::whereUserId(auth()->id())->delete();
        return redirect()->route('user.cart')->with('success', 'cart empty successfully');
    }
    function removeCartItem($id)
    {
        Cart::findOrFail($id)->delete();
        return redirect()->route('user.cart')->with('success', 'cart item remove successfully');
    }

    function update_cart(Request $request)
    {
        $cart = Cart::findOrFail($request->id);
        
        // Xử lý giá trị price và đảm bảo là số
        $number = str_replace(",", "", $cart->product->current_price);
        $number = floatval($number); // Chuyển đổi thành float nếu cần thiết
    
        $cart->qty = $request->qty;
        $cart->total = $number; // Gán giá trị sau khi xử lý
        $cart->sub_total = intval($request->qty) * $number; // Tính toán tổng phụ
    
        $cart->save();
    
        return redirect()->route('user.cart')->with('success', 'Cart update successfully');
    }
    
}
