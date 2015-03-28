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
    <body onunload="" class="page-login navigation-off-canvas page-fade-in" id="page-top" data-feedly-mini="yes">
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
                        <div class="login-box">
                            <input type="text" placeholder="Username" />
                            <input type="password" placeholder="Password" />
                            <input type="button" class="btn btn-default" value="Login"/>
                        </div>
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
            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&amp;libraries=places"></script>
            <script type="text/javascript" src="./assets/js/jquery-2.1.0.min.js"></script>
            <script type="text/javascript" src="./assets/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="./assets/js/bootstrap-select.min.js"></script>
            <script type="text/javascript" src="./assets/js/login.js"></script>
        </div>
        <div class="pac-container hdpi" style="display: none;"></div>
        <?php 
            include 'assets/moduls/add-modal.php';
            include 'assets/moduls/item-modal.php';
        ?>
    </body>
</html>