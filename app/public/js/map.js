
let map;
let marker;
var geocoder;

async function initMap() {
    
  const { Map } = await google.maps.importLibrary("maps");
  
  geocoder = new google.maps.Geocoder();
  
  const initialLatLng = { lat: 36.0652, lng: 136.2216 };


  map = new Map(document.getElementById("map"), {
    center: initialLatLng,
    zoom: 14,
  });
  // 初期のピン（マップを初期化したとき）
  marker = new google.maps.Marker({
    position: initialLatLng,
    map: map,
    draggable: true, // マーカーをドラッグ可能に
  });

  // マーカーがドラッグ終了したときのイベントリスナー
  marker.addListener('dragend', function () {
    const position = marker.getPosition();
    geocodePosition(position);
  });

  // 検索ボタンがクリックされたときのイベントリスナー
  document.getElementById("search-button").addEventListener("click", function () {
    const address = getAddressFromInputs();
    if (address) {
      geocodeAddress(address);
    }
  });

}

// 入力フィールドから住所を組み立てる関数
function getAddressFromInputs() {
  const location = document.getElementById("location").value;
  return location.trim();
}

// ピンの位置から住所を取得し、入力フィールドに設定する
function geocodePosition(position) {
  $.ajax({
    url: https://maps.googleapis.com/maps/api/geocode/json?latlng=${position.lat()},${position.lng()}&key=AIzaSyCtcHJf1h5g5mS31x-vgRCNrmWqzD1eUV0,
    method: 'GET',
    success: function (data) {
      if (data.status === 'OK' && data.results[0]) {
        const components = data.results[0].address_components;
        let addressParts = [];
        

        // すべての住所コンポーネントを結合して取得
        components.forEach(component => {
          const types = component.types;
          // 必要な住所情報を取得（市区町村、町名、番地など）
          if (
            types.includes('locality') || // 市区町村
            types.includes('administrative_area_level_2') || // 市区町村（広域）
            types.includes('sublocality') || // 町名、地域
            types.includes('sublocality_level_1') || // 小地域レベル1
            types.includes('neighborhood') || // 近隣地域
            types.includes('premise') || // 建物名
            types.includes('route') || // 路線
            types.includes('street_number') // 番地
          ) {
            addressParts.push(component.long_name);
          }
        });

        // 結合した住所をフィールドに表示
        document.getElementById("location").value = addressParts.reverse().join(' ').trim();
      } else {
        alert('住所が見つかりませんでした');
      }
    },
    error: function () {
      alert('住所取得に失敗しました');
    }
  });
}


// 入力された住所をジオコーディングしてマップにピンを指す
function geocodeAddress(address) {
  $.ajax({
    url: 'https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(address)}&key=AIzaSyCtcHJf1h5g5mS31x-vgRCNrmWqzD1eUV0',
    method: 'GET',
    success: function (data) {
      if (data.status === 'OK' && data.results[0]) {
        // 住所の位置にマップを移動
        const location = data.results[0].geometry.location;
        const latLng = new google.maps.LatLng(location.lat, location.lng);
        map.setCenter(latLng);
        marker.setPosition(latLng);
      } else {
        alert('住所が見つかりませんでした: ');
      }
    },
    error: function () {
      alert('住所取得に失敗しました');
    }
  });
}




initMap();