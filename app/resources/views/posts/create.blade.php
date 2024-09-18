@extends('layouts.app')

@section('title', '新規投稿')

@section('content')

<div class="container">
    <h1>新規投稿</h1>
    <form action="{{ route('posts.confirm') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="category">カテゴリー</label>
            <select name="category" id="category" class="form-control" required>
                <option value="グルメ">グルメ</option>
                <option value="観光スポット">観光スポット</option>
                <option value="イベント">イベント</option>
            </select>
        </div>
        <div class="form-group">
            <label for="store_name">店名</label>
            <input type="text" name="store_name" id="store_name" class="form-control" required>
        </div>
        <!-- <div class="form-group">
            <label for="location">所在地</label>
            <input type="text" name="location" id="location" class="form-control" required>
        </div> -->

        <!-- Googleマップ -->
        <label>郵便番号:</label>
        <input id="postal-code" type="text" placeholder="郵便番号">
        <br>
        <label>都道府県:</label>
        <input id="prefecture" type="text" placeholder="都道府県">
        <br>
        <label>市区町村:</label>
        <input id="city" type="text" placeholder="市区町村">
        <br>
        <label>その他  :</label>
        <input id="other" type="text" placeholder="マンション名やビル名など">
        <br>
         
        
        <div id="map" style="height: 400px; width: 100%;"></div>
        <!-- Googleマップ終わり -->

         <div class="form-group">
            <label for="title">投稿タイトル</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="comment">コメント</label>
            <textarea name="comment" id="comment" class="form-control" rows="3" maxlength="250" required></textarea>
        </div>
        <div class="form-group">
            <label for="genre">ジャンル (ハッシュタグ)</label>
            <input type="text" name="genre" id="genre" class="form-control">
        </div>
        <div class="form-group">
            <label for="images">画像 (最大10枚)</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple>
        </div>
        <button type="submit" class="btn btn-primary">確認画面へ</button>
    </form>
    @if ($errors->has('images'))
    <div class="alert alert-danger">
        {{ $errors->first('images') }}
    </div>
    @endif
</div>
@endsection