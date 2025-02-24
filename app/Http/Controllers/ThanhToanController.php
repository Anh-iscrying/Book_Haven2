<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThanhToanController extends Controller
{
    public function index(Request $request)
    {
        $cart = session('cart', []);
        $total_price = 0;
        foreach ($cart as $item) {
            $total_price += $item['price'] * $item['quantity'];
        }
        return view('thanh_toan', compact('cart', 'total_price'));
    }

    public function process(Request $request)
    {
        // Validate request (tương tự như kiểm tra trong JavaScript)
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
            'address' => 'required',
            'phone' => 'required|regex:/^0\d{9}$/',
            'payment_method' => 'required',
            'delivery_method' => 'required_if:payment_method,cod,transfer',
            'transfer_receipt' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Ví dụ
        ], [
            'email.regex' => 'Email không hợp lệ.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
            'delivery_method.required_if' => 'Vui lòng chọn phương thức vận chuyển.',
        ]);

        // Xử lý thanh toán (ví dụ: lưu thông tin vào database, gửi email xác nhận, v.v.)

        // Sau khi xử lý thành công, xóa giỏ hàng
        session()->forget('cart');

        return redirect()->route('trangchu')->with('success', 'Đơn hàng của bạn đã được hoàn tất!');
    }
}