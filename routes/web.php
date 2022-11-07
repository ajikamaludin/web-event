<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TicketController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Http\Middleware\InsightTracker;
use Illuminate\Http\Request;

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

Route::get('/', [SiteController::class, 'home'])->name('home')->middleware(InsightTracker::class);
Route::get('/order', [SiteController::class, 'order'])->name('order');
Route::post('/pay', [SiteController::class, 'pay'])->name('order.pay');
Route::get('/pay/{order:order_id}', [SiteController::class, 'show'])->name('order.show');
Route::get('/pay/midtrans/finish', [SiteController::class, 'finish'])->name('midtrans.finish');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');

    Route::get('/setting', [SettingController::class, 'show'])->name('setting.show');
    Route::post('/setting', [SettingController::class, 'update'])->name('setting.update');
    
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/export', [OrderController::class, 'export'])->name('orders.export');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');

    Route::get('/contents', [LandingPageController::class, 'index'])->name('contents.index');
    Route::post('/contents/{content}', [LandingPageController::class, 'update'])->name('contents.update');
});

require __DIR__.'/auth.php';
