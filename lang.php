<?php

session_start();

if(!isset($_SESSION["lang"])) {
    $_SESSION["lang"] = "en";
}else if (isset($_GET["lang"]) and $_SESSION["lang"] != $_GET["lang"] and !empty($_GET["lang"])   ) {
    if ($_GET["lang"] == "en") {
        $_SESSION["lang"] = "en";
    } else if ($_GET["lang"] == "ar") {
        $_SESSION["lang"] = "ar";
    }
}
require_once "lang/". $_SESSION["lang"] . ".php";

?>