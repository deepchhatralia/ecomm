<?php

if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['contact']) && isset($_POST['enquiry'])) {
    include 'database.php';
    $obj = new Database();

    $result = $obj->insert('enquiry', ['fname' => $_POST['fname'], 'lname' => $_POST['lname'], 'contact' => $_POST['contact'], 'enquiry' => $_POST['enquiry']]);

    if ($result) {
        echo "Submitted";
    } else {
        echo false;
    }
} else {
    include 'pagenotfound.php';
}
