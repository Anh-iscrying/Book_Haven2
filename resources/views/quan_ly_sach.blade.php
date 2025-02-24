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
                      <button class="button" onclick="editBook({{ $book->book_id }}, '{{ addslashes($book->book_title) }}')">Sửa</button>
                  </div>
              </div>
          @endforeach
      @else
          Không có sách nào.
      @endif
    </div>

    <div id="edit-form" style="display: none;">
      <h2>Sửa thông tin sách</h2>
        <form id="edit-book-form">
          <input type="hidden" id="edit-book-id">
          <label for="edit-title">Tiêu đề:</label>
          <input type="text" id="edit-title" placeholder="Nhập tiêu đề sách">
          <button type="submit" id="update-book-btn">Cập nhật</button>
          <button type="button" onclick="cancelEdit()">Hủy</button>
      </form>
    </div>
  </div>

  <script src="{{ asset('javascript/QLS.js') }}"></script>
</body>
</html>