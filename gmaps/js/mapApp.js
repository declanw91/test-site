var map;
function initMap() {
	var infowindow = new google.maps.InfoWindow();
  var london = new google.maps.LatLng(51.5,-0.11);
  var mapDiv = document.getElementById('map');
  map = new google.maps.Map(mapDiv, {
    center: london,
    zoom: 8
  });
}
jQuery('document').ready(function(){
  jQuery('#getMapValues').click(function(){
    var valueString = '';
    valueString = valueString + '<p class="zoomLevel">Zoom level is set to: ' + map.getZoom() + '</p>';
    valueString = valueString + '<p class="mapCenter">The map center is set to: ' + map.getCenter() + '</p>';
    jQuery('#mapValues .modal-body').html(valueString);
    jQuery('#mapValues .modal').modal({backdrop: true, show: true})
  });
  jQuery('#jumpTo').click(function(){
    jQuery('#mapJumpPoints .modal').modal({backdrop: true, show: true})
  });
  jQuery('#mapJumpPoints .placebutton').click(function(){
    jQuery('.placebutton').removeClass('active').removeClass('btn-success').addClass('btn-info');
    jQuery(this).addClass('active').removeClass('btn-info').addClass('btn-success');
  });
  jQuery('#jumpMap').click(function(){
    var statueOfLiberty = new google.maps.LatLng(40.6891,-74.0445);
    var london = new google.maps.LatLng(51.5,-0.11);
    var point = jQuery('.placebutton.active').attr('data-point');
    point = parseInt(point);
    if(point === 1) {
      map.setCenter(london)
    } else if (point ===2) {
      map.setCenter(statueOfLiberty);
    }
    jQuery('#closeJumpMap').trigger('click');
  });
});
google.maps.event.addDomListener(window, 'load', initMap);