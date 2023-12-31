<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Routing Account

// Route::get('/register', 'AccountController@index');



//Routing Transaction
Route::post('/transaction', [TransactionController::class,'store']);
Route::get('/listTransaction', [TransactionController::class,'index']);
Route::get('/getTransaction/{id}', [TransactionController::class,'getTransaction']);

