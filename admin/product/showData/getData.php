<?php


if (isset($_POST['operation'])) {
    include '../../../database.php';
    $obj = new Database();

    if (isset($_POST['id']) && $_POST['operation'] == 'select') {
        $productId = $_POST['id'];
        $result = $obj->select('*', 'productt', "product_id='{$productId}'");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $name = $row['product_name'];
            $desc = $row['product_desc'];
            $feature = $row['product_feature'];
            $price = $row['product_price'];
            $category = $row['product_category'];
            $stock = $row['product_stock'];
            $company = $row['company_profile_idcompany_profile'];
            $offer = $row['offer_idoffer'];

            $arr = array($name, $price, $category, $stock, $company, $productId, $offer, $desc, $feature);

            echo json_encode($arr);
        }
    }

    if (isset($_POST['id']) && $_POST['operation'] == 'delete') {
        $productId = $_POST['id'];

        $result = $obj->delete('productt', "product_id='{$productId}'");

        if (mysqli_errno($obj->connection()) == 1451) {
            echo "Cant delete. Product id being used at many places";
        } else {
            echo 'deleted';
        }
    }

    if ($_POST['operation'] == 'update') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $desc = mysqli_real_escape_string($obj->connection(), $_POST['desc']);
        $feature = mysqli_real_escape_string($obj->connection(), $_POST['feature']);
        $price = $_POST['price'];
        $category = $_POST['category'];
        $stock = $_POST['stock'];
        $company = $_POST['company'];
        $offer = $_POST['offer'];

        $result = $obj->update('productt', ['product_name' => $name, 'product_desc' => $desc, 'product_feature' => $feature, 'product_price' => $price, 'product_category' => $category, 'product_stock' => $stock, 'company_profile_idcompany_profile' => $company, 'offer_idoffer' => $offer], "product_id='{$id}'");
        echo $result;
        // echo mysqli_error($obj->connection());
    }
} else {
    include '../../../pagenotfound.php';
}
