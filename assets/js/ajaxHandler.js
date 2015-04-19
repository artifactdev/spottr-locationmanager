
;
(function() {
    /**
     * Der AJAX Handler abstrahiert die AJAX-Anbindung von jQuery, und bereitet
     * die Anfragen + Übergabewerte im richtigen Format für die Anfrage vor. Des
     * Weiteren führt er eine zentrale Fehlerbehandlung durch.
     */
    AjaxHandler = function() {
 
        /**
         * Private Methode zum Ausführen einer Ajax-Anfrage.
         *
         * @param config
         *            Ajax-Anfragedaten, z.b. URL, Methode, ...
         */
        function makeRequest(config) {
            $.ajax({
                url : path + 'rest-api/' + config.url,
                type : config.method,
                data : config.data,
                headers : config.headers,
                success : function(data) {
                    if (typeof config.success === "function") {
                        if (typeof data === "string") {
                            data = $.parseJSON(data);
                        }
                        config.success(data);
                    }
                },
                error : function(httpResponse) {
                   
                    var jsonData = $.parseJSON(httpResponse.responseText);
                    if (typeof jsonData == "object" && jsonData.errorMessage != undefined && jsonData.errorType != undefined) {
                        
                        if (typeof config.error === "function") {
                            var status = httpResponse.status;
                            config.error(jsonData, status);
                            return;
                        }
                    }
                }
            });
        }
 
        /**
         * Vorbereitung der Ajax Anfrage
         */
        function prepareAjaxConfig(config) {
            config.method = config.method !== undefined ? config.method : "GET";
            if (typeof config.data === "object") {
                config.data = JSON.stringify(config.data);
            }
            config.headers = {
                "Content-Type" : "application/json"
            };
            var authInfo = $.cookie("authInfo");
             if (AuthenticationHelper.isAuthenticated()) {
                config.headers = {
                    "Content-Type" : "application/json",
                    "X-MJRestApi-AuthInfo" : JSON.stringify(AuthenticationHelper.getAuthenticationToken())
                };
            }
            return config;
        }
 
        return {
            /**
             * Führt eine Ajax-Anfrage mit der gegebenen Konfiguration aus.
             */
            request : function(config) {
                var newConfig = prepareAjaxConfig(config);
                makeRequest(newConfig);
            }
        };
    }();
})();
