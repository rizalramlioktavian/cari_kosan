<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backends\BankController;
use App\Http\Controllers\Backends\CityController;
use App\Http\Controllers\Backends\HeroController;
use App\Http\Controllers\Backends\KosanController;
use App\Http\Controllers\Backends\OrderController;
use App\Http\Controllers\Backends\RuangController;
use App\Http\Controllers\Frontends\LokasiController;
use App\Http\Controllers\Frontends\RatingController;
use App\Http\Controllers\Frontends\BookingController;
use App\Http\Controllers\Backends\PromotionController;
use App\Http\Controllers\Frontends\CekOrderController;
use App\Http\Controllers\Frontends\HomePageController;
use App\Http\Controllers\Backends\ApplicationController;
use App\Http\Controllers\Frontends\PembayaranController;



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
    return view('layouts.appFrontend');
});

Auth::routes();

Route::get('/', [HomePageController::class, 'index'])->name('home.page');

Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');

Route::get('/booking/detail/{slug}', [BookingController::class, 'detail'])->name('booking.detail');

Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi.index');

Route::get('/lokasi/detail/{slug}', [LokasiController::class, 'detail'])->name('lokasi.detail');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Ini punya admin //
Route::middleware(['auth', 'CheckRole:admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('/admin/city', [CityController::class, 'index'])->name('city.index');
    Route::get('/admin/city/create', [CityController::class, 'create'])->name('city.create');
    Route::post('/admin/city/store', [CityController::class, 'store'])->name('city.store');
    Route::get('/admin/city/edit/{city}', [CityController::class, 'edit'])->name('city.edit');
    Route::put('/admin/city/update/{city}', [CityController::class, 'update'])->name('city.update');
    Route::delete('/admin/city/destroy/{city}', [CityController::class, 'destroy'])->name('city.destroy');

    Route::get('/admin/kosan', [KosanController::class, 'index'])->name('kosan.index');
    Route::get('/admin/kosan/create', [KosanController::class, 'create'])->name('kosan.create');
    Route::post('/admin/kosan/store', [KosanController::class, 'store'])->name('kosan.store');
    Route::get('/admin/kosan/edit/{kosan}', [KosanController::class, 'edit'])->name('kosan.edit');
    Route::put('/admin/kosan/update/{kosan}', [KosanController::class, 'update'])->name('kosan.update');
    Route::delete('/admin/kosan/destroy/{kosan}', [KosanController::class, 'destroy'])->name('kosan.destroy');

    Route::get('/admin/hero', [HeroController::class, 'index'])->name('hero.index');
    Route::get('/admin/hero/create', [HeroController::class, 'create'])->name('hero.create');
    Route::post('/admin/hero/store', [HeroController::class, 'store'])->name('hero.store');
    Route::get('/admin/hero/edit/{hero}', [HeroController::class, 'edit'])->name('hero.edit');
    Route::put('/admin/hero/update/{hero}', [HeroController::class, 'update'])->name('hero.update');
    Route::delete('/admin/hero/destroy/{hero}', [HeroController::class, 'destroy'])->name('hero.destroy');

    Route::get('/admin/application', [ApplicationController::class, 'index'])->name('application.index');
    Route::get('/admin/application/create', [ApplicationController::class, 'create'])->name('application.create');
    Route::post('/admin/application/store', [ApplicationController::class, 'store'])->name('application.store');
    Route::get('/admin/application/edit/{application}', [ApplicationController::class, 'edit'])->name('application.edit');
    Route::put('/admin/application/update/{application}', [ApplicationController::class, 'update'])->name('application.update');
    Route::delete('/admin/application/destroy/{application}', [ApplicationController::class, 'destroy'])->name('application.destroy');

    Route::get('/admin/promotion', [PromotionController::class, 'index'])->name('promotion.index');
    Route::get('/admin/promotion/create', [PromotionController::class, 'create'])->name('promotion.create');
    Route::post('/admin/promotion/store', [PromotionController::class, 'store'])->name('promotion.store');
    Route::get('/admin/promotion/edit/{promotion}', [PromotionController::class, 'edit'])->name('promotion.edit');
    Route::put('/admin/promotion/update/{promotion}', [PromotionController::class, 'update'])->name('promotion.update');
    Route::delete('/admin/promotion/destroy/{promotion}', [PromotionController::class, 'destroy'])->name('promotion.destroy');

    Route::get('/admin/order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/admin/order/create', [OrderController::class, 'create'])->name('order.create');
    Route::post('/admin/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/admin/order/edit/{order}', [OrderController::class, 'edit'])->name('order.edit');
    Route::put('/admin/order/update/{order}', [OrderController::class, 'update'])->name('order.update');
    Route::delete('/admin/order/destroy/{order}', [OrderController::class, 'destroy'])->name('order.destroy');

    Route::get('/admin/order/status/{order}',[OrderController::class,'status'])->name('order.status');

    Route::get('/admin/bank', [BankController::class, 'index'])->name('bank.index');
    Route::get('/admin/bank/create', [BankController::class, 'create'])->name('bank.create');
    Route::post('/admin/bank/store', [BankController::class, 'store'])->name('bank.store');
    Route::get('/admin/bank/edit/{bank}', [BankController::class, 'edit'])->name('bank.edit');
    Route::put('/admin/bank/update/{bank}', [BankController::class, 'update'])->name('bank.update');
    Route::delete('/admin/bank/destroy/{bank}', [BankController::class, 'destroy'])->name('bank.destroy');

    Route::get('/admin/ruang', [RuangController::class, 'index'])->name('ruang.index');
    Route::get('/admin/ruang/create', [RuangController::class, 'create'])->name('ruang.create');
    Route::post('/admin/ruang/store', [RuangController::class, 'store'])->name('ruang.store');
    Route::get('/admin/ruang/edit/{ruang}', [RuangController::class, 'edit'])->name('ruang.edit');
    Route::put('/admin/ruang/update/{ruang}', [RuangController::class, 'update'])->name('ruang.update');
    Route::delete('/admin/ruang/destroy/{ruang}', [RuangController::class, 'destroy'])->name('ruang.destroy');

    });

// ini punya user //
Route::middleware(['auth', 'CheckRole:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/booking/detail/{slug}/ruang', [BookingController::class, 'ruang'])->name('booking.ruang');
    Route::get('/booking/detail/{slug}/ruang/{slug_ruang}/order', [BookingController::class, 'order'])->name('booking.order');
    Route::post('/booking/detail/{slug}/ruang/{slug_ruang}/order/store', [BookingController::class, 'store'])->name('booking.store');

    // LOKASI PEMBAYARAN ROUTES
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');

    // BOOKING CEK ORDER ROUTES
    Route::get('/cek-order', [CekOrderController::class, 'index'])->name('cekOrder.index');
    Route::delete('/cek-order/destroy/{id}', [CekOrderController::class, 'destroy'])->name('cekOrder.destroy');

    // LOKASI RUANGNOT ROUTES
    Route::get('/lokasi/detail/{slug}/ruangnot', [LokasiController::class, 'ruangnot'])->name('lokasi.ruangnot');
    Route::get('/lokasi/detail/{slug}/ruangnot/{slug_ruangnot}/order', [LokasiController::class, 'order'])->name('lokasi.order');
    Route::get('/lokasi/detail/{slug}/ruangnot/{slug_ruangnot}/order/store', [LokasiController::class, 'store'])->name('lokasi.store');


     // Rating routes
     Route::post('/rating/store', [RatingController::class, 'store'])->name('rating.store');
    });
