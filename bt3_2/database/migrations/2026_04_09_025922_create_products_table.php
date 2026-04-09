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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Tên sản phẩm
        $table->decimal('price', 15, 2); // Giá
        $table->integer('quantity'); // Số lượng
        $table->string('image')->nullable(); // Ảnh (cho phép null nếu chưa có)
        
        // Khóa ngoại liên kết với bảng categories
        $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
