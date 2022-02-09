<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Rubik', sans-serif !important;
        }

        .hero_area {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .sub_page .hero_area {
            min-height: auto;
        }

        .sub_page .about_section {
            background-color: #313958;
        }

        .header_section {
            background-color: #3a4468;
        }

        .header_section .container-fluid {
            padding-right: 25px;
            padding-left: 25px;
        }

        .header_section .header_top {
            padding: 15px 0;
            background-color: #434f78;
        }

        .header_section .header_bottom {
            padding: 10px 0;
        }

        .top_nav_container {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .contact_nav {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }

        .contact_nav a {
            color: #ffffff;
            margin-right: 10px;
        }

        .contact_nav a i {
            color: #f3c93e;
        }

        .contact_nav a:hover {
            color: #f3c93e;
        }

        .search_form {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin: 0 15px;
        }

        .search_form .form-control {
            border-radius: 5px 0 0 5px;
            height: 40px;
            width: auto;
            min-width: unset;
        }

        .search_form button {
            width: 45px;
            min-width: 45px;
            height: 40px;
            padding: 0;
            border: none;
            outline: none;
            color: #ffffff;
            background-color: #f3c93e;
            border-radius: 0 5px 5px 0;
        }

        .user_option_box {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .user_option_box a {
            color: #ffffff;
            margin-left: 25px;
            text-transform: uppercase;
        }

        .user_option_box a i {
            color: #f3c93e;
        }

        .user_option_box a span {
            margin-left: 5px;
        }

        .user_option_box a:hover {
            color: #f3c93e;
        }

        .navbar-brand {
            padding: 0;
            margin: 0;
            color: #000000;
            font-weight: bold;
            font-size: 28px;
            font-weight: bold;
        }

        .navbar-brand span {
            color: #ffffff;
        }

        .custom_nav-container {
            padding: 0;
        }

        .custom_nav-container .navbar-nav {
            margin-left: auto;
        }

        .custom_nav-container .navbar-nav .nav-item .nav-link {
            padding: 10px 25px;
            color: #ffffff;
            text-align: center;
        }

        .custom_nav-container .navbar-nav .nav-item:hover .nav-link {
            color: #f3c93e;
        }

        .custom_nav-container .navbar-toggler {
            outline: none;
        }

        .custom_nav-container .navbar-toggler {
            padding: 0;
            width: 37px;
            height: 42px;
            -webkit-transition: all .3s;
            transition: all .3s;
        }

        .custom_nav-container .navbar-toggler span {
            display: block;
            width: 35px;
            height: 4px;
            background-color: #ffffff;
            margin: 7px 0;
            -webkit-transition: all 0.3s;
            transition: all 0.3s;
            position: relative;
            border-radius: 5px;
            -webkit-transition: all .3s;
            transition: all .3s;
        }

        .custom_nav-container .navbar-toggler span::before,
        .custom_nav-container .navbar-toggler span::after {
            content: "";
            position: absolute;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: #ffffff;
            top: -10px;
            border-radius: 5px;
            -webkit-transition: all .3s;
            transition: all .3s;
        }

        .custom_nav-container .navbar-toggler span::after {
            top: 10px;
        }

        .custom_nav-container .navbar-toggler[aria-expanded="true"] {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }

        .custom_nav-container .navbar-toggler[aria-expanded="true"] span {
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .custom_nav-container .navbar-toggler[aria-expanded="true"] span::before,
        .custom_nav-container .navbar-toggler[aria-expanded="true"] span::after {
            -webkit-transform: rotate(90deg);
            transform: rotate(90deg);
            top: 0;
        }
    </style>
</head>

<div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
        <div class="header_top">
            <div class="container-fluid">
                <div class="top_nav_container">
                    <div class="contact_nav">
                        <a href="tel: 9328324955">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span>
                                Call : +91 9328324955
                            </span>
                        </a>
                        <a href="mailto: gdstream@gmail.com">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <span>
                                Email : gdstream@gmail.com
                            </span>
                        </a>
                    </div>
                    <from class="search_form">
                        <input type="text" id="search" onkeyup="onKeyUp()" class="form-control" placeholder="Search here...">
                        <button class="" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </from>
                    <div class="user_option_box">
                        <?php
                        if (isset($_SESSION['userlogin'])) {
                        ?>
                            <a href="http://localhost/ecomm/account" class="account-link">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>
                                    My Account
                                </span>
                            </a>
                            <a href="http://localhost/ecomm/auth/logout.php" id="logout-btn" class="account-link">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>
                                    Logout
                                </span>
                            </a>
                            <a href="http://localhost/ecomm/cart" class="cart-link">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span>
                                    Cart
                                </span>
                            </a>
                            <a href="http://localhost/ecomm/product/wishlist.php" class="cart-link">
                                <i class="fas fa-heart" aria-hidden="true"></i>
                                <span>
                                    Wishlist
                                </span>
                            </a>
                        <?php
                        } else {
                            echo '<a href="http://localhost/ecomm/auth/login.php" id="login-btn" class="account-link">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>
                                Login
                            </span>
                        </a>
                        <a href="http://localhost/ecomm/auth/signup.php" id="login-btn" class="account-link">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>
                                Signup
                            </span>
                        </a>';
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
        <div class="header_bottom">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="http://localhost/ecomm/">
                        <span>
                            GDRS
                        </span>
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""> </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ">
                            <li class="nav-item active">
                                <a class="nav-link" href="http://localhost/ecomm/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="http://localhost/ecomm/product">Products </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="http://localhost/ecomm/product/category">Category</a>
                            </li>
                            <?php
                            if (isset($_SESSION['userlogin'])) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="http://localhost/ecomm/orders/">Orders</a>
                                </li>
                            <?php
                            }
                            ?>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="about.html"> About</a>
                            </li> -->
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!-- end header section -->

</div>

<script>
    document.getElementById('logout-btn').addEventListener('click', () => {
        if (confirm('Are you sure to logout ???')) {
            window.location.href = "http://localhost/ecomm/logout.php";
        }
    })

    function onKeyUp() {
        const value = document.getElementById('search').value;

        // $.ajax({
        //     url:""
        // })
    }
</script>