<!DOCTYPE html>
<html lang="en-US" style="height: auto;">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/styles/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="assets/styles/bootstrap-select.min.css" type="text/css">
        <link rel="stylesheet" href="assets/styles/font-awesome.css" type="text/css">
        <link rel="stylesheet" href="assets/styles/style.css" type="text/css">
        <title>Spottr</title>
    </head>
    <body onunload="" class="page-login navigation-off-canvas page-fade-in" id="page-top">
        <?php include 'languageloader.php' ?>
        <?php
            include 'assets/moduls/header.php';
        ?>
        <main>
            <div class="row">
                <div class="login-box">
                    <form action="authentication">
                        <div class="input-field">
                            <input type="text" id="email" name="email" class="validate"/>
                            <label for="email"><?php echo "$email" ?></label>
                        </div>

                        <div class="input-field">
                            <input type="password" id="password" name="password" class="validate"/>
                            <label for="password"><?php echo "$password" ?></label>
                        </div>

                        <button type="submit" class="btn btn-default pull-right"><?php echo "$login" ?></button>
                    </form>
                </div>

            </div>
        </main>

        <?php
            include 'assets/moduls/footer.php';
        ?>

         <!-- start libs -->
        <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true&amp;libraries=places"></script>
        <script type="text/javascript" src="./assets/js/libs/jquery-2.1.0.min.js"></script>
        <script type="text/javascript" src="./assets/js/libs/bootstrap.min.js"></script>
        <script type="text/javascript" src="./assets/js/libs/materialize.min.js"></script>

        <!-- end libs -->

        <!-- start plugins -->
        <script type="text/javascript" src="./assets/js/plugins/gmaps.js"></script>
        <script type="text/javascript" src="./assets/js/plugins/jqueryExtensions.js"></script>
        <script type="text/javascript" src="./assets/js/plugins/jquery.cookie.js"></script>
        <script type="text/javascript" src="./assets/js/plugins/jquery.validate.js"></script>
        <script type="text/javascript" src="./assets/js/plugins/jquery.validate.bootstrap.js"></script>
        <script type="text/javascript" src="./assets/js/plugins/spin.min.js"></script>
        <script type="text/javascript" src="./assets/js/plugins/iosOverlay.js"></script>

        <!-- end plugins -->

        <!-- start application -->
        <script type="text/javascript" src="./assets/js/language.js"></script>
        <script type="text/javascript" src="./assets/js/global.js"></script>
        <script type="text/javascript" src="./assets/js/ajaxHandler.js"></script>
        <script type="text/javascript" src="./assets/js/authenticationHelper.js"></script>
        <script type="text/javascript" src="./assets/js/login.js"></script>
    </body>
</html>