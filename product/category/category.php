<?php
session_start();
if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Category</title>

        <!-- Custom styles for this template -->
        <link href="../../css/index/style.css" rel="stylesheet" />
        <!-- responsive style -->
        <link href="../../css/index/responsive.css" rel="stylesheet" />
    </head>

    <body>
        <?php
        include '../../admin/includee/cdn.php';
        include '../../database.php';
        $obj = new Database();

        include '../../includee/navbar1.php';

        $result = $obj->select('*', 'productt', "product_category=" . $categoryId . " AND product_stock >= 1");
        if ($result->num_rows > 0) {

        ?>

            <section class="product_section layout_padding">
                <div class="container">
                    <div class="heading_container heading_center">
                        <h2>
                            Product's
                        </h2>
                    </div>
                    <div class="row">
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            $productId = $row["product_id"];

                            $result2 = $obj->select('*', 'image', 'product_product_id = ' . $productId);
                            $row2 = $result2->fetch_assoc();
                        ?>

                            <div class="col-sm-6 col-lg-4">
                                <a href="http://localhost/ecomm/product/product.php?id=<?php echo $productId; ?>">
                                    <div class="box">
                                        <div class="img-box">
                                            <img src="../../admin/product/uploads/<?php echo $row2['img_path']; ?>" alt="">
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
                                </a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </section>



        <?php
        } else {
            echo '<div class="container my-5">
                <div class="row text-center">
                <h4 class="h4">No products in this category</h4>
                </div>
                </div>';
            // include '../../pagenotfound.php';
        }
        include '../../includee/footer.php';
        ?>

        <!-- end product section -->

        <!-- jQery -->
        <script src="../../js/jquery-3.4.1.min.js"></script>
        <!-- bootstrap js -->
        <script src="../../js/bootstrap.js"></script>
    </body>

    </html>

<?php
} else {
    include '../../pagenotfound.php';
}
?>