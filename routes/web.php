<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhoneBookController;
use App\Http\Controllers\PhoneTypeController;
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

Route::get('/', [PhoneBookController::class, 'index']);

Route::resource('phonebook', PhoneBookController::class);
Route::resource('phonetype', PhoneTypeController::class);
