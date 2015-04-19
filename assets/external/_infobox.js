function drawInfobox(category, infoboxContent, json, i){

    if(json.items[i].color)          { var color = json.items[i].color }
        else                        { color = '' }
    if( json.items[i].price )        { var price = '<div class="price">' + json.items[i].price +  '</div>' }
        else                        { price = '' }
    if(json.items[i].id)             { var id = json.items[i].id }
        else                        { id = '' }
    if(json.items[i].url)            { var url = json.items[i].url }
        else                        { url = '' }
    if(json.items[i].type)           { var type = json.items[i].type }
        else                        { type = '' }
    if(json.items[i].title)          { var title = json.items[i].title }
        else                        { title = '' }
    if(json.items[i].location)       { var location = json.items[i].location }
        else                        { location = '' }
    if(json.items[i].gallery[0])     { var gallery = json.items[i].gallery[0] }
        else                        { gallery[0] = '../img/default-item.jpg' }

    var ibContent = '';
    ibContent =
    '<div class="infobox ' + color + '">' +
        '<div class="inner">' +
            '<div class="image">' +
                '<div class="item-specific">' + drawItemSpecific(category, json, i) + '</div>' +
                '<div class="overlay">' +
                    '<div class="wrapper">' +
                        '<a href="#" class="quick-view" data-toggle="modal" data-target="#modal" id="' + id + '">Quick View</a>' +
                        '<hr>' +
                        '<a href="' + url +  '" class="detail">Go to Detail</a>' +
                    '</div>' +
                '</div>' +
                '<a href="' + url +  '" class="description">' +
                    '<div class="meta">' +
                        price +
                        '<h2>' + title +  '</h2>' +
                        '<figure>' + location +  '</figure>' +
                        '<i class="fa fa-angle-right"></i>' +
                    '</div>' +
                '</a>' +
                '<img src="' + gallery +  '">' +
            '</div>' +
        '</div>' +
    '</div>';

    return ibContent;
}