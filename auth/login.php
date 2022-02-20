<?php
session_start();

if (!isset($_SESSION['userlogin'])) {
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

            #liveAlertPlaceholder {
                position: sticky;
                top: 0;
                left: 0;
                right: 0;
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

        <!-- Nucleo Icons -->
        <!-- <link href="../material/assets/css/nucleo-icons.css" rel="stylesheet" /> -->
        <!-- <link href="../material/assets/css/nucleo-svg.css" rel="stylesheet" /> -->
        <!-- Font Awesome Icons -->
        <!-- <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> -->
        <!-- Material Icons -->
        <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet"> -->

        <!-- <style>
            .header_top {
                padding: 0 !important;
            }

            .header_bottom {
                padding: 0 !important;
            }
        </style> -->
    </head>

    <body>
        <?php
        include '../admin/includee/cdn.php';
        include '../database.php';
        $obj = new Database();

        include '../includee/navbar1.php';
        ?>

        <div id="liveAlertPlaceholder"></div>

        <div class="container login-container my-5">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-md-4">
                    <h2 class="h2 mb-3 text-center font-bold">LOGIN</h2>
                    <div class="mb-3">
                        <h6 class="h6">Username</h6>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="mb-3">
                        <h6 class="h6">Password</h6>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-primary loginBtn w-100" name="loginBtn">
                            <h6 class="h6 m-0">Login</h6>
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <!-- <main class="main-content">
            <div class="page-header align-items-start min-vh-100" style="background-color: #FFFFFF;">
                <span class="mask opacity-6"></span>
                <div class="container my-auto">
                    <div class="row">
                        <div class="col-lg-4 col-md-8 col-12 mx-auto">
                            <div class="card z-index-0 fadeIn3 fadeInBottom">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                    <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                        <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign in</h4>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <form role="form" class="text-start">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control">
                                        </div>
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control">
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn bg-gradient-primary w-100 my-4 mb-2">Sign in</button>
                                        </div>
                                        <p class="mt-4 text-sm text-center">
                                            Don't have an account?
                                            <a href="http://localhost/ecomm/auth/signup.php" class="text-primary text-gradient font-weight-bold">Sign up</a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main> -->

        <?php
        include '../includee/footer.php';
        ?>



        <!-- Jquery  -->
        <script src="../jquery.js"></script>

        <!-- <script src="../material/assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="../material/assets/js/plugins/smooth-scrollbar.min.js"></script> -->

        <!-- <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script> -->

        <!-- <script src="../material/assets/js/material-dashboard.min.js?v=3.0.0"></script> -->


        <script>
            $(document).ready(() => {
                var alertPlaceholder = document.getElementById('liveAlertPlaceholder')

                function alert(message, type) {
                    var wrapper = document.createElement('div')
                    wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close alert-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                    alertPlaceholder.append(wrapper)
                }

                function callAlert(msg, type) {
                    $('.loginBtn').addClass('disabled')
                    alert(msg, type)
                    setTimeout(() => {
                        $('.loginBtn').removeClass('disabled')
                        $('#liveAlertPlaceholder').html('')
                    }, 3000);
                }

                $('.loginBtn').click(() => {
                    var username = $('#username').val();
                    var password = $('#password').val();

                    if (username && password) {
                        if (password.length < 8 && password !== "deep") {
                            callAlert('Incorrect username or password', 'danger')
                        } else {
                            $.ajax({
                                url: "loginSignup.php",
                                type: "POST",
                                data: {
                                    username,
                                    password,
                                    operation: "login"
                                },
                                beforeSend: function() {
                                    $('.loginBtn').addClass('disabled')
                                },
                                success: function(data) {
                                    if (data == "Successfull") {
                                        $('.loginBtn').removeClass('disabled')
                                        window.location.href = 'http://localhost/ecomm/';
                                    } else {
                                        callAlert('Incorrect username or password', 'danger')
                                    }
                                }
                            });
                        }
                    } else {
                        callAlert('Please fill all details', 'danger')
                    }
                });
            });
        </script>
    </body>

    </html>
<?php
} else {
    include '../pagenotfound.php';
}
?>