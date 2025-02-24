<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'tbl_book';
    protected $primaryKey = 'book_id';
    public $timestamps = false;
    protected $fillable = [
        'book_title',
        'book_image',
        'book_description',
        'book_original_price',
        'book_discount',
        'book_author',
        'book_publisher',
        'book_size',
         
    ];
}