@extends('layouts.app')

@section('title', 'マイページ')

@section('content')
<div class="container">
    <h1>マイページ</h1>

    <!-- アクションボタン -->
    <a href="{{ route('posts.create') }}" class="btn btn-primary">新規投稿</a>
    <br><br>
    <a href="{{ route('posts.index') }}" class="btn btn-primary">投稿一覧</a>
    <br><br>
    <a href="{{ route('posts.myCategory', 'グルメ') }}" class="btn btn-primary">自分のグルメの投稿一覧</a>
<a href="{{ route('posts.myCategory', '観光スポット') }}" class="btn btn-primary">自分の観光スポットの投稿一覧</a>
<a href="{{ route('posts.myCategory', 'イベント') }}" class="btn btn-primary">自分のイベントの投稿一覧</a>
    <br><br>

    <!-- 自分のグルメ投稿 -->
    <h2>自分のグルメ投稿</h2>
    <div class="row">
        @forelse($gourmetPosts as $post)
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
        @empty
            <p>グルメの投稿がありません。</p>
        @endforelse
    </div>

    <!-- 自分の観光スポット投稿 -->
    <h2>自分の観光スポット投稿</h2>
    <div class="row">
        @forelse($spotPosts as $post)
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
        @empty
            <p>観光スポットの投稿がありません。</p>
        @endforelse
    </div>

    <!-- 自分のイベント投稿 -->
    <h2>自分のイベント投稿</h2>
    <div class="row">
        @forelse($eventPosts as $post)
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
        @empty
            <p>イベントの投稿がありません。</p>
        @endforelse
    </div>
</div>
@endsection