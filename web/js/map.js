MAPS = {
    marker: null,
    map: null,

    initializeMaps: function initializeMaps() {
        var mapOptions = {
            center: new google.maps.LatLng(45.776, 3.085),
            zoom: 14
        };
        MAPS.map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
        google.maps.event.addListener(MAPS.map, 'click', function(event) {
            MAPS.moveMarker(event.latLng);
        });
    },

    moveMarker: function moveMarker(latLng) {

        if (null === MAPS.marker) {
            MAPS.marker = new google.maps.Marker({
                position: latLng,
                map: MAPS.map
            });
        } else {
            MAPS.marker.setPosition(latLng);
        }

        MAPS.updateFormAddress(MAPS.marker.position);
    },

    updateFormAddress: function updateFormAddress(position) {
        var url = '/geocoder/location/'+position.lat()+','+position.lng();
        $.getJSON( url, function(data){
            $('#street').val(data['street']);
            $('#city').val(data['city']);
            $('#postalCode').val(data['postalCode']);
            $('#country').val(data['country']);
        });
    }
}

google.maps.event.addDomListener(window, 'load', MAPS.initializeMaps);