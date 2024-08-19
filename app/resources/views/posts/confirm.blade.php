@extends('layouts.app')
@section('title', '投稿確認')
@section('content')
<div class="container">
    <h1>投稿確認</h1>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        @foreach(['category', 'store_name', 'location', 'title', 'comment', 'genre'] as $field)
            <input type="hidden" name="{{ $field }}" value="{{ $post[$field] }}">
        @endforeach

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
            <div class="image-preview">
                @foreach($post['images'] as $image)
                <p>{{ $image }}</p>
                    <img src="{{ asset('temp/' . basename($image)) }}" alt="Uploaded Image" class="preview-image">
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-primary">投稿する</button>
        <a href="{{ route('posts.create') }}" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection

@push('styles')
<style>
    .image-preview {
        display: flex;
        gap: 10px;
    }
    .preview-image {
        max-width: 100px;
        max-height: 100px;
    }
</style>
@endpush