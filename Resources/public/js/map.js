$.fn.gmap = function(settings) {


  console.log("Loading map", settings);
  var lat = $(settings.lat);
  var lng = $(settings.lng);
  var canvas = this;
  var map = null;
  var marker = null;

  var mapOptions = {
    zoom: 8,
    scrollwheel: false
  };

  canvas.centerMap = function() {

    console.log(lat, lng);
    if(!lat.val().match(/^-?[0-9\.]*$/) || !lng.val().match(/^-?[0-9\.]*$/)) {
      console.log("Invalid lat, lng", lat.val(), lng.val());
      return;

    }

    var location = new google.maps.LatLng(parseFloat(lat.val() ? lat.val() : 0), parseFloat(lng.val() ? lng.val() : 0));
    
    map.setCenter(location);
    marker.setPosition(location);
    google.maps.event.trigger(map, 'resize');

    if(settings && settings.callbacks && settings.callbacks.change) {

      settings.callbacks.change(map, marker);

    }

  }

  canvas.getMap = function() {

    return map;

  }

  canvas.getMarker = function() {

    return marker;

  }

  function initialize() {

    console.log("map", canvas);
    map = new google.maps.Map(canvas[0],
    mapOptions);
    console.log("map2", canvas);
    marker = new google.maps.Marker({
        map: map,
        title: 'Hello',
        draggable: true
    });

    canvas.centerMap();
    
    google.maps.event.addListener(marker, 'drag', function(data) {

        console.log("Drag",  data.latLng.lat(), data.latLng.toString());
        lat.val(data.latLng.lat());
        lng.val(data.latLng.lng());

        if(settings && settings.callbacks && settings.callbacks.change) {

          settings.callbacks.change(map, marker);

        }

      });

    var geocoder = new google.maps.Geocoder();

  }

  function setLocation(lt, lg) {

      lat.val(lt);
      lng.val(lg);
      canvas.centerMap(lt, lg);

  }

  initialize();

  var validateLatLngKey = function(event) {

    console.log(event);

  }

  var cancelLng = null;
  var cancelLat = null;
  lng.keyup(function() { 

    if(cancelLng) clearTimeout(cancelLng);
    cancelLng = setTimeout(function() { canvas.centerMap();}, 1000); 

  });
  lat.keyup(function() { 

    if(cancelLng) clearTimeout(cancelLng);
    cancelLng = setTimeout(function() { canvas.centerMap();}, 1000); 


  });



}

