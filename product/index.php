<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>


    <!-- Custom styles for this template -->
    <link href="../css/index/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="../css/index/responsive.css" rel="stylesheet" />
</head>

<body>
    <?php
    include '../admin/includee/cdn.php';
    include '../database.php';
    $obj = new Database();

    include '../admin/includee/cdn.php';
    include '../includee/navbar1.php';
    ?>

    <section class="product_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Our Products
                </h2>
            </div>
            <div class="row">
                <?php
                $result = $obj->select('*', 'productt', 'product_stock >= 1');

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $productId = $row["product_id"];
                        $row2 = $obj->select('*', 'image', 'product_product_id = ' . $productId);
                        $row2 = $row2->fetch_assoc();
                ?>

                        <div class="col-sm-6 col-lg-4">
                            <div class="box">
                                <div class="img-box">
                                    <img src="../admin/product/uploads/<?php echo $row2['img_path']; ?>" alt="">
                                    <a href="" class="add_cart_btn">
                                        <span>
                                            Add To Cart
                                        </span>
                                    </a>
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        <?php echo $row['product_name']; ?>
                                    </h5>
                                    <div class="product_info">
                                        <h5>
                                            <span>₹</span> <?php echo $row['product_price']; ?>
                                        </h5>
                                        <div class="star_container">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>

            </div>
        </div>
    </section>

    <?php include '../includee/footer.php'; ?>

    <!-- end product section -->

    <!-- jQery -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <!-- bootstrap js -->
    <!-- <script src="../js/bootstrap.js"></script> -->
</body>

</html>