<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title>GDRS</title>



    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet"> <!-- range slider -->


    <!-- Custom styles for this template -->
    <link href="css/index/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/index/responsive.css" rel="stylesheet" />

</head>

<body>
    <?php
    include 'admin/includee/cdn.php';
    include 'database.php';
    $obj = new Database();
    ?>

    <?php
    include 'includee/navbar1.php';
    ?>

    <section class="slider_section ">
        <div id="customCarousel1" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-box">
                                    <h1>
                                        Welcome to our shop
                                    </h1>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste quam velit saepe dolorem deserunt quo quidem ad optio.
                                    </p>
                                    <a href="">
                                        Read More
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="img-box">
                                    <img src="images/slider-img.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-box">
                                    <h1>
                                        Welcome to our shop
                                    </h1>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste quam velit saepe dolorem deserunt quo quidem ad optio.
                                    </p>
                                    <a href="">
                                        Read More
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="img-box">
                                    <img src="images/slider-img.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-box">
                                    <h1>
                                        Welcome to our shop
                                    </h1>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste quam velit saepe dolorem deserunt quo quidem ad optio.
                                    </p>
                                    <a href="">
                                        Read More
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="img-box">
                                    <img src="images/slider-img.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel_btn_box">
                <a class="carousel-control-prev" href="#customCarousel1" role="button" data-slide="prev">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>

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
                            <a class="product-box-a" href="http://localhost/ecomm/product/product.php?id=<?php echo $productId; ?>">
                                <div class="box">
                                    <div class="img-box">
                                        <img src="admin/product/uploads/<?php echo $row2['img_path']; ?>" alt="">
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
                }
                if ($result->num_rows > 5) {
                    ?>

                    <div class="btn_box">
                        <a href="" class="view_more-link">
                            View More
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- end product section -->


    <!-- about section -->

    <section class="about_section">
        <div class="container-fluid  ">
            <div class="row">
                <div class="col-md-5 ml-auto">
                    <div class="detail-box pr-md-3">
                        <div class="heading_container">
                            <h2>
                                We Provide Best For You
                            </h2>
                        </div>
                        <p>
                            Totam architecto rem beatae veniam, cum officiis adipisci soluta perspiciatis ipsa, expedita maiores quae accusantium. Animi veniam aperiam, necessitatibus mollitia ipsum id optio ipsa odio ab facilis sit labore officia!
                            Repellat expedita, deserunt eum soluta rem culpa. Aut, necessitatibus cumque. Voluptas consequuntur vitae aperiam animi sint earum, ex unde cupiditate, molestias dolore quos quas possimus eveniet facilis magnam? Vero, dicta.
                        </p>
                        <a href="">
                            Read More
                        </a>
                    </div>
                </div>
                <div class="col-md-6 px-0">
                    <div class="img-box">
                        <img src="images/about-img.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end about section -->

    <!-- why us section -->

    <section class="why_us_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Why Choose Us
                </h2>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="box ">
                        <div class="img-box d-flex justify-content-center">
                            <img src="images/w1.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Fast Delivery
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box ">
                        <div class="img-box d-flex justify-content-center">
                            <img src="images/w2.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Free Shipping
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box ">
                        <div class="img-box d-flex justify-content-center">
                            <img src="images/w3.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Best Quality
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end why us section -->

    <?php include 'includee/footer.php'; ?>

    <!-- jQery -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.js"></script>

    <script>
        $('.dropdown-item').on('click', (e) => {
            const id = e.currentTarget.getAttribute('data-id')
            $.ajax({
                url: "loadCategory.php",
                type: "POST",
                data: {
                    id
                },
                success(data) {
                    $('.grid').html(data)
                }
            })
        })

        function getYear() {
            var currentDate = new Date();
            var currentYear = currentDate.getFullYear();
            document.querySelector("#displayYear").innerHTML = currentYear;
        }
        getYear()
    </script>

</body>

</html>