<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/tasks', [TaskController::class, 'index'])
    ->name('tasks.index');

Route::post('/tasks', [TaskController::class, 'store'])
    ->name('tasks.store');

Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])
    ->name('tasks.edit');

Route::put('/tasks/{task}', [TaskController::class, 'update'])
    ->name('tasks.update');

Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])
    ->name('tasks.destroy');

Route::patch('/tasks/{task}/complete', [TaskController::class, 'complete'])
    ->name('tasks.complete');

    Route::middleware('auth')->group(function () {

    Route::get('/profile', [
        ProfileController::class,
        'edit'
    ])->name('profile.edit');

    Route::patch('/profile', [
        ProfileController::class,
        'update'
    ])->name('profile.update');

    Route::delete('/profile', [
        ProfileController::class,
        'destroy'
    ])->name('profile.destroy');
    
    Route::middleware('auth')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');

    Route::post('/categories', [CategoryController::class, 'store'])
        ->name('categories.store');

    Route::put('/categories/{category}', [CategoryController::class, 'update'])
        ->name('categories.update');

    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
        ->name('categories.destroy');
});
});

require __DIR__.'/auth.php';