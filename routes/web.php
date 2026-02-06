<?php
require __DIR__ . '/auth.php';

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if (!auth()->check()) {
        return redirect()->route('login');
    }

    $user = auth()->user();

    if ($user->hasRole('client')) {
        return redirect()->route('client.dashboard');
    }

    return redirect()->route('admin.dashboard');
});

// Routes CLIENT 
Route::middleware(['auth', 'role:client'])->prefix('client')->name('client.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/categorie/{id}', [DashboardController::class, 'CategorieProducts'])->name('categorieProducts');
    Route::get('/product/{id}', [DashboardController::class, 'productDetails']);


    // click dyal add to cart
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    /// affichage dyal cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    ///bach nmas7o product mn cart
    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    ///nzido l quantity wast l cart
    Route::post('/cart/increase/{product}', [CartController::class, 'increase'])->name('cart.increase');
    ///na9so l quantity wast l cart                                                                             
    Route::post('/cart/decrease/{product}', [CartController::class, 'decrease'])->name('cart.decrease');
    ///clear cart 
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');


    // Products by category
});

// Routes SELLER 
Route::middleware(['auth', 'role:seller'])->prefix('seller')->name('seller.')->group(function () {

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

// Routes ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Categories CRUD 
    Route::get('/categories/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{category}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('categories.destroy');

    // users role 
    Route::get('/users', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('usres.role');
    Route::post('update/roles/{id}', [App\Http\Controllers\Admin\RoleController::class, 'updateRole'])->name('roles.update');
});

// Routes MODERATOR 
Route::middleware(['auth', 'role:moderator'])->prefix('moderator')->name('moderator.')->group(function () {});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin|seller|moderator'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    });
