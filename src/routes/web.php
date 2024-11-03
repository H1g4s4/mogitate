<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// 商品一覧
Route::get('/products', [ProductController::class, 'index'])->name('product.index');

// 商品詳細
Route::get('/products/{productId}', [ProductController::class, 'show'])->name('product.show');

// 商品更新
Route::get('/products/{productId}/update', [ProductController::class, 'edit'])->name('product.edit'); // 更新フォーム表示
Route::put('/products/{productId}/update', [ProductController::class, 'update'])->name('product.update'); // 更新実行

// 商品登録
Route::get('/products/register', [ProductController::class, 'create'])->name('product.create');
// 登録フォーム表示
Route::post('/products/register', [ProductController::class, 'store'])->name('product.store'); // 登録実行

// 検索
Route::get('/products/search', [ProductController::class, 'search'])->name('product.search');

// 削除
Route::delete('/products/{productId}/delete', [ProductController::class, 'destroy'])->name('product.delete');

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


