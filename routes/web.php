<?php

use App\Http\Controllers\Website\AuthController;
use App\Http\Controllers\Website\HomepageController;
use App\Http\Controllers\Website\CategoryController;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\OrderController;
use App\Http\Controllers\Website\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomepageController::class);

Route::get('/category/{id}', [CategoryController::class, 'show']);

Route::get('/product/{id}', [ProductController::class, 'show']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'postRegister']);

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'postLogin']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/cart', [CartController::class, 'index']);
Route::post('/add-to-cart', [CartController::class, 'addToCart']);
Route::get('/remove-from-cart/{productId}', [CartController::class, 'removeFromCart']);
Route::post('/update-cart', [CartController::class, 'update']);

Route::get('/checkout', [OrderController::class, 'checkout']);
Route::post('/create-order', [OrderController::class, 'store']);
Route::get('/complete-order', [OrderController::class, 'completeOrder']);
