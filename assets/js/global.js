var path = ((window.location.href.match(/^(http.+\/)[^\/]+$/) != null) ? window.location.href.match(/^(http.+\/)[^\/]+$/)[1] : window.location);

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

function menuItemHandler() {
    var isVerwaltung = $('body.page-verwaltung').length;
    var isHome = $('body.page-homepage').length;

    if (isVerwaltung) {
        $('#useradmin-link').removeClass('hide');
    }
    if (isHome) {
        $('#admin-link').removeClass('hide');
    }
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

function searchFilter() {
    $("#category-filter-search").on('click', function(e){
        e.preventDefault();
        var filter = $('.category-filter').find('button').attr('title');

        console.log(filter);

        $('.items-list .results').find('li').each(function(element) {
            $(this).removeClass('hide');
            var itemCategory = $(this).find('.quick-preview').data('category');
            console.log(itemCategory);
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

function submitItem() {
    var addModal = $('body').find('#add-modal');

    $('.submit-item').on('click', function(){
        addModal.removeClass('hide').addClass('fade-in');
        fancySelect();
    });

    $('body').find('#add-modal .modal-close').on('click', function(){
        addModal.addClass('hide').removeClass('fade-in');
    });

    loadExifData();

    $("#geocomplete-search").geocomplete({
      details: "#add-form",
      types: ["geocode", "establishment"],
      detailsAttribute: "data-geo"
    });

    addModal.find('form').on('submit',function(e){
        e.preventDefault();
        AjaxHandler.request({
            method   : "POST",
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
        var $attForm = $("#add-modal form");
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

function goToIndex() {
    var currentPage = window.location.href;
    var indexPath = path + 'index.php';
    var loginPath = path + 'login.php';
    if (currentPage === loginPath) {
        window.location.replace(indexPath);
    }
}

function goToLogin() {
    var currentPage = window.location.href;
    var loginPath = path + 'login.php';
    if (currentPage != loginPath) {
        window.location.replace(loginPath);
    }
}