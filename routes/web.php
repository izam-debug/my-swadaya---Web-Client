<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [Controller::class, 'login_form'])->name('login')->middleware('guest');
Route::post('/login', [Controller::class, 'authenticate']);
Route::get('/dashboard', [Controller::class, 'dashboard'])->middleware('auth');
Route::post('/logout', [Controller::class, 'logout']);
Route::get('/dash/client/chart-tagihan', [Controller::class, 'chart_tagihan']);
Route::get('/dash/client/chart-pemakaian', [Controller::class, 'chart_pemakaian']);
