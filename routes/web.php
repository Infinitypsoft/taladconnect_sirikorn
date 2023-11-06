<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SinglePageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;

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

Route::get('/admin/{any}', [SinglePageController::class, 'index'])->where('any', '.*');

// Route::get('/', function () {
//     return view('./layout/home');
// });
// Route::post('/admin/api/login', [AuthController::class, 'login']);


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/store', [HomeController::class, 'store'])->name('store');
Route::get('/store/detail', [HomeController::class, 'storeDetail'])->name('store.detail');
Route::get('/new', [HomeController::class, 'new'])->name('new');
Route::get('/new/detail', [HomeController::class, 'newDetail'])->name('new.detail');

