@extends('layouts.app')

@section('title', '投稿確認')

@section('content')
<div class="container">
    <h1>投稿確認</h1>
    <div class="card">
        <div class="card-body">
            <p>カテゴリー: {{ $post->category }}</p>
            <p>店名: {{ $post->store_name }}</p>
            <p>所在地: {{ $post->location }}</p>
            <p>投稿タイトル: {{ $post->title }}</p>
            <p>コメント: {{ $post->comment }}</p>
            <p>ジャンル: {{ $post->genre }}</p>
            <p>画像:</p>
            <div>
                @foreach($post->images as $image)
                    <img src="{{ asset('storage/' . $image) }}" alt="Image" style="max-width: 100px; max-height: 100px;">
                @endforeach
            </div>
        </div>
    </div>
    <a href="{{ route('mypage') }}" class="btn btn-secondary">戻る</a>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">投稿を編集する</a>
</div>
@endsection