function initItems(){var a=51.541216,t=-.095678,e="assets/json/items.json.txt";$.getJSON(e).done(function(a){fillVerwaltung(a)}).fail(function(a,t,e){console.log(e)})}function fillVerwaltung(a){for(var t=$("body").find(".items-list"),e=0;e<a.data.length;e++)t.append('<li><div class="item" id="'+a.data[e].id+'"><a href="#" class="image"><img src="'+a.data[e].gallery+'" alt=""></a><div class="wrapper"><figure>'+a.data[e].category+"</figure><h3>"+a.data[e].title+'</h3></div><div class="col-md-12 item-footer"><div class="col-md-6"><span class="meta-element hidden" id="'+a.data[e].id+'" data-gallery="'+a.data[e].gallery+'" data-longitude="'+a.data[e].longitude+'" data-latitude="'+a.data[e].latitude+'" data-title="'+a.data[e].title+'" data-type="'+a.data[e].type+'"  data-category="'+a.data[e].category+'" data-location="'+a.data[e].location+'" data-aperture="'+a.data[e].aperture+'" data-date="'+a.data[e].date+'" data-focal="'+a.data[e].focal+'" data-iso="'+a.data[e].iso+'" data-rating="'+a.data[e].rating+'"><h3>'+a.data[e].title+'</h3></span><a href="#" class="btn btn-default btn-edit">Edit</a></div><div class="col-md-6"><a href="#" class="btn btn-red btn-delete">Delete</a></div></div></div></li>')}function showEditModal(){function a(a){var t=a;editModal(t);var e=$("#edit-modal");e.removeClass("hide"),e.addClass("fade-in"),$("#edit-modal .modal-close").on("click",function(){e.addClass("hide"),e.removeClass("fade-in")})}$("body").on("click",".btn-edit",function(t){var e=$(this).closest(".item").find(".meta-element");a(e)}),$("#geocomplete").geocomplete({details:"#add-form",types:["geocode","establishment"]})}function showDeleteModal(){function a(a){var t=a;deleteModal(t);var e=$("#delete-modal");e.removeClass("hide"),e.addClass("fade-in"),$("#delete-modal .modal-close").on("click",function(){e.addClass("hide"),e.removeClass("fade-in")})}$("body").on("click",".btn-delete",function(t){var e=$(this).closest(".item").find(".meta-element");a(e)})}function fancySelect(){var a=$("select");a.length>0&&a.selectpicker();var t=$(".bootstrap-select"),e=$(".dropdown-menu");t.on("shown.bs.dropdown",function(){e.removeClass("animation-fade-out"),e.addClass("animation-fade-in")}),t.on("hide.bs.dropdown",function(){e.removeClass("animation-fade-in"),e.addClass("animation-fade-out")}),t.on("hidden.bs.dropdown",function(){var a=$(this);$(a).addClass("open"),setTimeout(function(){$(a).removeClass("open")},100)})}function editModal(a){fancySelect();var t=$("#edit-modal"),e=a.data("title"),d=a.data("latitude"),i=a.data("longitude"),l=a.data("gallery"),n=a.data("category"),o=a.data("date_created"),s=a.data("aperture"),c=a.data("focal"),r=a.data("iso"),f=a.data("rating");t.find("#title").val(e),t.find("#category").val(n),t.find("#date").val(o),t.find("#aperture").val(s),t.find("#focal").val(c),t.find("#iso").val(r),t.find("#lng").val(i),t.find("#lat").val(d),t.find("#rating").val(f)}function deleteModal(a){var t=$("#delete-modal"),e=a.attr("id"),d=a.data("title");t.find("#id").val(e),t.find(".location").text(d)}$(document).ready(function(){initItems(),showEditModal(),showDeleteModal()});