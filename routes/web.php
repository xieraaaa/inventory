<?php

use App\Http\Controllers\Account;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\productController;
use App\Http\Controllers\UnitController;


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
    return view('auth.login');
});

Route::get('/dashboard', function () {
     return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

Route::middleware('admin')->group(function () {
Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth','admin'])->name('admin.dashboard');
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
Route::post('/brand/import', [BrandController::class, 'import'])->name('brand.import');

Route::get('product', [productController::class, 'index'])->name('product');
Route::post('store-product', [productController::class, 'store']);
Route::post('edit-product', [productController::class, 'edit']);
Route::post('delete-product', [productController::class, 'destroy']);

});