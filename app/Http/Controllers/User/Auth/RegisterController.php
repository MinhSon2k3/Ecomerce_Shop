<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\BillingAddress;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    function index(): View
    {
        return view('user.auth.register');
    }

    function create(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'email' => 'required|email|unique:users',
            'phone' => [
                'required',
                'unique:users',
                'regex:/^[0-9]{10}$/',
            ],
            'password' => [
                'required',
                'confirmed',
                'min:8',
                // 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
            ],
        ], [
            'first_name.required' => 'Trường họ là bắt buộc.',
            'first_name.alpha' => 'Họ chỉ được chứa các chữ cái.',

            'last_name.required' => 'Trường tên là bắt buộc.',
            'last_name.alpha' => 'Tên chỉ được chứa các chữ cái.',

            'email.required' => 'Trường email là bắt buộc.',
            'email.email' => 'Vui lòng nhập địa chỉ email hợp lệ.',
            'email.unique' => 'Địa chỉ email đã được sử dụng.',

            'phone.required' => 'Trường số điện thoại là bắt buộc.',
            'phone.regex' => 'Vui lòng nhập số điện thoại hợp lệ gồm 10 chữ số.',
            'phone.unique' => 'Số điện thoại đã được sử dụng.',

            'password.required' => 'Trường mật khẩu là bắt buộc.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',

            // 'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);

        $user = new User();
        $user->name = $request->last_name. ' ' . $request->first_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->photo = "null";
        $user->password = Hash::make($request->password);
        $user->save();

        BillingAddress::create([
            'user_id' => $user->id,
            'address1' =>  ' ',
            'address2' => ' ',
            'zip_code' => ' ',
            'company' => ' ',
            'city' => ' ',
            'phone' => ' ',
        ]);
        return redirect()->route('user.register')->with('success', 'Đăng ký thành công');
    }
}
