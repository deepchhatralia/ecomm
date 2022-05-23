<?php

session_start();
$invoice = false;

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
        <div class="modal fade" id="returnExampleModal" tabindex="-1" aria-labelledby="returnExampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Order Return</h5>
                        <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="return-modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="close-return-modal" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="return-btn" class="btn btn-danger">Confirm</button>
                    </div>
                </div>
            </div>
        </div>


        <button id="order-details-btn" class="d-none" data-bs-toggle="modal" data-bs-target="#exampleModal">Hello</button>

        <div class="container mt-3 d-none">
            <div class="d-flex align-items-center justify-content-end">
                <h6 class="h5 m-0"><button class="btn btn-danger" id="order-return-redirect">Order Returns</button></h6>
            </div>
        </div>

        <div class="container my-5">
            <h1 class="h1 mb-3">Order History</h1>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr style="font-size: 2.5vh; text-align: center;">
                            <th scope="col">ID</th>
                            <th>Shipping Address</th>
                            <th>Order Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Cancel</th>
                            <th>Return</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $days = 0;

                        $result = $obj->select('*', 'order', "userlogin_userid=" . $_SESSION['userlogin'], 'order_id DESC');
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr class="table-row text-center" data-orderId="<?php echo $row['order_id']; ?>">
                                    <th class="table-roww" scope="row"><?php echo $row['order_id']; ?></th>
                                    <td class="table-roww"><?php
                                                            if (strlen($row['shipping_address']) > 50) {
                                                                echo substr($row['shipping_address'], 0, 50) . "...";
                                                            } else {
                                                                echo $row['shipping_address'];
                                                            }
                                                            ?></td>
                                    <td class="table-roww"><?php echo $row['order_date']; ?></td>
                                    <td class="table-roww">₹ <?php echo $row['total']; ?></td>
                                    <td class="table-roww">
                                        <span class="badge rounded-pill bg-secondary"><?php echo $row['status']; ?></span>
                                    </td>
                                    <td>
                                        <?php
                                        $date1 = strtotime($row['order_date']);
                                        $date2 = strtotime(date("Y/m/d"));
                                        $days = round(abs($date2 - $date1) / (60 * 60 * 24), 0);

                                        if ($row['status'] !== "Delivered" && $days <= 2 && $row['isCancel'] == 0) {
                                            echo '<button data-id="' . $row['order_id'] . '" class="cancel-order-btn btn btn-danger">Cancel</button></td>';
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row['status'] === "Delivered" && $days <= 7 && $row['isCancel'] == 0 && $row['status'] != "Returned") {
                                            echo '<button data-bs-toggle="modal" data-bs-target="#returnExampleModal" data-id="' . $row['order_id'] . '" class="btn btn-danger return-btn">Return</button>';
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo '<h4 class="h4">No orders placed</h4>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title h5" id="exampleModalLabel">Order Details</h5>
                        <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="order-details-table">

                                    </tbody>
                                </table>
                            </div>
                            <div class="row d-flex justify-content-end">
                                <div class="col-md-3 order-details-total">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <?php
                        // if ($invoice) {
                        //     echo '<button class="btn btn-danger"><i class="fa-solid fa-file-lines"></i></button>';
                        // }
                        ?>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
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

                    if (message === "Order Return Initiated") {
                        window.location.reload();
                    }
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
                            $('.return-modal-body').html(data)
                        }
                    })
                })

                // Modal return button click
                $('#return-btn').click(() => {
                    const orderDetailId = $('#order-detail-id').html()
                    // const amount = $('.price').val()
                    // const qty = $('#qty-return').val()
                    // const productId = $('#product-id').html()

                    const reason = $('#return-reason').val()
                    const check = document.getElementsByClassName("product-checkbox");
                    let isChecked = false;

                    if (reason.length >= 100) {
                        for (let i = 0; i < check.length; i++) {
                            if (check[i].checked) {
                                $('#error-msg').text("");
                                isChecked = true;
                                const orderDetailId = check[i].getAttribute("data-id");
                                $.post({
                                    url: "./returns.php",
                                    data: {
                                        reason,
                                        orderDetailId,
                                        operation: "return product"
                                    },
                                    success(data) {
                                        if (data == "Returned") {
                                            $('#close-return-modal').click();
                                            alert("Order Return Initiated", 'success');
                                        } else {
                                            $('#error-msg').text(data);
                                        }
                                    }
                                })
                            }
                        }

                        if (!isChecked) {
                            $('#error-msg').text("Please select product");
                        }
                    } else {
                        $('#error-msg').text("Please specify reason");
                    }
                })

                // gets order details 
                $('.table-roww').click((e) => {
                    const orderId = e.target.parentElement.getAttribute('data-orderId');

                    $.ajax({
                        url: "getOrderData.php",
                        type: "POST",
                        data: {
                            orderId,
                            offerPrice: 0,
                            operation: "order details data"
                        },
                        success(data) {
                            const x = JSON.parse(data)
                            $('#order-details-table').html(x[0])
                            $('.order-details-total').html('<h6 class="h6 fw-bold">Total : ₹ ' + x[1] + '</h6>')

                            $('#order-details-btn').click();
                        }
                    })
                })

                // cancel order button 
                $('.cancel-order-btn').on('click', (e) => {
                    const id = e.target.getAttribute('data-id');

                    if (confirm('Are you sure to cancel your order???')) {
                        $.post({
                            url: "getData.php",
                            data: {
                                id,
                                operation: "cancel order"
                            },
                            success(data) {
                                if (data == "Cancelled") {
                                    window.location.reload();
                                }
                            }
                        })
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

                $('#order-return-redirect').click(() => {
                    window.location.href = "returns.php"
                });
            })
        </script>
    </body>

    </html>
<?php
} else {
    include '../pagenotfound.php';
}
?>