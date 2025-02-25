<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Book;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    // Số lượng sách hiển thị trên mỗi trang
    private $booksPerPage = 12;

    public function index(Request $request)
    {
        try {
            // Lấy danh mục
            $categories = Category::orderBy('category_id', 'DESC')->get();

            // Lấy slider
            $sliderImages = Slider::where('slider_active', 1)->pluck('slider_image')->toArray();

            // Tìm kiếm
            $searchKeyword = $request->input('search');

            // Truy vấn sách
            $query = Book::query();

            if (!empty($searchKeyword)) {
                $searchTerm = strtolower($searchKeyword);
                $query->where('book_title', 'LIKE', "%{$searchTerm}%");
            }

            // Phân trang
            $books = $query->paginate($this->booksPerPage);

            // Trả về view với dữ liệu
            return view('index', compact('categories', 'sliderImages', 'books', 'searchKeyword'));

        } catch (\Exception $e) {
            Log::error('Lỗi khi lấy dữ liệu trang chủ: ' . $e->getMessage());
            // Có thể chuyển hướng đến trang lỗi hoặc hiển thị thông báo thân thiện với người dùng
            abort(500, 'Đã xảy ra lỗi khi tải trang. Vui lòng thử lại sau.');
        }
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
}