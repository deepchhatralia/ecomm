<?php

if (isset($_POST['operation'])) {
    include '../database.php';
    $obj = new Database();

    $output = '<option value="0" selected disabled>Choose...</option>';

    if (isset($_POST['stateId']) && $_POST['operation'] == "get city") {
        $stateId = $_POST['stateId'];

        $result = $obj->select('*', 'city', "state_idstate=" . $stateId);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $output .= '<option value="' . $row['idcity'] . '">' . $row['city_name'] . '</option>';
            }
            echo $output;
        }
    } else if (isset($_POST['cityId']) && $_POST['operation'] == "get area") {
        $cityId = $_POST['cityId'];

        $result = $obj->select('*', 'area', 'city_idcity=' . $cityId);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $output .= '<option value="' . $row['idarea'] . '">' . $row['area'] . '</option>';
            }
            echo $output;
        }
    }
}
