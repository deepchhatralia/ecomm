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

            <div id="liveAlertPlaceholder"></div>



            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Order Return</h5>
                            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="return-btn" class="btn btn-danger">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container my-5">
                <div class="table-responsive">
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


                                            $price = $productRow['product_price'];
                                            if ($productRow['offer_idoffer'] != 0) {
                                                $result4 = $obj->select('*', 'offer', "idoffer=" . $productRow['offer_idoffer']);
                                                $row4 = $result4->fetch_assoc();

                                                $price = round($productRow['product_price'] - ($productRow['product_price'] * $row4['offer_discount'] / 100));
                                            }

                        ?>
                                            <tr class="table-row text-center">
                                                <th scope="row"><?php echo $detailRow['order_detail_id']; ?></th>
                                                <td class="d-flex align-items-center flex-wrap">
                                                    <img src="../admin/product/uploads/<?php echo $imagePath; ?>" class="productImg mr-5" alt="">
                                                    <span><?php echo $productRow['product_name']; ?></span>
                                                </td>
                                                <td><?php echo $detailRow['order_quantity']; ?></td>
                                                <td><?php echo $price; ?></td>
                                                <td><?php echo $detailRow['order_quantity'] * $price; ?></td>
                                                <td><?php
                                                    if (strlen($row['shipping_address']) > 50) {
                                                        echo substr($row['shipping_address'], 0, 50) . "...";
                                                    } else {
                                                        echo $row['shipping_address'];
                                                    }
                                                    ?></td>
                                                <td><?php echo $row['order_date']; ?></td>
                                                <td>
                                                    <span class="badge rounded-pill bg-secondary"><?php echo $detailRow['status']; ?></span>
                                                </td>
                                                <td>
                                                    <?php
                                                    $date1 = strtotime($row['order_date']);
                                                    $date2 = strtotime(date("Y/m/d"));
                                                    $days = round(abs($date2 - $date1) / (60 * 60 * 24), 0);

                                                    if ($detailRow['status'] == "Delivered" && $days <= 10) {
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
            </div>

            <?php
            include '../includee/footer.php';
            ?>


            <!-- jQery -->
            <script src="../js/jquery-3.4.1.min.js"></script>
            <!-- bootstrap js -->
            <script src="../js/bootstrap.js"></script>

            <script>
                $(document).ready(() => {
                    var alertPlaceholder = document.getElementById('liveAlertPlaceholder')

                    function alert(message, type) {
                        var wrapper = document.createElement('div')
                        wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                        alertPlaceholder.append(wrapper)
                    }

                    // Orders table return button click to open modal
                    $('.return-btn').click((e) => {
                        const id = e.target.getAttribute("data-id")

                        $.ajax({
                            url: "getData.php",
                            type: "POST",
                            data: {
                                id,
                                operation: "return btn click"
                            },
                            success(data) {
                                $('.modal-body').html(data)
                            }
                        })
                    })

                    // Modal return button click
                    $('#return-btn').click(() => {
                        const orderDetailId = $('#order-detail-id').html()
                        const amount = $('.price').val()
                        const qty = $('#qty-return').val()
                        const productId = $('#product-id').html()
                        const reason = $('#return-reason').val()

                        if (reason && reason.length >= 100) {
                            $('#return-reason').css('border-color', 'lightgray')

                            $.ajax({
                                url: "getData.php",
                                type: "POST",
                                data: {
                                    amount,
                                    qty,
                                    productId,
                                    orderDetailId,
                                    reason,
                                    operation: "return product"
                                },
                                success(data) {
                                    let msg = "";
                                    let color = "";
                                    if (data == "Inserted") {
                                        msg = "Return request for quantity " + qty + " was requested";
                                        color = "success";
                                        setTimeout(() => {
                                            window.location.reload()
                                        }, 2000);
                                    } else {
                                        msg = "Please try again...";
                                        color = "danger";
                                    }

                                    $('.modal-close').click()

                                    alert(msg, color)
                                    setTimeout(() => {
                                        $('#liveAlertPlaceholder').html('')
                                    }, 3000);
                                }
                            })
                        } else {
                            $('#return-reason').css('border-color', '#ff707e')
                        }
                    })

                    document.addEventListener('change', (e) => {
                        if (e.target && e.target.id == "qty-return") {
                            const qty = $('#qty-return').val();
                            const price = $('.fix-price').val()

                            $('.price').val(price * qty);
                        }
                        return () => {}
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