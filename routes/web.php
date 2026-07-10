<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;

Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::resource('categories', CategoryController::class);

    Route::post('/tasks/{task}/complete', fn() => '準備中')->name('tasks.complete');
    Route::get('/tasks/finished', fn() => '準備中')->name('tasks.finished');
});


