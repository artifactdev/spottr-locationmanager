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
            if($('body').hasClass('.page-verwaltung')) {
                console.log('passed');
                fillVerwaltung(json);
            }
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
}

// Create modal with item-details -----------------------------

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

function fillVerwaltung(json) {
    console.log(json);
}