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

                            $offerId = $row['offer_idoffer'];
                            $price = $row['product_price'];
                            if ($offerId != 0) {
                                $resultt = $obj->select('*', 'offer', "idoffer=" . $offerId);
                                $roww = $resultt->fetch_assoc();

                                $todaysDate = strtotime(date('Y-m-d'));
                                $startDate = strtotime($roww['offer_startDate']);
                                $endDate = strtotime($roww['offer_endDate']);

                                if ($todaysDate >= $startDate && $todaysDate <= $endDate) {
                                    $price = round($price - ($price * $roww['offer_discount'] / 100));
                                }
                            }
                        ?>

                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 margin_bottom_30_all">
                                <div class="product_list">
                                    <div class="product_img">
                                        <img class="img-responsive" src="../../admin/product/uploads/<?php echo $row2['img_path']; ?>" alt="">
                                    </div>
                                    <div class="product_detail_btm">
                                        <div class="center">
                                            <h4 class="h4">
                                                <a href="http://localhost/ecomm/product/product.php?id=<?php echo $productId; ?>"><?php echo $row['product_name']; ?></a>
                                            </h4>
                                        </div>
                                        <div class="product_price">
                                            <p><span class="new_price">₹ <?php echo $price; ?></span></p>
                                        </div>
                                    </div>
                                </div>
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