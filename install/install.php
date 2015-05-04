<!DOCTYPE html>
<html lang="en-US" style="height: auto;">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/styles/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="../assets/styles/bootstrap-select.min.css" type="text/css">
        <link rel="stylesheet" href="../assets/styles/font-awesome.css" type="text/css">
        <link rel="stylesheet" href="../assets/styles/style.css" type="text/css">
        <link rel="stylesheet" href="./install.css" type="text/css">
        <title>Spottr - Installation</title>
    <body onunload="" class="page-login navigation-off-canvas page-fade-in" id="page-top" data-feedly-mini="yes">
        <!-- Outer Wrapper-->
        <div id="outer-wrapper">
            <!-- Inner Wrapper -->
            <div id="inner-wrapper">
                <!-- Navigation-->
                <div class="header">
                    <div class="wrapper">
                        <div class="brand">
                            <a href="#"><img src="../assets/img/logo.png" alt="logo"></a>
                        </div>
                    </div>
                </div>
                <!-- end Navigation-->
                <!-- Page Canvas-->
                <div id="page-canvas">
                    <!--Page Content-->
                    <div id="page-content">
                        <div class="install-box">
                            <h2>Datenbank</h2>
                            <form action="install">
                                <input type="text" id="database" name="database" placeholder="Datenbankname" />
                                <input type="text" id="username" name="username" placeholder="Username" />
                                <input type="password" id="password" name="password" placeholder="Passwort" />
                                <input type="text" id="databasehost" name="databasehost" placeholder="Databasehost (localhost)" />
                                <button type="submit" class="btn btn-default">Anlegen</button>
                            </form>
                        </div>
                        <div class="adminuser-box hide">
                            <h2>Administrator Login</h2>
                            <form action="install">
                                <input type="text" id="email" name="email" placeholder="Username" />
                                <input type="password" id="password" name="password" placeholder="Password" />
                                <button type="submit" class="btn btn-default">Logins</button>
                            </form>
                        </div>
                    </div>
                    <!-- end Page Canvas-->
                    <!--Page Footer-->
                    <footer id="page-footer">
                        <div class="inner">
                            <!--/.footer-top-->
                            <div class="footer-bottom">
                                <div class="container">
                                    <span class="left">(C) ART-ifact, All rights reserved</span>
                                </div>
                            </div>
                            <!--/.footer-bottom-->
                        </div>
                    </footer>
                    <!--end Page Footer-->
                </div>
                <!-- end Inner Wrapper -->
            </div>
            <!-- end Outer Wrapper-->

             <!-- start libs -->
            <script type="text/javascript" src="../assets/js/libs/jquery-2.1.0.min.js"></script>
            <script type="text/javascript" src="../assets/js/libs/bootstrap.min.js"></script>

            <!-- end libs -->

            <!-- start plugins -->
            <script type="text/javascript" src="../assets/js/plugins/gmaps.js"></script>
            <script type="text/javascript" src="../assets/js/plugins/jquery.validate.js"></script>
            <script type="text/javascript" src="../assets/js/plugins/jquery.validate.bootstrap.js"></script>

            <!-- end plugins -->

            <!-- start application -->
            <script type="text/javascript" src="./install.js"></script>

            <!-- end application -->
        </div>
        <div class="pac-container hdpi" style="display: none;"></div>
    </body>
</html>