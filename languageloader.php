<?php
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    switch ($lang){
        case "de":
          include('lang/de_DE.php');
          break;
        case "en":
          include("./lang/en_EN.php");
          break;
        default:
          include("./lang/de_DE.php");
          break;
    }
?>