<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    /**
     * 一般ユーザー向けのマイページを表示
     */
    public function index()
    {
        return view('mypage');
    }

    /**
     * 管理者向けのユーザー管理ページを表示
     */
    public function adminIndex()
    {
        $users = User::all(); // 全ユーザーを取得
        return view('admin', compact('users'));
    }

    /**
     * ユーザーを削除する
     */
    public function destroy(User $user)
    {
        $user->delete(); // ユーザーを削除
        return redirect()->route('admin.users.index')->with('status', 'ユーザーを削除しました。');
    }
    // マイページの自分だけの投稿
    public function myPosts()
    {
        $user = Auth::user();
        
        $gourmetPosts = Post::where('user_id', $user->id)->where('category', 'グルメ')->latest()->take(3)->get();
        $spotPosts = Post::where('user_id', $user->id)->where('category', '観光スポット')->latest()->take(3)->get();
        $eventPosts = Post::where('user_id', $user->id)->where('category', 'イベント')->latest()->take(3)->get();
        
        return view('mypage', compact('gourmetPosts', 'spotPosts', 'eventPosts'));
    }
}
