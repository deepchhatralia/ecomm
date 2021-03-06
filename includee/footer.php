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

        .footer-gdrs:hover {
            color: skyblue !important;
            text-decoration: underline;
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
                            <i class="fas fa-map-marker-alt"></i>
                            <a target="blank" style="color:white; text-decoration:none;" href="https://www.google.com/maps/place/G.D.R.S./@23.0535069,72.5313053,17z/data=!3m1!4b1!4m5!3m4!1s0x395e853d37e44497:0xf934b7373bbbb74e!8m2!3d23.053502!4d72.533494">
                                A/29, Bapukrupa Society, Near Chinmay Tower, Opp. Upganda Park, Memnagar, Ahmedabad
                            </a>
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
                        <ul class="p-0">
                            <li>
                                <a href="http://localhost/ecomm">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="about.html">
                                    About
                                </a>
                            </li>
                            <li>
                                <a href="http://localhost/ecomm/enquiry.php"> Enquiry</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3671.1901922627185!2d72.533745!3d23.0534878!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e853d37e44497%3A0xf934b7373bbbb74e!2sG.D.R.S.!5e0!3m2!1sen!2sin!4v1644848508380!5m2!1sen!2sin" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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
                <a href="http://localhost/ecomm" class="footer-gdrs">GDRS</a>
            </p>
        </div>
    </footer>
    <!-- footer section -->
</div>

<script>
    document.getElementById("displayYear").innerHTML = new Date().getFullYear();
</script>