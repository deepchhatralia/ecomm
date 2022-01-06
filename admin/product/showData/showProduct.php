<?php

include '../../../database.php';
include '../../../includee/config.php';

$obj = new Database();

$sql = "SELECT * FROM `product`";
$result = mysqli_query($conn, $sql);

$output = "";

while ($row = mysqli_fetch_assoc($result)) {
    $category = $row['product_category'];
    $sql2 = "SELECT * FROM `product_category` WHERE category_id = $category";
    $result2 = mysqli_query($conn, $sql2);
    $category = mysqli_fetch_assoc($result2);

    $company = $row['company_profile_idcompany_profile'];
    $result2 = $obj->select('*', 'company_profile', 'idcompany_profile = ' . $company);
    $company = $result2->fetch_assoc();

    $offer = $row['offer_idoffer'];
    if ($offer) {
        $result2 = $obj->select('*', 'offer', 'idoffer = ' . $offer);
        $offer = $result2->fetch_assoc();
        $offer = $offer['offer_name'];
    } else {
        $offer = 'None';
    }

    $output .= '<tr class="border-b border-gray-200 hover:bg-gray-100">
        <td>' . $row['product_id'] . '</td>
        <td>' . $row['product_name'] . '</td>
        <td>' . substr($row['product_feature'], 0, 40) . '...</td>
        <td>' . $row['product_price'] . '</td>
        <td>' . $row['product_stock'] . '</td>
        <td>' . $category['category_name'] . '</td>
        <td>' . $company['company_name'] . '</td>
        <td>' . $offer . '</td>
        <td style="font-size: 13px;">
            <button id="fa-edit" class="my-btn bg-success edit-btn mb-1"><i class="far fa-edit mx-1"></i> Edit</button> 
            <button id="fa-trash-alt" class="my-btn bg-danger delete-btn"><i class="fas fa-trash-alt mx-1"></i> Delete</button>
        </td>
    </tr>';
}

echo $output;
