var path = ((window.location.href.match(/^(http.+\/)[^\/]+$/) != null) ? window.location.href.match(/^(http.+\/)[^\/]+$/)[1] : window.location);
var _latitude = 51.0545032;
var _longitude = 13.7416008;
;var spottr = {};
;(function ($, window, undefined) {
    spottr.global = {
        showEditModal: function () {
            $('body').on('click','.btn-edit', function(id) {
                var metaItem = $(this).closest('.item').find('.meta-element');
                var modal = $('#edit-modal');
                spottr.global.modalHandler(modal);
                spottr.administration.editModal(metaItem);
                 
            });
        },

        modalHandler: function (modalID) {
            var modal = modalID;

            modal.removeClass('hide');
            modal.addClass('fade-in');

            var modalForm = modal.find('form');
            var hasForm = modalForm.length;

            if (hasForm >= 1) {
                modalForm.validate();
            }
            
            modal.find('.modal-close').on('click', function(){

                modal.addClass('hide');
                modal.removeClass('fade-in');

                if (hasForm >= 1) {
                    modalForm.validate().resetForm();
                    modalForm.find('.tooltip').addClass('hide');
                }
            });
        },

        fancySelect: function () {
            var select = $('select');
            if (select.length > 0 ){
                select.selectpicker();
            }
            var bootstrapSelect = $('.bootstrap-select');
            var dropDownMenu = $('.dropdown-menu');
            bootstrapSelect.on('shown.bs.dropdown', function () {
                dropDownMenu.removeClass('animation-fade-out');
                dropDownMenu.addClass('animation-fade-in');
            });
            bootstrapSelect.on('hide.bs.dropdown', function () {
                dropDownMenu.removeClass('animation-fade-in');
                dropDownMenu.addClass('animation-fade-out');
            });
            bootstrapSelect.on('hidden.bs.dropdown', function () {
                var _this = $(this);
                $(_this).addClass('open');
                setTimeout(function() {
                    $(_this).removeClass('open');
                }, 100);
            });
        },

        menuItemHandler: function () {
            var isVerwaltung = $('body.page-verwaltung').length;
            var isHome = $('body.page-homepage').length;

            if (isVerwaltung) {
                $('#useradmin-link').removeClass('hide');
            }
            if (isHome) {
                $('#admin-link').removeClass('hide');
            }
        },

        loadExifData: function () {
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

                $('#lng').val(longitude);
                $('#lat').val(latitude);
                $('#aperture').val(aperture);
                //$('#date').val(date);
                $('#focal').val(focal);
                $('#iso').val(iso);

                // Uncomment the line below to examine the
                // EXIF object in console to read other values
                console.log(exifObject);

            };

            try {
                $('#file').change(function() {
                    $(this).fileExif(someCallback);
                });
            }
            catch (e) {
                console.log(e);
            }
        },

        searchFilter: function () {
            
        },

        submitItem: function () {
            var addModal = $('body').find('#add-modal');
            var addForm = $('#add-form');

            $('.submit-item').on('click', function(){
                spottr.global.modalHandler(addModal);
                spottr.global.fancySelect();
            });

            spottr.global.loadExifData();
            spottr.global.markerToPosition(addForm,'#map-add');

            $("#geocomplete-search").geocomplete({
              details: "#add-form",
              types: ["geocode", "establishment"],
              detailsAttribute: "data-geo"
            });

            addModal.find('#add-form').on('submit',function(e){
                e.preventDefault();
                AjaxHandler.request({
                    method   : "POST",
                    cache    : false,
                    url      : $(this).attr('action'),
                    data     : $(this).serializeObject(),
                    success  : function(data) {
                        var form = $('#add-form-image');
                        spottr.global.submitImage(data.id,form);
                    },
                        error    : function(data) {
                            console.log(data);
                        } 
                });
            });
        },

        submitImage: function (locationId, attForm) {
            var $file = attForm.find("input[type='file']");
            if ($file.val() == "" || locationId == undefined) {
                location.reload(true);
                return;
            }

            attForm.attr("action", "rest-api/locations/" + locationId + "/image");
            
            var $iframe = $("#js_iframe_location_attachment");
            $iframe.unbind().load(function(event) {
                event.preventDefault();
                location.reload(true);
            });
         
            attForm.submit();
        },

        markerToPosition: function (form,element) {
            var map;

            $(document).ready(function(){

                var map = new GMaps({
                    div: element,
                    lat: _latitude,
                    lng: _longitude,
                    width: '500px',
                    height: '250px',
                    zoom: 12,
                    zoomControl: true,
                    zoomControlOpt: {
                        style: 'SMALL',
                        position: 'TOP_RIGHT'
                    },
                    panControl: false
                });

              GMaps.on('click', map.map, function(event) {
                var index = map.markers.length;
                var lat = event.latLng.lat();
                var lng = event.latLng.lng();
                var formLat = $(form).find('#lat');
                var formLng = $(form).find('#lng');
                var completeInput = $(form).find('#geocomplete-search');

                console.log(lat);
                console.log(lng);

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
                    console.log('Bitte den Marker an gewünschte Position ziehen.');
                }

                google.maps.event.addListener(
                    marker,
                    'drag',
                    function() {
                        formLat.attr('value', marker.position.lat());
                        formLng.attr('value', marker.position.lng());
                    }
                );

                $('body').find('.modal-close').on('click', function(){
                    completeInput.removeAttr('disabled');
                    map.removeMarkers();
                    formLat.attr('value','');
                    formLng.attr('value','');
                });
              });
            });
                 
        },

        setInputsWidth: function (){
            var $inputRow = $('.search-bar.horizontal .input-row');
            for( var i=0; i<$inputRow.length; i++ ){
                if( $inputRow.find( $('button[type="submit"]') ).length ){
                    $inputRow.find('.form-group:last').css('width','initial');
                }
            }

            var searchBar =  $('.search-bar.horizontal .form-group');
            for( var a=0; a<searchBar.length; a++ ){
                if( searchBar.length <= ( 1 + 1 ) ){
                    $('.main-search').addClass('inputs-1');
                }
                else if( searchBar.length <= ( 2 + 1 ) ){
                    $('.main-search').addClass('inputs-2');
                }
                else if( searchBar.length <= ( 3 + 1 ) ){
                    $('.main-search').addClass('inputs-3');
                }
                else if( searchBar.length <= ( 4 + 1 ) ){
                    $('.main-search').addClass('inputs-4');
                }
                else if( searchBar.length <= ( 5 + 1 ) ){
                    $('.main-search').addClass('inputs-5');
                }
                else {
                    $('.main-search').addClass('inputs-4');
                }
                if( $('.search-bar.horizontal .form-group label').length > 0 ){
                    $('.search-bar.horizontal .form-group:last-child button').css('margin-top', 25)
                }
            }
        },
        goToIndex: function () {
            var currentPage = window.location.href;
            var indexPath = path + 'index.php';
            var loginPath = path + 'login.php';
            if (currentPage === loginPath) {
                window.location.replace(indexPath);
            }
        },

        goToLogin: function () {
            var currentPage = window.location.href;
            var loginPath = path + 'login.php';
            if (currentPage != loginPath) {
                window.location.replace(loginPath);
            }
        }
    
  };
})(jQuery, this);

