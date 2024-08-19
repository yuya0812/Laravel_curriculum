@extends('layouts.app')

@section('title', '投稿の編集')

@section('content')
<div class="container">
    <h1>投稿の編集</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="category">カテゴリー</label>
            <select name="category" id="category" class="form-control" required>
                <option value="グルメ" {{ $post->category == 'グルメ' ? 'selected' : '' }}>グルメ</option>
                <option value="観光スポット" {{ $post->category == '観光スポット' ? 'selected' : '' }}>観光スポット</option>
                <option value="イベント" {{ $post->category == 'イベント' ? 'selected' : '' }}>イベント</option>
            </select>
        </div>

        <div class="form-group">
            <label for="store_name">店名</label>
            <input type="text" name="store_name" id="store_name" class="form-control" value="{{ old('store_name', $post->store_name) }}" required>
        </div>

        <div class="form-group">
            <label for="location">所在地</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $post->location) }}" required>
        </div>

        <div class="form-group">
            <label for="title">投稿タイトル</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title) }}" required>
        </div>

        <div class="form-group">
            <label for="comment">コメント</label>
            <textarea name="comment" id="comment" class="form-control" rows="3" maxlength="250" required>{{ old('comment', $post->comment) }}</textarea>
        </div>

        <div class="form-group">
            <label for="genre">ジャンル (ハッシュタグ)</label>
            <input type="text" name="genre" id="genre" class="form-control" value="{{ old('genre', $post->genre) }}">
        </div>

        <div class="form-group">
            <label for="images">画像 (最大10枚)</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple>
            <div class="mt-2">
                <p>現在の画像:</p>
                @if ($post->images)
                    @foreach (json_decode($post->images, true) as $image)
                        <img src="{{ asset('/' . $image) }}" alt="現在の画像" style="width: 150px; height: auto;">
                    @endforeach
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-primary">更新する</button>
    </form>

    @if ($errors->has('images'))
        <div class="alert alert-danger">
            {{ $errors->first('images') }}
        </div>
    @endif
</div>
@endsection