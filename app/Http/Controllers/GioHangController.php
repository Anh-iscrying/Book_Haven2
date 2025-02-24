<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GioHangController extends Controller
{
    public function index()
    {
        return view('gio_hang');
    }

    public function update(Request $request)
    {
        $book_id = $request->input('book_id');
        $quantity = $request->input('quantity');

        $cart = session('cart', []);

        if ($quantity <= 0) {
            unset($cart[$book_id]);
        } else {
            if (isset($cart[$book_id])) {
                $cart[$book_id]['quantity'] = $quantity;
            }
        }

        session(['cart' => $cart]);

        return response()->json(['success' => true]);
    }

    public function remove(Request $request)
    {
        $book_id = $request->input('book_id');

        $cart = session('cart', []);

        unset($cart[$book_id]);

        session(['cart' => $cart]);

        return response()->json(['success' => true]);
    }
}