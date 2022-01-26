<?php


if (isset($_POST['id']) && $_POST['operation'] == 'delete') {
    include '../../../database.php';
    $obj = new Database();

    $imageId = $_POST['id'];
    $result = $obj->select('*', 'image', 'idimage=' . $imageId);
    $row = $result->fetch_assoc();

    if (unlink("../uploads/" . $row['img_path'])) {
        $result = $obj->delete('image', 'idimage=' . $imageId);
        if ($result) {
            echo "deleted";
        }
    }
} else {
    include '../../../pagenotfound.php';
}
