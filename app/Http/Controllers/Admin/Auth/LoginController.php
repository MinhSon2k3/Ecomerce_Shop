<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    function index(): View
    {
        return view('admin.auth.login');
    }

    function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => [
                'required',
                'min:8',
                // 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
            ],
        ], [
            'email.email' => 'Vui lòng nhập địa chỉ email hợp lệ.',
            'email.exists' => 'Địa chỉ email chưa được đăng ký.',
            'password.required' => 'Trường mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một chữ cái viết hoa, một chữ cái viết thường, một chữ số và một ký tự đặc biệt.',
        ]);
        $admin = Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]);
        if ($admin) {
            return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công');
        } else {
            return redirect()->back()->with('error', 'Tên đăng nhập và mật khẩu không hợp lệ');
        }
    }

    function profile_view()
    {
        return view('admin.auth.update-profile');
    }

    function update_profile(Request $request)
    {

        $request->validate([
            'username' => 'required|alpha',
            'email' => 'required|email',
            'phone' => [
                'required',
                'unique:users',
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'email.email' => 'Vui lòng nhập địa chỉ email hợp lệ.',
            'phone.required' => 'Trường số điện thoại là bắt buộc.',
            'phone.unique' => 'Số điện thoại đã được sử dụng.',
        ]);
        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);

        if ($request->existing_password) {
            $request->validate([
                'password' => 'required|confirmed'
            ]);

            // kiểm tra xem mật khẩu hiện tại có chính xác không
            if (!Hash::check($request->existing_password, $admin->password)) {
                return redirect()->back()->with('error', 'Mật khẩu hiện tại không chính xác');
            }
        }

        $filename = '';
        if ($request->file('image')) {
            $filename = $request->file('image')->store('profile', 'public');
        } else {
            $filename = $admin->image;
        }

        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->image = $filename;

        if ($request->existing_password) {
            $admin->password = Hash::make($request->password) ?? $admin->password;
        }

        $admin->save();
        return redirect()->back()->with('success', 'Cập nhật hồ sơ thành công');
    }

    function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.auth.login')->with('success', 'Đăng xuất thành công');
    }
}
