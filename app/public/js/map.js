// var MyLatLng = new google.maps.LatLng(35.6811673, 139.7670516);
// var Options = {
//  zoom: 15,      //地図の縮尺値
//  center: MyLatLng,    //地図の中心座標
//  mapTypeId: 'roadmap'   //地図の種類
// };
// var map = new google.maps.Map(document.getElementById('map'), Options);


let map;
        let marker;

        function initMap() {
            const defaultLocation = { lat: 35.681236, lng: 139.767125 }; // デフォルトは東京駅の座標
            map = new google.maps.Map(document.getElementById('map'), {
                center: defaultLocation,
                zoom: 15
            });

            marker = new google.maps.Marker({
                position: defaultLocation,
                map: map
            });
        }

        function geocodeAddress() {
            const address = document.getElementById('address').value;
            const geocoder = new google.maps.Geocoder();

            geocoder.geocode({ 'address': address }, function(results, status) {
                if (status === 'OK') {
                    map.setCenter(results[0].geometry.location);
                    marker.setPosition(results[0].geometry.location);
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }