$(document).ready(function() {
    var documentHeight = $( document ).height();
    var header = $('.header').height();
    var pageCanvas = documentHeight - header;

    $('#page-canvas').height(pageCanvas);

    });