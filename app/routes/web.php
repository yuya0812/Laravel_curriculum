<?php

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

// routes/web.php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/spots', function () {
    return view('spots');
})->name('spots');

Route::get('/gourmet', function () {
    return view('gourmet');
})->name('gourmet');

Route::get('/search', function () {
    return view('search');
})->name('search');

Route::get('/mypage', function () {
    return view('mypage');
})->name('mypage');

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
