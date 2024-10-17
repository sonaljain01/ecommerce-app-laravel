<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;


Route::group(['prefix' => 'admin'], function () {
    Route::get('register', [AdminAuthController::class, 'showRegiterForm'])->name('admin.register');
    Route::post('register', [AdminAuthController::class, 'register']);

    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login']);

    Route::middleware('auth')->group(function () {
        
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    });
});
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class)->only(['create', 'store']);
    Route::resource('categories', CategoryController::class)->only(['create', 'store']); 
    Route::resource('products', ProductController::class);
});
Route::get('admin/dashboard', [ProductController::class, 'index'])->name('admin.dashboard');
Route::get('admin/products/{product}', [ProductController::class, 'show'])->name('admin.products.show');