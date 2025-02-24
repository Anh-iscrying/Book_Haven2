<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'tbl_slider';
    protected $primaryKey = 'slider_id';  // Hoặc cột khóa chính khác nếu có
    public $timestamps = false;
    protected $fillable = ['slider_image', 'slider_active'];
}