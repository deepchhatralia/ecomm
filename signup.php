<?php

include 'includee/config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>

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

        @media screen and (max-width:270px) {
            .signupBtn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="popup-msg hidden">
        <p>Please fill all details</p>
    </div>

    <?php include 'includee/navbar.php'; ?>


    <div class="container signup-container my-5">
        <div class="row">
            <div class="col-md-5">
                <div class="mb-3">
                    <div>
                        <h6><span>Full Name</span></h6>
                    </div>
                    <div><input type="text" name="fullname" id="fullname"></div>
                </div>
                <div class="mb-3">
                    <div>
                        <h6><span>Email</span></h6>
                    </div>
                    <div><input type="email" name="email" id="email"></div>
                </div>
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
                    <div>
                        <h6><span>Confirm password</span></h6>
                    </div>
                    <div><input type="password" name="cpassword" id="cpassword"></div>
                </div>
                <div class="mb-3">
                    <div>
                        <button class="btn btn-primary signupBtn">Sign up</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="jquery.js"></script>

    <script>
        $(document).ready(() => {
            $('.signupBtn').click((e) => {
                var name = $('#fullname').val();
                var email = $('#email').val();
                var username = $('#username').val();
                var password = $('#password').val();
                var cpassword = $('#cpassword').val();

                if (name == '' || email == '' || username == '' || password == '' || cpassword == '') {
                    $('.popup-msg').removeClass('hidden');
                    setTimeout(() => {
                        $('.popup-msg').addClass('hidden');
                    }, 2000);
                } else {
                    if (password.length < 8) {
                        $('.popup-msg p').html('Password must be minimum 8 characters long');
                        $('.popup-msg').removeClass('hidden');
                        setTimeout(() => {
                            $('.popup-msg').addClass('hidden');
                        }, 2000);
                    } else {
                        if (password !== cpassword) {
                            $('.popup-msg p').html('Password does not match ');
                            $('.popup-msg').removeClass('hidden');
                            setTimeout(() => {
                                $('.popup-msg').addClass('hidden');
                            }, 2500);
                        } else {
                            $.ajax({
                                url: "signupAjax.php",
                                type: "POST",
                                data: {
                                    name,
                                    email,
                                    username,
                                    password
                                },
                                beforeSend: function() {
                                    $('.signupBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>')
                                    $('.signupBtn').css('opacity', 0.5)
                                },
                                success: function(data) {
                                    $('.signupBtn').html('Login')
                                    $('.signupBtn').css('opacity', 1)
                                    if (data == 'Signed up') {
                                        $('#fullname').val('');
                                        $('#email').val('');
                                        $('#username').val('');
                                        $('#password').val('');
                                        $('#cpassword').val('');
                                        window.location.href = 'login.php';
                                    }

                                    $('.popup-msg p').html(data);
                                    $('.popup-msg').removeClass('hidden');

                                    setTimeout(() => {
                                        $('.popup-msg').addClass('hidden');
                                    }, 2500);
                                }
                            });
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>