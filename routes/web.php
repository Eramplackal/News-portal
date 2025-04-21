<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/category', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/category/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/category/store', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/category/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
Route::post('/category/{id}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/comments', [CommentsController::class, 'index'])->name('comments.index');
//         Route::get('/role/{id}/show', [RoleController::class, 'show'])->name('role.show');
//         Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
//         Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
//         Route::get('/role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
//         Route::post('/role/{id}/update', [RoleController::class, 'update'])->name('role.update');
//         Route::get('/role/{id}/delete', [RoleController::class, 'destroy'])->name('role.delete');