<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGalleryController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', [DashboardController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::redirect('/', '/dashboard');
        Route::get('/products/{id}/gallery', [ProductController::class, 'gallery'])
            ->name('products.gallery');
        Route::resource('products', ProductController::class);
        Route::resource('product-galleries', ProductGalleryController::class);

        Route::get('/transactions/{id}/set-status', [TransactionController::class, 'setStatus'])
            ->name('transactions.status');
        Route::resource('transactions', TransactionController::class);
    });
