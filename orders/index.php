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
        <title>Orders</title>

        <link rel="stylesheet" href="../css/index/responsive.css">

        <style>
            .productImg {
                width: 8vw !important;
            }

            .table-row:hover {
                background-color: #e9f2f7;
                cursor: pointer;
            }
        </style>
    </head>

    <body>
        <?php
        include '../admin/includee/cdn.php';
        include '../database.php';
        $obj = new Database();

        include '../includee/navbar1.php';
        ?>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Order Return</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="container my-5">
            <table class="table table-striped">
                <thead>
                    <tr style="font-size: 2.5vh; text-align: center;">
                        <th scope="col">ID</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Shipping Address</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Return</th>
                    </tr>
                </thead>
                <!-- SELECT * FROM `image` JOIN `productt` ON `image`.`product_product_id`=`productt`.`product_id` -->
                <?php
                $result = $obj->select('*', 'order', "userlogin_userid=" . $_SESSION['userlogin']);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        $orderDetail = $obj->select('*', 'order_detail', "order_order_id=" . $row['order_id']);
                        if ($orderDetail->num_rows > 0) {
                            while ($detailRow = $orderDetail->fetch_assoc()) {
                                echo "<tbody>";
                                $product = $obj->select('*', 'productt', "product_id=" . $detailRow['product_id']);
                                if ($product->num_rows > 0) {
                                    $productRow = $product->fetch_assoc();

                                    $image = $obj->select('*', 'image', 'product_product_id=' . $productRow['product_id']);
                                    $imagePath = "";
                                    if ($image->num_rows > 0) {
                                        $imageRow = $image->fetch_assoc();
                                        $imagePath = $imageRow['img_path'];
                                    }
                ?>
                                    <tr class="table-row text-center">
                                        <th scope="row"><?php echo $detailRow['order_detail_id']; ?></th>
                                        <td class="d-flex flex-wrap">
                                            <img src="../admin/product/uploads/<?php echo $imagePath; ?>" class="productImg mr-5" alt="">
                                            <span><?php echo $productRow['product_name']; ?></span>
                                        </td>
                                        <td><?php echo $detailRow['order_quantity']; ?></td>
                                        <td><?php echo $productRow['product_price']; ?></td>
                                        <td><?php echo $detailRow['order_quantity'] * $productRow['product_price']; ?></td>
                                        <td><?php echo $row['shipping_address']; ?></td>
                                        <td><?php echo $row['order_date']; ?></td>
                                        <td>
                                            <span class="bg-secondary text-light py-1 px-2" style="border-radius: 10px;"><?php echo $row['status']; ?></span>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row['status'] == "Delivered") {
                                                echo '<button data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="' . $detailRow['order_detail_id'] . '" class="return-btn btn btn-danger">Return</button></td>';
                                            } else {
                                                echo 'Not Applicable';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                <?php
                                }
                            }
                            echo "</tbody>";
                        }
                    }
                } else {
                    echo '<tbody><h4 class="h4">No orders placed</h4></tbody>';
                }
                ?>
            </table>
        </div>

        <?php
        include '../includee/footer.php';
        ?>

        <script src="../js/jquery-3.4.1.min.js"></script>

        <script>
            $(document).ready(() => {
                $('.return-btn').click((e) => {

                    const id = e.target.getAttribute("data-id")
                    alert(id)
                    // $.ajax({
                    //     url: "",
                    //     type: "POST",
                    //     data: {
                    //         id
                    //     },
                    //     success(data) {
                    //         console.log(data);
                    //     }
                    // })
                })
            })
        </script>
    </body>

    </html>
<?php
} else {
    include '../pagenotfound.php';
}
?>