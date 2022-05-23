<?php

use function PHPSTORM_META\type;

if (isset($_POST['name'])) {
    $id = (int)$_POST['id'];
    $name = $_POST['name'];
    // $address = $_POST['address'];
    // $contact = $_POST['contact'];

    include '../../../database.php';
    $obj = new Database();

    $result = $obj->select('*', 'company_profile', "idcompany_profile=" . (int)$id);

    if (!$result->num_rows > 0) {
        $result = $obj->select('*', "company_profile", "company_name LIKE '{$name}'");
        if ($result->num_rows > 0) {
            echo 'company exist';
        } else {
            $result = $obj->insert('company_profile', ['idcompany_profile' => $id, 'company_name' => $name]);

            if ($result) {
                echo 'Added';
            } else {
                echo $result;
                // echo mysqli_error($obj->connection());
            }
        }
    } else {
        echo 'id';
    }
} else {
    include '../../../pagenotfound.php';
}
