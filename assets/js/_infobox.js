/**
 * drawInfobox adds the infobox to each marker
 * @param  {string} category       gets the category of item
 * @param  {} infoboxContent 
 * @param  {json} json           gets the json for each item
 * @param  {int} i              gets the number of the item in the json tree
 * @return {html}                returns html to add to the marker
 */
function drawInfobox(category, infoboxContent, json, i){

    if(json.items[i].id)                 { var id = json.items[i].id }
        else                            { id = '' }
    if(json.items[i].type)               { var type = json.items[i].type }
        else                            { type = '' }
    if(json.items[i].title)              { var title = json.items[i].title }
        else                            { title = '' }
    if(json.items[i].category)           { var category = json.items[i].category }
        else                            { category = '' }
    if(json.items[i].location)           { var location = json.items[i].location }
        else                            { location = '' }
    if(json.items[i].aperture)           { var aperture = json.items[i].aperture }
        else                            { aperture = '' }
    if(json.items[i].date)               { var date = json.items[i].date }
        else                            { date = '' }
    if(json.items[i].focal)              { var focal = json.items[i].focal }
        else                            { focal = '' }
    if(json.items[i].iso)                { var iso = json.items[i].iso }
        else                            { iso = '' }
    if(json.items[i].rating)             { var rating = json.items[i].rating }
        else                            { rating = '' }
    if(json.items[i].gallery)         { var gallery = json.items[i].gallery }
        else                            { gallery = 'rest-api/media/locations/default-item.png' }

    var path = ((window.location.href.match(/^(http.+\/)[^\/]+$/) != null) ? window.location.href.match(/^(http.+\/)[^\/]+$/)[1] : window.location);
    
    var ibContent = '';
    ibContent =
    '<div class="infobox">' +
        '<div class="inner">' +
            '<div class="image">' +
                '<div class="overlay">' +
                    '<div class="wrapper">' +
                        '<a href="#test" class="quick-view" data-id="' + id + '" data-gallery="' + path + gallery + '" data-title="' + title +'" data-type="' + type +'"  data-category="' + category +'" data-location="' + location +'" data-aperture="' + aperture +'" data-date="' + date +'" data-focal="' + focal +'" data-iso="' + iso +'" data-rating="' + rating +'">Quick View</a>' +
                    '</div>' +
                '</div>' +
                '<a href="#" class="quick-view">' +
                    '<div class="meta">' +
                        '<h2>' + title +  '</h2>' +
                        '<figure>' + location +  '</figure>' +
                    '</div>' +
                '</a>' +
                '<div class="imageWrapper">' +
                    '<img src="' + gallery +  '" width="50px">' +
                '</div>' +
            '</div>' +
        '</div>' +
    '</div>';

    return ibContent;
}