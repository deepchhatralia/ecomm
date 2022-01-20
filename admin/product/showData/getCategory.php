<?php

include '../../../database.php';
$obj = new Database();

if (isset($_POST['id']) && $_POST['operation'] == 'select') {
    $id = $_POST['id'];

    $result = $obj->select('*', 'product_category', "category_id = " . $id);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $arr = array($id, $row['category_name']);

        $x = json_encode($arr);
        echo $x;
    }
}

if (isset($_POST['id']) && $_POST['operation'] == 'update') {
    $id = $_POST['id'];
    $category = $_POST['name'];

    echo $obj->update('product_category', ['category_name' => $category], "category_id='{$id}'");
}

if (isset($_POST['id']) && $_POST['operation'] == 'delete') {
    $id = $_POST['id'];

    // $result = $obj->select('*','productt',)

    $result = $obj->delete('product_category', "category_id='{$id}'");

    if ($obj->connection()->error) {
        echo "Can't delete. Product with this category available in stock";
    } else {
        echo "deleted";
    }
}
