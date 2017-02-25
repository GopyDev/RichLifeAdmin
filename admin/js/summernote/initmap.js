function initMap(){
    var loc_id_text = document.getElementById('locationid');
    var uluru = {lat: 34.043333, lng: -78.028333};
    if (loc_id_text != null && loc_id_text.value != 0)
    {
        if(document.getElementById('latitude').value != 0 && document.getElementById('longitude').value != 0){
            uluru = {lat:parseFloat(document.getElementById('latitude').value), lng:parseFloat(document.getElementById('longitude').value)};
        } else{
            var position_text = document.getElementById('position');
            position_text.value = "(34.043333,-78.028333)";
        }
    }

    var map = new google.maps.Map(document.getElementById('location_map'), {
        zoom: 4,
        center: uluru
    });

    var infowindow = new google.maps.InfoWindow();
    var infowindowContent = document.getElementById('location_map');
    infowindow.setContent(infowindowContent);
    var marker = new google.maps.Marker({
      map: map,
      anchorPoint: new google.maps.Point(0, -29)
    });

    var addrs = document.getElementById('address');
    //map.controls[google.maps.ControlPosition.TOP_RIGHT].push(addrs);
    var autocomplete = new google.maps.places.Autocomplete(addrs);
    autocomplete.bindTo('bounds', map);

    autocomplete.addListener('place_changed', function() {
      infowindow.close();
      marker.setVisible(false);
      var place = autocomplete.getPlace();
      if (!place.geometry) {
        // User entered the name of a Place that was not suggested and
        // pressed the Enter key, or the Place Details request failed.
        window.alert("No details available for input: '" + place.name + "'");
        return;
      }

      // If the place has a geometry, then present it on a map.
      if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
      } else {
        map.setCenter(place.geometry.location);
        map.setZoom(17);  // Why 17? Because it looks good.
      }
      marker.setPosition(place.geometry.location);
      marker.setVisible(true);

      var lat_text = document.getElementById('latitude');
      var lng_text = document.getElementById('longitude');

      lat_text.value = place.geometry.location.lat();
      lng_text.value = place.geometry.location.lng();

      var position_text = document.getElementById('position');
      position_text.value = "(" + place.geometry.location.lat() + ", " + place.geometry.location.lng() + ")";

      var address = '';
      if (place.address_components) {
        address = [
          (place.address_components[0] && place.address_components[0].short_name || ''),
          (place.address_components[1] && place.address_components[1].short_name || ''),
          (place.address_components[2] && place.address_components[2].short_name || '')
        ].join(' ');
      }

      infowindowContent.children['place-icon'].src = place.icon;
      infowindowContent.children['place-name'].textContent = place.name;
      infowindowContent.children['place-address'].textContent = address;
      infowindow.open(map, marker);
    });


    map.addListener('click', function(event) {
        marker.setMap(null);

        var latlng = event.latLng;

        var lat = latlng.lat();
        var lng = latlng.lng();

        var position = {lat:lat, lng:lng};
        marker = new google.maps.Marker({
          position: position,
          map: map
        });

        var position_text = document.getElementById('position');
        position_text.value = "(" + lat + ", " + lng + ")";

        var lat_text = document.getElementById('latitude');
        var lng_text = document.getElementById('longitude');

        lat_text.value = lat;
        lng_text.value = lng;

        $.get("http://maps.googleapis.com/maps/api/geocode/json?latlng="+lat+","+lng+"&sensor=true", function(data) {
            document.getElementById('address').value = data.results[0].formatted_address;
        });

    });
    autocomplete.setTypes(2);
    //autocomplete.setOptions({strictBounds: this.checked});
    if (navigator.geolocation && loc_id_text.value == 0) {
        navigator.geolocation.getCurrentPosition(function(position) {
          var pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };

          map.setCenter(pos);

          marker.setMap(null);

          var lat = position.coords.latitude;
          var lng = position.coords.longitude;

          var position = {lat:lat, lng:lng};
          marker = new google.maps.Marker({
            position: position,
            map: map
          });

          var position_text = document.getElementById('position');
          position_text.value = "(" + lat + ", " + lng + ")";

          var lat_text = document.getElementById('latitude');
          var lng_text = document.getElementById('longitude');

          lat_text.value = lat;
          lng_text.value = lng;
        }, function() {
        });
    }
}