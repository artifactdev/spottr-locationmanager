<!DOCTYPE html>
<html lang="en-US" style="height: auto;">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./assets/styles/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="./assets/styles/bootstrap-select.min.css" type="text/css">
        <link rel="stylesheet" href="./assets/styles/font-awesome.css" type="text/css">
        <link rel="stylesheet" href="./assets/styles/style.css" type="text/css">
        <title>Spottr</title>
    <body onunload="" class="map-fullscreen page-homepage navigation-off-canvas page-fade-in login" id="page-top" data-feedly-mini="yes">
        <!-- Outer Wrapper-->
        <div id="outer-wrapper">
            <!-- Inner Wrapper -->
            <div id="inner-wrapper">
                <!-- Navigation-->
                <?php 
                    include 'assets/moduls/header.php';
                ?>
                <!-- end Navigation-->
                <!-- Page Canvas-->
                <div id="page-canvas">
                    <!--Page Content-->
                    <div id="page-content">
                        <!-- Map Canvas-->
                        <div class="map-canvas list-width-30">
                            <!-- Map -->
                            <div class="map">
                                <div class="toggle-navigation">
                                    <div class="icon">
                                        <div class="line"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                    </div>
                                </div>
                                <div id="map" class="has-parallax"></div>
                                <!--/#map-->
                                <?php 
                                    #include 'assets/moduls/searchbar.php';
                                ?>
                            </div>
                            <!-- end Map -->
                            <!--Items List-->
                            <?php 
                                include 'assets/moduls/sidebar.php';
                            ?>
                            <!--end Items List-->
                        </div>
                        <!-- end Map Canvas-->
                    </div>
                    <!-- end Page Canvas-->
                </div>
                <!-- end Inner Wrapper -->
            </div>
            <!-- end Outer Wrapper-->
            <!-- start libs -->
            <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true&amp;libraries=places"></script>
            <script type="text/javascript" src="./assets/js/libs/jquery-2.1.0.min.js"></script>
            <script type="text/javascript" src="./assets/js/libs/bootstrap.min.js"></script>

            <!-- end libs -->

            <!-- start plugins -->
            <script type="text/javascript" src="./assets/js/plugins/gmaps.js"></script>
            <script type="text/javascript" src="./assets/js/plugins/jqueryExtensions.js"></script>
            <script type="text/javascript" src="./assets/js/plugins/jquery.cookie.js"></script>
            <script type="text/javascript" src="./assets/js/plugins/jquery.exif.js"></script>
            <script type="text/javascript" src="./assets/js/plugins/jquery.geocomplete.min.js"></script>
            <script type="text/javascript" src="./assets/js/plugins/bootstrap-select.min.js"></script>
            <script type="text/javascript" src="./assets/js/plugins/richmarker.js"></script>
            <script type="text/javascript" src="./assets/js/plugins/markerclusterer.js"></script>
            <script type="text/javascript" src="./assets/js/plugins/jquery.validate.js"></script>
            <script type="text/javascript" src="./assets/js/plugins/jquery.validate.bootstrap.js"></script>
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
 
            
        </div>
        <div class="pac-container hdpi" style="display: none;"></div>
        <?php 
            include 'assets/moduls/add-modal.php';
            include 'assets/moduls/item-modal.php';
        ?>
    </body>
</html>