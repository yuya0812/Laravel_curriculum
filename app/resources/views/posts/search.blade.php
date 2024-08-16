@extends('layouts.app')

@section('title', '投稿検索')

@section('content')
<div class="container">
    <h1>投稿検索</h1>
    <form action="{{ route('posts.search') }}" method="GET">
        <div class="form-group">
            <input type="text" name="query" class="form-control" placeholder="検索キーワードを入力" value="{{ request('query') }}">
        </div>
        <div class="form-group">
            <select name="category" class="form-control">
                <option value="">カテゴリーを選択</option>
                <option value="グルメ" {{ request('category') == 'グルメ' ? 'selected' : '' }}>グルメ</option>
                <option value="観光スポット" {{ request('category') == '観光スポット' ? 'selected' : '' }}>観光スポット</option>
                <option value="イベント" {{ request('category') == 'イベント' ? 'selected' : '' }}>イベント</option>
            </select>
        </div>
        <div class="form-group">
            <input type="text" name="user" class="form-control" placeholder="投稿者名を入力" value="{{ request('user') }}">
        </div>
        <div class="form-group">
            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
        </div>
        <div class="form-group">
            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
        </div>
        <button type="submit" class="btn btn-primary">検索</button>
    </form>

    @if(isset($posts) && $posts->isNotEmpty())
        <div class="container mt-4">
            <h1>投稿一覧</h1>
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-4">
                        <a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-dark">
                            <div class="card mb-4">
                                @if($post->images && count($post->images) > 0)
                                    <img src="{{ asset('/' . $post->images[0]) }}" class="card-img-top" alt="...">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">
                                        <small class="text-muted">投稿者: {{ $post->user->name }}</small><br>
                                        <small class="text-muted">投稿日時: {{ $post->created_at->format('Y/m/d H:i') }}</small>
                                    </p>
                                    <p class="btn btn-primary">詳細を見る</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            {{ $posts->links() }}
        </div>
    @else
        <p class="mt-4">該当する投稿が見つかりませんでした。</p>
    @endif
</div>
@endsection
