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
        Schema::create('tbl_category', function (Blueprint $table) {
            $table->id('category_id'); // Hoặc $table->increments('category_id'); nếu bạn dùng auto-incrementing integer
            $table->string('category_name');
            $table->text('category_description')->nullable();
            $table->timestamps(); // Thêm created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_category');
    }
};