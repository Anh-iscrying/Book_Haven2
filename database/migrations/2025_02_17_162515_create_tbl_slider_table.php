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
        Schema::create('tbl_slider', function (Blueprint $table) {
            $table->id('slider_id'); // Hoặc $table->increments('slider_id');
            $table->string('slider_image');
            $table->boolean('slider_active')->default(1); // Ví dụ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_slider');
    }
};