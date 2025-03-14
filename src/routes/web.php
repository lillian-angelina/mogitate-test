<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index'); // 商品一覧
    Route::get('/register', [ProductController::class, 'create'])->name('products.create'); // 商品登録
    Route::post('/register', [ProductController::class, 'store'])->name('products.store'); // 商品登録処理
    Route::get('/search', [ProductController::class, 'search'])->name('products.search'); // 検索
    Route::get('/{productId}', [ProductController::class, 'show'])->name('products.show'); // 商品詳細
    Route::get('/{productId}/update', [ProductController::class, 'edit'])->name('products.edit'); // 商品更新
    Route::put('/{productId}/update', [ProductController::class, 'update'])->name('products.update'); // 商品更新処理
    Route::delete('/{productId}/delete', [ProductController::class, 'destroy'])->name('products.destroy'); // 商品削除
});

// ルートの変更
Route::get('/', [ProductController::class, 'index']); // 商品一覧ページにリダイレクト