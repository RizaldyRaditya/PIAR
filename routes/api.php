<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('login', [LoginController::class, 'login']);

Route::middleware(['auth:sanctum', 'token.valid'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout']);
    Route::resource('product', ProductController::class);
    Route::resource('productCategory', ProductCategoryController::class);
    Route::resource('user', UserController::class);
});

Route::resource('order', OrderController::class);



// Route::controller(LoginController::class)->group(function (){
//     Route::post('login', 'login');
// });
