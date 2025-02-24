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
}