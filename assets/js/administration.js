$( document ).ready(function() {
     
    initItems();

});

function initItems() {
    var _latitude = 51.541216;
    var _longitude = -0.095678;
    var jsonPath = 'assets/json/items.json.txt';

    $.getJSON(jsonPath)
        .done(function(json) {
            fillVerwaltung(json);
        })
        .fail(function( jqxhr, textStatus, error ) {
            console.log(error);
    });
}


function fillVerwaltung(json) {
    var itemsList = $('body').find('.items-list');

    for (var i = 0; i < json.data.length; i++) {
        itemsList.append(
            '<li>' +
            '<div class="item" id="' + json.data[i].id + '">' +
                '<a href="#" class="image">' +
                    '<div class="inner">' +
                        '<div class="item-specific">' +
                        '</div>' +
                        '<img src="' + json.data[i].gallery + '" alt="">' +
                    '</div>' +
                '</a>' +
                '<div class="wrapper">' +
                    '<a href="#" class="quick-preview" id="' + json.data[i].id + '" data-gallery="' + json.data[i].gallery + '" data-title="' + json.data[i].title +'" data-type="' + json.data[i].type +'"  data-category="' + json.data[i].category +'" data-location="' + json.data[i].location +'" data-aperture="' + json.data[i].aperture +'" data-date="' + json.data[i].date +'" data-focal="' + json.data[i].focal +'" data-iso="' + json.data[i].iso +'" data-rating="' + json.data[i].rating +'"><h3>' + json.data[i].title + '</h3></a>' +
                    '<figure>' + json.data[i].category + '</figure>' +
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