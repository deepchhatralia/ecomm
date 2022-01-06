<?php

session_start();

if (isset($_POST['name']) && isset($_POST['mrp']) && isset($_POST['price']) && isset($_POST['stock'])) {
    
    include '../../includee/config.php';
    include '../../database.php';
    $obj = new Database();

    // $product_desc = mysqli_real_escape_string($obj->connection(), $_POST['product_desc']);
    $product_name = mysqli_real_escape_string($conn, $_POST['name']);
    $product_mrp = mysqli_real_escape_string($conn, $_POST['mrp']);
    $product_price = mysqli_real_escape_string($conn, $_POST['price']);
    $product_stock = mysqli_real_escape_string($conn, $_POST['stock']);
    $uploaded_img = $_POST['uploaded_img'];
    $id = $_POST['id'];

    $errors = array();

    $file_name = $_FILES['productImage']['name'];

    if ($file_name != '') {
        $file_size = $_FILES['productImage']['size'];
        $file_tmp = $_FILES['productImage']['tmp_name'];
        $file_type = $_FILES['productImage']['type'];
        $x = explode('.', $file_name);
        $file_ext = end($x);
        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "This file extension is not allowed. Only jpeg,jpg and png files are allowed";
        }

        if ($file_size > 2097152) {
            $errors[] = "File size must be less than 2mb";
        }

        if (empty($errors)) {
            $file_name = rand() . $file_name;
            move_uploaded_file($file_tmp, "../../upload_img/" . $file_name);
            $uniqueId = uniqid("sb", true);
            $path = '../../upload_img/' . $uploaded_img;
            if (unlink($path)) {
                $result = $obj->update('products', ['product_name' => $product_name, 'product_mrp' => $product_mrp, 'product_price' => $product_price, 'product_stock' => $product_stock, '$product_img' => $file_name], "product_id='{$id}'");

                if ($result) {
                    echo 'Successful Updated';
                } else {
                    echo 'Please try again';
                }
            }
        } else {
            echo 'Invalid file extension';
        }
    } else {

        $result = $obj->update('products', ['product_name' => $product_name, 'product_mrp' => $product_mrp, 'product_price' => $product_price, 'product_stock' => $product_stock, '$product_img' => $file_name], "product_id='{$id}'");

        if ($result) {
            echo 'Successful Updated';
        } else {
            echo 'Please try again';
        }
    }
} else if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    $result = $obj->select('*', 'products', "product_id='{$productId}'");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['product_name'];
        $desc = $row['product_desc'];
        $mrp = $row['product_mrp'];
        $price = $row['product_price'];
        $stock = $row['product_stock'];
        $img = $row['product_img'];

        $arr = array($name, $desc, $mrp, $price, $stock, $img);

        $x = json_encode($arr);
        echo $x;
    }
} else {
    include '../../pagenotfound.php';
}