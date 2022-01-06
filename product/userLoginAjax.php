<?php

session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    include '../database.php';
    $obj = new Database();

    $username = mysqli_real_escape_string($obj->connection(), $_POST['username']);
    $password = mysqli_real_escape_string($obj->connection(), $_POST['password']);

    $result = $obj->select('*', 'userlogin', "username='{$username}'", null, null);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hash = $row['user_password'];
        if (password_verify($password, $hash)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['user_id'];
            echo 'Successfull Login';
        } else {
            echo 'Incorrect username or password';
        }
    } else {
        echo 'Incorrect username or password';
    }
} else {
    include '../pagenotfound.php';
}
