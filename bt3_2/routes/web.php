<?php

use Illuminate\Support\Facades\Route;
// Bắt buộc phải có dòng này để Laravel biết ProductController nằm ở đâu
use App\Http\Controllers\ProductController; 

Route::get('/', function () {
    return view('welcome');
});

// Route cho phần bài tập
Route::resource('products', ProductController::class);