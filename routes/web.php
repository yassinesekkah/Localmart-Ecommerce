<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModeratorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Market');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes CLIENT 
Route::middleware(['auth', 'role:client'])->prefix('client')->name('client.')->group(function () {

    Route::get('/catalog', [ClientController::class, 'catalog'])->name('catalog');
    
    Route::get('/product/{slug}', [ClientController::class, 'showProduct'])->name('product.show');
    
    Route::post('/cart/add', [ClientController::class, 'addToCart'])->name('cart.add');
    
    Route::get('/cart', [ClientController::class, 'cart'])->name('cart');
    Route::delete('/cart/{item}', [ClientController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/order', [ClientController::class, 'createOrder'])->name('order.create');
    Route::get('/orders', [ClientController::class, 'orders'])->name('orders');
    Route::get('/orders/{order}', [ClientController::class, 'showOrder'])->name('order.show');
    Route::post('/product/{product}/like', [ClientController::class, 'likeProduct'])->name('product.like');
    Route::post('/product/{product}/review', [ClientController::class, 'reviewProduct'])->name('product.review');
});

// Routes SELLER 
Route::middleware(['auth', 'role:seller'])->prefix('seller')->name('seller.')->group(function () {
   
    Route::get('/dashboard', [SellerController::class, 'dashboard'])->name('dashboard');
   
    
    Route::get('/products', [SellerController::class, 'products'])->name('products');
   
    Route::get('/products/create', [SellerController::class, 'createProduct'])->name('product.create');
   
    Route::post('/products', [SellerController::class, 'storeProduct'])->name('product.store');
   
    Route::get('/products/{product}/edit', [SellerController::class, 'editProduct'])->name('product.edit');
   
    Route::put('/products/{product}', [SellerController::class, 'updateProduct'])->name('product.update');
   
    Route::delete('/products/{product}', [SellerController::class, 'deleteProduct'])->name('product.delete');
    Route::get('/orders', [SellerController::class, 'orders'])->name('orders');
    Route::put('/orders/{order}/status', [SellerController::class, 'updateOrderStatus'])->name('order.update-status');
});

// Routes ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
  
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
   
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('user.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('user.update');
    Route::post('/users/{user}/role', [AdminController::class, 'assignRole'])->name('user.assign-role');
   
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/statistics', [AdminController::class, 'statistics'])->name('statistics');
});

// Routes MODERATOR 
Route::middleware(['auth', 'role:moderator'])->prefix('moderator')->name('moderator.')->group(function () {
    
    
    Route::get('/dashboard', [ModeratorController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/reviews', [ModeratorController::class, 'reviews'])->name('reviews');
    
    
    Route::delete('/reviews/{review}', [ModeratorController::class, 'deleteReview'])->name('review.delete');
    
    Route::put('/reviews/{review}/approve', [ModeratorController::class, 'approveReview'])->name('review.approve');
    
    Route::post('/users/{user}/suspend', [ModeratorController::class, 'suspendUser'])->name('user.suspend');
    Route::post('/products/{product}/suspend', [ModeratorController::class, 'suspendProduct'])->name('product.suspend');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});