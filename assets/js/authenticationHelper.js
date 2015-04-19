;
(function() {
    AuthenticationHelper = function() {
 
        var authenticationToken = null;
        var currentUser = null;
        var factory = {};
       
        /**
         * Prüft initial die Authentisierung.
         */
         factory.initialAuthCheck = function() {
             var cookieValue = $.cookie("X-MJRestApi-AuthInfo");
             if (cookieValue === undefined || cookieValue == null || cookieValue == "null") {
                // wenn nicht eingeloggt weiterleitung auf Login

                 //GuiHandler.show("authentication");
                 //GuiHandler.remove("initialize");
                 return;
             }
             cookieValue = $.parseJSON(cookieValue);
             factory.runAuthenticationCheck(cookieValue);
         };
 
        /**
         * Ist der Nutzer eingeloggt.
         */
         factory.isAuthenticated = function() {
             var token = authenticationToken;
 
             if (token == null) {
                 return false;
             }
             if (token.userUUId == undefined) {
                 return false;
             }
             return true;
 
         };
 
        /**
         * Lädt die Daten des aktuell eingeloggten Nutzers.
         */
         factory.loadCurrentUser = function(callback) {
             if (currentUser != null || !this.isAuthenticated()) {
                 return;
             }
 
             AjaxHandler.request({
                 url : "users/" + authenticationToken.userUUId,
                 method : "get",
                 success : function(data) {
                     currentUser = data;
 
                     if (typeof callback == "function") {
                         callback(currentUser);
                     }
                 }
             });
         };
 
        /**
         * Setze Authenticationtoken
         */
         factory.setAuthenticationToken = function(newToken) {
             authenticationToken = newToken;
             $.cookie("X-MJRestApi-AuthInfo", JSON.stringify(newToken), {
                 expires : (1 / 24),
                 path : "/"
             });
         };
 
        /**
         * Setze Authenticationtoken
         */
         factory.runAuthenticationCheck = function(token) {
 
             if (token == null || token.userUUId == undefined) {
                 // weiterleiten auf login
                  
                 //GuiHandler.show("authentication");
                 //GuiHandler.remove("initialize");
                 return;
             }
 
             this.setAuthenticationToken(token);
             this.loadCurrentUser(function(currentUser) {
 
                 if ($.inArray("1", currentUser.roles) >= 0) {
                    // Admin
                    
                }
                if ($.inArray("2", currentUser.roles) >= 0) {
                    // Kunde
                   
                }
               
                // weiterleiten auf index bzw jetzt isser angemeldet
            })
         };
 
        /**
         * Hole Authentication token.
         */
         factory.getAuthenticationToken = function() {
             return authenticationToken;
         };
 
         return factory;
     }();
     AuthenticationHelper.initialAuthCheck();
})();