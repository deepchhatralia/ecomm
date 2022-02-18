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

    <style>
        /* .container {
            max-width: 960px;
        } */

        /*
 * Custom translucent site header
 */

        .site-header {
            background-color: rgba(0, 0, 0, .85);
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            backdrop-filter: saturate(180%) blur(20px);
        }

        .site-header a {
            color: #999;
            transition: ease-in-out color .15s;
        }

        .site-header a:hover {
            color: #fff;
            text-decoration: none;
        }

        /*
 * Dummy devices (replace them with your own or something else entirely!)
 */

        .homePageMainImg {
            min-height: 440px;
        }

        .product-device {
            position: absolute;
            right: 10%;
            bottom: -30%;
            width: 300px;
            height: 540px;
            background-color: #333;
            border-radius: 21px;
            -webkit-transform: rotate(30deg);
            transform: rotate(30deg);
            z-index: 10;
        }

        .product-device::before {
            position: absolute;
            top: 10%;
            right: 10px;
            bottom: 10%;
            left: 10px;
            content: "";
            background-color: rgba(255, 255, 255, .1);
            border-radius: 5px;
        }

        .product-device-2 {
            top: -25%;
            right: auto;
            bottom: 0;
            left: 5%;
            background-color: #e5e5e5;
        }


        /*
 * Extra utilities
 */

        .border-top {
            border-top: 1px solid #e5e5e5;
        }

        .border-bottom {
            border-bottom: 1px solid #e5e5e5;
        }

        .box-shadow {
            box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05);
        }

        .flex-equal>* {
            -ms-flex: 1;
            -webkit-box-flex: 1;
            flex: 1;
        }

        .display-4,
        .ptag {
            position: relative;
            z-index: 100;
        }

        @media (min-width: 768px) {
            .flex-md-equal>* {
                -ms-flex: 1;
                -webkit-box-flex: 1;
                flex: 1;
            }
        }

        @media screen and (max-width:768px) {
            .homePageMainImg {
                min-height: 100px;
            }
        }

        .overflow-hidden {
            overflow: hidden;
        }

        .menu_side {
            float: right;
            width: auto;
        }

        .main_menu div#navbar_menu ul li a i {
            font-weight: 600;
        }

        #navbar_menu,
        #navbar_menu ul,
        #navbar_menu ul li,
        #navbar_menu ul li a,
        #navbar_menu #menu-button {
            margin: 0;
            padding: 0;
            border: 0;
            list-style: none;
            line-height: 1;
            display: block;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        #navbar_menu ul,
        #navbar_menu ul li,
        #navbar_menu ul li a,
        #navbar_menu #menu-button {
            position: relative;
        }

        #navbar_menu:after,
        #navbar_menu>ul:after {
            content: ".";
            display: block;
            clear: both;
            visibility: hidden;
            line-height: 0;
            height: 0;
        }

        #navbar_menu #menu-button {
            display: none;
        }

        #navbar_menu {
            margin: 37px 0 0 0;
            float: left;
        }

        #navbar_menu>ul>li {
            float: left;
        }

        #navbar_menu.align-center>ul {
            font-size: 0;
            text-align: center;
        }

        #navbar_menu.align-center>ul>li {
            display: inline-block;
            float: none;
        }

        #navbar_menu.align-center ul ul {
            text-align: left;
        }

        #navbar_menu.align-right>ul>li {
            float: right;
        }

        #navbar_menu>ul>li>a {
            padding: 15px 18px;
            font-size: 14px;
            color: #000;
            font-weight: 600;
            text-transform: uppercase;
        }

        #navbar_menu ul ul {
            position: absolute;
            left: -9999px;
        }

        #navbar_menu.align-right ul ul {
            text-align: right;
        }

        #navbar_menu ul ul li {
            height: 0;
            -webkit-transition: all .25s ease;
            -moz-transition: all .25s ease;
            -ms-transition: all .25s ease;
            -o-transition: all .25s ease;
            transition: all .25s ease;
        }

        #navbar_menu li:hover>ul {
            left: auto;
        }

        #navbar_menu.align-right li:hover>ul {
            left: auto;
            right: 0;
        }

        #navbar_menu li:hover>ul>li {
            height: 45px;
        }

        #navbar_menu ul ul ul {
            margin-left: 100%;
            top: 0;
        }

        #navbar_menu.align-right ul ul ul {
            margin-left: 0;
            margin-right: 100%;
        }

        #navbar_menu ul ul li a {
            padding: 15px 20px 15px;
            font-size: 14px;
            color: #999;
            font-weight: 500;
            background: #fff;
            color: #666 !important;
        }

        #navbar_menu ul ul li:hover>a,
        #navbar_menu ul ul li a:hover {
            color: #ffffff;
        }

        #navbar_menu ul ul {
            width: 250px;
            box-shadow: 0 5px 35px -18px #000;
            border-top: solid #000 2px;
        }

        #navbar_menu ul ul li a:hover,
        #navbar_menu ul ul li a:focus {
            color: #fff !important;
            padding: 15px 20px 15px;
        }

        .main_bg {
            margin-top: 0px;
            min-height: 70px;
            position: relative;
        }


        /*-- Search Bar --*/

        .search_icon {
            float: left;
            margin: 48px 0px 0 15px;
        }

        .search_icon ul {
            list-style: none;
            float: left;
            margin: 0;
            padding: 0;
        }

        .search_icon ul li {
            float: left;
            font-size: 14px;
        }

        .search_icon ul li {
            float: left;
            font-size: 16px;
        }

        .search_icon ul li a {
            color: #000;
        }

        #search_bar {
            padding: 0 !important;
        }

        #search_bar .modal-content {
            position: relative;
            background-color: transparent;
            border: none;
            border-radius: 0;
            box-shadow: none;
        }

        #search_bar .modal-dialog {
            width: 100%;
            padding: 0;
            margin: 0;
            transition: -webkit-transform .3s ease-out;
            transition: transform .3s ease-out;
            transition: transform .3s ease-out, -webkit-transform .3s ease-out;
            -webkit-transform: translate(0, 0%);
            transform: translate(0, 0%);
            max-width: 100%;
            margin: 0;
        }

        #search_bar button.close {
            float: right;
            font-weight: 400;
            line-height: 1;
            color: #000;
            text-shadow: none;
            opacity: 1;
            width: 60px;
            height: 60px;
            font-size: 18px;
            background: #fff;
            margin: 0;
            position: fixed;
            right: 0;
        }

        #search_bar .modal-header {
            padding: 0;
            border-bottom: none;
        }

        #search_bar .search-global {
            position: absolute;
            top: 50vh;
            margin-top: -122px;
            width: 90%;
        }

        #search_bar .search-global__input {
            width: 100%;
            color: #fff;
            border: none;
            border-bottom: 1px solid #fff !important;
            background-color: transparent;
            opacity: 1;
            height: auto !important;
            padding: 0 70px 23px 0 !important;
            font-size: 65px;
            font-weight: 600;
            line-height: 75px;
            letter-spacing: -3px;
        }

        #search_bar .search-global__btn {
            position: absolute;
            top: 7px;
            right: 16px;
            font-size: 42px;
            color: #fff;
            border: none;
            background-color: transparent;
            transition: all 0.3s;
            cursor: pointer;
        }

        #search_bar .search-global__note {
            margin-top: 25px;
            font-size: 15px;
            color: #fff;
        }

        #search_bar *::placeholder {
            color: #fff;
            opacity: 1;
        }

        #search_bar .modal-body {
            float: left;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        #search_bar .navbar-search {
            float: left;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .modal-open {
            padding: 0 !important;
        }

        .modal-backdrop.in {
            opacity: 1;
        }

        .modal-backdrop {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1040;
            background-color: rgba(0, 0, 0, .8);
        }


        /*-- Side Menu --*/

        .menu_icon {
            float: left;
            padding: 48px 0 0 0;
        }

        .menu_icon ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .menu_icon ul li a {
            color: #000;
        }


        /*-- Fix Header --*/

        .fix_header {
            position: absolute;
            width: 100%;
            top: 0;
        }


        /*-- header style 2 --*/

        .header_style_2 #navbar_menu {
            margin: 12px 0 11px;
            float: left;
        }

        .header_style_2 .search_icon {
            float: left;
            margin: 22px 0 0 21px;
        }

        .menu_icon {
            padding: 22px 0px 0 0px;
        }

        .header_bottom .info_cont h4 {
            font-size: 14px;
            font-family: poppins;
            font-weight: 500;
        }

        .header_bottom .information_bottom p {
            color: #737373;
            font-family: poppins;
            font-size: 14px;
        }

        .header_bottom .information_bottom {
            margin: 45px 0 0;
        }

        .main_bg #navbar_menu>ul>li>a {
            color: #fff;
        }

        .main_bg .search_icon ul li a {
            color: #fff;
        }

        .main_bg .menu_icon ul li a {
            color: #fff;
        }

        .header_style_2 .header_top ul li,
        .header_style_2 .header_top a,
        .header_style_2 .header_top i {
            color: #737373;
        }

        .header_style_2 .header_bottom {
            background: #fff;
        }

        .header_style_2 .menu_side {
            float: right;
            width: 100%;
        }

        .header_style_4 .header_top {
            background: transparent;
        }

        .header_style_4 .header_bottom {
            min-height: 120px;
            background: #ffffff;
            padding: 0 30px 0 20px;
            float: left;
            width: 100%;
        }

        .header_style_4 .logo {
            left: 0px;
        }

        header .header_top,
        header .header_bottom,
        section,
        footer,
        .bottom_footer,
        .light_silver,
        .bottom_silver_section {
            float: left;
            width: 100%;
        }
    </style>

    <link rel="stylesheet" href="css/productCard.css">
    <link rel="stylesheet" href="css/headingBorder.css">
