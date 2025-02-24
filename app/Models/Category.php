<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'tbl_category';  // Đặt tên bảng
    protected $primaryKey = 'category_id'; // Đặt khóa chính (nếu khác 'id')
    public $timestamps = false;  // Tắt timestamps (nếu bảng không có created_at và updated_at)

    // Các thuộc tính có thể gán hàng loạt (mass assignable)
    protected $fillable = ['category_name'];
}