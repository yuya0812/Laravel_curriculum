@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="container">
    <h1 class="display-4">{{ $post->title }}</h1>
    <div id="postCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($post->images as $key => $image)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $image) }}" class="d-block w-100" alt="...">
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#postCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#postCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="mt-4">
        <p><strong>カテゴリー:</strong> {{ $post->category }}</p>
        <p><strong>店名:</strong> {{ $post->store_name }}</p>
        <p><strong>所在地:</strong> {{ $post->location }}</p>
        <p><strong>コメント:</strong> {{ $post->comment }}</p>
        <p><strong>ジャンル:</strong> {{ $post->genre }}</p>
        <p><strong>投稿者:</strong> {{ $post->user->name }}</p>
        <p><strong>投稿日時:</strong> {{ $post->created_at->format('Y/m/d H:i') }}</p>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
