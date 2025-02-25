<?php

use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/", [PageController::class, "home"])->name('home');
Route::post("/shop-request", [PageController::class, "shop_request"])->name('shop_request');
