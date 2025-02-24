@extends('layouts.app')

@section('content')

<head>
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">  <!-- CSS chung của ứng dụng -->
    <link rel="stylesheet" href="{{ asset('css/ĐN.css') }}"> <!-- CSS riêng cho trang đăng nhập -->
</head>

<div class="gdđn">
    <div class="khunglon">
        <div class="dangnhap">
            <div class="dnvao">
                <span class="chu">Đăng nhập vào tài khoản của bạn</span>
            </div>

            <form action="{{ route('login') }}" method="post">
                @csrf  <!-- Thêm CSRF token -->

                <div class="chon">
                    <p class="mot">Email hoặc Tên người dùng<span class="sao">*</span></p>
                    <input type="text" id="" name="user" class="tdnemail" required value="{{ old('user') }}">
                    @error('user')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="chon">
                    <p class="mot">Mật khẩu<span class="sao">*</span></p>
                    <input type="password" id="" name="pass" class="pass" required>
                    @error('pass')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button name="login" class="bt">Đăng nhập</button>
            </form>

            <div class="qmk">
                <a href="#">Quên mật khẩu?</a>
            </div>
            <div class="back">
                <a href="#">Trở lại các mục đăng nhập</a>
            </div>
            <div class="last">
                Chưa có tài khoản?
                <a class="dki" href="{{ route('register') }}">Đăng ký</a> <!-- Thêm route đăng ký -->
            </div>
        </div>
    </div>
</div>
@endsection