<?php
session_start();
if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] == true) {
    session_unset();
    session_destroy();
    header("Location: http://localhost/ecomm/admin/");
} else {
    include '../pagenotfound.php';
}
