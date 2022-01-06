<?php

session_start();
if (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
    $_SESSION = array();
    session_unset();
    session_destroy();
    header("location: http://localhost/ecomm/");
}
