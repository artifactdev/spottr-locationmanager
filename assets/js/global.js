var path = ((window.location.href.match(/^(http.+\/)[^\/]+$/) != null) ? window.location.href.match(/^(http.+\/)[^\/]+$/)[1] : window.location);

// Default,
var _latitude = 51.0545032;
var _longitude = 13.7416008;

$(document).ready(function() {
    var cookieValue = $.cookie("X-SPOTTR-USER");
    if (cookieValue === undefined || cookieValue == null || cookieValue == "null") {
        return;
    }
    cookieValue = $.parseJSON(cookieValue);
    _longitude = cookieValue.longitude;
    _latitude = cookieValue.latitude;
});

var mapStyles = [{
    "featureType": "road",
    "elementType": "labels",
    "stylers": [{
        "visibility": "simplified"
    }, {
        "lightness": 20
    }]
}, {
    "featureType": "administrative.land_parcel",
    "elementType": "all",
    "stylers": [{
        "visibility": "off"
    }]
}, {
    "featureType": "landscape.man_made",
    "elementType": "all",
    "stylers": [{
        "visibility": "on"
    }]
}, {
    "featureType": "transit",
    "elementType": "all",
    "stylers": [{
        "saturation": -100
    }, {
        "visibility": "on"
    }, {
        "lightness": 10
    }]
}, {
    "featureType": "road.local",
    "elementType": "all",
    "stylers": [{
        "visibility": "on"
    }]
}, {
    "featureType": "road.local",
    "elementType": "all",
    "stylers": [{
        "visibility": "on"
    }]
}, {
    "featureType": "road.highway",
    "elementType": "labels",
    "stylers": [{
        "visibility": "simplified"
    }]
}, {
    "featureType": "poi",
    "elementType": "labels",
    "stylers": [{
        "visibility": "off"
    }]
}, {
    "featureType": "road.arterial",
    "elementType": "labels",
    "stylers": [{
        "visibility": "on"
    }, {
        "lightness": 50
    }]
}, {
    "featureType": "water",
    "elementType": "all",
    "stylers": [{
        "hue": "#a1cdfc"
    }, {
        "saturation": 30
    }, {
        "lightness": 49
    }]
}, {
    "featureType": "road.highway",
    "elementType": "geometry",
    "stylers": [{
        "hue": "#f49935"
    }]
}, {
    "featureType": "road.arterial",
    "elementType": "geometry",
    "stylers": [{
        "hue": "#fad959"
    }]
}, {
    featureType: 'road.highway',
    elementType: 'all',
    stylers: [{
        hue: '#dddbd7'
    }, {
        saturation: -92
    }, {
        lightness: 60
    }, {
        visibility: 'on'
    }]
}, {
    featureType: 'landscape.natural',
    elementType: 'all',
    stylers: [{
        hue: '#c8c6c3'
    }, {
        saturation: -71
    }, {
        lightness: -18
    }, {
        visibility: 'on'
    }]
}, {
    featureType: 'poi',
    elementType: 'all',
    stylers: [{
        hue: '#d9d5cd'
    }, {
        saturation: -70
    }, {
        lightness: 20
    }, {
        visibility: 'on'
    }]
}];

