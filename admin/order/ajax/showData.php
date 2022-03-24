<?php

if (isset($_POST['operation']) && $_POST['operation'] == 'select') {
    include '../../../database.php';
    $obj = new Database();

    $result = $obj->select('*', 'order');

    if ($result->num_rows > 0) {
        $output = "";
        $cancelled = "No";
        $arr = ["Ordered", "Cancelled", "Returned", "Delivered"];

        while ($row = $result->fetch_assoc()) {
            $user = $obj->select('*', 'userlogin', "userid=" . $row['userlogin_userid']);
            $user = $user->fetch_assoc();

            if ($row['isCancel']) {
                $cancelled = "Yes";
            }

            $output .= '<tr class="border-b border-gray-200 hover:bg-gray-100">
                <td>' . $row['order_id'] . '</td>
                <td>' . $user['user_firstname'] . " " . $user['user_lastname'] . '</td>
                <td>' . $row['shipping_address'] . '</td>
                <td>' . $row['order_date'] . '</td>
                <td>₹ ' . $row['total'] . '</td>
                <td>' . $cancelled . '</td>
                <td><select class="form-select">';

            foreach ($arr as $val) {
                if ($row['status'] == $val) {
                    $output .= '<option selected value="' . $val . '">' . $val . '</option>';
                } else {
                    $output .= '<option value="' . $val . '">' . $val . '</option>';
                }
            }

            $output .= '</select></td>
            <td style="font-size: 13px;">
                    <button id="fa-edit" data-id="' . $row['order_id'] . '" class="mb-1 my-btn bg-success edit-btn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-search mx-1"></i> View</button> 
                </td>
            </tr>';
        }
        // <td> $row['cgst'] %</td>
        // <td> $row['sgst'] %</td>

        // <button id="fa-trash-alt" class="mb-1 my-btn bg-danger delete-btn"><i class="fas fa-trash-alt mx-1"></i> Delete</button>
        echo $output;
    }
} else {
    include '../../../pagenotfound.php';
}
