<?php
require __DIR__ . '/auth.php';

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewsController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Mail;

Route::get('/', function () {

    if (!auth()->check()) {
        return redirect()->route('login');
    }

    $user = auth()->user();

    if ($user->hasRole('client')) {
        return redirect()->route('client.dashboard');
    }

    return redirect()->route('admin.dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//mail
Route::get('/test-mail', function () {
    Mail::raw('Test Mailtrap', function ($message) {
        $message->to('test@test.com')
            ->subject('Test Email');
    });

    return 'Mail envoyé !';
});



// Routes CLIENT 
Route::middleware(['auth', 'role:client'])->prefix('client')->name('client.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::get('/product/{id}', [DashboardController::class, 'CategorieProducts'])->name('categorieProducts');
    Route::get('/product/infos/{id}', [DashboardController::class, 'productDetails']);
    Route::post('/product/create-Review/{id}', [ReviewsController::class, 'createReview']);
    // Add to panier
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
    ///checkout info
    Route::get('/checkout/info', [CheckoutController::class, 'info'])->name('checkout.info');
    ///store dyal form info 
    Route::post('/checkout/info', [CheckoutController::class, 'store'])->name('checkout.storeInfo');
    ///checkout confirm page
    Route::get('/checkout/confirm', [CheckoutController::class, 'confirm'])->name('checkout.confirm');
    ////place order post
    Route::post('/checkout/confirm', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');

    Route::get('/favorite', [FavoriteController::class, 'index'])->name('favorite');
    // routes/web.php
    Route::get('/checkout/thank-you/{order}', [CheckoutController::class, 'thankYou'])->name('checkout.thankyou')
        ->middleware(['auth']);



    // Products by category
});

// Routes SELLER 
Route::middleware(['auth', 'role:seller'])->prefix('seller')->name('seller.')->group(function () {

    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    
    ///order status
    Route::patch('/orders/{order}/ship', [OrderController::class, 'ship'])->name('orders.ship');
    Route::patch('/orders/{order}/deliver', [OrderController::class, 'deliver'])->name('orders.deliver');
    Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
});

// Routes ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Categories CRUD 
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('categories.destroy');

    // users role 
    Route::get('/users', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('usres.role');
    Route::post('update/roles/{id}', [App\Http\Controllers\Admin\RoleController::class, 'updateRole'])->name('roles.update');
});

// Routes MODERATOR 
Route::middleware(['auth', 'role:moderator'])->prefix('moderator')->name('moderator.')->group(function () {});



Route::middleware(['auth', 'role:admin|seller|moderator'])->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/products', [ProductController::class, 'index'])->name('seller.products.index');
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    });
