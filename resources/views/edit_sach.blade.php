<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/Tao_san_pham.css') }}" type="text/css">
    <title>Chỉnh sửa sách</title>
</head>
<body>
    <div class="header">
        <a href="{{ route('quanly.sach') }}"><</a>
        <button onclick="document.getElementById('book-form').submit()">Lưu</button>
    </div>

    <div class="body">
        <form class="container" id="book-form" action="{{ route('quanly.sach.update', $book->book_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!--Ảnh tải avata-->
            <div class="box-avata">
                <div class="avata">
                    <input type="file" id="image-upload" name="book_image" accept="image/*" style="display: none;">
                    <label for="image-upload">
                        <img class="img" id="preview-image" src="{{ asset('images/' . $book->book_image) }}" alt="Preview Image">
                    </label>
                </div>
            </div>

            <div class="box-box">
                <div class="box" id="box">
                    <!--Nhập tên truyện, mô tả và chọn thể loại-->
                    <div class="book">
                        <!--Tiêu đề và mô tả-->
                        <p for="book-title">Tiêu đề:</p>
                        @error('book_title')
                            <div class="alert alert-danger" style="color: red;">{{ $message }}</div>
                        @enderror
                        <input type="text" name="book_title" id="book-title" placeholder="Nhập tiêu đề của truyện" width="200px" contenteditable="true" value="{{ $book->book_title }}">

                        <p for="book-describe">Mô tả:</p>
                        @error('book_description')
                            <div class="alert alert-danger" style="color: red;">{{ $message }}</div>
                        @enderror
                        <textarea id="book-describe" name="book_description" placeholder="Viết mô tả của truyện ở đây" width="300px" height="300px">{{ $book->book_description }}</textarea> <br>

                        <div class="hd">
                            <p>Tác giả:</p>
                            @error('book_author')
                                <div class="alert alert-danger" style="color: red;">{{ $message }}</div>
                            @enderror
                            <input type="text" name="book_author" id="book_author" width="200px" placeholder="Nhập tên tác giả" value="{{ $book->book_author }}" />
                        </div>

                        <label for="book_publisher">Nhà xuất bản:</label>
                        @error('book_publisher')
                            <div class="alert alert-danger" style="color: red;">{{ $message }}</div>
                        @enderror
                        <select id="book_publisher" name="book_publisher" required>
                            <option value="Nhà xuất bản Kim Đồng" {{ $book->book_publisher == 'Nhà xuất bản Kim Đồng' ? 'selected' : '' }}>Nhà xuất bản Kim Đồng</option>
                            <option value="Nhà xuất bản Trẻ" {{ $book->book_publisher == 'Nhà xuất bản Trẻ' ? 'selected' : '' }}>Nhà xuất bản Trẻ</option>
                            <option value="Nhà xuất bản IPM" {{ $book->book_publisher == 'Nhà xuất bản IPM' ? 'selected' : '' }}>Nhà xuất bản IPM</option>
                            <option value="Nhà xuất bản Amak" {{ $book->book_publisher == 'Nhà xuất bản Amak' ? 'selected' : '' }}>Nhà xuất bản Amak</option>
                        </select> <br>

                        <label for="book_size">Kích thước:</label>
                        @error('book_size')
                            <div class="alert alert-danger" style="color: red;">{{ $message }}</div>
                        @enderror
                        <select id="book_size" name="book_size" width="200px" required>
                            <option value="11.3x17.6 cm" {{ $book->book_size == '11.3x17.6 cm' ? 'selected' : '' }}>11.3x17.6 cm</option>
                            <option value="13x18 cm" {{ $book->book_size == '13x18 cm' ? 'selected' : '' }}>13x18 cm</option>
                            <option value="15.7x24 cm" {{ $book->book_size == '15.7x24 cm' ? 'selected' : '' }}>15.7x24 cm</option>
                            <option value="14.5x20.5 cm" {{ $book->book_size == '14.5x20.5 cm' ? 'selected' : '' }}>14.5x20.5 cm</option>
                        </select>

                        <div class="hd">
                            <p>Số tiền:</p>
                            @error('book_original_price')
                                <div class="alert alert-danger" style="color: red;">{{ $message }}</div>
                            @enderror
                            <input type="number" name="book_original_price" id="book_original_price" width="200px" placeholder="Nhập số tiền" min="0" step="1000" required value="{{ $book->book_original_price }}" />
                        </div>

                        <div class="hd">
                            <p>Phần trăm giảm:</p>
                            @error('book_discount')
                                <div class="alert alert-danger" style="color: red;">{{ $message }}</div>
                            @enderror
                            <input type="number" name="book_discount" id="book_discount" placeholder="Phần trăm giảm" min="0" max="100" step="1" required value="{{ $book->book_discount }}" />
                        </div>


                        <!--Thể loại-->
                        <label for="book_category">Thể loại:</label>
                        @error('book_category')
                            <div class="alert alert-danger" style="color: red;">{{ $message }}</div>
                        @enderror
                        <select name="book_category" id="book_category" class="form-group" required>
                            <option value="Trinh thám - Kinh dị" {{ $book->book_category == 'Trinh thám - Kinh dị' ? 'selected' : '' }}>Trinh thám - Kinh dị</option>
                            <option value="Boys Love - Girls Love" {{ $book->book_category == 'Boys Love - Girls Love' ? 'selected' : '' }}>Boys Love - Girls Love</option>
                            <option value="Light Novel" {{ $book->book_category == 'Light Novel' ? 'selected' : '' }}>Light Novel</option>
                            <option value="Văn Học Kinh Điển" {{ $book->book_category == 'Văn Học Kinh Điển' ? 'selected' : '' }}>Văn Học Kinh Điển</option>
                            <option value="Linh dị" {{ $book->book_category == 'Linh dị' ? 'selected' : '' }}>Linh dị</option>
                            <option value="Manga & Comics" {{ $book->book_category == 'Manga & Comics' ? 'selected' : '' }}>Manga & Comics</option>
                            <option value="Ngôn tình" {{ $book->book_category == 'Ngôn tình' ? 'selected' : '' }}>Ngôn tình</option>
                            <option value="Album" {{ $book->book_category == 'Album' ? 'selected' : '' }}>Album</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>

    </div>
    <script src="{{ asset('javascript/Tao_san_pham.js') }}" type="text/javascript"></script>
</body>
</html>