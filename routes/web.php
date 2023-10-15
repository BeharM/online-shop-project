<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/view-orders', [HomeController::class, 'orders'])->name('orders');
Route::post('/add-to-card/{id}', [ProductController::class, 'addToCart'])->name('products.addToCart');
Route::put('/update-cart', [ProductController::class, 'update'])->name('cart.update');
Route::delete('/remove/{id}', [ProductController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegistrationController::class, 'create'])->name('register.create');
    Route::post('/register/store', [RegistrationController::class, 'store'])->name('register');
    Route::get('/login', [LoginController::class, 'create'])->name('login.create');
    Route::post('/login/store', [LoginController::class, 'login'])->name('login');
    Route::delete('/logout', [LoginController::class, 'destroy'])->name('logout');
});

Route::group(['middleware' => 'auth'], function () {
    Route::delete('/logout', [LoginController::class, 'destroy'])->name('logout');
});
