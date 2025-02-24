<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Lấy danh mục
        $categories = Category::orderBy('category_id', 'DESC')->get();

        // Lấy slider
        $sliderImages = Slider::where('slider_active', 1)->pluck('slider_image')->toArray();

        // Tìm kiếm
        $search_keyword = $request->input('search');

        $books_per_page = 12;

        // Truy vấn
        $query = Book::query();

        if (!empty($search_keyword)) {
            $query->where('book_title', 'LIKE', "%" . $search_keyword . "%");
        }

        // Phân trang
        $books = $query->paginate($books_per_page);

        return view('index', compact('categories', 'sliderImages', 'books', 'search_keyword'));
    }

    public function dashboard()
    {
        return view('dashboard'); // Tạo view 'dashboard.blade.php'
    }

    public function showGioiThieu()
    {
        $categories = Category::orderBy('category_id', 'DESC')->get();
        return view('gioithieu', compact('categories')); // Tạo view 'gioithieu.blade.php'
    }

    // XÓA HOẶC COMMENT PHƯƠNG THỨC NÀY:
    /*
     public function showChiTietSanPham($book_id)
    {
        $book = Book::find($book_id);
         $categories = Category::orderBy('category_id', 'DESC')->get(); //Lấy categories
        return view('chitiet-sanpham', compact('book','categories')); //Truyền categories
    }
    */
}