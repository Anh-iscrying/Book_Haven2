<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuanLySachController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GioHangController; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhanLoaiController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ThanhToanController;
use App\Http\Controllers\Auth\LogoutController;  // Hoặc controller chứa logic logout của bạn


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('trangchu');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Giới thiệu
Route::get('/gioi-thieu', [HomeController::class, 'showGioiThieu'])->name('gioithieu');

// Quản lý sách
//Route::get('/quan-ly-sach', [QuanLySachController::class, 'index'])->name('quanly.sach')->middleware('auth');
Route::get('/quan-ly-sach', [QuanLySachController::class, 'index'])->name('quanly.sach'); 

//Quản lý đơn hàng
//Route::get('/orders/manage', [OrderController::class, 'manage'])->name('orders.manage')->middleware('auth');
Route::get('/orders/manage', [OrderController::class, 'manage'])->name('orders.manage');

// Tạo sản phẩm
//Route::get('/tao-san-pham', [BookController::class, 'create'])->name('tao.sanpham')->middleware('auth');
//Route::post('/tao-san-pham', [BookController::class, 'store'])->name('books.store')->middleware('auth');
Route::get('/tao-san-pham', [BookController::class, 'create'])->name('tao.sanpham');
Route::post('/tao-san-pham', [BookController::class, 'store'])->name('books.store');

// Route cho giỏ hàng
Route::get('/gio-hang', [GioHangController::class, 'index'])->name('giohang');
Route::post('/gio-hang/update', [GioHangController::class, 'update'])->name('giohang.update');
Route::post('/gio-hang/remove', [GioHangController::class, 'remove'])->name('giohang.remove');
Route::post('/them-vao-gio', function () {
    // xử lý thêm vào giỏ hàng (route này có thể cần controller riêng)
})->name('them.giohang');
Route::post('/them-vao-gio', [CartController::class, 'addToCart'])->name('them.giohang');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

//Chi tiết sản phầm
Route::get('/chitiet-sanpham/{id}', [ProductController::class, 'show'])->name('chitiet.sanpham');

//Thanh toán

Route::get('/thanh-toan', [ThanhToanController::class, 'index'])->name('thanh.toan');
Route::post('/thanh-toan', [ThanhToanController::class, 'process'])->name('thanh.toan.process');