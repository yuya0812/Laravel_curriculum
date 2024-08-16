<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function spots()
    {
        return view('spots');
    }

    public function gourmet()
    {
        return view('gourmet');
    }

    public function event()
    {
        return view('event');
    }

    public function searchPage()
    {
        return view('search');
    }

    public function mypage()
    {
        $userId = Auth::id(); // 現在のユーザーIDを取得
    
        $gourmetPosts = Post::where('user_id', $userId)
                            ->where('category', 'グルメ')
                            ->get();
    
        $spotPosts = Post::where('user_id', $userId)
                         ->where('category', '観光スポット')
                         ->get();
    
        $eventPosts = Post::where('user_id', $userId)
                          ->where('category', 'イベント')
                          ->get();
    
        return view('mypage', compact('gourmetPosts', 'spotPosts', 'eventPosts'));
    }

    public function admin()
    {
        return view('admin');
    }
    public function someAdminFunction()
{
    if (auth()->user()->isAdmin()) {
        // 管理者のみがアクセスできる処理
    } else {
        // 権限がない場合の処理
        return redirect()->route('home')->with('error', '権限がありません');
    }
}
}

