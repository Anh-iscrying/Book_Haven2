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
            $table->string('book_author')->nullable()->after('book_title'); // Thêm cột book_author
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_book', function (Blueprint $table) {
            $table->dropColumn('book_author'); // Xóa cột book_author
        });
    }
};