<?php

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    include '../database.php';
    $obj = new Database();
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Orders</title>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <link rel="stylesheet" href="../css/style.css">

        <link rel="stylesheet" href="../style.css">

        <style>
            .container-two {
                margin-top: 4rem;
            }

            .row-2 {
                background-color: #fff;
                padding: 1rem 0 0.6rem;
                border-radius: 5px;
            }

            .row-2:hover {
                cursor: pointer;
                background-color: #9AECDB;
                transition: ease-in 100ms;
            }

            .col-md-12 {
                border: 1px solid black;
                padding: 2rem;
            }

            img {
                width: 15vh;
            }

            .after {
                display: none;
            }

            .col-md-1 {
                display: block;
            }

            @media screen and (max-width:767px) {
                .table-header {
                    display: none;
                }

                .col-md-1 {
                    display: none;
                }

                .row-2 {
                    margin: 1rem 0.2rem;
                }

                .after {
                    display: inline;
                }

                .allOrderImg img {
                    margin-right: 1rem !important;
                }
            }
        </style>
    </head>

    <body>
        <?php include '../includee/navbar.php'; ?>

        <?php

        $user_id = $_SESSION['user_id'];
        $result = $obj->select('*', 'orders', "user_id='{$user_id}'", 'order_id DESC');

        if ($result) {

        ?>
            <div class="container container-two">
                <div class="row table-header">
                    <div class="col-md-1">
                        <h6>Order ID</h6>
                    </div>
                    <div class="col-md-4">
                        <h6>Order Detail</h6>
                    </div>
                    <div class="col-md-3">
                        <h6>Order Date</h6>
                    </div>
                    <div class="col-md-2">
                        <h6>Quantity</h6>
                    </div>
                    <div class="col-md-2">
                        <h6>Price</h6>
                    </div>
                </div>

                <?php
                while ($row = $result->fetch_assoc()) {
                    $product_id = $row['product_id'];
                    $result2 = $obj->select('*', "products", "product_id='{$product_id}'");
                    if ($result2->num_rows > 0) {
                        $row2 = $result2->fetch_assoc();
                        $price = $row2['product_price'] * $row['quantity'];
                        $img = $row2['product_img'];
                ?>

                        <div class="row row-2 my-3">
                            <div class="col-md-1 d-flex align-items-center">
                                <h6>
                                    <span class="after">Order ID : </span><?php echo $row['order_id']; ?>
                                </h6>
                            </div>
                            <div class="col-md-4 allOrderImg d-flex align-items-center" style="flex-wrap: wrap;">
                                <img style="margin: 0 3rem 0.3rem 0;" src="../upload_img/<?php echo $img; ?>" alt="">
                                <h6>
                                    <?php echo $row2['product_name']; ?>
                                    <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs"><?php echo $row['status']; ?></span>
                                </h6>
                            </div>
                            <div class="col-md-3 d-flex align-items-center">
                                <h6>
                                    <span class="after">Date : </span><?php echo $row['order_date']; ?>
                                </h6>
                            </div>
                            <div class="col-md-2 d-flex align-items-center">
                                <h6>
                                    <span class="after">Quantity : </span><?php echo $row['quantity']; ?>
                                </h6>
                            </div>
                            <div class="col-md-2 d-flex align-items-center">
                                <h6>
                                    <span class="after">Price : </span><?php echo $price; ?>
                                </h6>
                            </div>
                        </div>


            <?php
                    }
                }
            } else {
                echo '
                    <div class="container container-two">
                        <h5>Orders Not Found</h5>
                    </div>
                ';
            }
            ?>
            </div>
    </body>

    </html>


<?php

} else {
    echo '<h1>Page not found</h1>';
}

?>