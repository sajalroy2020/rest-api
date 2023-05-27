<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ProductController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// user protected route
Route::group(['middleware'=>'auth:sanctum'], function() {
    Route::get('product', [ProductController::class, 'product'])->name('product');
    Route::post('product-store', [ProductController::class, 'productStore'])->name('product_store');
    Route::get('product-edit/{id}', [ProductController::class, 'productEdit'])->name('product_edit');
    Route::post('product-update/{id}', [ProductController::class, 'productUpdate'])->name('product_update');
    Route::get('product-delete/{id}', [ProductController::class, 'productDelete'])->name('product_delete');
});

