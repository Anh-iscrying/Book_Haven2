@extends('layouts.app') {{-- Giả sử bạn có một layout chung --}}

@section('content')

<head>
    <title>Đăng ký</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">  <!-- CSS chung của ứng dụng -->
    <link rel="stylesheet" href="{{ asset('css/Đk.css') }}"> <!-- CSS riêng cho trang đăng nhập -->
</head>

<div class="gdđn">
    <div class="khunglon">
        <div class="x"><a href="{{ route('login') }}">X</a></div> {{-- Sử dụng route name --}}
        <div class="khungnho">
            <div class="khungbe">
                <div class="thamgiagt">
                    <div class="dnvao">
                        <span class="chu">Tham gia với chúng tôi</span>
                    </div>
                    <div class="dnvao">
                        <span class="quyenloi">Là một phần của cộng đồng tác giả và độc giả toàn cầu, mọi người đều được kết nối bằng sức mạnh của trí tưởng tượng.</span>
                    </div>
                </div>

                <form id="registerForm" method="POST" action="{{ route('register.post') }}" onsubmit="return validateForm()">
                    @csrf {{-- Thêm CSRF token --}}
                    <input type="text" id="name" name="name" placeholder="Tên" required>
                    <input type="email" id="email" name="email" placeholder="Email" required>
                    <input type="text" id="user" name="user" placeholder="Tên đăng nhập" required> {{-- Thêm trường tên đăng nhập --}}
                    <input type="tel" id="phone" name="phone" placeholder="Số điện thoại" required>
                    <input type="password" id="pass" name="pass" placeholder="Mật khẩu" required>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu" required> {{-- Sửa thành password_confirmation --}}
                    <button type="submit" class="buttondn">Đăng ký</button>
                </form>
            </div>
            <footer class="khungdk">
                <span>Nếu bạn đã có tài khoản <button class="dangki"><a class="dangki" href="{{ route('login') }}">Đăng nhập</a></button></span>
            </footer>
            <div class="quenMK">
                By continuing, you agree to Website's <a class="blue" href="">Điều khoản Dịch vụ</a> and <a class="blue" href="">Chính Sách Bảo Mật.</a>
            </div>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        var password = document.getElementById('pass').value;
        var confirmPassword = document.getElementById('password_confirmation').value;

        if (password !== confirmPassword) {
            alert("Mật khẩu và nhập lại mật khẩu không khớp!");
            return false;
        }

        return true;
    }
</script>
@endsection