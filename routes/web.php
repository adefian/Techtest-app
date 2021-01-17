<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionsController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']],function(){

    Route::get('/prepaid-balance', 'BalanceController@index')->name('balance');
    Route::post('/prepaid-balance/create', 'BalanceController@create')->name('balance.create');

    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::post('/product/create', [ProductController::class, 'create'])->name('product.create');

    Route::get('/success/{id}', [TransactionsController::class, 'success'])->name('success');

    Route::get('/payment', [TransactionsController::class, 'payment'])->name('payment');
    Route::post('/payment/create', [TransactionsController::class, 'payment_pay'])->name('payment.pay');

    Route::get('/order', [TransactionsController::class, 'order'])->name('order');
});