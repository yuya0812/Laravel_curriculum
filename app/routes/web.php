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
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

// 認証ルートとメール確認
Auth::routes(['verify' => true]);

// 検索機能
Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');


// ホームページ
// Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');


// その他の静的ページルート
Route::get('/spots', [PageController::class, 'spots'])->name('spots');
Route::get('/gourmet', [PageController::class, 'gourmet'])->name('gourmet');
Route::get('/event', [PageController::class, 'event'])->name('event');
Route::get('/search', [PageController::class, 'searchPage'])->name('search');
Route::get('/admin', [PageController::class, 'admin'])->name('admin');

// 管理者専用ルート（adminミドルウェアを適用）
Route::middleware(['auth', 'admin'])->group(function () {
    // Route::get('/admin/dashboard', [PageController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [UserController::class, 'adminIndex'])->name('admin.users.index');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});


// マイページ（認証が必要）
Route::middleware(['auth'])->group(function () {
    Route::get('/mypage', [UserController::class, 'index'])->name('mypage');
    Route::get('/mypage', [UserController::class, 'myPosts'])->name('mypage');
    Route::get('/mypage', [PostController::class, 'myPosts'])->name('mypage');
    
    // 投稿関連のルート
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/confirm', [PostController::class, 'confirm'])->name('posts.confirm');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
});


// 投稿表示カテゴリー分け
Route::get('/posts/category/{category}', [PostController::class, 'category'])->name('posts.category');
// 自分の投稿のみを表示
Route::get('/posts/my-category/{category}', [PostController::class, 'myCategory'])->name('posts.myCategory');


