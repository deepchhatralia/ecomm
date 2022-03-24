<?php

include '../../../database.php';
include '../../../includee/config.php';

$obj = new Database();

$sql = "SELECT * FROM `productt`";
$result = mysqli_query($conn, $sql);

$output = "";

while ($row = mysqli_fetch_assoc($result)) {
    $category = $row['product_category'];
    $result2 = $obj->select('*', 'product_category', "category_id =" . $category);
    $category = $result2->fetch_assoc();

    $company = $row['company_profile_idcompany_profile'];
    $result2 = $obj->select('*', 'company_profile', 'idcompany_profile = ' . $company);
    $company = $result2->fetch_assoc();

    $offer = $row['offer_idoffer'];
    if ($offer != '0') {
        $result2 = $obj->select('*', 'offer', "idoffer = {$offer}");
        $row2 = $result2->fetch_assoc();
        $offerName = $row2['offer_name'];

        $offerPrice = $row['product_price'] - round(($row['product_price'] * $row2['offer_discount'] / 100));
    } else {
        $offerName = 'None';
        $offerPrice = $row['product_price'];
    }

    $output .= '<tr class="border-b border-gray-200 hover:bg-gray-100">
        <td>' . $row['product_id'] . '</td>
        <td>' . $row['product_name'] . '</td>
        <td>' . substr($row['product_desc'], 0, 40) . '...</td>
        <td>' . substr($row['product_feature'], 0, 40) . '</td>
        <td>₹' . $row['product_price'] . '</td>
        <td>₹' . $offerPrice . '</td>
        <td>' . $row['product_stock'] . '</td>
        <td>' . $category['category_name'] . '</td>
        <td>' . $company['company_name'] . '</td>
        <td>' . $offerName . '</td>
        <td style="font-size: 13px;">
            <button id="fa-edit" class="mb-1 my-btn bg-success edit-btn"><i class="far fa-edit mx-1"></i> Edit</button> 
            <button id="fa-trash-alt" class="mb-1 my-btn bg-danger delete-btn"><i class="fas fa-trash-alt mx-1"></i> Delete</button>
        </td>
    </tr>';
}

echo $output;
