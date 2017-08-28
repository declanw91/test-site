var map;
var infowindow;
var bounds;
var mapPoints = [
  {"Name":"London", "Lat": 51.5, "Lng":-0.11},
  {"Name": "Statue Of Liberty", "Lat": 40.6891, "Lng":-74.0445}, 
  {"Name":"Manhattan","Lat":40.7257,"Lng":-74.0047},
  {"Name": "New York", "Lat": 40.756,"Lng":-73.986},
  {"Name": "Los Angeles", "Lat":34.088808, "Lng":-118.40612},
  {"Name":"Miami", "Lat":25.767368, "Lng":-80.18930},
  {"Name":"San Francisco", "Lat": 37.775,"Lng":-122.419},
  {"Name":"Seattle", "Lat": 47.620,"Lng":-122.347},
  {"Name":"Manchester", "Lat": 53.453093, "Lng":	-2.223126},
  {"Name":"Birmingham","Lat": 52.5, "Lng": -1.866667},
  {"Name":"Liverpool", "Lat": 53.386644, "Lng":	-2.91552},
  {"Name":"Leeds", "Lat": 53.816421, "Lng":	-1.526491},
  {"Name":"Cardiff", "Lat": 51.505196, "Lng":	-3.19628},
  {"Name":"Belfast", "Lat": 54.583333, "Lng":	-5.916667},
  {"Name":"Bristol", "Lat": 51.45, "Lng":	-2.6},
  {"Name": "Edinburgh", "Lat": 55.933333, "Lng": -3.25},
  {"Name": "Leicester", "Lat": 52.633333, "Lng":-1.133333},
  {"Name": "Peterborough", "Lat": 52.583333, "Lng": -0.25},
  {"Name": "Glasgow", "Lat": 55.866667, "Lng": -4.25},
  {"Name": "Basildon", "Lat": 51.566667, "Lng": 0.466667},
  {"Name": "Southend", "Lat": 51.533333, "Lng": 0.7},
  {"Name": "Oxford", "Lat": 51.75, "Lng": -1.25}
];
var defaultMapOptions = {center: new google.maps.LatLng(mapPoints[0].Lat,mapPoints[0].Lng), zoom: 8};
function initMap() {
	infowindow = new google.maps.InfoWindow();
  bounds = new google.maps.LatLngBounds();
  var london = new google.maps.LatLng(mapPoints[0].Lat,mapPoints[0].Lng);
  var mapDiv = document.getElementById('map');
  map = new google.maps.Map(mapDiv, defaultMapOptions);
}

function placeMarker(loc) {
    var latLng = new google.maps.LatLng( loc.Lat, loc.Lng);
    var marker = new google.maps.Marker({
      position : latLng,
      map      : map,
      title: loc.Name
    });
    bounds.extend(latLng);
    var infoContent = '<p>Marker for: '+loc.Name+'</p>';
    addInfoWindow(marker, infoContent);
    map.fitBounds(bounds);
}

function placeAllMarkers() {
  for(var i = 0; i < mapPoints.length; i++) {
    placeMarker(mapPoints[i]);
  }
}

function addInfoWindow(marker, content) {
	google.maps.event.addListener(marker, 'click', function(){
    //var detailDiv = jQuery('<div/>').css('width','200px').css('height','200px');
    var detailDiv = document.createElement('div');
    detailDiv.style.width = '200px';
    detailDiv.style.height = '200px';
    jQuery('#map').append(detailDiv);
    var overviewOptions = {zoom: 14, center: marker.getPosition(), mapTypeId: map.getMapTypeId(), disableDefaultUI: true};
    var detailMap = new google.maps.Map(detailDiv, overviewOptions);
    var detailMarker = new google.maps.Marker({position: marker.getPosition(), map: detailMap, clickable: false});
    infowindow.setContent(detailDiv);
    infowindow.open(map, marker);
  });
}

function attachEvents() {
  jQuery('#getMapValues').click(function(){
    var valueString = '';
    valueString = valueString + '<p class="zoomLevel">Zoom level is set to: ' + map.getZoom() + '</p>';
    valueString = valueString + '<p class="mapCenter">The map center is set to: ' + map.getCenter() + '</p>';
    jQuery('#mapValues .modal-body').html(valueString);
    jQuery('#mapValues .modal').modal({backdrop: true, show: true})
  });
  jQuery('#jumpTo').click(function(){
    jQuery('#mapJumpPoints .modal').modal({backdrop: true, show: true});
  });
  jQuery('#mapJumpPoints .placebutton').click(function(){
    jQuery('.placebutton').removeClass('active').removeClass('btn-success').addClass('btn-info');
    jQuery(this).addClass('active').removeClass('btn-info').addClass('btn-success');
  });
  jQuery('#jumpMap').click(function(){
    var selectedPoint = jQuery('.placebutton.active').attr('data-point');
    selectedPoint = parseInt(selectedPoint);
    var jumpPoint = new google.maps.LatLng(mapPoints[selectedPoint].Lat, mapPoints[selectedPoint].Lng);
    map.setCenter(jumpPoint);
    jQuery('#closeJumpMap').trigger('click');
  });
  jQuery('#setZoom').click(function(){
    for(var i = 1; i < 25; i++) {
      var option = '<option value="'+i+'">'+i+'</option>';
      jQuery('#zoomLevelSelect .modal-body select').append(option);
    }
    jQuery('#zoomLevelSelect .modal').modal({backdrop: true, show: true});
  });
  jQuery('#zoomMap').click(function(){
    var selectedZoom = jQuery('#zoomLevelSelect .modal-body select').find(":selected").text();
    selectedZoom = parseInt(selectedZoom);
    map.setZoom(selectedZoom);
    jQuery('#closeZoomMap').trigger('click');
  });
  jQuery('#resetMap').click(function(){
    map.setOptions(defaultMapOptions);
  });
  jQuery('#loadMarkers').click(function(){
    placeAllMarkers();
  });
}

jQuery('document').ready(function(){
  attachEvents();
});
google.maps.event.addDomListener(window, 'load', initMap);