<?php
session_start();

if (!isset($_SESSION['userlogin'])) {
    include '../pagenotfound.php';
} else {
    if (isset($_POST['checkout-btn'])) {
?>
        <!doctype html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">
            <link rel="icon" href="../../../../favicon.ico">

            <title>Checkout</title>

            <link rel="stylesheet" href="../css/index/responsive.css">

            <style>
                .container1 {
                    max-width: 960px !important;
                }

                .border-top {
                    border-top: 1px solid #e5e5e5;
                }

                .border-bottom {
                    border-bottom: 1px solid #e5e5e5;
                }

                .border-top-gray {
                    border-top-color: #adb5bd;
                }

                .box-shadow {
                    box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05);
                }

                .lh-condensed {
                    line-height: 1.25;
                }

                .checkmark__circle {
                    stroke-dasharray: 166;
                    stroke-dashoffset: 166;
                    stroke-width: 2;
                    stroke-miterlimit: 10;
                    stroke: #7ac142;
                    fill: none;
                    animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
                }

                .checkmark {
                    width: 60px;
                    height: 60px;
                    border-radius: 50%;
                    display: block;
                    stroke-width: 2;
                    stroke: #fff;
                    stroke-miterlimit: 10;
                    margin: 5% auto;
                    box-shadow: inset 0px 0px 0px #7ac142;
                    animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
                }

                .checkmark__check {
                    transform-origin: 50% 50%;
                    stroke-dasharray: 48;
                    stroke-dashoffset: 48;
                    animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
                }

                @keyframes stroke {
                    100% {
                        stroke-dashoffset: 0;
                    }
                }

                @keyframes scale {

                    0%,
                    100% {
                        transform: none;
                    }

                    50% {
                        transform: scale3d(1.1, 1.1, 1);
                    }
                }

                @keyframes fill {
                    100% {
                        box-shadow: inset 0px 0px 0px 30px #7ac142;
                    }
                }
            </style>
        </head>

        <body class="bg-light">
            <?php
            include '../admin/includee/cdn.php';
            include '../includee/navbar1.php';

            include '../database.php';
            $obj = new Database();
            ?>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="orderDone">
                modal
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                            </svg>
                            <h4 class="h4 text-center">Ordered</h4>
                            <div class="text-center">
                                <small class="text-muted">Redirecting you in <span id="seconds">5</span> seconds...</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container container1 my-5">
                <div class="row">
                    <div class="col-md-4 order-md-2 mb-4">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="h4 font-bold">Your Cart</span>
                            <span class="badge badge-secondary badge-pill">3</span>
                        </h4>
                        <ul class="list-group mb-3">
                            <?php
                            $sql = "SELECT * FROM `productt` JOIN `cart` ON `productt`.`product_id` = `cart`.`product_product_id` WHERE `userlogin_userid`=" . $_SESSION['userlogin'];
                            $result = $obj->sql($sql);

                            if ($result->num_rows > 0) {
                                $total = 0;
                                while ($row = $result->fetch_assoc()) {
                                    $price = $row['product_price'];
                                    $offerId = $row['offer_idoffer'];
                                    if ($offerId != 0) {
                                        $resultt = $obj->select('*', 'offer', "idoffer=" . $offerId);
                                        $roww = $resultt->fetch_assoc();

                                        $price = round($row['product_price'] - ($row['product_price'] * $roww['offer_discount'] / 100));
                                    }
                                    $total += $price * $row['cart_quantity'];
                            ?>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0"><?php echo $row['product_name']; ?></h6>
                                            <small class="text-muted">Qty : <?php echo $row['cart_quantity']; ?></small><br>
                                            <small class="text-muted">Price : <?php echo $price; ?></small>
                                        </div>
                                        <span class="text-muted">₹<?php echo $price * $row['cart_quantity']; ?></span>
                                    </li>
                            <?php
                                }
                                echo '<li class="list-group-item d-flex justify-content-between">
                                <span>Total (INR)</span>
                                <strong>₹<span id="total">' . $total . '</span></strong>
                            </li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="col-md-8 order-md-1">
                        <h4 class="mb-3 h4 font-bold">Shipping Address</h4>
                        <div class="mb-2">
                            <input type="checkbox" class="notChecked" id="same-address" /> Same as specified during signup
                        </div>
                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">First name</label>
                                    <input type="text" class="form-control" id="fname" placeholder="" value="" required>
                                    <div class="invalid-feedback">
                                        Valid first name is required.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Last name</label>
                                    <input type="text" class="form-control" id="lname" placeholder="" value="" required>
                                    <div class="invalid-feedback">
                                        Valid last name is required.
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email">Email </label>
                                <input type="email" required class="form-control" id="email" placeholder="you@example.com">
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="..." required>
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <label for="state">State</label>
                                    <select class="custom-select d-block w-100 form-select" id="state" required>
                                        <option value="0" selected disabled>Choose...</option>
                                        <?php
                                        $result = $obj->select('*', 'state');
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option value="' . $row['idstate'] . '">' . $row['state_name'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid country.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="city">City</label>
                                    <select class="custom-select d-block w-100 form-select" id="city" required>
                                        <option value="0" selected disabled>Choose...</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please provide a valid state.
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="zip">Zip</label>
                                    <input type="text" class="form-control" id="zip" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Zip code required.
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="area">Area</label>
                                    <select class="custom-select d-block w-100 form-select" id="area" required>
                                        <option value="0" selected disabled>Choose...</option>
                                    </select>
                                </div>
                            </div>
                            <hr class="mb-4">

                            <h4 class="mb-3">Payment</h4>

                            <div class="d-block my-3">
                                <!-- <form id="payment-form"> -->
                                <!-- <div class="custom-control custom-radio">
                                    <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                                    <label class="custom-control-label" for="debit">Debit card</label>
                                </div> -->
                                <div class="custom-control custom-radio">
                                    <input checked disabled id="cod" name="paymentMethod" type="radio" class="custom-control-input">
                                    <label class="custom-control-label" for="cod">Cash on Delivery</label>
                                </div>
                                <!-- </form> -->
                            </div>
                            <hr class="mb-4">
                            <button id="placeOrderBtn" class="btn btn-primary btn-lg btn-block w-100" type="submit">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>

            <?php
            include '../includee/footer.php';
            ?>

            <script src="../js/jquery-3.4.1.min.js"></script>
            <script src="../js/bootstrap.js"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

            <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
            <script>
                window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')
            </script>
            <script src="C:\Users\lenovo\Desktop\webpage\bootstrap-4.0.0\assets\js\vendor\popper.min.js"></script>
            <script src="../../../../dist/js/bootstrap.min.js"></script>
            <script src="C:\Users\lenovo\Desktop\webpage\bootstrap-4.0.0\assets\js\vendor\holder.min.js"></script>
            <script>
                (function() {
                    'use strict';

                    window.addEventListener('load', function() {
                        // Fetch all the forms we want to apply custom Bootstrap validation styles to
                        var forms = document.getElementsByClassName('needs-validation');

                        // Loop over them and prevent submission
                        var validation = Array.prototype.filter.call(forms, function(form) {
                            form.addEventListener('submit', function(event) {
                                if (form.checkValidity() === false) {
                                    event.preventDefault();
                                    event.stopPropagation();
                                }
                                form.classList.add('was-validated');
                            }, false);
                        });
                    }, false);
                })();

                $(document).ready(() => {
                    $('#same-address').on('change', () => {
                        if ($('#same-address').hasClass('notChecked')) {
                            $('#same-address').addClass('checkedd');
                            $('#same-address').removeClass('notChecked');

                            $.post({
                                url: "getData.php",
                                data: {
                                    operation: "user details for order"
                                },
                                success(data) {
                                    const x = JSON.parse(data);

                                    $('#fname').val(x[0]);
                                    $('#lname').val(x[1]);
                                    $('#email').val(x[2]);
                                    $('#address').val(x[3]);
                                    $('#zip').val(x[4]);
                                    $('#area').html('<option value="' + x[5] + '" selected>' + x[8] + '</option>')
                                    $('#city').html('<option value="' + x[6] + '" selected>' + x[9] + '</option>')
                                    $('#state').val(x[7]);
                                }
                            })
                        } else {
                            $('#same-address').removeClass('checkedd');
                            $('#same-address').addClass('notChecked');

                            $('#fname').val('');
                            $('#lname').val('');
                            $('#email').val('');
                            $('#address').val('');
                            $('#zip').val('');
                            $('#area').html('<option value="0" selected disabled>Choose...</option>')
                            $('#city').html('<option value="0" selected disabled>Choose...</option>')
                            $('#state').val(0);
                        }
                    })

                    $('.needs-validation').on('submit', (e) => {
                        e.preventDefault();
                        const fname = $('#fname').val();
                        const lname = $('#lname').val();
                        const email = $('#email').val();
                        const address = $('#address').val();
                        const areaId = $('#area').val();
                        const pincode = $('#zip').val();
                        const total = $('#total').html();
                        var timer = 5;

                        if (fname && lname && email && address && areaId && pincode) {
                            $.post({
                                url: "checkedOut.php",
                                data: {
                                    fname,
                                    lname,
                                    email,
                                    address,
                                    areaId,
                                    pincode,
                                    total,
                                    operation: "payment done"
                                },
                                beforeSend() {
                                    $('#placeOrderBtn').addClass('disabled')
                                },
                                success(data) {
                                    if (data == "Please login") {
                                        window.location.href = "http://localhost/ecomm";
                                    }
                                    if (data == "Done") {
                                        $('#orderDone').click();
                                        $('#seconds').html(timer);

                                        setInterval(() => {
                                            if (timer >= 0) {
                                                $('#seconds').html(timer);
                                                timer -= 1;
                                            }
                                        }, 1000);

                                        setTimeout(() => {
                                            $('#placeOrderBtn').removeClass('disabled');
                                            window.location.href = "http://localhost/ecomm/orders/";
                                        }, 5000);
                                    }
                                }
                            })
                        }
                    })

                    $('#state').on('change', () => {
                        const stateId = $('#state').val();
                        $('#area').html('<option value="0" selected disabled>Choose...</option>');

                        $.ajax({
                            url: "getCityArea.php",
                            type: "POST",
                            data: {
                                stateId,
                                operation: "get city"
                            },
                            success(data) {
                                $('#city').html(data);
                            }
                        });
                    })

                    $('#city').on('change', () => {
                        const cityId = $('#city').val();

                        $.ajax({
                            url: "getCityArea.php",
                            type: "POST",
                            data: {
                                cityId,
                                operation: "get area"
                            },
                            success(data) {
                                $('#area').html(data);
                            }
                        });
                    })
                })
            </script>
        </body>

        </html>

<?php
    } else {
        include '../pagenotfound.php';
    }
}
?>