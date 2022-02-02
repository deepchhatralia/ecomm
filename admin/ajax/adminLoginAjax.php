<?php

if (isset($_POST['username']) && isset($_POST['password'])) {
    include '../../database.php';
    $obj = new Database();

    $username = $_POST['username'];
    $password = $_POST['password'];

    // $sql = "SELECT * FROM userlogin WHERE user_name = '{$username}'";
    $result = $obj->select('*', 'userlogin', "user_name='{$username}'");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hash = $row['user_password'];

        if (password_verify($password, $hash)) {
            session_start();
            $_SESSION['admin_loggedin'] = true;
            echo 'Successfull loggedin';
        } else {
            echo 'Incorrect username or password';
        }
    } else {
        echo 'Incorrect username or password';
    }
} else {
    include '../../pagenotfound.php';
}
