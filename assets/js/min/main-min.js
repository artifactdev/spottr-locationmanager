function initMap(){var a=$("body");a.hasClass("map-fullscreen")&&($(window).width()>768?$(".map-canvas").height($(window).height()-$(".header").height()):$(".map-canvas #map").height($(window).height()-$(".header").height()));var t=51.541216,i=-.095678,e="assets/json/items.json.txt";$.getJSON(e).done(function(a){createSidebar(a),addMap(i,t,a)}).fail(function(a,t,i){console.log(i)})}function mobileNavigation(){$(window).width()<979&&($(".main-navigation.navigation-top-header").remove(),$(".toggle-navigation").css("display","inline-block"),$("body").removeClass("navigation-top-header"),$("body").addClass("navigation-off-canvas"))}function submitItem(){$(".submit-item").on("click",function(){$("body").find("#add-modal").removeClass("hide").addClass("fade-in")}),$("body").find("#add-modal .modal-close").on("click",function(){$("body").find("#add-modal").addClass("hide").removeClass("fade-in")}),loadExifData()}function fancySelect(){var a=$("select");a.length>0&&a.selectpicker();var t=$(".bootstrap-select"),i=$(".dropdown-menu");t.on("shown.bs.dropdown",function(){i.removeClass("animation-fade-out"),i.addClass("animation-fade-in")}),t.on("hide.bs.dropdown",function(){i.removeClass("animation-fade-in"),i.addClass("animation-fade-out")}),t.on("hidden.bs.dropdown",function(){var a=$(this);$(a).addClass("open"),setTimeout(function(){$(a).removeClass("open")},100)})}function showModal(){$("body").on("click",".results .item a",function(a){$("#modal").removeClass("hide"),$("#modal").addClass("fade-in")}),$("body").find(".results .item a").on("click",function(a){a.preventDefault,$("#modal").removeClass("hide"),$("#modal").addClass("fade-in")}),$("#geocomplete").geocomplete({details:"#add-form",types:["geocode","establishment"]})}function addMap(a,t,i){map=new GMaps({div:"#map",lat:t,lng:a}),addMarkers(map,i)}function addMarkers(a,t){for(var i=0;i<t.data.length;i++)a.addMarker({lat:t.data[i].latitude,lng:t.data[i].longitude,title:t.data[i].title,infoWindow:{content:"<h4>"+t.data[i].title+'</h4><img src="'+t.data[i].gallery[0]+'" alt="" width="50px" height="auto">'}});var e={map:"#map"};$("#location").geocomplete(e)}function createSidebar(a){for(var t=0;t<a.data.length;t++)$(".items-list .results").append('<li data-category="'+a.data[t].category+'"><div class="item" id="'+a.data[t].id+'"><a href="#" class="image"><div class="inner"><div class="item-specific"></div><img src="'+a.data[t].gallery[0]+'" alt=""></div></a><div class="wrapper"><a href="#" id="'+a.data[t].id+'"><h3>'+a.data[t].title+"</h3></a><figure>"+a.data[t].location+'</figure><div class="info"><div class="type"><i><img src="'+a.data[t].type_icon+'" alt=""></i><span>'+a.data[t].type+'</span></div><div class="rating" data-rating="'+a.data[t].rating+'"></div></div></div></div></li>')}function setInputsWidth(){for(var a=$(".search-bar.horizontal .input-row"),t=0;t<a.length;t++)a.find($('button[type="submit"]')).length&&a.find(".form-group:last").css("width","initial");for(var i=$(".search-bar.horizontal .form-group"),e=0;e<i.length;e++)$(".main-search").addClass(i.length<=2?"inputs-1":i.length<=3?"inputs-2":i.length<=4?"inputs-3":i.length<=5?"inputs-4":i.length<=6?"inputs-5":"inputs-4"),$(".search-bar.horizontal .form-group label").length>0&&$(".search-bar.horizontal .form-group:last-child button").css("margin-top",25)}function searchFilter(){$("#category-filter-search").on("click",function(a){a.preventDefault();var t=$("#category-filter").val();$(".items-list .results").find("li").each(function(a){$(this).removeClass("hide");var i=$(this).data("category");i!=t&&$(this).addClass("hide")})}),$("#reset-filter").on("click",function(a){a.preventDefault(),$(".items-list .results").find("li").each(function(a){$(this).removeClass("hide")}),$("#location").val(""),initMap()})}function loadExifData(){var a=function(a){var t=a.GPSLatitude,i=a.GPSLongitude;$("#lng").val(i),$("#lat").val(t),console.log(a)};try{$("#file").change(function(){$(this).fileExif(a)})}catch(t){console.log(t)}}$(document).ready(function(){initMap(),mobileNavigation(),showModal(),fancySelect(),setInputsWidth(),searchFilter(),submitItem()});