<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;

class PhanLoaiController extends Controller
{
    public function index(Request $request, $category_id)
    {
        $category = Category::findOrFail($category_id);
        $categories = Category::orderBy('category_id', 'DESC')->get();
        $books = Book::where('category_id', $category_id)->paginate(15);

        return view('phan_loai', compact('category', 'categories', 'books'));
    }
}