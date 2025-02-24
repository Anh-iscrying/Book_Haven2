@php
    use App\Models\Category;
@endphp

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giới thiệu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Trang_chủ.css') }}" type="text/css">
    <script>
        document.getElementById('cart').addEventListener('click', function() {
            window.location.href = '{{ route('giohang') }}'; // Thay 'giohang' bằng route name cho trang giỏ hàng của bạn
        });
    </script>
</head>

<body>
    <!-- header -->
    <header>
        <nav>
            <div class="content-nav">
                <div class="img-nav">
                    <img src="{{ asset('images/book_haven.jpg') }}" width="50px" height="50px" alt="Book Haven Logo" />
                </div>

                <ul>
                    <li><a href="{{ route('trangchu') }}">Trang Chủ</a></li>
                    <li><a href="#">Sản Phẩm</a>
                        <ul>
                            @foreach ($categories as $category)
                                <li><a href="{{ route('phanloai', $category->id) }}">{{ $category->category_name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="#">Liên Hệ</a></li>
                    <li><a href="{{ route('gioithieu') }}">Giới Thiệu</a></li>
                </ul>
            </div>
            <button id="cart">
                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                Giỏ Hàng
            </button>
            <ul class="login">
                <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                <li><a href="{{ route('register') }}">Đăng ký</a></li>
            </ul>
        </nav>
    </header>

    <!-- content -->

    <section class="wrapper_gt">
        <div class="box_gt">
            <ul>
                <li>
                    <h1>Giới thiệu</h1>
                    <p>Dự án phần mềm website BookHaven sẽ mang đến trải nghiệm mua sắm sách cá nhân hóa và tiện lợi, với giao diện tối giản và thân thiện. Khách hàng có thể dễ dàng tìm kiếm sách qua thanh tìm kiếm thông minh. Các tính năng như giỏ hàng, thanh toán đa dạng, theo dõi đơn hàng sẽ giúp quá trình mua sắm mượt mà và nhận hỗ trợ trực tuyến khi cần thiết.</p>
                </li>
                <li>
                    <h2>Sản phẩm và dịch vụ</h2>
                    <p>Xuất bản, phát hành sách và các ấn phẩm văn hóa.</p>

                </li>
                <li>
                    <h2>Tầm nhìn</h2>
                    <p>Trở thành đơn vị xuất bản chất lượng tại Việt Nam và đối tác tin cậy của các Nhà xuất bản trên thế giới.</p>
                </li>
                <li>
                    <h2>Sứ mệnh</h2>
                    <p>Xuất bản các tác phẩm giá trị với chất lượng cao nhằm góp phần đáp ứng nhu cầu hưởng thụ văn hóa ngày càng cao của độc giả cả nước, góp phần xây dựng và phát triển một nền văn hóa đọc lành mạnh, phong phú và tiên tiến.</p>
                </li>
                <li>
                    <h1>Giá trị cốt lõi</h1>
                    <p>Xây dựng, phát triển mô hình kinh doanh bền vững trên nền tảng đảm bảo phục vụ tốt nhất các quyền lợi của khách hàng, nhân viên và các cổ đông.
                    </p>
                </li>
            </ul>


        </div>
    </section>

    <!-- footer -->
    <footer>
        <div>
            <ul class="end">
                <li>
                    <ul>
                        <img src="{{ asset('images/Book Haven (2).png') }}" width="130px" height="130px" alt="Book Haven Logo">
                    </ul>
                </li>
                <li>
                    <ul>
                        <li class="tieu_de">Dịch vụ</li>
                        <li><a href="">Điều khoản sử dụng</a></li>
                        <li><a href="">Liên hệ</a></li>
                        <li><a href="">Hệ thống nhà sách</a></li>
                    </ul>
                </li>

                <li>
                    <ul>
                        <li class="tieu_de">Hỗ trợ</li>
                        <li><a href="">Chính sách đổi trả - hoàn tiền</a></li>
                        <li><a href="">Phương thức vận chuyển</a></li>
                        <li><a href="">Phương thức thanh toán</a></li>
                    </ul>
                </li>

                <li>
                    <ul>
                        <li class="tieu_de">Nhà sách bán lẻ</li>
                        <li>Giám đốc: Tào Thanh Hà | Mai Phương Anh</li>
                        <li>Địa chỉ: Đại học Phenikaa</li>
                        <li>Số điện thoại:</li>
                        <li>Email:</li>
                        <li>Facebook:</li>
                    </ul>
                </li>
            </ul>
        </div>
    </footer>
</body>

</html>