<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Khai báo các trường được phép thêm/sửa nhanh
    protected $fillable = [
        'name', 
        'price', 
        'quantity', 
        'category_id', 
        'image'
    ];

    // Product thuộc về 1 Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}