@php
    use App\Models\Book;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý sách</title>
  <link rel="stylesheet" href="{{ asset('css/QLS.css') }}">
</head>
<body>
    <div class="header">
        <a href="{{ route('trangchu') }}"><</a>

        <!-- Form Đăng Xuất -->
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-button">Đăng xuất</button>
        </form>
    </div>

    <div class="container">
    <h1>Quản lý sách</h1>
    <form method="get" action="{{ route('quanly.sach') }}">
      <input class="tim-kiem" type="text" name="search" placeholder="Tìm kiếm sách..." value="{{ request('search') }}">
      <input type="submit" value="Tìm kiếm">
    </form>

    <a href="{{ route('tao.sanpham') }}" id="add-book-btn">Thêm sách</a>

    <div id="book-list">
      @if ($books->count() > 0)
          @foreach ($books as $book)
              <div class="book row">
                  <div class="book-left row">
                      <div class="image"><img src="{{ asset('images/' . $book->book_image) }}" alt="{{ $book->book_title }}"></div>
                      <div class="book-title">{{ $book->book_title }}</div>
                  </div>
                  <div class="book-right row">
                      <button class="button" onclick="deleteBook({{ $book->book_id }})">Xóa</button>
                      <button class="button" onclick="editBook({{ $book->book_id }})">Sửa</button>
                  </div>
              </div>
          @endforeach
      @else
          Không có sách nào.
      @endif
    </div>

  </div>

  <script>
    function deleteBook(bookId) {
        if (confirm("Bạn có chắc chắn muốn xóa sách này?")) {
            // Tạo một form ẩn để gửi request DELETE
            var form = document.createElement("form");
            form.method = "POST";
            form.action = "/quan-ly-sach/" + bookId; // Đường dẫn đến route xóa sách

            // Thêm CSRF token
            var csrfToken = document.createElement("input");
            csrfToken.type = "hidden";
            csrfToken.name = "_token";
            csrfToken.value = "{{ csrf_token() }}"; // Lấy CSRF token từ Blade
            form.appendChild(csrfToken);

            // Thêm method spoofing để giả lập method DELETE
            var methodField = document.createElement("input");
            methodField.type = "hidden";
            methodField.name = "_method";
            methodField.value = "DELETE";
            form.appendChild(methodField);

            document.body.appendChild(form); // Thêm form vào body
            form.submit(); // Submit form
        }
    }

    function editBook(bookId) {
        // Chuyển hướng đến trang chỉnh sửa sách
        window.location.href = "/quan-ly-sach/" + bookId + "/edit"; // Đường dẫn đến route chỉnh sửa sách
    }
  </script>
</body>
</html>