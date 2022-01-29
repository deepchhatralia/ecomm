<?php
session_start();
if (isset($_POST['operation']) && $_POST['operation'] == "login") {
    $username = $_POST['username'];

    include 'database.php';
    $obj = new Database();

    $result = $obj->select('*', 'userlogin', "user_name='{$username}'");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hash = $row['user_password'];
        if (password_verify($_POST['password'], $hash)) {
            $_SESSION['userlogin'] = $row['userid'];
            $_SESSION['username'] = $username;

            echo "Successfull";
        }
    } else {
        echo false;
    }
} else if (isset($_POST['operation']) && $_POST['operation'] == "signup") {
    include 'database.php';
    $obj = new Database();

    $fname = mysqli_real_escape_string($obj->connection(), $_POST['fname']);
    $lname = mysqli_real_escape_string($obj->connection(), $_POST['lname']);
    $email = mysqli_real_escape_string($obj->connection(), $_POST['email']);
    $contact = mysqli_real_escape_string($obj->connection(), $_POST['contact']);
    $username = mysqli_real_escape_string($obj->connection(), $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $squestion = mysqli_real_escape_string($obj->connection(), $_POST['squestion']);
    $sanswer = mysqli_real_escape_string($obj->connection(), $_POST['sanswer']);

    $result = $obj->select('*', 'userlogin', "user_name='{$username}'");

    if ($result->num_rows > 0) {
        echo "Username already exist";
    } else {
        $result = $obj->select('*', 'userlogin', "user_email='{$email}'");

        if ($result->num_rows > 0) {
            echo "Email already exist";
        } else {
            $result = $obj->insert('userlogin', ['user_name' => $username, 'user_password' => $password, 'user_firstname' => $fname, 'user_lastname' => $lname, 'user_email' => $email, 'security_question' => $squestion, 'security_answer' => $sanswer, 'user_contact_number' => $contact, 'area_idarea' => 1]);

            if ($result) {
                echo "success";
            } else {
                echo "Try again...";
            }
        }
    }
} else {
    include 'pagenotfound.php';
}
