<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_book', function (Blueprint $table) {
            $table->id('book_id');
            $table->string('book_title');
            $table->string('book_image')->nullable(); // Ví dụ
            $table->text('book_description')->nullable();
            $table->decimal('book_original_price', 10, 2); // Ví dụ
            $table->integer('book_discount')->default(0); // Ví dụ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_book');
    }
};