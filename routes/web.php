<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/google/login', [AuthController::class, 'google_login'])->name('google.login');
Route::get('/google/callback', [AuthController::class, 'google_callback'])->name('google.callback');

Route::get("/", [PageController::class, "home"])->name('home');
Route::get("/product/{id}", [PageController::class, "product"])->name('product');

Route::get("/compare", [PageController::class, "compare"])->name('compare');
Route::post("/shop-request", [PageController::class, "shop_request"])->name('shop_request');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get("/carts", [AuthController::class, "carts"])->name('carts');
    Route::post("/cart-store", [AuthController::class, "cart_store"])->name('cart.store');

    Route::post('/cart/update/{id}', [AuthController::class, 'update_cart'])->name('cart.update');
Route::delete('/cart/remove/{id}', [AuthController::class, 'remove_cart'])->name('cart.remove');
});

require __DIR__ . '/auth.php';
