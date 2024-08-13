<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class PostController extends Controller
{
    /**
     * 投稿作成フォームを表示する
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * 投稿内容の確認処理を行う
     */
    public function confirm(Request $request)
    {
        $validated = $this->validatePost($request);

        $images = $this->handleUploadedImages($request->file('images'), 'temp');

        $post = $validated;
        $post['images'] = $images;

        return view('posts.confirm', compact('post'));
    }

    /**
     * 投稿一覧を表示する
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * 指定された投稿を表示する
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * 投稿データをバリデートする
     */
    protected function validatePost(Request $request)
    {
        return $request->validate([
            'category' => 'required|string',
            'store_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'comment' => 'required|string|max:250',
            'genre' => 'nullable|string|max:255',
            // 'images' => 'required',
            // 'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

    /**
     * アップロードされた画像を処理する
     */
    protected function handleUploadedImages($images, $directory)
    {
        $storedImages = [];
        if ($images) {
            foreach ($images as $image) {
                $path = $image->store($directory);
                $storedImages[] = $path;
            }
        }
        return $storedImages;
    }

    /**
     * 確認後に画像を保存する
     */
    protected function storeImages(Request $request)
    {
        $images = [];
        if ($request->hasFile('images')) {
            $images = $this->handleUploadedImages($request->file('images'), 'temp');
        } else {
            foreach ($request->input('images', []) as $image) {
                $tempPath = storage_path('app/temp/' . basename($image));
                $newPath = public_path('storage/images/' . basename($image)); // 修正箇所
                try {
                    if (file_exists($tempPath)) {
                        rename($tempPath, $newPath);
                        $images[] = 'storage/images/' . basename($image);
                    }
                } catch (Exception $e) {
                    // エラーが発生した場合の処理
                    Log::error('Image move failed: ' . $e->getMessage());
                    return redirect()->back()->withErrors(['images' => '画像の移動中にエラーが発生しました: ' . $e->getMessage()]);
                }
            }
        }
        return $images;
    }

    /**
     * 新しい投稿をデータベースに保存する
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // バリデーションと保存処理
        $validated = $this->validatePost($request);
        $images = $this->storeImages($request);

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
        // dd($request->all());

        return redirect()->route('posts.index')->with('status', '投稿が完了しました。'); // 修正箇所
    }

    public function search(Request $request)
    {

        $query = $request->input('query');
    
        if ($query) {
            $posts = Post::where('title', 'like', "%{$query}%")
                         ->orWhere('comment', 'like', "%{$query}%")
                         ->orWhere('store_name', 'like', "%{$query}%")
                         ->paginate(10);
        } else {
            $posts = Post::paginate(10);
        }
        
    
        return view('posts.search', compact('posts'));
    }

    // すべてのユーザーの投稿をカテゴリーごとに表示するメソッド
    public function category($category)
    {
        $posts = Post::where('category', $category)
                     ->with('user') // ユーザー情報をロード
                     ->latest()
                     ->paginate(10);

        return view('posts.category', compact('posts', 'category'));
    }
    // ログインユーザーの投稿のみをカテゴリーごとに表示するメソッド
    public function myPosts()
    {
        $userId = Auth::id();

        $gourmetPosts = Post::where('user_id', $userId)->where('category', 'グルメ')->get();
        $spotPosts = Post::where('user_id', $userId)->where('category', '観光スポット')->get();
        $eventPosts = Post::where('user_id', $userId)->where('category', 'イベント')->get();

        return view('mypage', compact('gourmetPosts', 'spotPosts', 'eventPosts'));
    }


}
