<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/roles', [RoleController::class, 'index'])->name('roles');
        Route::get('/role/{id}/show', [RoleController::class, 'show'])->name('role.show');
        Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
        Route::get('/role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
        Route::post('/role/{id}/update', [RoleController::class, 'update'])->name('role.update');
        Route::get('/role/{id}/delete', [RoleController::class, 'destroy'])->name('role.delete');