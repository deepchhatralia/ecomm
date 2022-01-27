<?php

if (!isset($_GET['id'])) {
    include '../pagenotfound.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../css/index/responsive.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">

    <style>
        /* * {
            border: 1px solid black !important;
        } */

        .container {
            font-family: 'Rubik', sans-serif;
        }

        .product-img-container img {
            width: 100%;
            max-width: 100px;
            height: auto;
            /* margin: 0 5px; */
            cursor: pointer;
        }

        .price-container h1 {
            font-weight: 800 !important;
        }

        .feature-container .product-feature {
            font-size: 15px;
            max-height: 29vh;
            overflow: hidden;
        }

        .view-more-less {
            cursor: pointer;
        }

        #addToCart {
            background-color: rebeccapurple;
            color: #fff;
            letter-spacing: 3px;
            cursor: pointer;
            border: none;
            border-radius: 3px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
        }

        #addToCart:hover {
            transition: all 1s ease;
            box-shadow: none;
            transform: scale(1.01);
        }
    </style>
</head>

<body>
    <?php
    include '../admin/includee/cdn.php';
    include '../database.php';
    $obj = new Database();


    $id = $_GET['id'];

    $result = $obj->select('*', 'productt', "product_id=" . $id);

    if ($result->num_rows > 0) {
        include '../includee/navbar1.php';

        $row = $result->fetch_assoc();

        $offerId = $row['offer_idoffer'];

        $price = $row['product_price'];
        if ($offerId != 0) {
            $result = $obj->select('*', 'offer', "idoffer=" . $offerId);
            $row2 = $result->fetch_assoc();

            $price = round($row['product_price'] - ($row['product_price'] * $row2['offer_discount'] / 100));
        }
    ?>
        <div class="container mt-4" style="margin-bottom: 20vh;">
            <div class="row">
                <div class="col-md-6">
                    <div class="main-product-img my-3 d-flex align-items-center justify-content-center">
                        <img src="../images/p1.png" alt="">
                    </div>

                    <div class="product-img-container d-flex align-items-center justify-content-between flex-wrap">
                        <img src="../images/p2.png" alt="">
                        <img src="../images/p3.png" alt="">
                        <img src="../images/p4.png" alt="">
                        <img src="../images/p5.png" alt="">
                        <img src="../images/p6.png" alt="">
                    </div>
                </div>

                <div class="col-md">
                    <h2 class="h2 my-3"><?php echo $row['product_name']; ?> <span class="h6">by GDRS</span>
                    </h2>

                    <div class="price-container">
                        <h1 class="h1">Rs. <?php echo $price; ?></h1>
                    </div>

                    <div class="rating-container my-3">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <span class="h5">3.5/5</span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between">

                    </div>

                    <div class="feature-container">
                        <p class="product-feature"><?php echo $row['product_feature'] ?><br /></p>

                        <div class="d-flex align-items-center justify-content-center my-2">
                            <h6 class="h6 view-more-less view-more">MORE <i class="fas fa-arrow-down"></i></h6>
                        </div>

                        <div class="addToCart-container">
                            <?php
                            if ($row['product_stock'] < 8) {
                            ?>
                                <h5 class="h5 text-danger">Hurry ! Only 5 left in stock</h5>
                            <?php
                            }
                            ?>

                            <div class="d-flex align-items-center justify-content-center py-2 my-3" id="addToCart">
                                <h4 class="h4 m-0">ADD TO CART</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include '../includee/footer.php';
        ?>

        <script src="../js/jquery-3.4.1.min.js"></script>

        <script>
            $(document).ready(() => {


                $('.view-more-less').click(() => {
                    if ($('.view-more-less').hasClass("view-more")) {
                        $('.feature-container p').css("height", "auto")
                        $('.view-more-less').html('LESS <i class="fas fa-arrow-up"></i>')

                        $('.view-more-less').removeClass('view-more')
                        $('.view-more-less').addClass('view-less')
                    } else {
                        $('.feature-container p').css("height", "29vh")
                        $('.view-more-less').html('MORE <i class="fas fa-arrow-down"></i>')

                        $('.view-more-less').removeClass('view-less')
                        $('.view-more-less').addClass('view-more')
                    }
                })
            })
        </script>

    <?php
    } else {
        include '../pagenotfound.php';
    }
    ?>
</body>

</html>