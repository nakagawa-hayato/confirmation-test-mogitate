<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{productId}/', [ProductController::class, 'show'])->name('products.detail');
Route::put('/products/{productId}/update', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{productId}/delete', [ProductController::class, 'destroy'])->name('products.delete');
Route::post('/products/register', [ProductController::class, 'showRegisterForm'])->name('register.form');
Route::get('/products/register', [ProductController::class, 'showRegisterForm'])->name('register.redirect');
Route::post('/products', [ProductController::class, 'register'])->name('register');

