$(document).ready(function() {
    var documentHeight = $( document ).height();
    var header = $('.header').height();
    var pageCanvas = documentHeight - header;

    $('#page-canvas').height(pageCanvas);

    spottr.login.authenticateUser();

});

;(function ($, window, undefined) {
    spottr.login = {
        authenticateUser: function () {
            $('.login-box').find('form').on('submit',function(e){
                e.preventDefault();
                var url = $(this).attr('action');
                AjaxHandler.request({
                    method     : "POST",
                    cache    : false,
                    url      : url,
                    data     : $(this).serializeObject(),
                    success  : function(data) {
                       AuthenticationHelper.runAuthenticationCheck(data);
                    }
                });

            });
        }
    };
})(jQuery, this);

