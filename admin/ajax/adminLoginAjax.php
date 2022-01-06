<?php

if (isset($_POST['username']) && isset($_POST['password'])) {
    include '../../database.php';
    include '../../includee/config.php';
    $obj = new Database();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM userlogin WHERE user_name = '{$username}'";
    $result = mysqli_query($conn,$sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hash = $row['user_password'];

        if ($password == $hash) {
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