;
var spottr = {};;
(function($, window, undefined) {
    spottr.global = {
        /**
         * general modal handling opens the modal with the given modalID
         * @param  {ID} modalID the given modal ID
         */
        modalHandler: function(modalID) {
            var modal = modalID;

            modal.openModal();
            modal.find('.modal-content').scrollTop(0);

            var modalForm = modal.find('form');
            var hasForm = modalForm.length;

            if (hasForm >= 1) {
                modalForm.validate();
            }
        },

        /**
         * converts select elements to bootstrap selects
         */
        fancySelect: function() {
            $(document).ready(function() {
                $('select').material_select();
            });
        },

        /**
         * handles the menuItems and shows them where they should appear
         */
        menuItemHandler: function() {
            var isVerwaltung = $('body.page-verwaltung').length;
            var isHome = $('body.page-homepage').length;

            if (isVerwaltung) {
                $('#useradmin-link').removeClass('hide');
            }
            if (isHome) {
                $('#admin-link').removeClass('hide');
            }
            if (isHome || isVerwaltung) {
                $('.submit-item ').removeClass('hide');
            }
        },

        /**
         * loads the exif data of location image in formelements on location edit and add
         */
        loadExifData: function() {
            var someCallback = function(exifObject) {

                if (!exifObject) {
                    return
                }
                var latitude = exifObject.GPSLatitude;
                var longitude = exifObject.GPSLongitude;
                var aperture = exifObject.ApertureValue;
                //var date = exifObject.DateTimeOriginal;
                var focal = exifObject.FocalLength;
                var iso = exifObject.ISOSpeedRatings;

                if (focal === undefined || focal === 'NaN') {
                    var focal = 0;
                }

                var focalRounded = Math.round(focal);

                $('#lng').val(longitude);
                $('#lat').val(latitude);
                $('#aperture').val(aperture);
                //$('#date').val(date);
                $('#focal').val(focalRounded);
                $('#iso').val(iso);

                // Uncomment the line below to examine the
                // EXIF object in console to read other values
                console.log(exifObject);

            };

            try {
                $('#file').change(function() {
                    $(this).fileExif(someCallback);
                });
            } catch (e) {
                console.log(e);
            }
        },

        searchFilter: function() {

        },

        /**
         * shows the add location modal and initialises all data and functions which are needed there
         * also it handles the submit of a new location
         */
        submitItem: function() {
            var addModal = $('body').find('#add-modal');
            var addForm = $('#add-form');

            $('.submit-item').on('click', function() {
                spottr.global.modalHandler(addModal);
                spottr.global.fancySelect();
            });

            spottr.global.loadExifData();

            $("#geocomplete-search").geocomplete({
                details: "#add-form",
                types: ["geocode", "establishment"],
                detailsAttribute: "data-geo"
            });


            spottr.global.markerToPosition(addForm, '#map-add');

            $('.getLocation').on('click', function(e){
                e.preventDefault;
                console.log('clicked');
                spottr.global.getLocation(addForm);
            });

            addModal.find('#add-form').on('submit', function(e) {
                e.preventDefault();
                spottr.global.loading();
                addForm.validate();
                if (addForm.valid()) {
                    AjaxHandler.request({
                        method: "POST",
                        cache: false,
                        url: $(this).attr('action'),
                        data: $(this).serializeObject(),
                        success: function(data) {
                            var form = $('#add-form-image');
                            spottr.global.submitImage(data.id, form);
                        },
                        error: function(data) {
                            spottr.global.error('Fehler beim hinzufügen');
                            console.log(data);
                        }
                    });
                }
            });

            // fix for strange loading issue
            $('body').find('.submit-item').on('click', function() {
                setTimeout(function() {
                    spottr.global.markerToPosition(addForm, '#map-add');
                }, 500);
            });
        },

        /**
         * gets the current location from gps
         * @return {[type]} [description]
         */
        getLocation: function(addForm){

            function showLocation(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                console.log(latitude);
                console.log(longitude);
                console.log(position);

                spottr.global.markerToPosition(addForm, '#map-add',latitude,longitude);

                var formLat = $(addForm).find('#lat');
                var formLng = $(addForm).find('#lng');

                formLat.val(latitude);
                formLng.val(longitude);

             }

             function errorHandler(err) {
                if(err.code == 1) {
                   alert("Error: Access is denied!");
                }else if( err.code == 2) {
                   alert("Error: Position is unavailable!");
                }
             }

            if( navigator.geolocation) {
                var options = { enableHighAccuracy: true, maximumAge: 100, timeout: 60000 };
                var watchID = navigator.geolocation.getCurrentPosition(showLocation, errorHandler, options);
                var timeout = setTimeout( function() { navigator.geolocation.clearWatch( watchID ); }, 5000 );
            } else {
               alert("Sorry, browser does not support geolocation!");
            }
         },

        /**
         * submits the location image to the backend on success the window will be reloaded
         * @param  {ID} locationId the given locationID where image should be added to
         * @param  {ID} attForm    The form where it gets the image from
         */
        submitImage: function(locationId, attForm) {
            var $file = attForm.find("input[type='file']");
            if ($file.val() == "" || locationId == undefined) {
                location.reload(true);
                return;
            }

            attForm.attr("action", "rest-api/locations/" + locationId + "/image");

            var $iframe = $("#js_iframe_location_attachment");
            $iframe.unbind().load(function(event) {
                event.preventDefault();
                spottr.global.loading();
                location.reload(true);
            });

            attForm.submit();
        },

        /**
         * adds a marker to a given map or handles the setting of a marker
         * @param  {Object} form      The form where it should fired
         * @param  {ID} element   The element where the map should be added
         * @param  {String} latitude  The Latitude if an marker should be shown on initialize
         * @param  {String} longitude The Longitude if an marker should be shown on initialize
         */
        markerToPosition: function(form, element, latitude, longitude) {
            var map;

            $(document).ready(function() {

                if (latitude != undefined && longitude != undefined) {
                    _latitude = latitude;
                    _longitude = longitude;
                }

                var map = new GMaps({
                    div: element,
                    lat: _latitude,
                    lng: _longitude,
                    width: '500px',
                    height: '250px',
                    zoom: 12,
                    styles: mapStyles,
                    zoomControl: true,
                    zoomControlOpt: {
                        style: 'SMALL',
                        position: 'TOP_RIGHT'
                    },
                    panControl: false
                });

                if (latitude === undefined && longitude === undefined) {
                    GMaps.on('click', map.map, function(event) {
                        var index = map.markers.length;
                        var lat = event.latLng.lat();
                        var lng = event.latLng.lng();
                        var formLat = $(form).find('#lat');
                        var formLng = $(form).find('#lng');
                        var completeInput = $(form).find('#geocomplete-search');

                        if (index <= 0) {
                            var marker;
                            marker = map.addMarker({
                                lat: lat,
                                lng: lng,
                                draggable: true
                            });
                            formLat.attr('value', lat);
                            formLng.attr('value', lng);
                            completeInput.attr('disabled', 'disabled');
                        } else {
                            spottr.global.error('Bitte den Marker zur Position ziehen.',3e3);
                        }

                        google.maps.event.addListener(
                            marker,
                            'drag',
                            function() {
                                formLat.attr('value', marker.position.lat());
                                formLng.attr('value', marker.position.lng());
                            }
                        );

                        $('body').find('.modal-close').on('click', function() {
                            completeInput.removeAttr('disabled');
                            map.removeMarkers();
                            formLat.attr('value', '');
                            formLng.attr('value', '');
                        });
                    });

                } else {
                    var marker;
                    marker = map.addMarker({
                        lat: latitude,
                        lng: longitude,
                        draggable: false
                    });
                }
            });

        },

        /**
         * Sets input widths for searchbar
         */
        setInputsWidth: function() {
            var $inputRow = $('.search-bar.horizontal .input-row');
            for (var i = 0; i < $inputRow.length; i++) {
                if ($inputRow.find($('button[type="submit"]')).length) {
                    $inputRow.find('.form-group:last').css('width', 'initial');
                }
            }

            var searchBar = $('.search-bar.horizontal .form-group');
            for (var a = 0; a < searchBar.length; a++) {
                if (searchBar.length <= (1 + 1)) {
                    $('.main-search').addClass('inputs-1');
                } else if (searchBar.length <= (2 + 1)) {
                    $('.main-search').addClass('inputs-2');
                } else if (searchBar.length <= (3 + 1)) {
                    $('.main-search').addClass('inputs-3');
                } else if (searchBar.length <= (4 + 1)) {
                    $('.main-search').addClass('inputs-4');
                } else if (searchBar.length <= (5 + 1)) {
                    $('.main-search').addClass('inputs-5');
                } else {
                    $('.main-search').addClass('inputs-4');
                }
                if ($('.search-bar.horizontal .form-group label').length > 0) {
                    $('.search-bar.horizontal .form-group:last-child button').css('margin-top', 25)
                }
            }
        },

        /**
         * goes to index page
         */
        goToIndex: function(currentUser) {
            $.cookie("X-SPOTTR-USER", JSON.stringify(currentUser), {
                expires: (1 / 24),
                path: "/"
            });
            var currentPage = window.location.href;
            var indexPath = path + 'index.php';
            var loginPath = path + 'login.php';
            if (currentPage === loginPath) {
                window.location.replace(indexPath);
            }
        },

        /**
         * goes to login page
         */
        goToLogin: function() {
            var currentPage = window.location.href;
            var loginPath = path + 'login.php';
            if (currentPage != loginPath) {
                window.location.replace(loginPath);
            };
            spottr.global.logout();
        },

        /**
         * deletes the authentication cookie if logout button is clicked and reloads the page
         */
        logout: function() {
            var currentPage = window.location.href;
            var loginPath = path + 'login.php';
            if (currentPage != loginPath) {
                var logoutButton = $('body').find('#logout');
                logoutButton.removeClass('hide');
                logoutButton.on('click', function() {
                    AuthenticationHelper.deleteAuthenticationToken();
                    window.location.reload();
                });

            }
        },

        /**
         * adds a loadingspinner
         */
        loading: function(duration) {
            var durationTime = null;

            if (duration != undefined) {
                durationTime = duration;
            }

            var opts = {
                lines: 13, // The number of lines to draw
                length: 11, // The length of each line
                width: 5, // The line thickness
                radius: 17, // The radius of the inner circle
                corners: 1, // Corner roundness (0..1)
                rotate: 0, // The rotation offset
                color: '#FFF', // #rgb or #rrggbb
                speed: 1, // Rounds per second
                trail: 60, // Afterglow percentage
                shadow: false, // Whether to render a shadow
                hwaccel: false, // Whether to use hardware acceleration
                className: 'spinner', // The CSS class to assign to the spinner
                zIndex: 2e9, // The z-index (defaults to 2000000000)
                top: 'auto', // Top position relative to parent in px
                left: 'auto' // Left position relative to parent in px
            };
            var target = document.createElement("div");
            document.body.appendChild(target);
            Materialize.toast('Loading', 3000);
            return false;
        },

        /**
         * shows an error alert
         */

        error: function(message,duration) {
            var errorMessage = 'Error!',
                durationTime = 4000;

            if (message != undefined) {
                errorMessage = message;
            }

            if (duration != undefined) {
                durationTime = duration;
            }

            Materialize.toast(errorMessage, durationTime);
            return false;
        },

        /**
         * shows a success alert
         */

        success: function(message,duration) {
            var successMessage = 'Success!',
                durationTime = 3000;

            if (message != undefined) {
                successMessage = message;
            }

            if (duration != undefined) {
                durationTime = duration;
            }

            Materialize.toast(successMessage, durationTime);
            return false;
        }

    };
})(jQuery, this);
