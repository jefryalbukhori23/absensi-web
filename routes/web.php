<?php

use App\Http\Controllers\qrController;
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
    return view('Auth.login');
});

Route::get('/qrCode', [qrController::class, 'index']);
Route::get('/absen', [qrController::class, 'absen']);

Route::group(['middleware' => ['auth', 'hakakses:admin']], function () {

});
Route::group(['middleware' => ['auth', 'hakakses:student']], function () {

});