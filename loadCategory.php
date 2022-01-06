<?php

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    include 'database.php';
    $obj = new Database();

    if ($id == 0) {
        $result = $obj->select('*', 'products');
    } else {
        $result = $obj->select('*', 'products', "category_id={$id}");
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '
            <a href="product/product.php?q=' . $row['product_id'] . '" class="group">
                <div class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
                    <img src="upload_img/' . $row['product_img'] . '" alt="" class="w-full h-full object-center object-cover group-hover:opacity-75">
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <h3 class="mt-1 ml-2 text-sm text-gray-700 font-medium">
                        ' . $row['product_name'] . '
                    </h3>
                    <p class="mt-1 mr-2 text-lg font-medium text-gray-900">
                        ₹ ' . $row['product_price'] . '
                    </p>
                </div>
                      
            </a>
            ';
        }
    }

    $id = $_POST['id'];
} else {
    include '../pagenotfound.php';
}
