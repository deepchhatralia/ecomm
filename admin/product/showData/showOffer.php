<?php

if (isset($_POST['operation']) && $_POST['operation'] == "select") {


    include '../../../database.php';
    include '../../../includee/config.php';

    $obj = new Database();

    $sql = "SELECT * FROM `offer`";

    $result = mysqli_query($conn, $sql);

    $output = "";

    while ($row = mysqli_fetch_assoc($result)) {
        $startDate = $row['offer_startDate'];
        $endDate = $row['offer_endDate'];
        $buttonGroup = '<td style="font-size: 13px;">
                <button id="fa-edit" class="mb-1 my-btn bg-success edit-btn"><i class="far fa-edit mx-1"></i> Edit</button> 
                <button id="fa-trash-alt" class="mb-1 my-btn bg-danger delete-btn"><i class="fas fa-trash-alt mx-1"></i> Delete</button>
            </td>';
        if ($row['idoffer'] == '0') {
            $buttonGroup = "";
            $startDate = "";
            $endDate = "";
        }
        $output .= '<tr class="border-b border-gray-200 hover:bg-gray-100">
            <td>' . $row['idoffer'] . '</td>
            <td>' . $row['offer_name'] . '</td>
            <td>' . $row['offer_detail'] . '</td>
            <td>' . $startDate . '</td>
            <td>' . $endDate . '</td>
            <td>' . $row['offer_discount'] . '%</td>
            ' . $buttonGroup . '
        </tr>';
    }

    echo $output;
} else {
    include '../../../pagenotfound.php';
}
