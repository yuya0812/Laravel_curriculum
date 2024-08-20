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
use App\Http\Controllers\LikeController;



Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');

// 認証ルートとメール確認
Auth::routes(['verify' => true]);

// ホームページ
Route::get('/', [HomeController::class, 'index'])->name('home');

// 静的ページルート
Route::get('/spots', [PageController::class, 'spots'])->name('spots');
Route::get('/gourmet', [PageController::class, 'gourmet'])->name('gourmet');
Route::get('/event', [PageController::class, 'event'])->name('event');
Route::get('/search', [PageController::class, 'searchPage'])->name('search');
Route::get('/admin', [PageController::class, 'admin'])->name('admin');

// 投稿関連ルート
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::post('/posts/{post}/update', [PostController::class, 'update'])->name('posts.update');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// カテゴリー別投稿表示
Route::get('/posts/category/{category}', [PostController::class, 'category'])->name('posts.category');
// 自分の投稿のみ表示
Route::get('/posts/my-category/{category}', [PostController::class, 'myCategory'])->name('posts.myCategory');

// 検索機能
Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');

// マイページ関連（認証が必要）
Route::middleware(['auth'])->group(function () {
    Route::get('/mypage', [UserController::class, 'index'])->name('mypage');
    Route::get('/mypage', [PostController::class, 'myPosts'])->name('mypage');
    Route::get('/mypage/posts', [PostController::class, 'myPosts'])->name('mypage.posts');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/confirm', [PostController::class, 'confirm'])->name('posts.confirm');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
});

Route::get('/posts/my-category/{category}', [PostController::class, 'myCategory'])->name('posts.myCategory');


// 管理者専用ルート（adminミドルウェアを適用）
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'adminIndex'])->name('admin.users.index');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

});

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Route::post('/posts/{post}', [LikeController::class, 'likePost'])->name('posts.like');
// Route::delete('/posts/{post}', [LikeController::class, 'unlikePost'])->name('posts.unlike');

Route::post('/like/{postId}',[LikeController::class,'store']);

Route::post('/unlike/{postId}',[LikeController::class,'destroy']);

Route::get('/like-count/{postId}', [LikeController::class, 'getLikeCount']);

