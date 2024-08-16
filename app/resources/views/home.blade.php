@extends('layouts.app')

@section('title', 'ホーム')

@section('content')
<div class="container">
    <h1 class="display-4">ホームページ</h1>

    <!-- グルメ投稿一覧 -->
    <h2>グルメ</h2>
    <div class="row">
        @foreach($gourmetPosts->take(3) as $post)
            <div class="col-md-4">
                <div class="card mb-4">
                    @if($post->images && count($post->images) > 0)
                        <img src="{{ asset('/' . $post->images[0]) }}" class="card-img-top" alt="...">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">
                            <strong>店名:</strong> {{ $post->store_name }}<br>
                            <strong>所在地:</strong> {{ $post->location }}<br>
                            <strong>コメント:</strong> {{ $post->comment }}<br>
                            <small class="text-muted">投稿者: {{ $post->user->name }}</small><br>
                            <small class="text-muted">投稿日時: {{ $post->created_at->format('Y/m/d H:i') }}</small>
                        </p>
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">詳細を見る</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- 観光スポット投稿一覧 -->
    <h2>観光スポット</h2>
    <div class="row">
        @foreach($spotPosts->take(3) as $post)
            <div class="col-md-4">
                <div class="card mb-4">
                    @if($post->images && count($post->images) > 0)
                        <img src="{{ asset('/' . $post->images[0]) }}" class="card-img-top" alt="...">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">
                            <strong>店名:</strong> {{ $post->store_name }}<br>
                            <strong>所在地:</strong> {{ $post->location }}<br>
                            <strong>コメント:</strong> {{ $post->comment }}<br>
                            <small class="text-muted">投稿者: {{ $post->user->name }}</small><br>
                            <small class="text-muted">投稿日時: {{ $post->created_at->format('Y/m/d H:i') }}</small>
                        </p>
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">詳細を見る</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- イベント投稿一覧 -->
    <h2>イベント</h2>
    <div class="row">
        @foreach($eventPosts->take(3) as $post)
            <div class="col-md-4">
                <div class="card mb-4">
                    @if($post->images && count($post->images) > 0)
                        <img src="{{ asset('/' . $post->images[0]) }}" class="card-img-top" alt="...">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">
                            <strong>店名:</strong> {{ $post->store_name }}<br>
                            <strong>所在地:</strong> {{ $post->location }}<br>
                            <strong>コメント:</strong> {{ $post->comment }}<br>
                            <small class="text-muted">投稿者: {{ $post->user->name }}</small><br>
                            <small class="text-muted">投稿日時: {{ $post->created_at->format('Y/m/d H:i') }}</small>
                        </p>
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">詳細を見る</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
