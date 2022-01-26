<?php

include '../../../database.php';
include '../../../includee/config.php';

$obj = new Database();

$sql = "SELECT * FROM `product_category`";

$result = mysqli_query($conn, $sql);

$output = "";

while ($row = mysqli_fetch_assoc($result)) {
    $output .= '<tr class="border-b border-gray-200 hover:bg-gray-100">
            <td>' . $row['category_id'] . '</td>
            <td>' . $row['category_name'] . '</td>
            <td><img class="category-img img-fluid" src="category_uploads/' . $row['category_img'] . '"/></td>
            <td style="font-size: 13px;">
                <button id="fa-edit" data-bs-toggle="modal" data-bs-target="#exampleModal" class="mb-1 my-btn bg-success edit-btn"><i class="far fa-edit mx-1"></i> Edit</button> 
                <button id="fa-trash-alt" class="mb-1 my-btn bg-danger delete-btn"><i class="fas fa-trash-alt mx-1"></i> Delete</button>
            </td>
        </tr>';
}

echo $output;
