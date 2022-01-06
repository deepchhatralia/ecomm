<?php

include '../../../database.php';
$obj = new Database();

if (isset($_POST['id']) && $_POST['operation'] == 'delete') {
    $imageId = $_POST['id'];
    $result = $obj->select('*', 'image', 'idimage=' . $imageId);
    $row = $result->fetch_assoc();

    if (unlink("../uploads/" . $row['img_path'])) {
        $result = $obj->delete('image', 'idimage=' . $imageId);
        if ($result) {
            echo "deleted";
        }
    }
}
