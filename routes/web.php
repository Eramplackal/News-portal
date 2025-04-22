<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('welcome');
})->name('admin.home');


Route::get('/', [CommonController::class, 'index'])->name('home');
Route::post('/store-comment', [CommonController::class, 'storeComment'])->name('comment.store');

Route::get('/category', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/category/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/category/store', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/category/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
Route::get('/category/{id}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
Route::post('/news/store', [NewsController::class, 'store'])->name('news.store');
Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
Route::post('/news/{id}/update', [NewsController::class, 'update'])->name('news.update');
Route::get('/news/{id}/destroy', [NewsController::class, 'destroy'])->name('news.destroy');

Route::get('/comments', [CommentsController::class, 'index'])->name('comments.index');
