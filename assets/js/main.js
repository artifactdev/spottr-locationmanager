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
        var metaItem = $(this).closest('.quick-preview');
        modalHandler(metaItem);
         
    });

    $('body').on('click','.infobox a', function(e) {
        e.preventDefault;
        modalHandler($(this));
         
    });

    function modalHandler(item) {
        var metaElement = item;
        
        fillModal(metaElement);

        var modal = $('#modal');

        modal.removeClass('hide');
        modal.addClass('fade-in');

        $('#modal .modal-close').on('click', function(){

            modal.addClass('hide');
            modal.removeClass('fade-in');
        });
    }

    $("#geocomplete").geocomplete({
          details: "#add-form",
          types: ["geocode", "establishment"],
        });
}

function drawItemSpecific(category, json, a){
    return '';
}

function addMap(_longitude,_latitude,json) {
    createHomepageGoogleMap(_latitude,_longitude,json);
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
            var aperture = exifObject.ApertureValue;
            var date = exifObject.DateTimeOriginal;
            var focal = exifObject.FocalLength;
            var iso = exifObject.ISOSpeedRatings;         

            $('#lng').val(longitude);
            $('#lat').val(latitude);
            $('#aperture').val(aperture);
            $('#date').val(date);
            $('#focal').val(focal);
            $('#iso').val(iso);

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

function pushItemsToArray(json, a, category, visibleItemsArray){
    var itemPrice;
    visibleItemsArray.push(
        '<li>' +
            '<div class="item" id="' + json.data[a].id + '">' +
                '<a href="#" class="image">' +
                    '<div class="inner">' +
                        '<div class="item-specific">' +
                            drawItemSpecific(category, json, a) +
                        '</div>' +
                        '<img src="' + json.data[a].gallery + '" alt="">' +
                    '</div>' +
                '</a>' +
                '<div class="wrapper">' +
                    '<a href="#" class="quick-preview" id="' + json.data[a].id + '" data-gallery="' + json.data[a].gallery + '" data-title="' + json.data[a].title +'" data-type="' + json.data[a].type +'"  data-category="' + json.data[a].category +'" data-location="' + json.data[a].location +'" data-aperture="' + json.data[a].aperture +'" data-date="' + json.data[a].date +'" data-focal="' + json.data[a].focal +'" data-iso="' + json.data[a].iso +'" data-rating="' + json.data[a].rating +'"><h3>' + json.data[a].title + '</h3></a>' +
                    '<figure>' + json.data[a].category + '</figure>' +
                    '<div class="info">' +
                        '<div class="type">' +
                            '<i><img src="' + json.data[a].type_icon + '" alt=""></i>' +
                            '<span>' + json.data[a].type + '</span>' +
                        '</div>' +
                        '<div class="rating" data-rating="' + json.data[a].rating + '"></div>' +
                    '</div>' +
                '</div>' +
            '</div>' +
        '</li>'
    );

    function drawPrice(price){
        if( price ){
            itemPrice = '<div class="price">' + price +  '</div>';
            return itemPrice;
        }
        else {
            return '';
        }
    }
}

// Create modal with item-detauls -----------------------------

function fillModal(metaElement) {

    var modal = $('#modal');

    var title = metaElement.data('title');
    var gallery = metaElement.data('gallery');
    var category = metaElement.data('category');
    var date = metaElement.data('date_created');
    var aperture = metaElement.data('aperture');
    var focal = metaElement.data('focal');
    var iso = metaElement.data('iso');

    modal.find('.title').text(title);
    modal.find('.gallery-image').attr('src', gallery);
    modal.find('.category').text(category);
    modal.find('.date').text(date);
    modal.find('.aperture').text(aperture);
    modal.find('.focal').text(focal);
    modal.find('.iso').text(iso);

}