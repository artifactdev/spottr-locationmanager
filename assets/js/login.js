$(document).ready(function() {
    var documentHeight = $(document).height();
    var header = $('.header').height();
    var pageCanvas = documentHeight - header;

    $('#page-canvas').height(pageCanvas);

    spottr.login.authenticateUser();

});

;
(function($, window, undefined) {
    spottr.login = {
        /**
         * handles the loginform and calls AuthenticationHelper.runAuthenticationCheck(data)
         */
        authenticateUser: function() {
            $('.login-box').find('form').on('submit', function(e) {
                e.preventDefault();
                var url = $(this).attr('action');
                AjaxHandler.request({
                    method: "POST",
                    cache: false,
                    url: url,
                    data: $(this).serializeObject(),
                    success: function(data) {
                        spottr.global.success();
                        AuthenticationHelper.runAuthenticationCheck(data);
                    },
                    error: function() {
                        spottr.global.error('Fehler beim Login!');
                    }
                });

            });
        }
    };
})(jQuery, this);
