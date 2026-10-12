
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home page
Route::get('/', function () {
    return view('welcome');
});

// Authenticated user routes
Route::middleware('auth')->group(function () {

    // Dashboard redirects to the task management dashboard
    Route::get('/dashboard', function () {
        return redirect()->route('tasks.index');
    })->name('dashboard');

    // Task management routes
    Route::resource('tasks', TaskController::class);

    // Category management routes
    Route::resource('categories', CategoryController::class);

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// Authentication routes (Login, Register, Logout, etc.)
require __DIR__.'/auth.php';
