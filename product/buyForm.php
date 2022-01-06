<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

    if (isset($_GET['q'])) {
        include '../database.php';
        $obj = new Database();

        $id = $_GET['q'];
        $user_id = $_SESSION['user_id'];

        $result = $obj->select('*', 'cart', "user_id={$user_id}");

        if (mysqli_num_rows($result) > 0) {
?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Buy</title>

                <!-- Bootstrap  -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

                <!-- Navbar Css -->
                <link rel="stylesheet" href="../style.css">

                <style>
                    body {
                        min-height: 100vh;
                        background-color: #EEEFF2;
                    }

                    .fluid-one {
                        display: flex;
                        align-items: center;
                    }

                    .container-two {
                        display: grid;
                        grid-template-columns: auto;
                        grid-gap: 1rem;
                    }

                    .boxA,
                    .boxB,
                    .boxC {
                        background-color: #F6F8FA;
                        padding: 1rem;
                    }

                    .boxA {
                        grid-column: 1 / span 2;
                    }

                    .boxB {
                        grid-column: 3;
                        grid-row: 1 / span 2;
                    }

                    .boxC {
                        grid-column: 1;
                        grid-row: 2;
                    }

                    input {
                        width: 75%;
                        border-radius: 4px;
                        border: 1px solid #d0d0d0;
                        box-shadow: 0 1px 0 rgb(255 255 255 50%), 0 1px 0 rgb(0 0 0 / 7%) inset;
                        padding: 3px 7px;
                        outline: none;
                        border-top: 1px solid #bbb;
                    }

                    .order-summary p {
                        margin: 0;
                        padding: 0;
                    }

                    .order-summary span {
                        float: right;
                    }

                    .order-summary h4 {
                        color: #d63031;
                    }

                    .popup-msg {
                        position: fixed;
                        top: 2rem;
                        right: 2rem;
                        background-color: #c0392b;
                        color: #ecf0f1;
                        padding: 0.5rem 1rem 0.5rem;
                        border-radius: 4px;
                    }

                    .popup-msg p {
                        margin: 0;
                    }

                    .hidden {
                        display: none;
                    }

                    .container-two .row {
                        display: flex;
                    }

                    @media screen and (max-width:767px) {
                        .fluid-one .col-md-12 {
                            text-align: center;
                        }

                        .col-md-4 {
                            margin-top: 2rem;
                            position: relative;
                        }
                    }

                    @media screen and (max-width:500px) {
                        input {
                            width: 100%;
                        }
                    }
                </style>

            </head>

            <body>

                <div class="popup-msg hidden">
                    <p>Please fill all details</p>
                </div>

                <div class="container-fluid fluid-one">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Siddhi Boutique</h2>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="container-fluid fluid-two">
                    <div class="container container-two">
                        <div class="boxA">
                            <h3 class="mb-5">Shipping Details</h3>
                            <form action="reviewOrder.php" method="POST">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="mb-3">
                                            <div>
                                                <h6><span>Full Name</span></h6>
                                            </div>
                                            <div><input type="text" name="name" id="name"></div>
                                        </div>
                                        <div class="mb-3">
                                            <div>
                                                <h6><span>Mobile Number</span></h6>
                                            </div>
                                            <div><input type="number" name="phone" id="phone"></div>
                                        </div>
                                        <div class="mb-3">
                                            <div>
                                                <h6><span>PIN Code</span></h6>
                                            </div>
                                            <div><input type="number" name="pincode" id="pincode"></div>
                                        </div>
                                        <div class="mb-3">
                                            <div>
                                                <h6><span>Email</span></h6>
                                            </div>
                                            <div><input type="email" name="email" id="email"></div>
                                        </div>
                                        <div class="mb-3">
                                            <div>
                                                <h6><span>Flat, House no., Building, Company, Apartment</span></h6>
                                            </div>
                                            <div><input type="text" name="flat" id="flat"></div>
                                        </div>
                                        <div class="mb-3">
                                            <div>
                                                <h6><span>Area, Colony, Street, Sector, Village</span></h6>
                                            </div>
                                            <div><input type="text" name="area" id="area"></div>
                                        </div>
                                        <div class="mb-3">
                                            <div>
                                                <h6><span>Landmark</span></h6>
                                            </div>
                                            <div><input type="text" name="landmark" id="landmark"></div>
                                        </div>
                                        <div class="mb-3">
                                            <div>
                                                <h6><span>City</span></h6>
                                            </div>
                                            <div><input type="text" name="city" id="city"></div>
                                        </div>
                                        <div class="mb-3">
                                            <div>
                                                <h6><span>State</span></h6>
                                            </div>
                                            <div><input type="text" name="state" id="state"></div>
                                        </div>

                                        <div class="mb-3">
                                            <button class="btn btn-success btnNext" name="next" id="next" type="submit">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script src="../jquery.js"></script>


                <script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }


                    $(document).ready(() => {
                        $('#next').click((e) => {
                            var name = $('#name').val();
                            var phone = $('#phone').val();
                            var pincode = $('#pincode').val();
                            var flat = $('#flat').val();
                            var area = $('#area').val();
                            var landmark = $('#landmark').val();
                            var city = $('#city').val();
                            var state = $('#state').val();
                            var quantity = $('#quantity').val();
                            var email = $('#email').val();

                            if (name == '' || phone == '' || pincode == '' || flat == '' || area == '' || landmark ==
                                '' || city == '' || state == '' || quantity == '' || email == '') {
                                e.preventDefault();
                                $('.popup-msg').removeClass('hidden');
                                setTimeout(() => {
                                    $('.popup-msg').addClass('hidden').fadeOut(2000);
                                }, 3000);
                            }
                        });
                    });
                </script>
            </body>

            </html>

<?php
        } else {
            echo '<h1>Page not found</h1>';
        }
    } else {
        echo '<h1>Page not found</h1>';
    }
} else {
    echo '<h1>Page not found</h1>';
}

?>