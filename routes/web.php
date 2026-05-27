<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

// Admin auth routes (no middleware)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.dashboard'));
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('admin')->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard', [
                'totalBlogs'      => Blog::count(),
                'totalCategories' => Category::count(),
                'recentBlogs'     => Blog::with('category')->latest()->take(5)->get(),
            ]);
        })->name('dashboard');

        Route::resource('blogs', BlogController::class)->except('show');
        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });
});

// Public routes (added in Phase 5)
Route::get('/', fn () => view('welcome'));
