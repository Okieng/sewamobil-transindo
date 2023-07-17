<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MobilController; //load controller 
use App\Http\Controllers\PeminjamanController; //load controller post
use App\Http\Controllers\PengembalianController; //load controller post
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

Route::resource('mobil', MobilController::class);
Route::resource('peminjaman', PeminjamanController::class);
Route::resource('pengembalian', PengembalianController::class);
Route::post('/pengembalians', 'PengembalianController@store')->name('pengembalians.store');