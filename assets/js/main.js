$( document ).ready(function() {
     
    initMap();

    mobileNavigation();

    showModal();

    fancySelect();

    setInputsWidth();

    searchFilter();

    submitItem();

});

function initMap() {
    var $body = $('body');
    if( $body.hasClass('map-fullscreen') ) {
        if( $(window).width() > 768 ) {

            $('.map-canvas').height( $(window).height() - $('.header').height() );
        }
        else {
            $('.map-canvas #map').height( $(window).height() - $('.header').height() );
        }
    }

    var _latitude = 51.541216;
    var _longitude = -0.095678;
    var jsonPath = 'assets/json/items.json.txt';

    $.getJSON(jsonPath)
        .done(function(json) {
            createSidebar(json);
            addMap(_longitude,_latitude,json);
        })
        .fail(function( jqxhr, textStatus, error ) {
            console.log(error);
    });
}

function mobileNavigation(){
    if( $(window).width() < 979 ){
        $(".main-navigation.navigation-top-header").remove();
        $(".toggle-navigation").css("display","inline-block");
        $("body").removeClass("navigation-top-header");
        $("body").addClass("navigation-off-canvas");
    }
}

function submitItem() {
    $('.submit-item').on('click', function(){
        $('body').find('#add-modal').removeClass('hide').addClass('fade-in');
    });

    $('body').find('#add-modal .modal-close').on('click', function(){
        $('body').find('#add-modal').addClass('hide').removeClass('fade-in');
    });

    loadExifData();
}

function fancySelect() {
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
}

function showModal() {
    $('body').on('click','.results .item a', function(id) {
        $('#modal').removeClass('hide');
        $('#modal').addClass('fade-in');
         
    });

    $('body').find('.results .item a').on('click', function(e) {
        e.preventDefault;
        $('#modal').removeClass('hide');
        $('#modal').addClass('fade-in');
         
    });

    $("#geocomplete").geocomplete({
          details: "#add-form",
          types: ["geocode", "establishment"],
        });
}

function addMap(_longitude,_latitude,json) {
    map = new GMaps({
        div: '#map',
        lat: _latitude,
        lng: _longitude
    });

   addMarkers(map,json);

}

function addMarkers(map,json) {
    for (var i = 0; i < json.data.length; i++) {
        map.addMarker({
            lat: json.data[i].latitude,
            lng: json.data[i].longitude,
            title: json.data[i].title,
            infoWindow: {
              content: '<h4>' + json.data[i].title +'</h4>' +
                        '<img src="' + json.data[i].gallery[0] + '" alt="" width="50px" height="auto">' 
            }
        });
    }

    var options = {
      map: "#map"
    };
        
    $("#location").geocomplete(options);
        
}

function createSidebar(json) {
    for (var i = 0; i < json.data.length; i++) {
        $('.items-list .results').append(
            '<li data-category="' + json.data[i].category + '">' +
                '<div class="item" id="' + json.data[i].id + '">' +
                    '<a href="#" class="image">' +
                        '<div class="inner">' +
                            '<div class="item-specific">' +
                                //drawItemSpecific(category, json, a) +
                            '</div>' +
                            '<img src="' + json.data[i].gallery[0] + '" alt="">' +
                        '</div>' +
                    '</a>' +
                    '<div class="wrapper">' +
                        '<a href="#" id="' + json.data[i].id + '"><h3>' + json.data[i].title + '</h3></a>' +
                        '<figure>' + json.data[i].location + '</figure>' +
                        '<div class="info">' +
                            '<div class="type">' +
                                '<i><img src="' + json.data[i].type_icon + '" alt=""></i>' +
                                '<span>' + json.data[i].type + '</span>' +
                            '</div>' +
                            '<div class="rating" data-rating="' + json.data[i].rating + '"></div>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
            '</li>'
        );
    }
}

function setInputsWidth(){
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
}

function searchFilter() {
    $("#category-filter-search").on('click', function(e){
        e.preventDefault();
        var filter = $('#category-filter').val();

        $('.items-list .results').find('li').each(function(element) {
            $(this).removeClass('hide');
            var itemCategory = $(this).data('category');
            if (itemCategory != filter) {
                $(this).addClass('hide');
            }
        });
    });

    $("#reset-filter").on('click', function(e){
        e.preventDefault();

        $('.items-list .results').find('li').each(function(element) {
            $(this).removeClass('hide');
        });

        $('#location').val('');

        initMap();
    });
}

function loadExifData() {
    var someCallback = function(exifObject) {

            var latitude = exifObject.GPSLatitude;
            var longitude = exifObject.GPSLongitude;            

            $('#lng').val(longitude);
            $('#lat').val(latitude);

            // Uncomment the line below to examine the
            // EXIF object in console to read other values
            console.log(exifObject);

        }

      try {
        $('#file').change(function() {
            $(this).fileExif(someCallback);
        });
      }
      catch (e) {
        console.log(e);
      }
}