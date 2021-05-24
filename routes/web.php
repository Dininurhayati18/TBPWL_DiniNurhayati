<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LbmasukController;
use App\Http\Controllers\LbkeluarController;
use App\Models\Transaksi;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/main', function () {
    return view('main');
});

Auth::routes();

Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home')->middleware('is_admin');


Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// pengelolaan Brand
Route::get('/brand', [App\Http\Controllers\BrandController::class, 'index'])->name('brand');
Route::get('/ajax/dataBrand/{id}', [App\Http\Controllers\BrandController::class, 'getDataBrand']);
Route::post('/brand', [App\Http\Controllers\BrandController::class, 'submit_brand'])->name('brand.submit');
Route::patch('/brand/update', [App\Http\Controllers\BrandController::class, 'update_brand'])->name('brand.update');
Route::delete('/brand/delete', [App\Http\Controllers\BrandController::class, 'delete_brand'])->name('brand.delete');

// pengelolaan Category
Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('category');
Route::get('/ajax/dataCategory/{id}', [App\Http\Controllers\CategoryController::class, 'getDataCategory']);
Route::post('/category', [App\Http\Controllers\CategoryController::class, 'submit_category'])->name('category.submit');
Route::patch('/category/update', [App\Http\Controllers\CategoryController::class, 'update_category'])->name('category.update');
Route::delete('/category/delete', [App\Http\Controllers\CategoryController::class, 'delete_category'])->name('category.delete');

// pengelolaan Product
Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product');
Route::get('/ajax/dataProduct/{id}', [App\Http\Controllers\ProductController::class, 'getDataProduct']);
Route::post('/product', [App\Http\Controllers\ProductController::class, 'submit_product'])->name('product.submit');
Route::patch('/product/update', [App\Http\Controllers\ProductController::class, 'update_product'])->name('product.update');
Route::delete('/product/delete', [App\Http\Controllers\ProductController::class, 'delete_product'])->name('product.delete');

// Route::get('/admin/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home')->middleware('is_admin');

Route::middleware('is_admin')->prefix('admin')->group(function () {
    Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');
});

// Barang Masuk
Route::get('/barang_masuk', [App\Http\Controllers\LbmasukController::class, 'index'])->name('barang_masuk');
Route::get('/ajax/dataBMasuk/{id}', [App\Http\Controllers\LbmasukController::class, 'getDataBMasuk']);
Route::post('/barang_masuk', [App\Http\Controllers\LbmasukController::class, 'tambah_bmasuk'])->name('barang_masuk.submit');
Route::patch('/barang_masuk/update', [App\Http\Controllers\LbmasukController::class, 'update_bmasuk'])->name('barang_masuk.update');
Route::delete('/barang_masuk/delete', [App\Http\Controllers\LbmasukController::class, 'delete_bmasuk'])->name('barang_masuk.delete');

// Barang Keluar
Route::get('/barang_keluar', [App\Http\Controllers\LbkeluarController::class, 'index'])->name('barang_keluar');
Route::get('/ajax/dataBKeluar/{id}', [App\Http\Controllers\LbkeluarController::class, 'getDataBKeluar']);
Route::post('/barang_keluar', [App\Http\Controllers\LbkeluarController::class, 'tambah_bkeluar'])->name('barang_keluar.submit');
Route::patch('/barang_keluar/update', [App\Http\Controllers\LbkeluarController::class, 'update_bkeluar'])->name('barang_keluar.update');
Route::delete('/barang_keluar/delete', [App\Http\Controllers\LbkeluarController::class, 'delete_bkeluar'])->name('barang_keluar.delete');

//user
Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::get('/ajax/dataUser/{id}', [App\Http\Controllers\UserController::class, 'getDataUser']);
Route::post('/user', [App\Http\Controllers\UserController::class, 'submit_user'])->name('user.submit');
Route::patch('/user/update', [App\Http\Controllers\UserController::class, 'update_user'])->name('user.update');
Route::delete('/user/delete', [App\Http\Controllers\UserController::class, 'delete_user'])->name('user.delete');

//print pdf barang masuk
Route::get('laporan_bmasuk/print_produk', [ProductController::class, 'print_produk'])
    ->name('print.produk')
    ->middleware('is_admin');


Route::get('print_produk', [TransaksiController::class, 'print_produk'])
    ->name('print.produk')
    ->middleware('is_admin');

Route::get('print_bkeluar', [LbkeluarController::class, 'print_bkeluar'])
    ->name('print.barang_keluar')
    ->middleware('is_admin');
Route::get('print_bmasuk', [LbmasukController::class, 'print_bmasuk'])
    ->name('print.barang_masuk')
    ->middleware('is_admin');

    

//route transaksi
Route::get('transaksi', [TransaksiController::class, 'index'])
    ->name('transaksi')
    ->middleware('is_admin');
Route::post('transaksi',[TransaksiController::class, 'submit_transaction'])
    ->name('transaksi.submit')
    ->middleware('is_admin');
Route::patch('transaksi/update',[TransaksiController::class, 'update_transaction'])
    ->name('transaksi.update')
    ->middleware('is_admin');
Route::get('ajax/dataTransaksi/{id}',[TransaksiController::class, 'getDataTransaksi']);
Route::delete('transaksi/delete', [TransaksiController::class, 'delete_transaction'])
    ->name('transaksi.delete')
    ->middleware('is_admin');
    