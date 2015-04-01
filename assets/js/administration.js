$( document ).ready(function() {
     
    initItems();
    showEditModal();
    showDeleteModal();

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
                    '<img src="' + json.data[i].gallery + '" alt="">' +
                '</a>' +
                '<div class="wrapper">' +
                    '<figure>' + json.data[i].category + '</figure>' +
                    '<h3>' + json.data[i].title + '</h3>' +
                '</div>' +
                '<div class="col-md-12 item-footer">' +
                    '<div class="col-md-6">' +
                        '<span class="meta-element hidden" id="' + json.data[i].id + '" data-gallery="' + json.data[i].gallery + '" data-longitude="' + json.data[i].longitude + '" data-latitude="' + json.data[i].latitude + '" data-title="' + json.data[i].title +'" data-type="' + json.data[i].type +'"  data-category="' + json.data[i].category +'" data-location="' + json.data[i].location +'" data-aperture="' + json.data[i].aperture +'" data-date="' + json.data[i].date +'" data-focal="' + json.data[i].focal +'" data-iso="' + json.data[i].iso +'" data-rating="' + json.data[i].rating +'"><h3>' + json.data[i].title + '</h3></span>' +
                    
                        '<a href="#" class="btn btn-default btn-edit">Edit</a>' +
                    '</div>' +
                    '<div class="col-md-6">' +
                        '<a href="#" class="btn btn-red btn-delete">Delete</a>' +
                    '</div>' +
                '</div>' +
            '</div>' +
        '</li>'
        );
    }
}

function showEditModal() {
    $('body').on('click','.btn-edit', function(id) {
        var metaItem = $(this).closest('.item').find('.meta-element');
        modalHandler(metaItem);
         
    });

    function modalHandler(item) {
        var metaElement = item;
        
        editModal(metaElement);

        var modal = $('#edit-modal');

        modal.removeClass('hide');
        modal.addClass('fade-in');

        $('#edit-modal .modal-close').on('click', function(){

            modal.addClass('hide');
            modal.removeClass('fade-in');
        });
    }

    $("#geocomplete").geocomplete({
          details: "#add-form",
          types: ["geocode", "establishment"],
        });
}

function showDeleteModal() {
    $('body').on('click','.btn-delete', function(id) {
        var metaItem = $(this).closest('.item').find('.meta-element');
        modalHandler(metaItem);
         
    });

    function modalHandler(item) {
        var metaElement = item;
        
        deleteModal(metaElement);

        var modal = $('#delete-modal');

        modal.removeClass('hide');
        modal.addClass('fade-in');

        $('#delete-modal .modal-close').on('click', function(){

            modal.addClass('hide');
            modal.removeClass('fade-in');
        });
    }   
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

// Create modal with item-details -----------------------------

function editModal(metaElement) {

    fancySelect();

    var modal = $('#edit-modal');

    var title = metaElement.data('title');
    var latitude = metaElement.data('latitude');
    var longitude = metaElement.data('longitude');
    var gallery = metaElement.data('gallery');
    var category = metaElement.data('category');
    var date = metaElement.data('date_created');
    var aperture = metaElement.data('aperture');
    var focal = metaElement.data('focal');
    var iso = metaElement.data('iso');
    var rating = metaElement.data('rating');

    modal.find('#title').val(title);
    modal.find('#category').val(category);
    modal.find('#date').val(date);
    modal.find('#aperture').val(aperture);
    modal.find('#focal').val(focal);
    modal.find('#iso').val(iso);
    modal.find('#lng').val(longitude);
    modal.find('#lat').val(latitude);
    modal.find('#rating').val(rating);

}

function deleteModal(metaElement) {

    var modal = $('#delete-modal');

    var id = metaElement.attr('id');
    var title = metaElement.data('title');

    modal.find('#id').val(id);
    modal.find('.location').text(title);

}