<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book; // Import model Book
use App\Models\Category; // Import model Category

class ProductController extends Controller
{
    public function show($id)
    {
        $book = Book::find($id); // Tìm sách theo ID
        $categories = Category::all(); // Lấy tất cả danh mục

        if (!$book) {
            abort(404); // Xử lý nếu không tìm thấy sách
        }

        $relatedBooks = Book::where('category_id', $book->category_id)
                           ->where('book_id', '!=', $book->book_id)
                           ->limit(4)
                           ->get();

        return view('chitiet-sanpham', compact('book', 'categories', 'relatedBooks'));
    }
}