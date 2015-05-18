<?php
if (count($_POST) > 0)
{
    include 'mysqlsetup.php';
    $test = new mysqlsetup();
    $test->setup(setup($_POST));
}
?>
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
                            <form action="install.php" method="post">
                                <input type="hidden" name="type" value="dbsetup"/>
                                <input type="text" id="database" name="database" placeholder="Datenbankname" required/>
                                <input type="text" id="username" name="username" placeholder="Username" required/>
                                <input type="password" id="password" name="password" placeholder="Passwort" required/>
                                <input type="text" id="databasehost" name="databasehost" placeholder="Databasehost (localhost)" required/>
                                <input type="submit" class="btn btn-default" value="Datenbank anlegen"/>
                            </form>
                        </div>
                        <div class="adminuser-box hide">
                            <h2>Administrator Login</h2>
                            <form action="install.php" id="admin-form">
                                <input type="text" id="email" name="email" placeholder="E-Mail" required/>
                                <input type="password" id="password" name="password" placeholder="Passwort" required/>
                                <input type="text" id="vorname" name="vorname" placeholder="Vorname" required/>
                                <input type="text" id="nachname" name="nachname" placeholder="Nachname" required/>
                                <input type="text" id="firma" name="firma" placeholder="Firma" required/>
                                <button type="submit" class="btn btn-default">Admin anlegen</button>
                            </form>
                        </div>
                        <div class="success-box hide">
                            <h2>Installation erfolgreich</h2>
                            <p>
                                Die installation war erfolgreich und Sie können sich in die Anwendung mit den von Ihnen eingetragenen Adminuser einloggen.
                                Löschen Sie nun den Install Ordner aus dem Root-Verzeichnis der Anwendung.
                            </p>
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

            <script>
            $('body').find('#admin-form').on('submit',function(e){
                e.preventDefault();
                var adminForm = $('#admin-form');

                adminForm.validate();
                if(adminForm.valid()) {
                    $.ajax({
                        type     : 'POST',
                        cache    : false,
                        url      : $(this).attr('action')
                    }).success(function() {
                        $('.install-box').addClass('hide');
                        $('.adminuser-box').removeClass('hide');
                    }).error(function() {
                        console.log('could not add database');
                    });
                }
            });

            $('body').find('#db-form').on('submit',function(e){
                    e.preventDefault();
                    var dbForm = $('#db-form');

                    dbForm.validate();
                    if(dbForm.valid()) {
                        $.ajax({
                            type     : 'POST',
                            cache    : false,
                            url      : $(this).attr('action'),
                        }).success(function() {
                            $('.adminuser-box').addClass('hide');
                            $('.success-box').removeClass('hide');
                        }).error(function() {
                            console.log('could not add database');
                        });
                    }
                });
            </script>

            <!-- end plugins -->

            <!-- start application -->
            <script type="text/javascript" src="./install.js"></script>

            <!-- end application -->
        </div>
        <div class="pac-container hdpi" style="display: none;"></div>
    </body>
</html>