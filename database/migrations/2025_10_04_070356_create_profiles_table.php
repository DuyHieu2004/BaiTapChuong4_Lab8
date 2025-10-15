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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            // 🔑 Khóa ngoại: Liên kết với bảng 'users'.
            // 'unique()' đảm bảo mỗi User chỉ có 1 Profile (Quan hệ One-to-One)
            $table->foreignId('user_id')
                  ->unique()
                  ->constrained() // Mặc định liên kết đến id của bảng 'users'
                  ->onDelete('cascade'); // Xóa User thì Profile cũng bị xóa

            $table->string('address')->nullable();
            $table->string('phone', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
