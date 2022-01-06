<?php

include 'includee/config.php';

if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    include 'database.php';
    $obj = new Database();

    $fullname = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $result = $obj->select('*','userlogin',"username='{$username}'",null,null);


    if ($result->num_rows > 0) {
        echo 'Username already exist';
    }else {
        $result = $obj->select('*','userlogin',"user_email = '{$email}'");

        if ($result->num_rows > 0) {
            echo 'Email already exist';
        } else {
            $result2 = $obj->insert('userlogin',['fullname'=>$fullname,'username'=>$username,'user_password'=>$password,'user_email'=>$email]);

            if ($result2) {
                echo 'Signed up';
            }
        }
    }
} else {
    echo '<h1>Page not found</h1>';
}

?>