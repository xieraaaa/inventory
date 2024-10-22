<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\KategoriController;
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


Route::prefix('kategori')->group(function () {
    Route::get('/index', [KategoriController::class, 'index'])->name('index');
    Route::get('/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/edit/{id}',[KategoriController::class,'edit']);
    Route::post('/update/{id}', [KategoriController::class, 'update']);
    Route::get('/delete/{id}',[KategoriController::class,'destroy']);
});

Route::prefix('unit')->group(function () {
    Route::get('/manage', [UnitController::class, 'index'])->name('manage');
    Route::get('/create', [UnitController::class, 'create'])->name('unit.create');
    Route::post('/store', [UnitController::class, 'store'])->name('unit.store');
    Route::get('/edit/{id}',[UnitController::class,'edit']);
    Route::post('/update/{id}', [UnitController::class, 'update']);
    Route::get('/delete/{id}',[UnitController::class,'destroy']);
});

Route::prefix('brand')->group(function () {
    Route::get('/manage', [BrandController::class, 'index'])->name('brand.manage');
    Route::get('/create', [BrandController::class, 'create'])->name('brand.create');
    Route::post('/store', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/edit/{id}',[BrandController::class,'edit']);
    Route::post('/update/{id}', [BrandController::class, 'update']);
    Route::get('/delete/{id}',[BrandController::class,'destroy']);
});

