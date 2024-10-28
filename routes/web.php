<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\productController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
// Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
// Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
// Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
// Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
// Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

Route::get('kategori', [KategoriController::class, 'index'])->name('kategori');
Route::post('store-kategori', [KategoriController::class, 'store']);
Route::post('edit-kategori', [KategoriController::class, 'edit']);
Route::post('delete-kategori', [KategoriController::class, 'destroy']);

Route::get('unit', [UnitController::class, 'index'])->name('unit');
Route::post('store-unit', [UnitController::class, 'store']);
Route::post('edit-unit', [UnitController::class, 'edit']);
Route::post('delete-unit', [UnitController::class, 'destroy']);

Route::get('brand', [BrandController::class, 'index'])->name('brand');
Route::post('store-brand', [BrandController::class, 'store']);
Route::post('edit-brand', [BrandController::class, 'edit']);
Route::post('delete-brand', [BrandController::class, 'destroy']);

Route::get('product', [productController::class, 'index'])->name('product');
Route::post('store-product', [productController::class, 'store']);
Route::post('edit-product', [productController::class, 'edit']);
Route::post('delete-product', [productController::class, 'destroy']);







Route::get('/', [Dashboard::class, 'index'])->name('dashboard.index');