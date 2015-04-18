$( document ).ready(function() {
     
    initItems();
    showEditModal();
    showDeleteModal();
    menuItemHandler();
    submitItem();
    setInputsWidth();
    fancySelect();

});

function initItems() {
    var _latitude = 51.541216;
    var _longitude = -0.095678;

    jQuery.ajax({
        url: "http://localhost:8888/spottr/rest-api/locations",
        type: "GET",

        contentType: 'application/json; charset=utf-8',
        success: function(json) {
            fillVerwaltung(json);
        },
        error : function(jqXHR, textStatus, errorThrown) {
            console.log(errorThrownr);
        },

        timeout: 120000,
    });

    $("#geocomplete").geocomplete({
      details: "#edit-form",
      types: ["geocode", "establishment"],
    });
}

function fillVerwaltung(json) {
    var itemsList = $('body').find('.items-list');

    console.log(json);

    for (var i = 0; i < json.items.length; i++) {
        var path = ((window.location.href.match(/^(http.+\/)[^\/]+$/) != null) ? window.location.href.match(/^(http.+\/)[^\/]+$/)[1] : window.location);
        if(json.items[i].gallery)         { var gallery = json.items[i].gallery }
        else                            { gallery = path + '/assets/img/default-item.png' }
        itemsList.append(
            '<li>' +
            '<div class="item" id="' + json.items[i].id + '">' +
                '<a href="#" class="image">' +
                    '<img src="' + gallery + '" alt="">' +
                '</a>' +
                '<div class="wrapper">' +
                    '<figure>' + json.items[i].category + '</figure>' +
                    '<h3>' + json.items[i].title + '</h3>' +
                '</div>' +
                '<div class="col-md-12 item-footer">' +
                    '<div class="col-md-6">' +
                        '<span class="meta-element hidden" id="' + json.items[i].id + '" data-gallery="' + json.items[i].gallery + '" data-longitude="' + json.items[i].longitude + '" data-latitude="' + json.items[i].latitude + '" data-title="' + json.items[i].title +'" data-type="' + json.items[i].type +'"  data-category="' + json.items[i].category +'" data-location="' + json.items[i].location +'" data-aperture="' + json.items[i].aperture +'" data-date="' + json.items[i].date +'" data-focal="' + json.items[i].focal +'" data-iso="' + json.items[i].iso +'" data-rating="' + json.items[i].rating +'"><h3>' + json.items[i].title + '</h3></span>' +
                    
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
    var id = metaElement.attr('id');

    var actionURL = modal.find('form').attr('action');
    modal.find('form').attr('action', actionURL + id);
    modal.find('#title').val(title);
    modal.find('#category').val(category);
    modal.find('#date').val(date);
    modal.find('#aperture').val(aperture);
    modal.find('#focal').val(focal);
    modal.find('#iso').val(iso);
    modal.find('#lng').val(longitude);
    modal.find('#lat').val(latitude);
    modal.find('#rating').val(rating);

    modal.find('form').on('submit',function(e){
        e.preventDefault();
        $.ajax({
            type     : "PUT",
            cache    : false,
            url      : $(this).attr('action'),
            data     : $(this).serialize(),
            success  : function(data) {
                location.reload(true);
            }
        });

    });

    $("#geocomplete-edit").geocomplete({
      details: "#edit-form",
      types: ["geocode", "establishment"],
    });
}

function deleteModal(metaElement) {

    var modal = $('#delete-modal');

    var id = metaElement.attr('id');
    var title = metaElement.data('title');

    var actionURL = modal.find('form').attr('action');
    modal.find('form').attr('action', actionURL + id);

    modal.find('.location').text(title);

    modal.find('form').on('submit',function(e){
        e.preventDefault();
        $.ajax({
            type     : "DELETE",
            cache    : false,
            url      : $(this).attr('action'),
            data     : $(this).serialize(),
            success  : function(data) {
                console.log('deleted');
                location.reload(true);
            }
        });
    });

}