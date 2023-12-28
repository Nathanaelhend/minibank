<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;

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

//Routing ke halaman utama
Route::get('/', function () {
    return view('account.listAccount');
});

// Penamaan Routing untuk bagian account
Route::resource('accounts', 'App\Http\Controllers\AccountController');

//Routing untuk bagian get Account
Route::get('getAccount', [AccountController::class, 'getAccount'])->name('getAccount');
Route::get('/search', [AccountController::class, 'search'])->name('search');

// Routing untuk melakukan register account
Route::post('/store', [AccountController::class, 'store']);

//Penamaan Routing untuk bagian Transaksi
Route::resource('transactions', 'App\Http\Controllers\TransactionController');

//Routing untuk bagian get transaksi
Route::get('/searchTransaction', [TransactionController::class, 'searchTransaction'])->name('searchTransaction');
Route::get('getTransaction', [TransactionController::class, 'getTransaction'])->name('getTransaction');
