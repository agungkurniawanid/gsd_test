<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('produk.index');
Route::post('/master-produk', [ProductController::class, 'store'])->name('produk.store');
Route::get('/master-produk/{product}', [ProductController::class, 'show'])->name('produk.show');
Route::delete('/master-produk/{product}', [ProductController::class, 'destroy'])->name('produk.destroy');
Route::get('/master-produk/filter', [ProductController::class, 'filter'])->name('produk.filter');
Route::get('/master-produk/{id}/edit', [ProductController::class, 'edit'])->name('produk.edit');
Route::put('/master-produk/{id}', [ProductController::class, 'update'])->name('produk.update');
