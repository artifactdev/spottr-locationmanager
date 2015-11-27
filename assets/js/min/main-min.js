$(document).ready(function() {

    spottr.main.initMap();

    spottr.main.mobileNavigation();

    spottr.main.showModal();

    spottr.global.fancySelect();

    spottr.global.setInputsWidth();

    spottr.global.submitItem();

    spottr.main.categoryFilter();

    spottr.global.menuItemHandler();

});

;
(function($, window, undefined) {
    spottr.main = {
        /**
         * initialoses the map and calls createHomepageGoogleMap(_latitude,_longitude,json) which loads items to the map as markers and to the results as list
         */
        initMap: function() {
            var $body = $('body');
                if ($(window).width() > 768) {

                    $('.map-canvas').height($(window).height() - $('.header').height() - 15);
                } else {
                    $('.map-canvas #map').height($(window).height() - $('.header').height());
                }

            var path = ((window.location.href.match(/^(http.+\/)[^\/]+$/) != null) ? window.location.href.match(/^(http.+\/)[^\/]+$/)[1] : window.location);

            AjaxHandler.request({
                url: "locations",
                method: "GET",
                success: function(json) {
                    spottr.global.loading();
                    createHomepageGoogleMap(_latitude, _longitude, json);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    spottr.global.error(errorThrownr,'5e3')
                    console.log(errorThrownr);
                }
            });
        },

        /**
         * handles the mobile navigation which closes the result list on screens < 979 px
         */
        mobileNavigation: function() {
            $(".button-collapse").sideNav({
                menuWidth: 380, // Default is 240
                edge: 'left', // Choose the horizontal origin
                closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
              }
            );
        },

        /**
         * shows item modal and gets the metaItem to get the data from when clicked on a location(quick-link)
         */
        showModal: function() {
            var metaItem = $(this).find('.quick-preview');
            var modal = $('#modal');

            $('body').on('click', '.results li', function(id) {
                var metaItem = $(this).find('.quick-preview');
                spottr.global.modalHandler(modal);
                spottr.main.fillModal(metaItem);

            });

            $('body').on('mouseover', '.results li', function(id) {
                var metaItem = $(this).find('.quick-preview');
                var id = metaItem.attr('id');
                spottr.main.highlightMarker(id, 'add');

            });

            $('body').on('mouseout', '.results li', function(id) {
                var metaItem = $(this).find('.item');
                var id = metaItem.attr('id');
                spottr.main.highlightMarker(id, 'remove');
            });

            $('body').on('click', '.infobox a:not(.nav-link)', function(e) {
                e.preventDefault;
                spottr.global.modalHandler(modal);
                spottr.main.fillModal($(this));

            });


        },

        drawItemSpecific: function(category, json, a) {
            return '';
        },

        /**
         * highlights the marker on map if the marker is clicked
         * @param  {ID} id     the marker id
         * @param  {action} action the given action
         */
        highlightMarker: function(id, action) {
            var markerElement = $('#map').find("[data-id='" + id + "']").parent('.marker-loaded');
            if (action === 'add') {
                markerElement.addClass('marker-active');
            }
            if (action === 'remove') {
                markerElement.removeClass('marker-active');
            }
        },

        /**
         * creates html for each item to push it in the result list later
         * @param  {JSON} json              the given JSON
         * @param  {INT} a                 the given item in json
         * @param  {STRING} category          the item category
         * @param  {ARRAY} visibleItemsArray the Array where the filled template will be pushed to
         */
        pushItemsToArray: function(json, a, category, visibleItemsArray) {
            var path = ((window.location.href.match(/^(http.+\/)[^\/]+$/) != null) ? window.location.href.match(/^(http.+\/)[^\/]+$/)[1] : window.location);

            if (json.items[a].gallery) {
                var gallery = json.items[a].thumb
            } else {
                gallery = 'rest-api/media/locations/default-item.png'
            }

            visibleItemsArray.push(
                '<li>' +
                '<div class="item" id="' + json.items[a].id + '">' +
                '<a href="#" class="image">' +
                '<div class="inner">' +
                '<div class="item-specific">' +
                spottr.main.drawItemSpecific(category, json, a) +
                '</div>' +
                '<img src="' + path + gallery + '" alt="">' +
                '</div>' +
                '</a>' +
                '<div class="wrapper">' +
                '<a href="#" class="quick-preview" id="' + json.items[a].id + '" data-gallery="' + json.items[a].gallery + '" data-title="' + json.items[a].title + '" data-type="' + json.items[a].type + '"  data-category="' + json.items[a].category + '" data-location="' + json.items[a].latitude + ','+ json.items[a].longitude + '" data-aperture="' + json.items[a].aperture + '" data-date="' + json.items[a].date + '" data-focal="' + json.items[a].focal + '" data-iso="' + json.items[a].iso + '" data-notiz="' + json.items[a].note + '" data-rating="' + json.items[a].rating + '"><h3>' + json.items[a].title + '</h3></a>' +
                '<div class="info">' +
                '<div class="col-md-12 no-padding">' +
                '<figure>' + json.items[a].category + '</figure>' +
                '<div class="type">' +
                '<i><img src="' + path + json.items[a].type + '" alt=""></i>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-12 no-padding">' +
                '<figure class="rating-label">Zugänglichkeit</figure>' +
                '<input class="rating" type="number" readonly value="' + json.items[a].rating + '"/>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</li>'
            );
        },

        /**
         * Create modal with item-details
         * @param  {ELEMENT} metaElement the element the function gets the data from to fill the modal
         */
        fillModal: function(metaElement) {

            var modal = $('#modal');

            var title = metaElement.data('title');
            var gallery = metaElement.data('gallery');
            var category = metaElement.data('category');
            var date = metaElement.data('date');
            var aperture = metaElement.data('aperture');
            var focal = metaElement.data('focal');
            var iso = metaElement.data('iso');
            var notiz = metaElement.data('notiz');
            var rating = metaElement.data('rating');
            var location = metaElement.data('location');

            var navlink = 'http://maps.google.com/?daddr=' + location;

            var ratingItem = modal.find('.rating-item-modal');

            modal.find('.title').text(title);
            modal.find('.gallery-image').attr('src', gallery);
            modal.find('.category').text(category);
            modal.find('.date').text(date);
            modal.find('.aperture').text(aperture);
            modal.find('.focal').text(focal);
            modal.find('.iso').text(iso);
            modal.find('.anmerkung').text(notiz);
            modal.find('.nav-link').attr('href', navlink);
            ratingItem.attr('value', rating);

            spottr.global.rating(ratingItem);

        },

        /**
         * checks the category filter if changed and a category is selected it calls the loadFilteredItems function
         */
        categoryFilter: function() {
            $("#category-filter").change(function(e) {
                e.preventDefault();
                var filter = $('.category-filter').find('button').attr('title');
                if (filter != 'Kein Filter gesetzt') {
                    spottr.main.loadFilteredItems(filter, 'category');
                } else {
                    spottr.main.initMap();
                }

            });

        },

        /**
         * gets all locations and filteres them after filtering the fitting json will be loaded to the map again createHomepageGoogleMap(_latitude,_longitude,items)
         * @param  {String} filter         what should be searched for
         * @param  {String} searchProperty where in the json should be searched
         */
        loadFilteredItems: function(filter, searchProperty) {

            AjaxHandler.request({
                url: "locations",
                method: "GET",
                success: function(json) {
                    console.log(json);
                    var config = {
                            property: searchProperty,
                            wrapper: true,
                            value: filter,
                            checkContains: false,
                            startsWith: false,
                            matchCase: true,
                            avoidDuplicates: false
                        },

                        itemsToload = $.fn.filterJSON(json, config);
                    console.log(itemsToload);
                    var items = {};
                    items['items'] = itemsToload;
                    console.log(items);
                    createHomepageGoogleMap(_latitude, _longitude, items);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrownr);
                }
            });
        }
    };
})(jQuery, this);


