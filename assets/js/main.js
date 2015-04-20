$( document ).ready(function() {
     
    initMap();

    mobileNavigation();

    showModal();

    fancySelect();

    setInputsWidth();

    searchFilter();

    submitItem();

    menuItemHandler()

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

    var _latitude = 51.0545032;
    var _longitude = 13.7416008;

    var path = ((window.location.href.match(/^(http.+\/)[^\/]+$/) != null) ? window.location.href.match(/^(http.+\/)[^\/]+$/)[1] : window.location);

    AjaxHandler.request({
        url: "locations",
        method: "GET",
        success: function(json) {
            createHomepageGoogleMap(_latitude,_longitude,json);
        },
        error : function(jqXHR, textStatus, errorThrown) {
            console.log(errorThrownr);
        }
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
    var metaItem = $(this).find('.quick-preview');

    $('body').on('click','.results li', function(id) {
        var metaItem = $(this).find('.quick-preview');
        modalHandler(metaItem);
         
    });

    $('body').on('mouseover','.results li', function(id) {
        var metaItem = $(this).find('.quick-preview');
        var id = metaItem.attr('id');
        highlightMarker(id, 'add');
         
    });

    $('body').on('mouseout','.results li', function(id) {
        var metaItem = $(this).find('.item');
        var id = metaItem.attr('id');
        highlightMarker(id, 'remove');
    });

    $('body').on('click','.infobox a', function(e) {
        e.preventDefault;
        modalHandler($(this));
         
    });

    function highlightMarker(id,action) {
        var markerElement = $('#map').find("[data-id='" + id + "']").parent('.marker-loaded');
        if (action === 'add') {
            markerElement.addClass('marker-active');
        } 
        if (action === 'remove') {
            markerElement.removeClass('marker-active');
        }
    }

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
}

function drawItemSpecific(category, json, a){
    return '';
}

function pushItemsToArray(json, a, category, visibleItemsArray){
    var itemPrice;
    var path = ((window.location.href.match(/^(http.+\/)[^\/]+$/) != null) ? window.location.href.match(/^(http.+\/)[^\/]+$/)[1] : window.location);
        
     if(json.items[a].gallery)         { var gallery = json.items[a].gallery }
        else                            { gallery = 'assets/img/default-item.png' }

    visibleItemsArray.push(
        '<li>' +
            '<div class="item" id="' + json.items[a].id + '">' +
                '<a href="#" class="image">' +
                    '<div class="inner">' +
                        '<div class="item-specific">' +
                            drawItemSpecific(category, json, a) +
                        '</div>' +
                        '<img src="' + path + gallery + '" alt="">' +
                    '</div>' +
                '</a>' +
                '<div class="wrapper">' +
                    '<a href="#" class="quick-preview" id="' + json.items[a].id + '" data-gallery="' + json.items[a].gallery + '" data-title="' + json.items[a].title +'" data-type="' + json.items[a].type +'"  data-category="' + json.items[a].category +'" data-location="' + json.items[a].location +'" data-aperture="' + json.items[a].aperture +'" data-date="' + json.items[a].dateCreated +'" data-focal="' + json.items[a].focal +'" data-iso="' + json.items[a].iso +'" data-rating="' + json.items[a].rating +'"><h3>' + json.items[a].title + '</h3></a>' +
                    '<figure>' + json.items[a].category + '</figure>' +
                    '<div class="info">' +
                        '<div class="type">' +
                            '<i><img src="' + path + json.items[a].type + '" alt=""></i>' +
                        '</div>' +
                        '<div class="rating" data-rating="' + json.items[a].rating + '"></div>' +
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