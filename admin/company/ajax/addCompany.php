<?php

use function PHPSTORM_META\type;

if (isset($_POST['name']) && isset($_POST['address']) && isset($_POST['contact'])) {
    $id = (int)$_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    include '../../../database.php';
    $obj = new Database();

    $result = $obj->select('*', 'company_profile', "idcompany_profile=" . (int)$id);

    if (!$result->num_rows > 0) {
        $result = $obj->insert('company_profile', ['idcompany_profile' => $id, 'company_name' => $name, 'company_address' => $address, 'company_contact_number' => $contact]);

        if ($result) {
            echo 'Added';
        } else {
            echo $result;
        }
    } else {
        echo 'id';
    }
} else {
    include '../../../pagenotfound.php';
}
