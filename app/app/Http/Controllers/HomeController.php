<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $gourmetPosts = Post::where('category', 'グルメ')->latest()->take(5)->get();
        $spotPosts = Post::where('category', '観光スポット')->latest()->take(5)->get();
        $eventPosts = Post::where('category', 'イベント')->latest()->take(5)->get();
        return view('home', compact('gourmetPosts', 'spotPosts', 'eventPosts'));
    }
}
