<?php

use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/", [PageController::class, "home"])->name('home');
Route::get("/product/{id}", [PageController::class, "product"])->name('product');

Route::get("/compare", [PageController::class, "compare"])->name('compare');
Route::post("/shop-request", [PageController::class, "shop_request"])->name('shop_request');
