<?php

session_start();
if (isset($_SESSION['userlogin'])) {
    $_SESSION = array();
    session_unset();
    session_destroy();
    header("location: http://localhost/ecomm/");
} else {
    include './pagenotfound.php';
}
