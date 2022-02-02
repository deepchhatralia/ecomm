<?php
session_start();

if (isset($_SESSION['userlogin'])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Wishlist</title>

        <link rel="stylesheet" href="../css/index/responsive.css">

        <style>
            .productImg {
                width: 12vw !important;
            }
        </style>
    </head>

    <body>
        <?php
        include '../admin/includee/cdn.php';

        include '../database.php';
        $obj = new Database();

        include '../includee/navbar1.php';

        $result = $obj->select('*', 'wishlist', "userlogin_userid=" . $_SESSION['userlogin']);
        if ($result->num_rows > 0) {
        ?>

            <div class="container my-5">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr style="font-size: 2.5vh; text-align: center;">
                                <th scope="col">Product</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="wishlist-body">
                            <?php
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
                                echo '<tr>
                                    <td class="d-flex align-items-center">
                                        <img class="mr-5 productImg" src="../admin/product/uploads/' . $img . '" alt="" />
                                        <h4 class="h4 m-0">' . $productname . '</h4>
                                    </td>
                                    <td class="text-center align-items-center">
                                        <button id="remove-item-wishlist" class="m-0 btn btn-danger" data-id="' . $productId . '">Remove</button>
                                    </td>
                                </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php
        } else {
            echo '<div class="container my-5">
                <h4 class="h4">No items in your wishlist</h4>
            </div>';
        }
        ?>


        <?php
        include '../includee/footer.php';
        ?>

        <!-- jQery -->
        <script src="../js/jquery-3.4.1.min.js"></script>
        <!-- bootstrap js -->
        <script src="../js/bootstrap.js"></script>

        <script>
            $(document).ready(() => {
                $('#remove-item-wishlist').click((e) => {
                    const id = e.target.getAttribute("data-id");

                    $.ajax({
                        url: "ajax/wishlist.php",
                        type: "POST",
                        data: {
                            id,
                            operation: "removeItem"
                        },
                        success(data) {
                            if (data) {
                                window.location.reload()
                            } else {
                                alert('Please try again...', 'danger');
                            }
                        }
                    })
                })
            })
        </script>
    </body>

    </html>

<?php
}
?>