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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// web
Route::get('/', [App\Http\Controllers\Web\HomeController::class, 'index']);
Route::get('/jersey', [App\Http\Controllers\Web\HomeController::class, 'jersey']);
Route::get('/jersey/detail/{id}', [App\Http\Controllers\Web\HomeController::class, 'detail']);
Route::get('/keranjang', [App\Http\Controllers\Web\HomeController::class, 'keranjang']);



