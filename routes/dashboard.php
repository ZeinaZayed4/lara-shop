<?php

use App\Http\Controllers\Dashboard\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.index');
});

Route::get('/login', function () {
    return view('dashboard.login');
})->name('login');

Route::get('/create', function (){

});

Route::resource('/categories', CategoryController::class);

//Route::get('/categories', [CategoryController::class, 'index']);
//
//Route::get('/categories/show', [CategoryController::class, 'show']);
//
//Route::get('/categories/create', [CategoryController::class, 'create']);
//
//Route::post('/categories/store/{id}', [CategoryController::class, 'store']);
//
//Route::get('/categories/edit/{id}', [CategoryController::class, 'edit']);
//
//Route::post('/categories/update/{id}', [CategoryController::class, 'update']);
//
//Route::post('/categories/destroy/{id}', [CategoryController::class, 'destroy']);
