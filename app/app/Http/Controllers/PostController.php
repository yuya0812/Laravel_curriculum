<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class PostController extends Controller
{
    // 投稿作成フォームを表示する
    public function create()
    {
        return view('posts.create');
    }

    // 投稿内容の確認処理を行う
    public function confirm(Request $request)
    {
        $validated = $this->validatePost($request);
        $images = $this->handleUploadedImages($request->file('images'), 'temp');
        $post = $validated;
        $post['images'] = $images;
        return view('posts.confirm', compact('post'));
    }

    // 投稿一覧を表示する
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    // 指定された投稿を表示する
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // 投稿データをバリデートする
    protected function validatePost(Request $request)
    {
        return $request->validate([
            'category' => 'required|string',
            'store_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'comment' => 'required|string|max:250',
            'genre' => 'nullable|string|max:255',
        ]);
    }

    // アップロードされた画像を処理する
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

    // 確認後に画像を保存する
    protected function storeImages(Request $request)
    {
        $images = [];
        if ($request->hasFile('images')) {
            $images = $this->handleUploadedImages($request->file('images'), 'temp');
        } else {
            foreach ($request->input('images', []) as $image) {
                $tempPath = storage_path('app/temp/' . basename($image));
                $newPath = public_path('storage/images/' . basename($image));
                try {
                    if (file_exists($tempPath)) {
                        rename($tempPath, $newPath);
                        $images[] = 'storage/images/' . basename($image);
                    }
                } catch (Exception $e) {
                    Log::error('Image move failed: ' . $e->getMessage());
                    return redirect()->back()->withErrors(['images' => '画像の移動中にエラーが発生しました: ' . $e->getMessage()]);
                }
            }
        }
        return $images;
    }

    // 新しい投稿をデータベースに保存する
    public function store(Request $request)
    {
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

        return redirect()->route('posts.index')->with('status', '投稿が完了しました。');
    }

    // 複数項目での検索
    public function search(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');
        $user = $request->input('user');
        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $posts = Post::query();

        if ($query) {
            $posts = $posts->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('comment', 'like', "%{$query}%")
                  ->orWhere('store_name', 'like', "%{$query}%");
            });
        }

        if ($category) {
            $posts = $posts->where('category', $category);
        }

        if ($user) {
            $posts = $posts->whereHas('user', function ($q) use ($user) {
                $q->where('name', 'like', "%{$user}%");
            });
        }

        if ($date_from) {
            $posts = $posts->whereDate('created_at', '>=', $date_from);
        }

        if ($date_to) {
            $posts = $posts->whereDate('created_at', '<=', $date_to);
        }

        $posts = $posts->paginate(10);

        return view('posts.search', compact('posts'));
    }

    // すべてのユーザーの投稿をカテゴリーごとに表示する
    public function category($category)
    {
        $posts = Post::where('category', $category)
                     ->with('user')
                     ->latest()
                     ->paginate(10);

        return view('posts.category', compact('posts', 'category'));
    }

    // ログインユーザーの投稿のみをカテゴリーごとに表示する
    public function myPosts()
    {
        $userId = Auth::id();
    
        // 各カテゴリーの投稿を取得
        $gourmetPosts = Post::where('user_id', $userId)->where('category', 'グルメ')->get();
        $spotPosts = Post::where('user_id', $userId)->where('category', '観光スポット')->get();
        $eventPosts = Post::where('user_id', $userId)->where('category', 'イベント')->get();
    
        return view('mypage', compact('gourmetPosts', 'spotPosts', 'eventPosts'));
    }
    public function myCategory($category)
{
    $userId = Auth::id(); // ログインしているユーザーのIDを取得
    $posts = Post::where('user_id', $userId)
                 ->where('category', $category)
                 ->get(); // ユーザーIDとカテゴリーでフィルタリング

    return view('posts.my_category', compact('posts', 'category'));
}

    public function edit($id)
{
    $post = Post::findOrFail($id);
    if ($post->user_id !== Auth::id()) {
        abort(403, '権限がありません。');
    }

    return view('posts.edit', compact('post'));
}

public function update(Request $request, $id)
{
    $post = Post::findOrFail($id);
    if ($post->user_id !== Auth::id()) {
        abort(403, '権限がありません。');
    }

    $validated = $request->validate([
        'category' => 'required|string',
        'store_name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'comment' => 'required|string|max:250',
        'genre' => 'nullable|string|max:255',
    ]);

    $post->update($validated);

    return redirect()->route('posts.show', $post->id)->with('status', '投稿が更新されました。');
}

public function destroy($id)
{
    $post = Post::findOrFail($id);
    if ($post->user_id !== Auth::id()) {
        abort(403, '権限がありません。');
    }

    $post->delete();

    return redirect()->route('home')->with('status', '投稿が削除されました。');
}

}
