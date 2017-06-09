$( document ).ready(function() {
  var minZoomLevel = 14;
  var map = null;
  var markers = [];
  var filters = {
    "provider_first_name":"",
    "provider_last_name":"",
  };
  var iconMarkerUrl = url + "img/marker.png";
  $( "#clear" ).on( "click", function() {
    filters = {} ;
    $( ".form-control" ).val('');
    getRadius();
  });
  $( "#find" ).on( "click", function() {
    filters.provider_first_name = $( "#firstName" ).val();
    filters.provider_last_name = $( "#lastName" ).val();

    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(null);
    }
    markers = [];
    getRadius();
  });
  initMap();
  function initMap(){
    if ( navigator.geolocation ) {
        $("#map-canvas").before('<input placeholder="Search" class="controls" type="text" id="input_MapLocation_search">') ; // No geolocation support, show default map

        function success(pos) {
            // Location found, show map with these coordinates
            drawMap(new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude));
          
        }

        function fail(error) {
            drawMap(new google.maps.LatLng(40.742244,-73.952784));  // Failed to find location, show default map
        }

        // Find the users current position.  Cache the location for 5 minutes, timeout after 6 seconds
        navigator.geolocation.getCurrentPosition(success, fail, {maximumAge: 500000, enableHighAccuracy:true, timeout: 6000});
    } else {
        drawMap(defaultLatLng);
    }
  }
    function drawMap(variable){
        var latlng = variable;

        var styles = [
            {
                stylers: [
                    { saturation: -70 }
                ]
            },
            {
                featureType: "building",
                elementType: "labels"
            },
            {
                featureType: "poi", //points of interest
                stylers: [
                    { hue: '#0044ff' }
                ]
            }
        ];
        
        var myOptions = {
            zoom: 17,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
            mapTypeControl: false,
            styles: styles,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL
            }
        };

        map = new google.maps.Map(document.getElementById('map-canvas'), myOptions);
        //$("#map-canvas").prepend('<span style="width: 10px;height: 10px;left: 5px;right:5px;top:5px;bottom: 5px;margin: auto;position: absolute;background: url(https://agero.waterfield.com/Agero/Images/little-red-corvette.png);z-index: 999;"></span>') ;

        // var image = 'enter path to image here';
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            title:"My Site",
            visible: false,
        // icon: image // enable if using image for marker
        });
        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow({
            disableAutoPan: true
        });
        marker.bindTo('position', map, 'center');
        geocodeLatLng(geocoder, map, infowindow, map.getCenter(), marker);

        google.maps.event.addListener(map, 'idle', function() {
            if (infowindow) {
                infowindow.close();
            }
            var bounds = map.getBounds();
            var ne = bounds.getNorthEast(); // LatLng of the north-east corner
            var sw = bounds.getSouthWest(); // LatLng of the south-west corder
            
            getMarkers(sw, ne);
            geocodeLatLng(geocoder, map, infowindow, map.getCenter(), marker);
        });
        google.maps.event.addListener(map, 'zoom_changed', function() {
          if (map.getZoom() < minZoomLevel) map.setZoom(minZoomLevel);
        });

        var input = document.getElementById('input_MapLocation_search');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

        /*  // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];*/

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            /*markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));*/

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
      
    }
    function geocodeLatLng(geocoder, map, infowindow, latLng, marker) {
        var address = "unknow";
        geocoder.geocode({'location': latLng}, function(results, status) {
            if (status === 'OK') {
                if (results[1]) {
                    console.log(latLng.toUrlValue(6));
                    //console.log(results[0].formatted_address);
                    address = results[0].formatted_address;
                    //infowindow.setContent(results[0].formatted_address);
                    //infowindow.open(map, marker);
                } 
            }
        });
      }
      function getRadius(){
        var bounds = map.getBounds();
        var ne = bounds.getNorthEast(); // LatLng of the north-east corner
        var sw = bounds.getSouthWest(); // LatLng of the south-west corder  
        getMarkers(sw, ne);
      }
      function getMarkers(mixLatLng, maxLatLng) {
        var maxLat = maxLatLng.lat();
        var minLat = mixLatLng.lat();
        var maxLng = maxLatLng.lng();
        var minLng = mixLatLng.lng();
        $.ajax({
          dataType: 'json',
          type:'POST',
          url: url+'api/getRadius.php',
          data: {minLat:minLat, maxLat:maxLat,minLng:minLng,maxLng:maxLng, filters: btoa(JSON.stringify(filters))}
        }).done(function(data){
          //console.log(data.data)
          if(data.data.length > 0){
            $.each( data.data, function( key, value ) {
              var parsedPosition = new google.maps.LatLng(value.provider_lat,value.provider_long);
              var marker = new google.maps.Marker({
                position: parsedPosition,
                map: map,
                //title: value.provider_first_name + "\n" + value.provider_last_name,
                icon: iconMarkerUrl,
                //label: value.provider_level
              });
              markers.push(marker);
              var contentString = 
                '<div id="content">'+
                '<div id="siteNotice">'+
                '</div>'+
                '<b>'+checkField(value.provider_first_name)+' '+checkField(value.provider_last_name)+'</b><br>'+
                '<div id="bodyContent">'+
                '<p><b>NPI: </b>'+checkField(value.npi)+'<br>'+
                '<b>Adress: </b>'+checkField(value.provider_address)+'</p>' +
                '</div>';
              var infowindow = new google.maps.InfoWindow({
                content: contentString
              });
              marker.addListener('click', function() {
                infowindow.open(map, marker);
              });
            });
          }
        });

      }
      function checkField(val){
        if (val === undefined || val == null || val.length <= 0)
          return ""
        return val;
      }
});