<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store($postId)
{
    Auth::user()->like($postId);
    $post = Post::find($postId); // 投稿を取得
    return response()->json(['like_count' => $post->likes()->count()]);
}

public function destroy($postId)
{
    Auth::user()->unlike($postId);
    $post = Post::find($postId); // 投稿を取得
    return response()->json(['like_count' => $post->likes()->count()]);
}
    public function getLikeCount($postId)
    {
        $post = Post::findOrFail($postId);
        $likeCount = $post->likes()->count();
        
        return response()->json(['likeCount' => $likeCount]);
    }
}
