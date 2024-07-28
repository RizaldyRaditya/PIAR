<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\product;
use App\Http\Controllers\productCategory;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\QRController;

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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/generate-qrcode', [QRController::class, 'generate'])->name('generate.qrcode');
Route::get('/authenticate', [QRController::class, 'authenticate'])->name('authenticate');
Route::post('/generate-token', [QRController::class, 'generateToken'])->name('generate.token');
Route::get('/order-page', [QRController::class, 'order'])->name('order.page');

// Route::resource('product', ProductController::class);
// Route::resource('productCategory', ProductCategoryController::class);
