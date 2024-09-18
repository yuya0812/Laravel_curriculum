
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

}

function geocodePosition(position) {
  geocoder.geocode({ location: position }, function (results, status) {
    if (status === 'OK' && results[0]) {
      const components = results[0].address_components;
      let postalCode = '';
      let prefecture = '';
      let city = '';
      let other = '';

      // 各コンポーネントをループして住所情報を抽出
      components.forEach(component => {
        const types = component.types;
        
        if (types.includes('postal_code')) {
          postalCode = component.long_name; // 郵便番号
        }
        if (types.includes('administrative_area_level_1')) {
          prefecture = component.long_name; // 都道府県
        }
        if (types.includes('locality') || types.includes('sublocality')) {
          city = component.long_name; // 市区町村
        }
        if (types.includes('premise') || types.includes('subpremise') || types.includes('route')) {
          other += component.long_name + ' '; // マンション名やビル名など
        }
      });

      // 各HTML要素に値をセットする
      document.getElementById("postal-code").value = postalCode;
      document.getElementById("prefecture").value = prefecture;
      document.getElementById("city").value = city;
      document.getElementById("other").value = other.trim();
    } else {
      alert('住所が見つかりませんでした');
    }
  });
}




initMap();

