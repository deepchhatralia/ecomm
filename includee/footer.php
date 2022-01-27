<head>
    <style>
        .info_section {
            background-color: #3a4468;
            color: #ffffff;
            padding: 90px 0 45px 0;
        }

        .info_section h5 {
            margin-bottom: 15px;
            font-size: 24px;
        }

        .info_section .info_links ul {
            padding: 0;
        }

        .info_section .info_links ul li {
            list-style-type: none;
        }

        .info_section .info_links ul li a {
            display: inline-block;
            color: #ffffff;
            margin-bottom: 5px;
        }

        .info_section .info_form form input {
            outline: none;
            width: 100%;
            padding: 7px 10px;
        }

        .info_section .info_form form button {
            padding: 8px 35px;
            outline: none;
            border: none;
            color: #ffffff;
            background: #f3c93e;
            margin-top: 15px;
            text-transform: uppercase;
        }

        .info_section .info_form .social_box {
            margin-top: 35px;
            width: 100%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }

        .info_section .info_form .social_box a {
            margin-right: 25px;
            color: #ffffff;
            font-size: 24px;
        }

        /* footer section*/
        .footer_section {
            position: relative;
            background-color: #3a4468;
            text-align: center;
        }

        .footer_section p {
            border-top: 1px solid #ffffff;
            color: #ffffff;
            padding: 20px 0;
            margin: 0;
        }

        .footer_section p a {
            color: inherit;
        }
    </style>
</head>

<div class="footer-container">
    <!-- info section -->
    <section class="info_section ">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-md-4">
                    <div class="info_contact">
                        <h5>
                            <a href="" class="navbar-brand">
                                <span>
                                    GDRS
                                </span>
                            </a>
                        </h5>
                        <p class="mb-2">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            A/29, Bapukrupa Society, Near Chinmay Tower, Opp. Upganda Park, Memnagar, Ahmedabad
                        </p>
                        <p class="mb-2">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <a href="tel: 9328324955">+91 9328324955</a>
                        </p>
                        <p class="mb-2">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <a href="mailto: gdstream@gmail.com">gdstream@gmail.com</a>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info_links">
                        <h5>
                            Useful Links
                        </h5>
                        <ul>
                            <li>
                                <a href="http://localhost/ecomm">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="http://localhost/ecomm/product">
                                    Products
                                </a>
                            </li>
                            <li>
                                <a href="http://localhost/ecomm/product/category">
                                    Category
                                </a>
                            </li>
                            <li>
                                <a href="about.html">
                                    About
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info_form ">
                        <h5>
                            Newsletter
                        </h5>
                        <form action="">
                            <input type="email" placeholder="Enter your email">
                            <button>
                                Subscribe
                            </button>
                        </form>
                        <div class="social_box">
                            <a href="">
                                <i class="fab fa-facebook" aria-hidden="true"></i>
                            </a>
                            <a href="">
                                <i class="fab fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="">
                                <i class="fab fa-instagram" aria-hidden="true"></i>
                            </a>
                            <a href="">
                                <i class="fab fa-youtube" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end info_section -->


    <!-- footer section -->
    <footer class="footer_section">
        <div class="container">
            <p>
                &copy; <span id="displayYear"></span> All Rights Reserved By
                <a href="http://localhost/ecomm">GDRS</a>
            </p>
        </div>
    </footer>
    <!-- footer section -->
</div>