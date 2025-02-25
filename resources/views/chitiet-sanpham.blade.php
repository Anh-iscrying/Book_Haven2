@php
    use App\Models\Category;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/Chi_tiet_san_pham.css') }}" type="text/css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>{{ $book->book_title ?? 'Chi tiết sách' }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <!-- header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <a class="navbar-brand" href="index.php">
                <img src="{{ asset('images/book_haven.jpg')}}" width="50" height="50" class="d-inline-block align-top" alt="Book Haven">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('trangchu') }}">Trang Chủ <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sản Phẩm
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Liên_hệ.html">Liên Hệ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('gioithieu') }}">Giới Thiệu</a>
                    </li>
                </ul>
                <form class="form-inline ml-auto" method="get" action="">
                    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Tìm kiếm sản phẩm..." aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
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

    <div class="story">
        <div class="story-bg">
            <div class="box-avata">
                <div class="avata">
                    <div class="image"><img src="{{ asset('images/' . ($book->book_image ?? 'default.jpg')) }}" alt="{{ $book->book_title ?? 'Sách' }}"></div>
                    <div class="discount-badge">{{ $book->book_discount ?? '0' }}%</div>
                </div>
            </div>
            <div class="story-infor">
                <div class="story-name">{{ $book->book_title ?? 'Chưa có tiêu đề' }}</div>
                <div class="view">
                    <li>Tác giả: <span>{{ $book->book_author ?? 'Không xác định' }}</span></li>
                    <li>Nhà xuất bản: <span>{{ $book->book_publisher ?? 'Không xác định' }}</span></li>
                    <li>Kích thước: <span>{{ $book->book_size ?? 'Không xác định' }}</span></li>
                    <li>Thể loại: <span>{{ $book->book_category ?? 'Không xác định' }}</span></li>

                    @php
                        $price = ($book->book_original_price ?? 0) * (1 - ($book->book_discount ?? 0) / 100);
                    @endphp

                    <li><div class="price">{{ number_format($price, 0, ',', '.') }}đ</div></li>
                    <li><div class="original-price">{{ number_format($book->book_original_price ?? 0, 0, ',', '.') }}đ</div></li>
                </div>

                <div class="box-counter">
                    <form action="{{ route('them.giohang') }}" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->book_id }}">
                        <input type="hidden" name="book_title" value="{{ $book->book_title }}">
                        <input type="hidden" name="book_image" value="{{ $book->book_image }}">
                        <input type="hidden" name="book_price" value="{{ $price }}">
                        <div class="counter">
                            <button type="button" id="decrease">-</button>
                            <div class="number" id="count">1</div>
                            <button type="button" id="increase">+</button>
                        </div>
                        <input type="hidden" name="quantity" id="quantity" value="1">
                        <button type="submit" class="btn btn-cart">Thêm Vào Giỏ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="box-box">
        <div class="tong">
            <div class="words">
                <span class="word selected" onclick="changeContent(this, 'Mô tả')">Mô tả</span>
                <span class="word" onclick="changeContent(this, 'Bình luận')">Bình luận</span>
            </div>
        </div>

        <div class="box" id="box">
            <div class="mota">
                <div class="box-mota">
                    <div class="story-content">{{ $book->book_description ?? 'Chưa có mô tả' }}</div>  {{-- Sửa ở đây --}}
                </div>
            </div>

            <div class="cmt" style="display: none;">
                <div class="box-cmt">
                    <!-- Phần bình luận sẽ được thêm vào sau -->
                </div>
            </div>
        </div>
    </div>

    <h2>Xem thêm các sản phẩm khác</h2>
    <section class="wrapper">
    <div class="box">
        @foreach ($relatedBooks as $relatedBook)
            @php
                $relatedPrice = ($relatedBook->book_original_price ?? 0) * (1 - ($relatedBook->book_discount ?? 0) / 100);
            @endphp
            <div class="card">
                <a href="{{ route('chitiet.sanpham', $relatedBook->book_id) }}">
                    <img src="{{ asset('images/' . $relatedBook->book_image) }}" alt="{{ $relatedBook->book_title }}">
                    <div class="discount">{{ $relatedBook->book_discount }}%</div>
                    <div class="title">{{ $relatedBook->book_title }}</div>
                    <div class="price">{{ number_format($relatedPrice, 0, ',', '.') }}đ</div>
                    <div class="original-price">{{ number_format($relatedBook->book_original_price, 0, ',', '.') }}đ</div>
                </a>
            </div>
        @endforeach
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
                <li><ul>
                    <li class="tieu_de">Dịch vụ</li>
                    <li><a href="">Điều khoản sử dụng</a></li>
                    <li><a href="">Liên hệ</a></li>
                    <li><a href="">Hệ thống nhà sách</a></li>
                </ul></li>

                <li><ul>
                    <li class="tieu_de">Hỗ trợ</li>
                    <li><a href="">Chính sách đổi trả - hoàn tiền</a></li>
                    <li><a href="">Phương thức vận chuyển</a></li>
                    <li><a href="">Phương thức thanh toán</a></li>
                </ul></li>

                <li><ul>
                    <li class="tieu_de">Nhà sách bán lẻ</li>
                    <li>Giám đốc: Tào Thanh Hà | Mai Phương Anh</li>
                    <li>Địa chỉ: Đại học Phenikaa</li>
                    <li>Số điện thoại: </li>
                    <li>Email: </li>
                    <li>Facebook: </li>
                </ul></li>
            </ul>
        </div>
    </footer>
    <script src="{{ asset('javascript/Chi_tiet_san_pham.js') }}"></script>
</body>
</html>