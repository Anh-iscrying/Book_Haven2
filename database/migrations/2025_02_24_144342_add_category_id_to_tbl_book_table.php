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
        Schema::table('tbl_book', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('book_id'); // Thêm cột category_id
            // $table->foreign('category_id')->references('category_id')->on('tbl_category'); // (Tùy chọn) Tạo foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_book', function (Blueprint $table) {
            $table->dropForeign(['category_id']); // (Tùy chọn) Xóa foreign key
            $table->dropColumn('category_id'); // Xóa cột category_id
        });
    }
};