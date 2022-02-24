<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use \App\Http\Controllers\LoanController;
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


Route::resource('books' , BookController::class);

Route::resource('books',BookController::class)->middleware("auth");

Route::resource('categories',CategoryController::class)->middleware("auth");

Route::resource('loans',LoanController::class)->middleware("auth");
/*
Route::get('/admin', function () {
    return view('layout');
})->middleware("auth");
 */
Route::post('/',[ \App\Http\Controllers\HomeController::class, 'search']);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
