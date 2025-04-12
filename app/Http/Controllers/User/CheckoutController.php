<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BillingAddress;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Stripe;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    function index()
    {
        if(Cart::whereUserId(auth()->id())->count() <= 0){
            return redirect()->route('user.shop')->with('error','Giỏ hàng của bạn đang trống');
        }
        $billing_address = BillingAddress::whereUserId(auth()->id())->first();
        if (!$billing_address) {
            BillingAddress::create([
                'user_id' => auth()->id(),
                'address1' =>  ' ',
                'address2' => ' ',
                'zip_code' => ' ',
                'company' => ' ',
                'city' => ' ',
                'phone' => ' ',
            ]);
            return view('user.checkout', compact('billing_address'));
        }
        return view('user.checkout', compact('billing_address'));
    }

    function update_billing_address(Request $request)
    {
        $validate = $request->validate([
            'address1' => 'required',
            'address2' => 'required',
            'zip_code' => 'required',
            'city' => 'required',
            'phone' => 'required',
        ]);

        $billing_address = BillingAddress::whereUserId(auth()->id())->first();
        if ($billing_address) {
            BillingAddress::where('user_id', auth()->id())->update([
                'user_id' => auth()->id(),
                'address1' =>  $request->address1,
                'address2' => $request->address2,
                'zip_code' => $request->zip_code,
                'company' => $request->company ?? ' ',
                'city' => $request->city,
                'phone' => $request->phone,
            ]);
        }
        return redirect()->route('user.payment')->with('success', 'Cập nhật địa chỉ thanh toán thành công');
    }

    function payment()
    {
        if(Cart::whereUserId(auth()->id())->count() <= 0){
            return redirect()->route('user.shop')->with('error','Giỏ hàng của bạn đang trống');
        }
        $billing_address = BillingAddress::whereUserId(auth()->id())->first();
        return view('user.payment', compact('billing_address'));
    }


    //MOMO
    public function checkout_submit_momo(Request $request)
    {
        $total_amount = Cart::whereUserId(auth()->id())->sum('sub_total');
        $order_id = Str::uuid()->toString(); // Mã đơn hàng duy nhất
    
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $redirectUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
        $ipnUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
        $orderInfo = "Thanh toán đơn hàng #" . $order_id;
    
        $requestId = Str::uuid()->toString();
        $extraData = ""; // Có thể mã hóa thông tin người dùng tại đây
    
        $rawHash = "accessKey=$accessKey&amount=$total_amount&extraData=$extraData&ipnUrl=$ipnUrl&orderId=$order_id&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=captureWallet";

        // Tạo chữ ký với hash_hmac
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        

        $data = [
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $total_amount,
            'orderId' => $order_id,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'extraData' => $extraData,
            'requestType' => 'captureWallet',
            'signature' => $signature,
            'lang' => 'vi'
        ];
       
    
        $response = Http::withOptions([
            'verify' => false, // Tắt kiểm tra SSL
        ])->post($endpoint, $data);
        if ($response->successful() && isset($response['payUrl'])) {
            // Lưu session order_id để xử lý sau
            session(['momo_order_id' => $order_id, 'momo_total' => $total_amount]);
            return redirect($response['payUrl']);
        }
    
        return back()->with('error', 'Không thể kết nối với cổng thanh toán Momo');
    }

    public function momo_redirect(Request $request)
{
    $order_id = session('momo_order_id');
    $total_amount = session('momo_total');

    if ($request->resultCode == 0) {
        // Thanh toán thành công
        $product_ids = Cart::whereUserId(auth()->id())->pluck('product_id');

        $order = new Order();
        $order->uuid = $order_id;
        $order->transaction_id = $request->transId;
        $order->user_id = auth()->id();
        $order->total_amount = $total_amount;
        $order->payment_status = 'paid';
        $order->order_status = 'pending';
        $order->product_id = json_encode($product_ids);
        $order->payment_method = 'momo';
        $order->save();

        $transaction = new Transaction();
        $transaction->order_id = $order_id;
        $transaction->user_id = auth()->id();
        $transaction->payment_status = 'paid';
        $transaction->order_status = 'pending';
        $transaction->total_amount = $total_amount;
        $transaction->save();

        Cart::whereUserId(auth()->id())->delete();

        return redirect()->route('user.order')->with('success', 'Đặt hàng thành công qua Momo');
    }

    return redirect()->route('user.payment')->with('error', 'Thanh toán thất bại');
}


    function checkout_submit_cash_on_delivery(Request $request)
    {
        $order = new Order();
        $transaction = new Transaction();
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $randomString = substr(str_shuffle($characters), 0, 10);

        $total_amount = Cart::whereUserId(auth()->id())->sum('sub_total');
        $product_ids = Cart::whereUserId(auth()->id())->pluck('product_id');
        $order->uuid = $randomString;
        $order->transaction_id = 'null';
        $order->user_id = auth()->id();
        $order->total_amount = $total_amount;
        $order->payment_status = 'unpaid';
        $order->order_status = 'pending';
        $order->product_id = json_encode($product_ids);
        $order->payment_method = $request->payment_method;
        $order->save();

        $transaction->order_id = $order->uuid;
        $transaction->user_id = auth()->id();
        $transaction->payment_status = 'unpaid';
        $transaction->order_status = 'pending';
        $transaction->total_amount = $total_amount;
        $transaction->save();

        Cart::whereUserId(auth()->id())->delete();

        return redirect()->route('user.order')->with('success', 'Đặt hàng thành công');
    }

    function order()
    {
        $orders = Order::whereUserId(auth()->id())->latest()->get();
        return view('user.order', compact('orders'));
    }

    public function stripePost(Request $request)
    {
        $total_amount = Cart::whereUserId(auth()->id())->sum('sub_total');
        $stripeToken = $request->input('_token');
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $charge = Stripe\Charge::create([
            "amount" => 100 * $total_amount,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanh toán thành công từ " . Auth::user()->name,
        ]);

        if ($charge->status) {
            $order = new Order();
            $transaction = new Transaction();
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            $randomString = substr(str_shuffle($characters), 0, 10);

            $product_ids = Cart::whereUserId(auth()->id())->pluck('product_id');
            $order->uuid = $randomString;
            $order->transaction_id = $charge->id;
            $order->user_id = auth()->id();
            $order->total_amount = $total_amount;
            $order->payment_status = $charge->status == 'succeeded' ? 'paid' : 'unpaid';
            $order->order_status = 'pending';
            $order->product_id = json_encode($product_ids);
            $order->payment_method = $request->payment_method;
            $order->save();

            $transaction->order_id = $order->uuid;
            $transaction->user_id = auth()->id();
            $transaction->payment_status = $charge->status == 'succeeded' ? 'paid' : 'unpaid';
            $transaction->order_status = 'pending';
            $transaction->total_amount = $total_amount;
            $transaction->save();

            Cart::whereUserId(auth()->id())->delete();

            return redirect()->route('user.order')->with('success', 'Đặt hàng thành công');
        }
    }

    function checkout_submit_back_transfer(Request $request)
    {
        $order = new Order();
        $transaction = new Transaction();
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $randomString = substr(str_shuffle($characters), 0, 10);

        $total_amount = Cart::whereUserId(auth()->id())->sum('sub_total');
        $product_ids = Cart::whereUserId(auth()->id())->pluck('product_id');
        $order->uuid = $randomString;
        $order->transaction_id = $request->transaction;
        $order->user_id = auth()->id();
        $order->total_amount = $total_amount;
        $order->payment_status = 'unpaid';
        $order->order_status = 'pending';
        $order->product_id = json_encode($product_ids);
        $order->payment_method = $request->payment_method;
        $order->save();

        $transaction->order_id = $order->uuid;
        $transaction->user_id = auth()->id();
        $transaction->payment_status = 'unpaid';
        $transaction->order_status = 'pending';
        $transaction->total_amount = $total_amount;
        $transaction->save();

        Cart::whereUserId(auth()->id())->delete();

        return redirect()->route('user.order')->with('success', 'Đặt hàng thành công');
    }
}
