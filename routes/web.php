<?php
require __DIR__.'/auth.php';

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Market');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes CLIENT 
Route::middleware(['auth', 'role:client'])->prefix('client')->name('client.')->group(function () {

<<<<<<< HEAD

=======
>>>>>>> 64df08008bd3a7edb75b809c6d6e2d7438c89b5e
});

// Routes SELLER 
Route::middleware(['auth', 'role:seller'])->prefix('seller')->name('seller.')->group(function () {
<<<<<<< HEAD
   
=======

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    
>>>>>>> 64df08008bd3a7edb75b809c6d6e2d7438c89b5e
});

// Routes ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
  
    
});

// Routes MODERATOR 
Route::middleware(['auth', 'role:moderator'])->prefix('moderator')->name('moderator.')->group(function () {
    
<<<<<<< HEAD
    
=======

>>>>>>> 64df08008bd3a7edb75b809c6d6e2d7438c89b5e
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});