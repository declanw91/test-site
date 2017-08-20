var map;
var mapPoints = [{"Name":"London", "Lat": 51.5, "Lng":-0.11},{"Name": "StatueOfLiberty", "Lat": 40.6891, "Lng":-74.0445}];
var defaultMapOptions = {center: new google.maps.LatLng(mapPoints[0].Lat,mapPoints[0].Lng), zoom: 8};
function initMap() {
	var infowindow = new google.maps.InfoWindow();
  var london = new google.maps.LatLng(mapPoints[0].Lat,mapPoints[0].Lng);
  var mapDiv = document.getElementById('map');
  map = new google.maps.Map(mapDiv, defaultMapOptions);
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
}

jQuery('document').ready(function(){
  attachEvents();
});
google.maps.event.addDomListener(window, 'load', initMap);