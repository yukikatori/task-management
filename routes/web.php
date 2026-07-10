<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;

Route::middleware('auth')->group(function () {
    Route::get('/tasks/finished', [TaskController::class, 'finished'])->name('tasks.finished');
    Route::post('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
    Route::resource('tasks', TaskController::class);
    
    Route::resource('categories', CategoryController::class);
});


