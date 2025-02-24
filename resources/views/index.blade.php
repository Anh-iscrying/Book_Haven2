@php
    use App\Models\Category;
    use App\Models\Book;
@endphp

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping-cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Trang_chủ.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/reponsive.css') }}" />
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
                    <li><a href="#">Trang Chủ</a></li>
                    <li><a href="#">Sản phẩm</a>
                        <ul>
                            @foreach ($categories as $category)
                                <li><a href="{{ route('phanloai', $category->id) }}">{{ $category->category_name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="#">Liên Hệ</a></li>
                    <li><a href="{{ route('gioithieu') }}">Giới Thiệu</a></li>
                </ul>
                <form method="get" action="{{ route('trangchu') }}">
                    <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." value="{{ request('search') }}"/>
                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
            <a href="{{ route('giohang') }}">
            <button id="cart">
                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                <li>Giỏ hàng</li>
            </button>
            </a>

            <ul class="login">
                @guest  {{-- Nếu người dùng chưa đăng nhập --}}
                    <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                    <li><a href="{{ route('register') }}">Đăng ký</a></li>
                @else  {{-- Nếu người dùng đã đăng nhập --}}
                    <li>
                        <a href="#">Xin chào, {{ Auth::user()->name }}</a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            Đăng xuất
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </nav>
    </header>

    <!--Slidershow-->
    <section id="slider">
        <div class="aspect-ratio-169">
            @foreach ($sliderImages as $slide)
                <img class="slide" src="{{ asset('images/' . $slide) }}" alt="Slider Image">
            @endforeach
        </div>
    </section>

    <!-- content -->
    <section class="wrapper">
        <div class="box">
            @if ($books->count() > 0)
                @foreach ($books as $book)
                    @php
                        $price = $book->book_original_price * (1 - $book->book_discount / 100);
                    @endphp
                    <div class="card">
                        <a href="{{ route('chitiet.sanpham', $book->book_id) }}">
                            <img src="{{ asset('images/' . $book->book_image) }}" alt="{{ $book->book_title }}">
                            <div class="discount">{{ $book->book_discount }}%</div>
                            <div class="title">{{ $book->book_title }}</div>
                            <div class="price">{{ number_format($price, 0, ',', '.') }}đ</div>
                            <div class="original-price">{{ number_format($book->book_original_price, 0, ',', '.') }}đ</div>
                        </a>
                    </div>
                @endforeach
            @else
                <p>Không có sách nào trong cơ sở dữ liệu.</p>
            @endif
        </div>
    </section>

    <div class="box_pagination">
       {{ $books->links() }}  {{-- CHỈ GIỮ LẠI DÒNG NÀY --}}
    </div>

    <!-- footer -->
    <footer>
        <div>
            <ul class="end">
                <li>
                    <ul>
                        <img src="{{ asset('images/Book Haven (2).png') }}" width="130px" height="130px" alt="Book Haven" >
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
                    </ul>
                </li>
            </ul>
        </div>
    </footer>
    <script src="{{ asset('javascript/Trang_chủ.js') }}"></script>
</body>
</html>