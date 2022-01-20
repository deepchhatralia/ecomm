<?php

include '../../../database.php';
include '../../../includee/config.php';

$obj = new Database();

$sql = "SELECT * FROM `offer`";

$result = mysqli_query($conn, $sql);

$output = "";

while ($row = mysqli_fetch_assoc($result)) {
    $output .= '<tr class="border-b border-gray-200 hover:bg-gray-100">
            <td>' . $row['idoffer'] . '</td>
            <td>' . $row['offer_name'] . '</td>
            <td>' . $row['offer_detail'] . '</td>
            <td>' . $row['offer_startDate'] . '</td>
            <td>' . $row['offer_endDate'] . '</td>
            <td>' . $row['offer_discount'] . '</td>';

    if ($row['idoffer'] !== '0') {
        $output .=
            '<td style="font-size: 13px;">
                <button id="fa-edit" data-bs-toggle="modal" data-bs-target="#exampleModal" class="my-btn bg-success edit-btn"><i class="far fa-edit mx-1"></i> Edit</button> 
                <button id="fa-trash-alt" class="my-btn bg-danger delete-btn"><i class="fas fa-trash-alt mx-1"></i> Delete</button>
            </td>';
    }

    $output .= '</tr>';
}

echo $output;
