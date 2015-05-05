"use strict";
var $ = jQuery.noConflict();

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Homepage map - Google
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function createHomepageGoogleMap(_latitude, _longitude, json) {
    $.get("./assets/js/_infobox.js", function() {
        gMap();
    });

    function gMap() {
        var mapCenter = new google.maps.LatLng(_latitude, _longitude);
        var mapOptions = {
            zoom: 12,
            center: mapCenter,
            disableDefaultUI: false,
            scrollwheel: true,
            styles: mapStyles,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.BOTTOM_CENTER
            },
            panControl: false,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.LARGE,
                position: google.maps.ControlPosition.RIGHT_BOTTOM
            }
        };
        var mapElement = document.getElementById('map');
        var map = new google.maps.Map(mapElement, mapOptions);
        var newMarkers = [];
        var markerClicked = 0;
        var activeMarker = false;
        var lastClicked = false;

        for (var i = 0; i < json.items.length; i++) {

            // Google map marker content -----------------------------------------------------------------------------------

            if (json.items[i].color) var color = json.items[i].color;
            else color = '';

            var markerContent = document.createElement('DIV');

            var path = ((window.location.href.match(/^(http.+\/)[^\/]+$/) != null) ? window.location.href.match(/^(http.+\/)[^\/]+$/)[1] : window.location);

            markerContent.innerHTML =
                '<div class="map-marker" data-id="' + json.items[i].id + '">' +
                '<div class="icon">' +
                '<img src="' + path + json.items[i].type + '">' +
                '</div>' +
                '</div>';

            // Create marker on the map ------------------------------------------------------------------------------------

            var marker = new RichMarker({
                position: new google.maps.LatLng(json.items[i].latitude, json.items[i].longitude),
                map: map,
                draggable: false,
                content: markerContent,
                flat: true
            });

            newMarkers.push(marker);

            // Create infobox for marker -----------------------------------------------------------------------------------

            var infoboxContent = document.createElement("div");
            var infoboxOptions = {
                content: infoboxContent,
                disableAutoPan: false,
                pixelOffset: new google.maps.Size(-18, -42),
                zIndex: null,
                alignBottom: true,
                boxClass: "infobox",
                enableEventPropagation: true,
                closeBoxMargin: "0px 0px -30px 0px",
                closeBoxURL: "assets/img/close.png",
                infoBoxClearance: new google.maps.Size(1, 1)
            };

            // Infobox HTML element ----------------------------------------------------------------------------------------

            var category = json.items[i].category;
            infoboxContent.innerHTML = drawInfobox(category, infoboxContent, json, i);

            // Create new markers ------------------------------------------------------------------------------------------

            newMarkers[i].infobox = new InfoBox(infoboxOptions);

            // Show infobox after click ------------------------------------------------------------------------------------

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    google.maps.event.addListener(map, 'click', function(event) {
                        lastClicked = newMarkers[i];
                    });
                    activeMarker = newMarkers[i];
                    if (activeMarker != lastClicked) {
                        for (var h = 0; h < newMarkers.length; h++) {
                            newMarkers[h].content.className = 'marker-loaded';
                            newMarkers[h].infobox.close();
                        }
                        newMarkers[i].infobox.open(map, this);
                        newMarkers[i].infobox.setOptions({
                            boxClass: 'fade-in-marker'
                        });
                        newMarkers[i].content.className = 'marker-active marker-loaded';
                        markerClicked = 1;
                    }
                    spottr.main.showModal();
                }
            })(marker, i));

            // Fade infobox after close is clicked -------------------------------------------------------------------------

            google.maps.event.addListener(newMarkers[i].infobox, 'closeclick', (function(marker, i) {
                return function() {
                    activeMarker = 0;
                    newMarkers[i].content.className = 'marker-loaded';
                    newMarkers[i].infobox.setOptions({
                        boxClass: 'fade-out-marker'
                    });
                }
            })(marker, i));
        }

        // Close infobox after click on map --------------------------------------------------------------------------------

        google.maps.event.addListener(map, 'click', function(event) {
            if (activeMarker != false && lastClicked != false) {
                if (markerClicked == 1) {
                    activeMarker.infobox.open(map);
                    activeMarker.infobox.setOptions({
                        boxClass: 'fade-in-marker'
                    });
                    activeMarker.content.className = 'marker-active marker-loaded';
                } else {
                    markerClicked = 0;
                    activeMarker.infobox.setOptions({
                        boxClass: 'fade-out-marker'
                    });
                    activeMarker.content.className = 'marker-loaded';
                    setTimeout(function() {
                        activeMarker.infobox.close();
                    }, 350);
                }
                markerClicked = 0;
            }
            if (activeMarker != false) {
                google.maps.event.addListener(activeMarker, 'click', function(event) {
                    markerClicked = 1;
                });
            }
            markerClicked = 0;
        });

        // Create marker clusterer -----------------------------------------------------------------------------------------

        var clusterStyles = [{
            url: 'assets/img/cluster.png',
            height: 34,
            width: 34
        }];

        var markerCluster = new MarkerClusterer(map, newMarkers, {
            styles: clusterStyles,
            maxZoom: 19
        });

        // Dynamic loading markers and data from JSON ----------------------------------------------------------------------

        google.maps.event.addListener(map, 'idle', function() {
            var visibleArray = [];
            for (var i = 0; i < json.items.length; i++) {
                if (map.getBounds().contains(newMarkers[i].getPosition())) {
                    visibleArray.push(newMarkers[i]);
                    $.each(visibleArray, function(i) {
                        setTimeout(function() {
                            if (map.getBounds().contains(visibleArray[i].getPosition())) {
                                if (!visibleArray[i].content.className) {
                                    visibleArray[i].setMap(map);
                                    visibleArray[i].content.className += 'bounce-animation marker-loaded';
                                    markerCluster.repaint();
                                }
                            }
                        }, i * 50);
                    });
                } else {
                    newMarkers[i].content.className = '';
                    newMarkers[i].setMap(null);
                }
            }

            var visibleItemsArray = [];
            $.each(json.items, function(a) {
                if (map.getBounds().contains(new google.maps.LatLng(json.items[a].latitude, json.items[a].longitude))) {
                    var category = json.items[a].category;
                    spottr.main.pushItemsToArray(json, a, category, visibleItemsArray);
                }
            });

            // Create list of items in Results sidebar ---------------------------------------------------------------------

            $('.items-list .results').html(visibleItemsArray);

            // Check if images are cached, so will not be loaded again

            $.each(json.items, function(a) {
                if (map.getBounds().contains(new google.maps.LatLng(json.items[a].latitude, json.items[a].longitude))) {
                    is_cached(json.items[a].gallery, a);
                }
            });

            // Call Rating function ----------------------------------------------------------------------------------------

            spottr.global.rating();
        });

        redrawMap('google', map);

        function is_cached(src, a) {
            var image = new Image();
            var loadedImage = $('.results li #' + json.items[a].id + ' .image');
            image.src = src;
            if (image.complete) {
                $(".results").each(function() {
                    loadedImage.removeClass('loading');
                    loadedImage.addClass('loaded');
                });
            } else {
                $(".results").each(function() {
                    $('.results li #' + json.items[a].id + ' .image').addClass('loading');
                });
                $(image).load(function() {
                    loadedImage.removeClass('loading');
                    loadedImage.addClass('loaded');
                });
            }
        }

    }
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Item Detail Map - Google
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function itemDetailMap(json) {
    var mapCenter = new google.maps.LatLng(json.latitude, json.longitude);
    var mapOptions = {
        zoom: 14,
        center: mapCenter,
        disableDefaultUI: true,
        scrollwheel: false,
        styles: mapStyles,
        panControl: false,
        zoomControl: false,
        draggable: true
    };
    var mapElement = document.getElementById('map-detail');
    var map = new google.maps.Map(mapElement, mapOptions);
    if (json.type) var icon = '<img src="' + json.type + '">';
    else icon = '';

    // Google map marker content -----------------------------------------------------------------------------------

    var markerContent = document.createElement('DIV');
    markerContent.innerHTML =
        '<div class="map-marker">' +
        '<div class="icon">' +
        icon +
        '</div>' +
        '</div>';

    // Create marker on the map ------------------------------------------------------------------------------------

    var marker = new RichMarker({
        position: new google.maps.LatLng(json.latitude, json.longitude),
        map: map,
        draggable: false,
        content: markerContent,
        flat: true
    });

    marker.content.className = 'marker-loaded';
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Functions
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// Center map to marker position if function is called (disabled) ------------------------------------------------------

function centerMapToMarker() {
    $.each(json.items, function(a) {
        if (json.items[a].id == id) {
            var _latitude = json.items[a].latitude;
            var _longitude = json.items[a].longitude;
            var mapCenter = new google.maps.LatLng(_latitude, _longitude);
            map.setCenter(mapCenter);
        }
    });
}

// Redraw map after item list is closed --------------------------------------------------------------------------------

function redrawMap(mapProvider, map) {
    $('.map .toggle-navigation').click(function() {
        $('.map-canvas').toggleClass('results-collapsed');
        $('.map-canvas .map').one("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function() {
            if (mapProvider == 'google') {
                google.maps.event.trigger(map, 'resize');
            }
        });
    });
}
