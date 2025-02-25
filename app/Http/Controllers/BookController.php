<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function create()
    {
        return view('tao_san_pham');
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_title' => 'required|string|max:255',
            'book_description' => 'nullable|string',
            'book_author' => 'nullable|string|max:255',
            'book_publisher' => 'nullable|string|max:255',
            'book_size' => 'nullable|string|max:255',
            'book_original_price' => 'required|numeric|min:0',
            'book_discount' => 'required|integer|min:0|max:100',
            'book_category' => 'nullable|string|max:255',
            'book_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image, set nullable
        ]);

        $data = $request->except('book_image');

        $imageName = null;
        if ($request->hasFile('book_image')) {
            try {
                $image = $request->file('book_image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName); // Lưu trữ hình ảnh vào thư mục public/images
            } catch (\Exception $e) {
                // Ghi log lỗi
                Log::error('Lỗi lưu file ảnh: ' . $e->getMessage());
                // Hiển thị thông báo lỗi cho người dùng
                return back()->with('error', 'Có lỗi xảy ra khi lưu file ảnh. Vui lòng thử lại.');
            }
            $data['book_image'] = $imageName;
        }

        $book = Book::create($data);

        return redirect()->route('quanly.sach')->with('success', 'Sách đã được tạo thành công!');
    }
}