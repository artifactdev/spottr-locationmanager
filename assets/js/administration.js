$( document ).ready(function() {
     
    initItems();
    showEditModal();
    showDeleteModal();
    menuItemHandler();
    submitItem();
    setInputsWidth();
    fancySelect();
    userAdministration();

});

function initItems() {
    var _latitude = 51.541216;
    var _longitude = -0.095678;

    AjaxHandler.request({
        url: "locations",
        method: "GET",
        success: function(json) {
            fillVerwaltung(json);
        },
        error : function(jqXHR, textStatus, errorThrown) {
            console.log(errorThrownr);
        }
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
                        '<span class="meta-element hidden" id="' + json.items[i].id + '" data-gallery="' + json.items[i].gallery + '" data-longitude="' + json.items[i].longitude + '" data-latitude="' + json.items[i].latitude + '" data-title="' + json.items[i].title +'" data-type="' + json.items[i].type +'"  data-category="' + json.items[i].category +'" data-location="' + json.items[i].location +'" data-aperture="' + json.items[i].aperture +'" data-date="' + json.items[i].dateCreated +'" data-focal="' + json.items[i].focal +'" data-iso="' + json.items[i].iso +'" data-rating="' + json.items[i].rating +'"><h3>' + json.items[i].title + '</h3></span>' +
                    
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
    var date = metaElement.data('date');
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
        AjaxHandler.request({
            method   : "PUT",
            cache    : false,
            url      : $(this).attr('action'),
            data     : $(this).serializeObject(),
            success  : function(data) {
                submitImage(data.id);
                location.reload(true);

            },

            error    : function(data) {
                console.log(data);
            } 
        });

    });

    function submitImage(locationID) {
        var $attForm = $("#edit-modal form");
        var $file = $attForm.find("input[type='file']");
        if ($file.val() == "") {
            if (typeof callback == "function") {
                callback();
            }
            return;
        }

        $attForm.attr("action", "locations/" + locationID + "/image");
        var $iframe = $("#fnJS_iframe_location_attachment");
        $iframe.unbind().load(function(event) {
            event.preventDefault();
             //console.log($(this).contents());
             callback($(this).contents());
        });
     
        $attForm.submit();

    }

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
        AjaxHandler.request({
            method     : "DELETE",
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

function userAdministration() {

    $('body').on('click','#useradmin-link', function(id) {
        modalHandler();
    });

    function modalHandler() {
        var modal = $('#user-modal');

        modal.removeClass('hide');
        modal.addClass('fade-in');

        $('#user-modal .modal-close').on('click', function(){

            modal.addClass('hide');
            modal.removeClass('fade-in');
        });

        loadUsers();

        saveUser(modal);
    }

    function saveUser(modal) {
        modal.find('form').on('submit',function(e){
            e.preventDefault();
            AjaxHandler.request({
                method     : "POST",
                cache    : false,
                url      : $(this).attr('action'),
                data     : $(this).serializeObject(),
                success  : function(data) {
                    loadUsers();
                }
            });
        });
    }

    function loadUsers() {
        AjaxHandler.request({
            method     : "GET",
            cache    : false,
            url      : "users",
            data     : $(this).serialize(),
            success  : function(data) {
                fillTable(data);
            }
        });

        function fillTable(json) {
            console.log(json);
            for (var i = 0; i < json.items.length; i++) {
                var userTable = $('#user-modal table.userlist tbody');
                userTable.empty();
                userTable.append(
                    '<tr>' +
                        '<td class="id">' + json.items[i].id + '</td>' +
                        '<td class="id">' + json.items[i].email + '</td>' +
                        '<td class="id">' + json.items[i].password + '</td>' +
                        '<td class="id">' + json.items[i].firstName + '</td>' +
                        '<td class="id">' + json.items[i].lastName + '</td>' +
                        '<td class="id">' + json.items[i].companyName + '</td>' +
                        '<td class="id">' + json.items[i].roles + '</td>' +
                    '</tr>'
                );
            }
        }
    }
}