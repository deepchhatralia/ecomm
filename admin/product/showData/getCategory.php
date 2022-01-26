<?php

include '../../../database.php';
$obj = new Database();

if (isset($_POST['id']) && $_POST['operation'] == 'select') {
    $id = $_POST['id'];

    $result = $obj->select('*', 'product_category', "category_id = " . $id);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $arr = array($id, $row['category_name'], $row['category_img']);

        echo json_encode($arr);
    }
}

if ((isset($_POST['id']) && $_POST['operation'] == 'update') || isset($_FILES['modal_category_img'])) {
    if (isset($_FILES['modal_category_img'])) {
        $id = $_POST['modal_category_id'];
        $category = $_POST['modal_category'];

        $oldImg = $_POST['modal_category_image'];
        $newImg = $_FILES['modal_category_img'];

        $target_dir = "../category_uploads/";
        $target_file = $target_dir . basename($_FILES["modal_category_img"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        } else {
            // Check file size
            if ($_FILES["modal_category_img"]["size"] > 5000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            } else {
                // Allow certain file formats
                if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
                ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
            }
        }


        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["modal_category_img"]["tmp_name"], $target_file)) {
                unlink("../category_uploads/" . $oldImg);
                echo "The file " . htmlspecialchars(basename($_FILES["modal_category_img"]["name"])) . " has been uploaded.";

                $result = $obj->update('product_category', ['category_name' => $category, 'category_img' => htmlspecialchars(basename($_FILES["modal_category_img"]["name"]))], "category_id = " . $id);
            } else {
                echo "<br/>Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $id = $_POST['id'];
        $category = $_POST['name'];

        echo $obj->update('product_category', ['category_name' => $category], "category_id='{$id}'");
    }
}

if (isset($_POST['id']) && $_POST['operation'] == 'delete') {
    $id = $_POST['id'];

    $result = $obj->select('*', "product_category", "category_id=" . $id);
    $row = $result->fetch_assoc();
    $category_img = $row['category_img'];


    if ($obj->connection()->error) {
        echo "Can't delete. Product with this category available in stock";
    } else {
        if (unlink("../category_uploads/" . $category_img)) {
            $result = $obj->delete("product_category", "category_id=" . $id);
            echo "deleted";
        } else {
            echo "Try again...";
        }
    }
}
