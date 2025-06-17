<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');


Route::get('/', [ProductController::class, 'home'])->name('home');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/products/create', [AdminController::class, 'create'])->name('admin.products.create');    // Форма создания
    Route::post('/admin/products', [AdminController::class, 'store'])->name('admin.products.store');              // Сохранение нового товара
    Route::get('/admin/products', [AdminController::class, 'index'])->name('admin.products.index');              // Список товаров
    Route::get('/admin/products/{product}/edit', [AdminController::class, 'edit'])->name('admin.products.edit'); // Форма редактирования
    Route::put('/admin/products/{product}', [AdminController::class, 'update'])->name('admin.products.update');  // Обновление товара
    Route::delete('/admin/products/{product}', [AdminController::class, 'destroy'])->name('admin.products.destroy'); // Удаление товара
});

Route::post('/search', [SearchController::class, 'search'])->name('search.perform');
Route::get('/search-history', [SearchController::class, 'history'])->name('search.history');

Route::middleware('auth')->group(function () {
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');
    Route::get('/order/payment/{order}', [OrderController::class, 'paymentForm'])->name('order.payment.form');
    Route::post('/order/payment/{order}', [OrderController::class, 'processPayment'])->name('order.payment.process');
    Route::get('/order/success/{order}', [OrderController::class, 'success'])->name('order.success');
});




