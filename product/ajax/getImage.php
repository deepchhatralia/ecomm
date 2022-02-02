<?php
session_start();

if (isset($_SESSION['userlogin'])) {
    if (isset($_POST['id']) && $_POST['operation'] == "select image") {
        $id = $_POST['id'];

        include '../../database.php';
        $obj = new Database();

        $result = $obj->select('*', 'image', 'idimage=' . $id);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '<img class="other-img" data-id="' . $id . '" src="../admin/product/uploads/' . $row['img_path'] . '" alt="" />';
        } else {
            echo "Image not found";
        }
    } else {
        include '../../pagenotfound.php';
    }
} else {
    include '../../pagenotfound.php';
}
