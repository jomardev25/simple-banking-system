<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(["prefix" => "v1/banks"], function () {
    Route::post("/transfer", "App\Http\Controllers\BankController@transfer");
    Route::post("/deposit", "App\Http\Controllers\BankController@deposit");
    Route::post("/withdraw", "App\Http\Controllers\BankController@withdraw");
});
