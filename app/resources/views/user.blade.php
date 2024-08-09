@extends('layouts.app')

@section('title', 'マイページ')

@section('content')
<div class="container">
    <h1>マイページ</h1>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">新規投稿</a>
    <!-- その他のマイページのコンテンツ -->
</div>
@endsection
