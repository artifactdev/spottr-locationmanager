<!DOCTYPE html>
<html lang="en-US" style="height: auto;">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./assets/styles/font-awesome.css" type="text/css">
        <link rel="stylesheet" href="./assets/styles/style.css" type="text/css">
        <title>Spottr</title>
    <body onunload="" class=" page-homepage navigation-off-canvas page-fade-in login" id="page-top">

            <!-- Navbar goes here -->
           <?php include 'assets/moduls/header.php' ?>
            <!-- Page Layout here -->
            <main>
                <div class="row">
                    <?php include 'assets/moduls/sidebar.php'; ?>
                    <div class="no-padding col s12">
                      <!-- Teal page content  -->
                      <div id="map"></div>
                    </div>
                    <div class="fixed-action-btn">
                          <a class="btn-floating submit-item btn-large">
                            <i class="material-icons mdi-av-playlist-add">playlist_add</i>
                          </a>
                    </div>

                </div>
            </main>
            <!-- start libs -->
            <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true&amp;libraries=places"></script>
            <script type="text/javascript" src="./assets/js/libs/jquery-2.1.0.min.js"></script>
            <script type="text/javascript" src="./assets/js/libs/materialize.min.js"></script>


            <!-- end libs -->

            <!-- start plugins -->
            <script type="text/javascript" src="./assets/js/plugins/gmaps.js"></script>
            <script type="text/javascript" src="./assets/js/plugins/jqueryExtensions.js"></script>
            <script type="text/javascript" src="./assets/js/plugins/jquery.cookie.js"></script>
            <script type="text/javascript" src="./assets/js/plugins/jquery.exif.js"></script>
            <script type="text/javascript" src="./assets/js/plugins/jquery.geocomplete.min.js"></script>
            <script type="text/javascript" src="./assets/js/plugins/richmarker.js"></script>
            <script type="text/javascript" src="./assets/js/plugins/markerclusterer.js"></script>
            <script type="text/javascript" src="./assets/js/plugins/jquery.validate.js"></script>
            <script type="text/javascript" src="./assets/js/plugins/star-rating.js"></script>
            <script type="text/javascript" src="./assets/js/plugins/filterJSON.plugin.js"></script>
            <script type="text/javascript" src="./assets/js/plugins/spin.min.js"></script>
            <script type="text/javascript" src="./assets/js/plugins/iosOverlay.js"></script>


            <!-- end plugins -->

            <!-- start application -->
            <script type="text/javascript" src="./assets/js/global.js"></script>
            <script type="text/javascript" src="./assets/js/ajaxHandler.js"></script>
            <script type="text/javascript" src="./assets/js/authenticationHelper.js"></script>
            <script type="text/javascript" src="./assets/js/infobox.js"></script>
            <script type="text/javascript" src="./assets/js/maps.js"></script>
            <script type="text/javascript" src="./assets/js/main.js"></script>

            <!-- end application -->

        <?php
            include 'assets/moduls/add-modal.php';
            include 'assets/moduls/item-modal.php';
        ?>
    </body>
</html>