<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepositController;
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


Route::get('/dashboard', [AdminController::class, 'index1'])->middleware(['auth', 'verified'])->name('dashboard');

use App\Http\Controllers\PaymentController;

Route::get('/deposit', [DepositController::class, 'index']);
Route::post('/process-deposit', [DepositController::class, 'processDeposit'])->name('process.deposit');

Route::middleware('auth')->group(function () {
    Route::get('/hi', [AdminController::class, 'index1']);

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
    Route::get('/myport', [PortController::class, 'portfolio'])->name('portfolio');
    Route::get('/history', [PortController::class, 'history'])->name('history');

    Route::get('/mywallet', [PortController::class, 'showwallet'])->name('showwallet');
    Route::get('/deposit_money', [DepositController::class, 'depositpage'])->name('depositpage');
    
});

Route::middleware(['auth:admin', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/hi', [AdminController::class, 'index'])->name('hi');

    Route::get('/managebroker', [AdminController::class, 'showbroker'])->name('showbroker');
    Route::get('/addbroker', [AdminController::class, 'pageaddbroker'])->name('pageaddbroker');
    Route::post('/addbroker', [AdminController::class, 'addbroker'])->name('addbroker');

    Route::get('/supervisebroker', [AdminController::class, 'showTakecarebroker'])->name('showTakecarebroker');

    Route::get('/buythemost', [AdminController::class, 'buythemost'])->name('buythemost');
    Route::get('/sellthemost', [AdminController::class, 'sellthemost'])->name('sellthemost');
    Route::get('/sectorbuy', [AdminController::class, 'adminsectorbuy'])->name('adminsectorbuy');
    Route::get('/sectorsell', [AdminController::class, 'adminsectorsell'])->name('adminsectorsell');

    Route::get('/managestocks', [AdminController::class, 'showstock'])->name('showstock');
    Route::get('/addstock', [AdminController::class, 'pageaddstock'])->name('pageaddstock');
    Route::post('/addstock', [AdminController::class, 'addstock'])->name('addstock');
});



require __DIR__.'/auth.php';

Route::get('/admin/dashboard', [AdminController::class, 'admindasboard'])->middleware(['auth:admin', 'verified'])->name('admin.dashboard');




require __DIR__.'/adminauth.php';