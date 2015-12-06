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

            $('#map').height($(window).height() - $('header').height());

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
                menuWidth: 350, // Default is 240
                edge: 'left', // Choose the horizontal origin
                closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
              }
            );
        },

        /* TODO */
        addResultListener: function() {
            var modal = $('#itemModal');

            $('body').find('.result-card').each(function(e) {
                $(this).on('click', function(){
                    var metaItem = $(this);
                    spottr.global.modalHandler(modal);
                    spottr.main.fillModal(metaItem);
                });
            });
        },

        /**
         * shows item modal and gets the metaItem to get the data from when clicked on a location(quick-link)
         */
        showModal: function() {
            var modal = $('#itemModal');

            $('body').on('mouseover', '.results .result-card', function(id) {
                var metaItem = $(this);
                var id = metaItem.attr('id');
                spottr.main.highlightMarker(id, 'add');

            });

            $('body').on('mouseout', '.results .result-card', function(id) {
                var metaItem = $(this);
                var id = metaItem.attr('id');
                spottr.main.highlightMarker(id, 'remove');
            });

            $('body').unbind().on('click', '.infobox a:not(.nav-link)', function(e) {

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
                /* TODO */
                '<div class="card result-card" id="' + json.items[a].id + '" data-gallery="' + json.items[a].gallery + '" data-title="' + json.items[a].title + '" data-type="' + json.items[a].type + '"  data-category="' + json.items[a].category + '" data-location="' + json.items[a].latitude + ','+ json.items[a].longitude + '" data-aperture="' + json.items[a].aperture + '" data-date="' + json.items[a].date + '" data-focal="' + json.items[a].focal + '" data-iso="' + json.items[a].iso + '" data-notiz="' + json.items[a].note + '" data-rating="' + json.items[a].rating + '">'+
                '<div class="card-image">'+
                  '<img src="' + path + gallery + '" alt="">' +
                  '<span class="card-title">' + json.items[a].title + '<span class="rating">' + json.items[a].rating + '</span>' + '</span>' +
                  '<div class="card-info">' +
                      '<div class="col s12 no-padding">' +
                            '<div class="type">' +
                                '<i><img src="' + path + json.items[a].type + '" alt=""></i>' +
                                '<span>' + json.items[a].category + '</span>' +
                            '</div>' +
                        '</div>' +
                        '<span class="clearfix"></span>' +
                    '</div>' +
                '</div>' +
              '</div>'
            );
        },

        /**
         * Create modal with item-details
         * @param  {ELEMENT} metaElement the element the function gets the data from to fill the modal
         */
        fillModal: function(metaElement) {

            var modal = $('#itemModal');

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

            modal.find('.title').text(title);
            modal.find('.gallery-image').attr('src', gallery);
            modal.find('.category').text(category);
            modal.find('.date').text(date);
            modal.find('.aperture').text(aperture);
            modal.find('.focal').text(focal);
            modal.find('.iso').text(iso);
            modal.find('.anmerkung').text(notiz);
            modal.find('.nav-link').attr('href', navlink);
            modal.find('.rating-item-modal').text(rating);

        },

        /**
         * checks the category filter if changed and a category is selected it calls the loadFilteredItems function
         */
        categoryFilter: function() {
            $("#category-filter").change(function(e) {
                e.preventDefault();
                var filter = $('#category-filter').val();
                if (filter != 'nothing') {
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
            console.log(filter, searchProperty);

            AjaxHandler.request({
                url: "locations",
                method: "GET",
                success: function(json) {
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
                    console.log(itemsToload);
                    createHomepageGoogleMap(_latitude, _longitude, items);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrownr);
                }
            });
        }
    };
})(jQuery, this);
