<?php

if (isset($_FILES['fileToUpload'])) {
  $target_dir = "../uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  include '../../../database.php';
  $obj = new Database();

  // Check if image file is a actual image or fake image

  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }

  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  } else {
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
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
    $result = $obj->select('*', 'image', 'product_product_id=' . $_POST['product']);

    // user cannot add more than 5 images for a particular product
    if ($result->num_rows <= 4) {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        $product = $_POST['product'];
        $result = $obj->insert('image', ['img_path' => htmlspecialchars(basename($_FILES["fileToUpload"]["name"])), 'product_product_id' => $product]);
      } else {
        echo "<br/>Sorry, there was an error uploading your file.";
      }
    } else {
      echo "Cannot add more than 5 images for a product";
    }
  }
} else {
  include '../../../pagenotfound.php';
}
