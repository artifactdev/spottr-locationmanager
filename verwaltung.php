<!DOCTYPE html>
<!-- saved from url=(0030)http://localhost:8888/spotter/ -->
<html lang="en-US" style="height: auto;">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./assets/styles/font-awesome.css" type="text/css">
        <link rel="stylesheet" href="./assets/styles/style.css" type="text/css">
        <title>Spottr</title>
    <body onunload="" class="page-verwaltung navigation-off-canvas page-fade-in" id="page-top" data-feedly-mini="yes">
    <?php include 'languageloader.php' ?>
        <!-- Outer Wrapper-->
        <div id="outer-wrapper">
            <!-- Inner Wrapper -->
            <div id="inner-wrapper">
                <!-- Navigation-->
                <?php
                    $isVerwaltung = true;
                ?>
                <?php
                    include 'assets/moduls/header.php';
                ?>
                <!-- end Navigation-->
                <!-- Page Canvas-->
                <div id="page-canvas">
                    <!--Page Content-->
                    <div id="page-content">
                        <?php
                            #include 'assets/moduls/searchbar.php';
                        ?>
                        <div class="col s12 search-bar">
                        </div>
                        <div class="items-list">

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <!-- end Page Canvas-->
                    <!--Page Footer-->
                    <?php
                        include 'assets/moduls/footer.php';
                    ?>
                    <!--end Page Footer-->
                </div>
                <!-- end Inner Wrapper -->
            </div>
            <!-- end Outer Wrapper-->

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
            <script type="text/javascript" src="./assets/js/language.js"></script>
            <script type="text/javascript" src="./assets/js/global.js"></script>
            <script type="text/javascript" src="./assets/js/ajaxHandler.js"></script>
            <script type="text/javascript" src="./assets/js/authenticationHelper.js"></script>
            <script type="text/javascript" src="./assets/js/userhandler.js"></script>
            <script type="text/javascript" src="./assets/js/administration.js"></script>

            <!-- end application -->
        </div>
        <div class="pac-container hdpi" style="display: none;"></div>
        <?php
            include 'assets/moduls/add-modal.php';
            include 'assets/moduls/edit-modal.php';
            include 'assets/moduls/delete-modal.php';

            include 'assets/moduls/user-modal.php';
            include 'assets/moduls/item-modal.php';
        ?>
    </body>
</html>