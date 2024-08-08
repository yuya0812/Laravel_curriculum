<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function confirm(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string',
            'store_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'comment' => 'required|string|max:250',
            'genre' => 'nullable|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('temp');
                $images[] = $path;
            }
        }

        $post = $validated;
        $post['images'] = $images;

        return view('posts.confirm', compact('post'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string',
            'store_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'comment' => 'required|string|max:250',
            'genre' => 'nullable|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $images[] = $path;
            }
        }

        $post = Post::create([
            'user_id' => Auth::id(),
            'category' => $validated['category'],
            'store_name' => $validated['store_name'],
            'location' => $validated['location'],
            'title' => $validated['title'],
            'comment' => $validated['comment'],
            'genre' => $validated['genre'],
            'images' => $images,
        ]);

        return redirect()->route('mypage')->with('status', '投稿が完了しました。');
    }
        public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show' , compact('post'));
    }
}




