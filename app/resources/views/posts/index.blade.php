@extends('layouts.app')

@section('title', '投稿一覧')

@section('content')
<div class="container">
    <h1>投稿一覧</h1>
    <div class="row">
        @foreach($posts as $post)
            <div class="col-md-4">
                <div class="card mb-4">
                    @if($post->images && count($post->images) > 0)
                        <img src="{{ asset('storage/' . $post->images[0]) }}" class="card-img-top" alt="...">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">
                            <small class="text-muted">投稿者: {{ $post->user->name }}</small><br>
                            <small class="text-muted">投稿日時: {{ $post->created_at->format('Y/m/d H:i') }}</small>
                        </p>
                        <a href="#" class="btn btn-primary">詳細を見る</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $posts->links() }}
</div>
@endsection
