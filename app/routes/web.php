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

use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/spots', function () {
    return view('spots');
})->name('spots');

Route::get('/gourmet', function () {
    return view('gourmet');
})->name('gourmet');

Route::get('/event', function () {
    return view('event');
})->name('event');

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

Route::middleware(['auth'])->group(function () {
    Route::get('/mypage', [App\Http\Controllers\UserController::class, 'index'])->name('mypage');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/confirm', [PostController::class, 'confirm'])->name('posts.confirm');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
});


Route::post('/posts/confirm', [PostController::class, 'confirm'])->name('posts.confirm');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

