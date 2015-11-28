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
            <header class="header">
                <nav>
                  <div class="nav-wrapper">
                    <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
                    <a href="index.php" class="brand-logo left"><img src="assets/img/logo.png" alt="logo"></a>
                    <ul id="nav-mobile" class="right">
                      <li><a href="#">Users</a></li>
                      <li><a href="verwaltung.php">Verwaltung</a></li>
                      <li><a href="#">Logout</a></li>
                      <li><a href="#" class="submit-item">Spot hinzufügen</a></li>
                    </ul>
                  </div>
                </nav>
            </header>
            <!-- Page Layout here -->
            <main>
                <div class="row">
                    <div id="slide-out" class="side-nav fixed">
                      <h3 class="center">Results</h3>
                      <div class="input-field col s12">
                            <select class="icons">
                              <option value="0" disabled selected>Choose your option</option>
                              <option value="1" >example 1</option>
                              <option value="2" >example 2</option>
                              <option value="3" >example 1</option>
                            </select>
                            <label>Filter</label>
                          </div>
                          <div class="col s12 results"></div>
                    </div>
                    <div class="no-padding col s12">
                      <!-- Teal page content  -->
                      <div id="map"></div>
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

        <?php
            include 'assets/moduls/add-modal.php';
            include 'assets/moduls/item-modal.php';
        ?>
    </body>
</html>