</head>

<body>
    <?php
    include 'admin/includee/cdn.php';
    include 'database.php';
    $obj = new Database();

    include 'includee/navbar1.php';
    ?>


    <!-- <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active h-50">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSIPLxsDaGmTWe-vk-d_lNQNUPW-hfx23iqjg&usqp=CAU" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div> -->

    <!-- <section class="slider_section ">
        <div id="customCarousel1" class="carouse slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-box">
                                    <?php
                                    // $text = "WELCOME TO OUR SHOP";
                                    // if (isset($_SESSION['userlogin'])) {
                                    //     $user = $obj->select('*', 'userlogin', 'userid=' . $_SESSION['userlogin']);
                                    //     if ($user->num_rows > 0) {
                                    //         $user = $user->fetch_assoc();
                                    //         $text = "WELCOME, " . $user['user_firstname'];
                                    //     }
                                    // }
                                    ?>
                                    <h1 class="h1">
                                        <?php //echo $text; 
                                        ?>
                                    </h1>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="img-box">
                                    <img src="images/laptopPNG.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- <div class="position-relative overflow-hidden p-md-5 text-center bg-light homePageMainImg">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
            <?php
            // $text = "WELCOME TO OUR SHOP";
            // if (isset($_SESSION['userlogin'])) {
            //     $user = $obj->select('*', 'userlogin', 'userid=' . $_SESSION['userlogin']);
            //     if ($user->num_rows > 0) {
            //         $user = $user->fetch_assoc();
            //         $text = "WELCOME, " . $user['user_firstname'];
            //     }
            // }
            ?>
            <h1 class="display-4 font-weight-normal" style="z-index: 100;"><?php //echo $text; 
                                                                            ?></h1>
        </div>
        <div class="product-device box-shadow d-none d-md-block"></div>
        <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
    </div> -->

    <?php include './includee/slider.php'; ?>


    <section class="product_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center main_heading">
                <h2 class="h2 m-0">Our Products</h2>
            </div>
            <div class="row">
                <?php
                $result = $obj->select('*', 'productt', 'product_stock >= 1', null, 8);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $productId = $row["product_id"];
                        $row2 = $obj->select('*', 'image', 'product_product_id = ' . $productId);
                        $row2 = $row2->fetch_assoc();

                        $offerId = $row['offer_idoffer'];

                        $price = $row['product_price'];
                        if ($offerId != 0) {
                            $resultt = $obj->select('*', 'offer', "idoffer=" . $offerId);
                            $roww = $resultt->fetch_assoc();

                            $price = round($row['product_price'] - ($row['product_price'] * $roww['offer_discount'] / 100));
                        }
                ?>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 margin_bottom_30_all">
                            <div class="product_list">
                                <div class="product_img">
                                    <img class="img-responsive" src="admin/product/uploads/<?php echo $row2['img_path']; ?>" alt="">
                                </div>
                                <div class="product_detail_btm">
                                    <div class="center">
                                        <h4 class="h4">
                                            <a href="http://localhost/ecomm/product/product.php?id=<?php echo $productId; ?>"><?php echo $row['product_name']; ?></a>
                                        </h4>
                                    </div>
                                    <div class="product_price">
                                        <p><span class="new_price">₹<?php echo $price; ?></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>


                    <?php
                    }
                    if ($result->num_rows > 8) {
                    ?>
                        <div class="btn_box">
                            <a href="http://localhost/ecomm/product" class="view_more-link">
                                View More
                            </a>
                        </div>
                <?php }
                }
                ?>
            </div>
        </div>
    </section>
    <!-- end product section -->



    <section class="why_us_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center main_heading">
                <h2 class="h2 m-0">Why Choose Us</h2>
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
                    <div class="box">
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