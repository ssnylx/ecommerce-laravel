<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CarouselController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
// routes/web.php
Auth::routes();

Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');


Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
Route::get('/produk/{produk}', [ProdukController::class, 'show'])->name('produk.show');
Route::get('/produk/{produk}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
Route::put('/produk/{produk}', [ProdukController::class, 'update'])->name('produk.update');
Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');

use App\Http\Controllers\LandingPageController;

Route::get('/landing', [LandingPageController::class, 'index'])->name('landingpage.index');
Route::get('/landing/{id}', [LandingPageController::class, 'show'])->name('landingpage.show');
Route::post('/landing/search', [LandingPageController::class, 'search'])->name('landingpage.search');
Route::get('/landing/kategori/{kategori_id}', [LandingPageController::class, 'kategori'])->name('landingpage.kategori');

Route::get('/carousel', [CarouselController::class, 'index'])->name('carousel.index');
Route::get('/carousel/create', [CarouselController::class, 'create'])->name('carousel.create');
Route::post('/carousel', [CarouselController::class, 'store'])->name('carousel.store');
Route::get('/carousel/{carousel}', [CarouselController::class, 'show'])->name('carousel.show');
Route::get('/carousel/{carousel}/edit', [CarouselController::class, 'edit'])->name('carousel.edit');
Route::put('/carousel/{carousel}', [CarouselController::class, 'update'])->name('carousel.update');
Route::delete('/carousel/{carousel}', [CarouselController::class, 'destroy'])->name('carousel.destroy');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
