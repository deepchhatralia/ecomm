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
            <div class="heading_container heading_center">
                <h2>
                    Product Category
                </h2>
            </div>
            <div class="row">
                <?php
                $result = $obj->select('*', 'product_category');

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>

                        <div class="col-sm-6 col-lg-4">
                            <div class="box">
                                <div class="img-box">
                                    <img src="../../admin/product/category_uploads/<?php echo $row['category_img']; ?>" alt="">
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        <?php echo $row['category_name']; ?>
                                    </h5>
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
    <script src="../js/jquery-3.4.1.min.js"></script>
    <!-- bootstrap js -->
    <!-- <script src="../js/bootstrap.js"></script> -->
</body>

</html>