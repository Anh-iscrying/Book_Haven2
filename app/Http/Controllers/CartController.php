<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book; // Import model Book

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $book_id = $request->input('book_id');
        $book = Book::find($book_id);

        if (!$book) {
            return redirect()->back()->with('error', 'Không tìm thấy sản phẩm.');
        }

        $quantity = 1; // Số lượng mặc định

        $cart = session()->get('cart', []);

        if (isset($cart[$book_id])) {
            $cart[$book_id]['quantity']++;
        } else {
            $cart[$book_id] = [
                "title" => $book->book_title,
                "image" => $book->book_image,
                "price" => $book->book_original_price,
                "quantity" => $quantity
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }
}