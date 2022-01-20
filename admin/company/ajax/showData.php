<?php

if (isset($_POST['operation']) && $_POST['operation'] == 'select') {
    include '../../../database.php';
    $obj = new Database();

    $result = $obj->select('*', 'company_profile');

    if ($result->num_rows > 0) {
        $output = "";

        while ($row = $result->fetch_assoc()) {
            $output .= '<tr class="border-b border-gray-200 hover:bg-gray-100">
                <td>' . $row['idcompany_profile'] . '</td>
                <td>' . $row['company_name'] . '</td>
                <td>' . $row['company_address'] . '</td>
                <td>' . $row['company_contact_number'] . '</td>
                <td style="font-size: 13px;">
                    <button id="fa-edit" class="mb-1 my-btn bg-success edit-btn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-edit mx-1"></i> Edit</button> 
                    <button id="fa-trash-alt" class="mb-1 my-btn bg-danger delete-btn"><i class="fas fa-trash-alt mx-1"></i> Delete</button>
                </td>
            </tr>';
        }
        echo $output;
    }
} else {
    include '../../../pagenotfound.php';
}
