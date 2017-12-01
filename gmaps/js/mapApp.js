var map;
var infowindow;
var bounds;
var polyline;
var mapPoints = [
  {"Name":"London", "Lat": 51.5, "Lng":-0.11},
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
  google.maps.event.addListener(map, 'click', function(e){
    if(polyline !== null && typeof polyline !== 'undefined') {
      var path = polyline.getPath();
      path.push(e.latLng);
    }
  });
  getMyLocation(map);
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
    jQuery('#detailedMap').remove();
    var detailMapWrapper = document.createElement('div');
    detailMapWrapper.id = 'detailMapWrapper';
    var detailDiv = document.createElement('div');
    detailDiv.id = 'detailedMap';
    detailMapWrapper.appendChild(detailDiv);
    jQuery('#map').append(detailMapWrapper);
    var overviewOptions = {zoom: 14, center: marker.getPosition(), mapTypeId: map.getMapTypeId(), disableDefaultUI: true};
    var detailMap = new google.maps.Map(detailDiv, overviewOptions);
    var detailMarker = new google.maps.Marker({position: marker.getPosition(), map: detailMap, clickable: false});
    var zoomInLink = jQuery('<div/>').addClass('linkWrapper');
    zoomInLink.append('<a href="#">Zoom in on large map</a>');
    zoomInLink.click(function(event){
      map.setCenter(marker.getPosition());
      map.setZoom(14);
      infowindow.close();
    });
    jQuery('#detailMapWrapper').append(zoomInLink);
    infowindow.setContent(detailMapWrapper);
    infowindow.open(map, marker);
  });
}

function drawLine() {
  var route = new google.maps.MVCArray();
  var polylineOptions = {path: route, strokeColor: '#FF0000', strokeOpacity: 0.5};
  polyline = new google.maps.Polyline(polylineOptions);
  polyline.setMap(map);
}

function drawShape() {
  var points = [
    new google.maps.LatLng(37.7671, -122.4206),
    new google.maps.LatLng(36.1131, -115.1763),
    new google.maps.LatLng(34.0485, -118.2568)
  ];
  var polygon = new google.maps.Polygon({
    paths: points,
    map: map,
    fillColor: '#FF0000',
    fillOpacity: 0.35
  });
  var outerPoints = [
    new google.maps.LatLng(37.303, -81.256),
    new google.maps.LatLng(37.303, -78.333),
    new google.maps.LatLng(35.392, -78.333),
    new google.maps.LatLng(35.392, -81.256)
  ];
  var innerPoints = [
    new google.maps.LatLng(36.705, -80.459),
    new google.maps.LatLng(36.705, -79),
    new google.maps.LatLng(35.9, -79),
    new google.maps.LatLng(35.9, -80.459)
  ];
  var donutPoints = [outerPoints, innerPoints];
  var donut = new google.maps.Polygon({
    paths: donutPoints,
    map: map
  });
  var bermudaTrianglePoints = [
    new google.maps.LatLng(25.7516, -80.1670),
    new google.maps.LatLng(32.2553, -64.8493),
    new google.maps.LatLng(18.4049, -66.0578)
  ];
  var bermudaTriangle = new google.maps.Polygon({
    paths: bermudaTrianglePoints,
    map: map,
    strokeColor: '#FF0000',
    strokeOpacity: 0.6,
    strokeWeight: 1,
    fillColor: '#FF0000',
    fillOpacity: 0.35
  });
  google.maps.event.addListener(bermudaTriangle, 'mouseover', function(){
    bermudaTriangle.setOptions({
      fillColor: '#0000FF',
      strokeColor: '#0000FF'
    });
  });
  google.maps.event.addListener(bermudaTriangle, 'mouseout', function(){
    bermudaTriangle.setOptions({
      fillColor: '#FF0000',
      strokeColor: '#FF0000'
    });
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
    if(polyline !== null && typeof polyline !== 'undefined') {
      polyline.setMap(null);
    }
  });
  jQuery('#drawLine').click(function(){
    drawLine();
  });
  jQuery('#drawShape').click(function(){
    drawShape();
  });
  jQuery('#loadMarkers').click(function(){
    placeAllMarkers();
  });
}

function getMyLocation(mapObj){
  if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position){
          var latLng = new google.maps.LatLng( position.coords.latitude, position.coords.longitude);
          var marker = new google.maps.Marker({
            position : latLng,
            map      : mapObj,
            title: "My Location"
          });
        });
    } else {
        console.log("Geolocation is not supported by this browser.");
    }
}

jQuery('document').ready(function(){
  attachEvents();
});
google.maps.event.addDomListener(window, 'load', initMap);