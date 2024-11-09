<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class,'productsPage'])->name('products');




Route::get('products',[ProductController::class,'productsPage'])->name('products');

Route::get('products/create',[ProductController::class,'createProductPage'])->name('create-product');

Route::get('product/view/{id}',[ProductController::class,'viewProduct'])->name('view-product');

Route::get('product/edit/{id}',[ProductController::class,'editProductPage'])->name('edit-product');




Route::post('product.store',[ProductController::class,'createProduct'])->name('product.store');

Route::put('update-product/{id}',[ProductController::class,'updateProduct'])->name('update-product');

Route::get('delete/{id}',[ProductController::class,'deleteProduct'])->name('delete-product');
