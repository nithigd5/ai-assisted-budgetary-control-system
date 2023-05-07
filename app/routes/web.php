<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::controller(TicketingController::class)->prefix('tickets')->name('tickets.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/overall', 'overall')->name('overall');
        Route::get('/assigned', 'assigned')->name('assigned');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{ticket}/update', 'update')->name('update');
        Route::put('/{ticket}/reply', 'reply')->name('reply');
        Route::get('/{ticket}', 'show')->name('show');
    });

    Route::controller(\App\Http\Controllers\FeatureController::class)->prefix('features')->name('features.')->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::post('/expense', [ExpenseController::class, 'store'])->name('expense.store');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
});
