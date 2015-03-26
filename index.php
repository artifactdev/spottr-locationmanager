<!DOCTYPE html>
<!-- saved from url=(0030)http://localhost:8888/spotter/ -->
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
    <body onunload="" class="map-fullscreen page-homepage navigation-off-canvas page-fade-in" id="page-top" data-feedly-mini="yes">
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
                                    include 'assets/moduls/searchbar.php';
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
                    <!--Page Footer-->
                    <?php 
                        include 'assets/moduls/footer.php';
                    ?>
                    <!--end Page Footer-->
                </div>
                <!-- end Inner Wrapper -->
            </div>
            <!-- end Outer Wrapper-->
            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;libraries=places"></script>
            <script type="text/javascript" src="./assets/js/jquery-2.1.0.min.js"></script>
            <script type="text/javascript" src="./assets/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="./assets/js/bootstrap-select.min.js"></script>
            <script type="text/javascript" src="./assets/js/jquery.geocomplete.min.js"></script>
            <script type="text/javascript" src="./assets/js/jquery.exif.js"></script>
            <script type="text/javascript" src="./assets/js/gmaps.js"></script>
            <script type="text/javascript" src="./assets/js/main.js"></script>
 
            
        </div>
        <div class="pac-container hdpi" style="display: none;"></div>
        <?php 
            include 'assets/moduls/add-modal.php';
            include 'assets/moduls/item-modal.php';
        ?>
    </body>
</html>