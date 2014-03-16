
function initializeMaps() {
    var mapOptions = {
        center: new google.maps.LatLng(45.776, 3.085),
        zoom: 14
    };
    var map = new google.maps.Map(document.getElementById("map-canvas"),
        mapOptions);
}

google.maps.event.addDomListener(window, 'load', initializeMaps);