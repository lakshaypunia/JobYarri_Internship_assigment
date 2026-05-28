<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\BlogController;
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
                'blogsThisMonth'  => Blog::whereMonth('created_at', now()->month)
                                         ->whereYear('created_at', now()->year)->count(),
                'recentBlogs'     => Blog::with('category')->latest()->take(5)->get(),
            ]);
        })->name('dashboard');

        Route::resource('blogs', AdminBlogController::class)->except('show');
        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });
});

// Public routes
Route::get('/', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blog/{blog}', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/blogs/filter', [BlogController::class, 'filter'])->name('blogs.filter');
