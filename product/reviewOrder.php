<?php

if (isset($_POST['next'])) {
    session_start();

    include '../database.php';
    $obj = new Database();

    $name = mysqli_real_escape_string($obj->connection(), $_POST['name']);
    $phone = mysqli_real_escape_string($obj->connection(), $_POST['phone']);
    $pincode = mysqli_real_escape_string($obj->connection(), $_POST['pincode']);
    $flat = mysqli_real_escape_string($obj->connection(), $_POST['flat']);
    $area = mysqli_real_escape_string($obj->connection(), $_POST['area']);
    $landmark = mysqli_real_escape_string($obj->connection(), $_POST['landmark']);
    $city = mysqli_real_escape_string($obj->connection(), $_POST['city']);
    $state = mysqli_real_escape_string($obj->connection(), $_POST['state']);
    $email = mysqli_real_escape_string($obj->connection(), $_POST['email']);

    // $quantity = $_POST['quantity'];
    $quantity = 1;
    $user_id = $_SESSION['user_id'];

    $result = $obj->select('*', 'cart', "user_id={$user_id}");

    if ($result->num_rows > 0) {
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Review Order</title>

            <!-- Bootstrap  -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


            <style>
                body {
                    min-height: 100vh;
                    background-color: #EEEFF2;
                }

                .fluid-one {
                    display: flex;
                    align-items: center;
                }

                .fluid-two {
                    margin-top: 5rem;
                }

                .fluid-two .row {
                    border-radius: 5px;
                }

                .change-address {
                    color: blue;
                    cursor: pointer;
                }

                .change-address:hover {
                    text-decoration: underline;
                }

                .col-lg-4,
                .col-lg-2 {
                    max-height: 32vh;
                }

                .col-lg-4,
                .col-lg-3,
                .col-lg-2 {
                    padding: 2rem;
                    background-color: #F6F8FA;
                }

                p {
                    font-size: 14px;
                    margin: 0;
                }

                .offset-lg-1 h5 {
                    margin: 0;
                }

                .popup {
                    position: fixed;
                    top: 1rem;
                    right: 2rem;
                    border-radius: 4px;
                    padding: 0.7rem 2rem 0.3rem;
                    background-color: #e74c3c;
                    color: white;
                }

                .hidden {
                    display: none;
                }

                .order-summary-container {
                    margin-bottom: 2rem;
                }

                .order-summary-container h6 {
                    margin-bottom: 0;
                }

                @media screen and (max-width:750px) {
                    .fluid-one .col-md-12 {
                        text-align: center;
                    }

                    .fluid-two {
                        margin: 2rem 0;
                    }
                }

                @media screen and (max-width:250px) {
                    .popup {
                        padding: 0.7rem 1rem 0.9rem;
                    }

                    .col-lg-4,
                    .col-lg-3,
                    .col-lg-2 {
                        padding: 1.5rem 1rem;
                    }

                    .col-lg-4 {
                        border-radius: 5px 5px 0 0;
                    }

                    .col-lg-3 {
                        border-radius: 0 0 5px 5px;
                    }
                }
            </style>
        </head>

        <body>

            <div class="popup hidden">
                <h6 style="margin: 0;">Order Placed</h6>
            </div>

            <div class="container-fluid fluid-one">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Siddhi Boutique</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid fluid-two">
                <div class="container">
                    <div class="row">
                        <div class="mb-3">
                            <h4>Review Order</h4>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-5">
                                <h6>Shipping Address <span class="change-address" onclick="goBack()">Change</span></h6>
                                <p>
                                    <?php echo $name; ?>
                                </p>
                                <p>
                                    <?php echo $area; ?>
                                </p>
                                <p><span><?php echo $landmark; ?></span> <span><?php echo $flat; ?></span></p>
                                <p><span><?php echo $city; ?></span> <span><?php echo $state; ?></span>
                                    <span><?php echo $pincode; ?></span>
                                </p>
                            </div>
                        </div>


                        <div class="col-lg-2" style="padding-right: 1.5rem;">
                            <h6>Payment Method</h6>
                            <p>Cash on Delivery</p>
                        </div>

                        <div class="col-lg-3 offset-lg-1 order-summary-container">
                            <h5>Order Summary</h5>
                            <div class="mt-4">
                                <?php
                                $total = 0;
                                while ($row = $result->fetch_assoc()) {
                                    $product_id = $row['product_id'];
                                    $result2 = $obj->select('*', 'products', "product_id='{$product_id}'");

                                    $result3 = $obj->select('*', 'cart', "user_id={$user_id} AND product_id='{$product_id}'");
                                    $row3 = $result3->fetch_assoc();
                                    $quantity = $row3['quantity'];

                                    $row2 = $result2->fetch_assoc();
                                    $price = $row2['product_price'];

                                    $temp = $price * $quantity;
                                    $total += $temp;
                                ?>
                                    <div class="mb-3">
                                        <h6>
                                            <?php echo $row2['product_name']; ?>
                                            <span style="float: right;">&#8377;<?php echo $row2['product_price']; ?></span>
                                        </h6>
                                        <p>Qty <span style="float: right;"><?php echo $quantity; ?></span></p>
                                    </div>
                                <?php
                                }
                                ?>
                                <h6>Delivery <span style="float: right;">&#8377; 50</span></h6>
                                <h4 style="color: #e74c3c;" class="mt-4">Order Total <span id="ordertotal" style="float: right;"><?php echo $total + 50; ?></span></h4>

                                <div class="mt-4">
                                    <button class="btn btn-success placeorder">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="../jquery.js"></script>

            <script>
                $(document).ready(() => {
                    var area = '<?php echo $area; ?>';
                    var landmark = '<?php echo $landmark; ?>';
                    var city = '<?php echo $city; ?>';
                    var state = '<?php echo $state; ?>';
                    var pincode = `<?php echo $pincode; ?>`;
                    var phone = `<?php echo $phone; ?>`;
                    var email = '<?php echo $email; ?>';
                    var customername = '<?php echo $name; ?>';

                    var fullAddress = area + ", " + landmark + ", " + city + ", " + state + " " + pincode;

                    $('.placeorder').click(() => {
                        $.ajax({
                            url: "placeOrderAjax.php",
                            type: "POST",
                            data: {
                                fullAddress,
                                customername,
                                phone,
                                email
                            },
                            success: function(data) {
                                $('.popup').removeClass('hidden');
                                $('.popup').html(data);
                                setTimeout(() => {
                                    $('.popup').addClass('hidden');
                                    location.href = 'http://localhost/ecomm/';
                                }, 200000);
                            }
                        });
                    });
                });

                function goBack() {
                    window.history.back();
                }
            </script>
        </body>

        </html>





<?php
    } else {
        echo '<h1>Page not foundd</h1>';
    }
} else {
    echo '<h1>Page not founddd</h1>';
}
