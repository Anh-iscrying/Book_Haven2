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
</head>
<body>
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
            <a href="{{ route('giohang') }}">
            <button id="cart">
                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                <li>Giỏ hàng</li>
            </button>
            </a>
            <ul class="login">
                <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
            
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