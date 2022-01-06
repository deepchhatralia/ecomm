<?php

include 'includee/config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Navbar Css -->
    <link rel="stylesheet" href="style.css">

    <style>
        input {
            width: 100%;
            border-radius: 4px;
            border: 1px solid #d0d0d0;
            box-shadow: 0 1px 0 rgb(255 255 255 / 50%), 0 1px 0 rgb(0 0 0 / 7%) inset;
            padding: 3px 7px;
            outline: none;
            border-top: 1px solid #bbb;
        }

        .popup-msg {
            position: fixed;
            top: 5rem;
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

        @media screen and (max-width:560px) {
            .col-md-5 {
                margin: 1rem auto;
            }
        }

        @media screen and (max-width:270px) {
            .loginBtn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="popup-msg hidden">
        <p></p>
    </div>

    <?php include 'includee/navbar.php'; ?>

    <div class="container login-container my-5">
        <div class="row">
            <div class="col-md-5">
                <div class="mb-3">
                    <div>
                        <h6><span>Username</span></h6>
                    </div>
                    <div><input type="text" name="username" id="username"></div>
                </div>
                <div class="mb-3">
                    <div>
                        <h6><span>Password</span></h6>
                    </div>
                    <div><input type="password" name="password" id="password"></div>
                </div>
                <div class="mb-3">
                    <div style="width: 100%;">
                        <button class="btn btn-primary loginBtn">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery  -->
    <script src="jquery.js"></script>

    <script>
        $(document).ready(() => {
            $('.loginBtn').click(() => {
                var username = $('#username').val();
                var password = $('#password').val();

                if (username == '' || password == '') {
                    $('.popup-msg p').html('Please fill all details');
                    $('.popup-msg').removeClass('hidden');
                    setTimeout(() => {
                        $('.popup-msg').addClass('hidden');
                    }, 2000);
                } else {
                    $.ajax({
                        url: "product/userLoginAjax.php",
                        type: "POST",
                        data: {
                            username,
                            password
                        },
                        beforeSend: function() {
                            $('.loginBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>')
                            $('.loginBtn').css('opacity', 0.5)
                        },
                        success: function(data) {
                            $('.loginBtn').html('Login')
                            $('.loginBtn').css('opacity', 1)
                            if (data == "Successfull Login") {
                                window.location.href = 'http://localhost/ecomm/';
                            } else {
                                $('.popup-msg p').html(data);
                                $('.popup-msg').removeClass('hidden');
                                setTimeout(() => {
                                    $('.popup-msg').addClass('hidden');
                                }, 2000);
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>