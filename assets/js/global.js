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
    var isVerwaltung = $('body.page-verwaltung');

    if (isVerwaltung) {
        $('#admin-link').hide();
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

function submitItem() {
    $('.submit-item').on('click', function(){
        $('body').find('#add-modal').removeClass('hide').addClass('fade-in');
        fancySelect();
    });

    $('body').find('#add-modal .modal-close').on('click', function(){
        $('body').find('#add-modal').addClass('hide').removeClass('fade-in');
    });

    loadExifData();
}
