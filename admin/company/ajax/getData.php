<?php

include '../../../database.php';
$obj = new Database();

if (isset($_POST['id']) && isset($_POST['operation']) && $_POST['operation'] == 'select') {
    $id = (int)$_POST['id'];

    $result = $obj->select('*', 'company_profile', "idcompany_profile = {$id}");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $name = $row['company_name'];
        // $address = $row['company_address'];
        // $contact = $row['company_contact_number'];

        $arr = array($id, $name);
        $arr = json_encode($arr);
        echo $arr;
    }
} else if (isset($_POST['myid']) && isset($_POST['id']) && isset($_POST['name']) && $_POST['operation'] == "update") {
    $myid = $_POST['myid'];
    $id = $_POST['id'];
    $name = $_POST['name'];
    // $address = $_POST['address'];
    // $contact = $_POST['contact'];

    $result = $obj->select('*', 'company_profile', "idcompany_profile=" . $id);

    if ($result->num_rows > 1) {
        echo "ID already exist";
        echo $myid . $id;
    } else {
        $result = $obj->update('company_profile', ['idcompany_profile' => $id, 'company_name' => $name], "idcompany_profile={$myid}");


        // 'company_address' => $address, 'company_contact_number' => $contact

        if ($result) {
            echo "updated";
        } else {
            if (mysqli_errno($obj->connection()) == 1062) {
                echo "ID already exist";
            } else {
                echo "Please try again...";
            }
        }
    }
} else if (isset($_POST['id']) && $_POST['operation'] == "delete") {
    $id = (int)$_POST['id'];

    $result = $obj->delete('company_profile', "idcompany_profile={$id}");

    if (mysqli_errno($obj->connection()) == 1451) {
        echo "Can't delete. Product of this company available in stock";
    } else {
        echo "deleted";
    }
} else {
    include '../../../pagenotfound.php';
}
