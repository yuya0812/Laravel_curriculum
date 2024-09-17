
let map;
let marker;
var geocoder;

async function initMap() {
  
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
    draggable: true // マーカーをドラッグ可能に
  });


  document.getElementById("search-button").addEventListener("click", function () {
        const address = document.getElementById("search-box").value;
        if (address) {
            geocodeAddress(address);
      }
  });
}

initMap();