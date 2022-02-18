<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Category</title>


    <!-- Custom styles for this template -->
    <link href="../../css/index/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="../../css/index/responsive.css" rel="stylesheet" />

    <link rel="stylesheet" href="../../css/productCard.css">
    <link rel="stylesheet" href="../../css/headingBorder.css">

</head>

<body>
    <?php
    include '../../admin/includee/cdn.php';
    include '../../database.php';
    $obj = new Database();

    include '../../admin/includee/cdn.php';
    include '../../includee/navbar1.php';
    ?>

    <section class="product_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center main_heading">
                <h2 class="h2">
                    Product Category
                </h2>
            </div>
            <div class="row align-items-center justify-content-between">
                <?php
                $result = $obj->select('*', 'product_category');

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 margin_bottom_30_all">
                            <div class="product_list" style="min-height: 0;">
                                <div class="product_img">
                                    <img class="img-responsive" src="../../admin/product/category_uploads/<?php echo $row['category_img']; ?>" alt="">
                                </div>
                                <div class="product_detail_btm">
                                    <div class="center">
                                        <h4 class="h4">
                                            <a href="http://localhost/ecomm/product/category/category.php?id=<?php echo $row['category_id']; ?>"><?php echo $row['category_name'];; ?></a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo '<div class="heading_container heading_center">
                        <h1>There are no product category</h1>
                    </div>';
                }
                ?>

            </div>
        </div>
    </section>

    <?php include '../../includee/footer.php'; ?>

    <!-- end product section -->

    <!-- jQery -->
    <script src="../../js/jquery-3.4.1.min.js"></script>
    <!-- bootstrap js -->
    <script src="../../js/bootstrap.js"></script>
</body>

</html>