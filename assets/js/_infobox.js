function drawInfobox(category, infoboxContent, json, i){

    if(json.data[i].id)                 { var id = json.data[i].id }
        else                            { id = '' }
    if(json.data[i].type)               { var type = json.data[i].type }
        else                            { type = '' }
    if(json.data[i].title)              { var title = json.data[i].title }
        else                            { title = '' }
    if(json.data[i].category)           { var category = json.data[i].category }
        else                            { category = '' }
    if(json.data[i].location)           { var location = json.data[i].location }
        else                            { location = '' }
    if(json.data[i].aperture)           { var aperture = json.data[i].aperture }
        else                            { aperture = '' }
    if(json.data[i].date)               { var date = json.data[i].date }
        else                            { date = '' }
    if(json.data[i].focal)              { var focal = json.data[i].focal }
        else                            { focal = '' }
    if(json.data[i].iso)                { var iso = json.data[i].iso }
        else                            { iso = '' }
    if(json.data[i].rating)             { var rating = json.data[i].rating }
        else                            { rating = '' }
    if(json.data[i].gallery[0])         { var gallery = json.data[i].gallery[0] }
        else                            { gallery[0] = '../img/default-item.jpg' }
    
    var ibContent = '';
    ibContent =
    '<div class="infobox">' +
        '<div class="inner">' +
            '<div class="image">' +
                '<div class="item-specific">' + drawItemSpecific(category, json, i) + '</div>' +
                '<div class="overlay">' +
                    '<div class="wrapper">' +
                        '<a href="#test" class="quick-view" data-id="' + id + '" data-gallery="' + gallery + '" data-title="' + title +'" data-type="' + type +'"  data-category="' + category +'" data-location="' + location +'" data-aperture="' + aperture +'" data-date="' + date +'" data-focal="' + focal +'" data-iso="' + iso +'" data-rating="' + rating +'">Quick View</a>' +
                    '</div>' +
                '</div>' +
                '<a href="#" class="quick-view">' +
                    '<div class="meta">' +
                        '<h2>' + title +  '</h2>' +
                        '<figure>' + location +  '</figure>' +
                        '<i class="fa fa-angle-right"></i>' +
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