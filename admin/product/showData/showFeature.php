<?php

include '../../../database.php';
include '../../../includee/config.php';

$obj = new Database();

$sql = "SELECT * FROM `product_feature`";

$result = mysqli_query($conn, $sql);

$output = "";

while ($row = mysqli_fetch_assoc($result)) {
    $product_id = $row['productId'];
    $product = $obj->select('*', 'product', "product_id='{$product_id}'");
    $product = $product->fetch_assoc();
    $output .= '<tr class="border-b border-gray-200 hover:bg-gray-100">
            <td>' . $row['idproduct_feature'] . '</td>
            <td>' . $row['product_feature'] . '</td>
            <td>' . $product['product_name'] . '</td>
            <td style="font-size: 13px;">
                <button id="fa-edit" class="my-btn bg-success edit-btn"><i class="far fa-edit mx-1"></i> Edit</button> 
                <button id="fa-trash-alt" class="my-btn bg-danger delete-btn"><i class="fas fa-trash-alt mx-1"></i> Delete</button>
            </td>
        </tr>';
}

echo $output;
