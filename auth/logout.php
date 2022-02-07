<?php

session_start();
if (isset($_SESSION['userlogin'])) {
    session_unset();
    session_destroy();
    header("Location: http://localhost/ecomm/");
} else {
    include './pagenotfound.php';
}
