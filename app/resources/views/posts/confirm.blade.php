@extends('layouts.app')

@section('title', '投稿確認')

@section('content')
<div class="container">
    <h1>投稿確認</h1>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <input type="hidden" name="category" value="{{ $post['category'] }}">
        <input type="hidden" name="store_name" value="{{ $post['store_name'] }}">
        <input type="hidden" name="location" value="{{ $post['location'] }}">
        <input type="hidden" name="title" value="{{ $post['title'] }}">
        <input type="hidden" name="comment" value="{{ $post['comment'] }}">
        <input type="hidden" name="genre" value="{{ $post['genre'] }}">
        @foreach($post['images'] as $image)
            <input type="hidden" name="images[]" value="{{ $image }}">
        @endforeach

        <div class="form-group">
            <label>カテゴリー:</label>
            <p>{{ $post['category'] }}</p>
        </div>
        <div class="form-group">
            <label>店名:</label>
            <p>{{ $post['store_name'] }}</p>
        </div>
        <div class="form-group">
            <label>所在地:</label>
            <p>{{ $post['location'] }}</p>
        </div>
        <div class="form-group">
            <label>投稿タイトル:</label>
            <p>{{ $post['title'] }}</p>
        </div>
        <div class="form-group">
            <label>コメント:</label>
            <p>{{ $post['comment'] }}</p>
        </div>
        <div class="form-group">
            <label>ジャンル:</label>
            <p>{{ $post['genre'] }}</p>
        </div>
        <div class="form-group">
            <label>画像:</label>
            <div>
                @foreach($post['images'] as $image)
                    <img src="{{ asset('storage/' . $image) }}" alt="Image" style="max-width: 100px; max-height: 100px;">
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-primary">投稿する</button>
        <a href="{{ route('posts.create') }}" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection
