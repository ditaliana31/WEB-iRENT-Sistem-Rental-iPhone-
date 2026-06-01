<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| ADMIN CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SalesController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', [ProductController::class, 'home'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| PRODUCT
|--------------------------------------------------------------------------
*/

Route::get('/katalog', [ProductController::class, 'index'])
    ->name('katalog');

Route::get('/detail/{id}', [ProductController::class, 'show'])
    ->name('detail');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'login'])
        ->name('login');

    Route::post('/login/process', [AuthController::class, 'loginProcess'])
        ->name('login.process');

    Route::get('/register', [AuthController::class, 'register'])
        ->name('register');

    Route::post('/register/process', [AuthController::class, 'registerProcess'])
        ->name('register.process');
});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | CART / KERANJANG
    |--------------------------------------------------------------------------
    */

    Route::get('/keranjang', [CartController::class, 'index'])
        ->name('keranjang');

    Route::post('/keranjang/store/{id}', [CartController::class, 'store'])
        ->name('keranjang.store');

    Route::put('/keranjang/update/{id}', [CartController::class, 'update'])
        ->name('keranjang.update');

    Route::delete('/keranjang/delete/{id}', [CartController::class, 'delete'])
        ->name('keranjang.delete');

    /*
    |--------------------------------------------------------------------------
    | PAYMENT
    |--------------------------------------------------------------------------
    */

    Route::get('/pembayaran', [PaymentController::class, 'index'])
        ->name('pembayaran');

    Route::post('/pembayaran/store', [PaymentController::class, 'store'])
        ->name('pembayaran.store');

    /*
    |--------------------------------------------------------------------------
    | INVOICE
    |--------------------------------------------------------------------------
    */

    Route::get('/invoice/{id}', [PaymentController::class, 'invoice'])
        ->name('invoice');

    /*
    |--------------------------------------------------------------------------
    | USER DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

    /*
    |--------------------------------------------------------------------------
    | PAYMENT STATUS & REVIEW
    |--------------------------------------------------------------------------
    */

    Route::post('/payment/{id}/status', [PaymentController::class, 'updateStatus'])
        ->name('payment.updateStatus');

    Route::post('/payment/{id}/rating', [PaymentController::class, 'storeRating'])
        ->name('payment.storeRating');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | SALES
        |--------------------------------------------------------------------------
        */

        Route::get('/sales', [SalesController::class, 'index'])
            ->name('sales.index');

        /*
        |--------------------------------------------------------------------------
        | PAYMENTS
        |--------------------------------------------------------------------------
        */

        Route::get('/payments', [AdminPaymentController::class, 'index'])
            ->name('payments');

        Route::post('/payments/{id}/update-status', [AdminPaymentController::class, 'updateStatus'])
            ->name('payments.updateStatus');

        /*
        |--------------------------------------------------------------------------
        | USERS
        |--------------------------------------------------------------------------
        */

        Route::get('/users', [AdminUserController::class, 'index'])
            ->name('users');

        /*
        |--------------------------------------------------------------------------
        | PRODUCTS CRUD
        |--------------------------------------------------------------------------
        */

        Route::resource('products', AdminProductController::class);
    });
