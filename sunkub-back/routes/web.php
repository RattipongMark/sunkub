<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortController;
use App\Http\Controllers\AdminController;
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
    return view('real_pages.landing');
});


Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/hi', [AdminController::class, 'index']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/loginport', [PortController::class, 'login'])->name('portlogin');
    Route::post('/loginport', [PortController::class, 'checkPort'])->name('checkPort');

    Route::get('/stock', [PortController::class, 'showstock'])->name('showstock');
    Route::get('/specificstock/{stock_symbol}', [PortController::class, 'showspecificstock'])->name('poststock');

    Route::get('/prebuy/{stock_symbol}', [PortController::class, 'prebuy'])->name('prebuy');
    Route::post('/buy/{stock_symbol}', [PortController::class, 'buy'])->name('buy');

    Route::get('/presell/{stock_symbol}', [PortController::class, 'presell'])->name('presell');
    Route::post('/sell/{stock_symbol}', [PortController::class, 'sell'])->name('sell');

    Route::get('/trading', [PortController::class, 'menu1'])->name('trading');
    Route::get('/mydashboard', [PortController::class, 'dashboard'])->name('mydashboard');
});

require __DIR__.'/auth.php';

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

Route::get('/wallet', function () {
    return view('user_wallet_main');
});



require __DIR__.'/adminauth.php';