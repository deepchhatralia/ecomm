<?php
session_start();

if (isset($_SESSION['userlogin'])) {
    $userId = $_SESSION['userlogin'];

    include '../../database.php';
    $obj = new Database();

    if (isset($_POST['id']) && $_POST['operation'] == "addToWishlist") {
        $id = $_POST['id'];
        $userId = $_SESSION['userlogin'];

        $result = $obj->insert('wishlist', ['userlogin_userid' => $userId, 'product_id' => $id]);

        if ($result) {
            echo "Added to wishlist";
        } else {
            echo "Try again...";
            // echo mysqli_error($obj->connection());
        }
    } else if (isset($_POST['id']) && $_POST['operation'] == "removeItem") {
        $id = $_POST['id'];

        $result = $obj->delete('wishlist', 'userlogin_userid=' . $userId . ' AND product_id=' . $id);

        // echo mysqli_error($obj->connection());
        if ($result) {
            echo "Removed from wishlist";
        } else {
            echo false;
        }
    } else if (isset($_POST['operation']) && $_POST['operation'] == "load wishlist") {
        $output = "";

        $result = $obj->select('*', 'wishlist', "userlogin_userid=" . $_SESSION['userlogin']);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productId = $row['product_id'];
                $result2 = $obj->select('*', 'image', 'product_product_id=' . $productId);
                $img = "";
                if ($result2->num_rows > 0) {
                    $img = $result2->fetch_assoc();
                    $img = $img['img_path'];
                }
                $result2 = $obj->select('*', 'productt', "product_id=" . $productId);
                $productname = "";
                if ($result2->num_rows > 0) {
                    $productname = $result2->fetch_assoc();
                    $productname = $productname['product_name'];
                }
                $output .= '<tr>
                    <td class="d-flex align-items-center">
                        <img class="mr-5 productImg" src="../admin/product/uploads/' . $img . '" alt="" />
                        <h4 class="h4 m-0">' . $productname . '</h4>
                    </td>
                    <td class="text-center">
                        <button class="add-to-cart btn btn-success add" data-id="' . $productId . '"><i data-id="' . $productId . '" class="add fa-solid fa-cart-arrow-down"></i></button>
                        <button class="rm remove-item-wishlist m-0 btn btn-danger" data-id="' . $productId . '"><i data-id="' . $productId . '" class="rm fa-solid fa-trash"></i></button>
                    </td>
                </tr>';
            }
            echo $output;
        } else {
            echo '<div class="container my-5">
                <h4 class="h4">No items in your wishlist</h4>
            </div>';
        }
    } else {
        include '../../pagenotfound.php';
    }
} else {
    include '../../pagenotfound.php';
}
