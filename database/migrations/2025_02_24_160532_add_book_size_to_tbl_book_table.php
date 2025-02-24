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
            $table->string('book_size')->nullable()->after('book_publisher'); // Thêm cột book_size
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_book', function (Blueprint $table) {
            $table->dropColumn('book_size'); // Xóa cột book_size
        });
    }
};