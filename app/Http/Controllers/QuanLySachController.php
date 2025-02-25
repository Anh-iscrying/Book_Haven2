<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;  // Thêm dòng này

class QuanLySachController extends Controller
{
    public function index(Request $request)
    {
        // Kiểm tra quyền admin
        if (!Auth::check() || Auth::user()->is_admin != 1) {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        $search_keyword = $request->input('search');

        $query = Book::query();

        if (!empty($search_keyword)) {
            $query->where('book_title', 'LIKE', '%' . $search_keyword . '%');
        }

        $books = $query->get();

        return view('quan_ly_sach', compact('books'));
    }

    // QuanLySachController.php

// Hiển thị form chỉnh sửa
public function edit($id)
{
    // Kiểm tra quyền admin (tương tự như trong index())
    if (!Auth::check() || Auth::user()->is_admin != 1) {
        abort(403, 'Bạn không có quyền truy cập trang này.');
    }

    $book = Book::findOrFail($id); // Tìm sách theo ID, nếu không thấy trả về lỗi 404

    return view('edit_sach', compact('book')); // Tạo view 'edit_sach.blade.php' để hiển thị form
}

// Cập nhật thông tin sách
public function update(Request $request, $id)
{
    // Kiểm tra quyền admin (tương tự như trong index())
    if (!Auth::check() || Auth::user()->is_admin != 1) {
        abort(403, 'Bạn không có quyền truy cập trang này.');
    }

    $request->validate([ // Validate dữ liệu
        'book_title' => 'required|string|max:255',
        // Thêm các rule validate khác tùy theo các trường bạn muốn cho phép chỉnh sửa
    ]);

    $book = Book::findOrFail($id);

    $book->update($request->all()); // Cập nhật thông tin sách

    return redirect()->route('quanly.sach')->with('success', 'Sách đã được cập nhật thành công!');
}


// Xóa sách
public function destroy($id)
{
    // Kiểm tra quyền admin (tương tự như trong index())
    if (!Auth::check() || Auth::user()->is_admin != 1) {
        abort(403, 'Bạn không có quyền truy cập trang này.');
    }

    $book = Book::findOrFail($id); // Tìm sách theo ID
    $book->delete(); // Xóa sách

    return redirect()->route('quanly.sach')->with('success', 'Sách đã được xóa thành công!');
}
}