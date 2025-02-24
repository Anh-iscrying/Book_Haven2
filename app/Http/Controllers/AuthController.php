<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Import Hash facade, but not use

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'user' => 'required',
            'pass' => 'required',
        ]);

        $userInput = $request->input('user');
        $password = $request->input('pass');

        // Tìm người dùng bằng email hoặc tên người dùng
        $user = User::where('email', $userInput)->orWhere('user', $userInput)->first();

        if ($user) {
            // So sánh mật khẩu đã nhập với mật khẩu không băm
            if ($password === $user->password) {
                // Đăng nhập thành công
                Auth::login($user);

                $request->session()->regenerate();

                // Kiểm tra xem người dùng có quyền admin hay không
                if ($user->is_admin == 1) {
                    // Nếu là admin, chuyển hướng đến route quản lý sách
                    return redirect()->route('quanly.sach');
                } else {
                    // Nếu không phải admin, chuyển hướng đến route trang chủ
                    return redirect()->route('trangchu');
                }
            } else {
                // Mật khẩu không chính xác
                return back()->withErrors(['pass' => 'Mật khẩu không chính xác.']);
            }
        } else {
            // Người dùng không tồn tại
            return back()->withErrors(['user' => 'Người dùng không tồn tại.']);
        }
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'user' => 'required|string|max:255|unique:users',
            'pass' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20',
        ]);

        // Tạo người dùng mới
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'user' => $request->user,
            'phone' => $request->phone,
            'password' => $request->pass, // Lưu mật khẩu không băm
        ]);

        // Đăng nhập người dùng
        Auth::login($user);

        // Chuyển hướng người dùng đến trang chủ
        return redirect()->route('trangchu');
    }
}