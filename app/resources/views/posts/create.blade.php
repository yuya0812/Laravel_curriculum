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
        <div class="form-group">
            <label for="location">所在地</label>
            <input type="text" name="location" id="location" class="form-control" required>
        </div>
        <div id="map" style="height: 400px; width: 100%;"></div>
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
</div>
@endsection

@section('scripts')
<script>
function initMap() {
    const input = document.getElementById('location');
    const autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.setFields(['formatted_address']);

    autocomplete.addListener('place_changed', function() {
        const place = autocomplete.getPlace();
        input.value = place.formatted_address;
        const latLng = place.geometry.location;
        map.setCenter(latLng);
        marker.setPosition(latLng);
    });

    const map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 35.6895, lng: 139.6917},
        zoom: 15
    });

    const marker = new google.maps.Marker({
        map: map,
        draggable: true,
    });

    map.addListener('click', function(event) {
        marker.setPosition(event.latLng);
        geocodeLatLng(event.latLng);
    });

    marker.addListener('dragend', function(event) {
        geocodeLatLng(event.latLng);
    });

    function geocodeLatLng(latLng) {
        const geocoder = new google.maps.Geocoder();
        geocoder.geocode({'location': latLng}, function(results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    input.value = results[0].formatted_address;
                } else {
                    window.alert('No results found');
                }
            } else {
                window.alert('Geocoder failed due to: ' + status);
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    initMap();
});
</script>
@endsection





