<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');
// Các route cũ giữ nguyên...
Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::post('/students/{id}/update', [StudentController::class, 'update'])->name('students.update');
Route::post('/students/{id}/delete', [StudentController::class, 'destroy'])->name('students.destroy');