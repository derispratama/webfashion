<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// web
Route::get('/', [App\Http\Controllers\Web\HomeController::class, 'index']);
Route::get('/jersey/{id_liga?}', [App\Http\Controllers\Web\HomeController::class, 'jersey']);
Route::get('/jersey/detail/{id}', [App\Http\Controllers\Web\HomeController::class, 'detail']);
Route::get('/keranjang', [App\Http\Controllers\Web\HomeController::class, 'keranjang']);

// dashboard
Route::resource('liga', App\Http\Controllers\LigaController::class);
Route::resource('produk', App\Http\Controllers\ProdukController::class);
Route::resource('bank', App\Http\Controllers\BankController::class);
Route::resource('users', App\Http\Controllers\UserController::class);

//auth
Route::get('/login', [App\Http\Controllers\AuthController::class, 'index']);
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
Route::get('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::get('/forgotpass', [App\Http\Controllers\AuthController::class, 'forgotpass']);

Route::post('/checklogin', [App\Http\Controllers\AuthController::class, 'checklogin']);
Route::post('/user_register', [App\Http\Controllers\AuthController::class, 'user_register']);
Route::post('/keranjang', [App\Http\Controllers\Web\HomeController::class, 'store_keranjang']);



