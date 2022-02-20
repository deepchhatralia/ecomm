<?php
session_start();

if (isset($_SESSION['admin_loggedin'])) {
    header("location: http://localhost/ecomm/admin/dashboard.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>

    <!-- Tailwind CSS  -->
    <!-- <link rel="stylesheet" href="../css/style.css"> -->

    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

    <link id="pagestyle" href="../material/assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>

<body>
    <?php include 'includee/cdn.php'; ?>

    <main class="main-content my-5">
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
                                        <label class="form-label">Username</label>
                                        <input id="username" type="email" class="form-control">
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Password</label>
                                        <input id="password" type="password" class="form-control">
                                    </div>
                                    <small class="font-italic text-danger incorrect"></small>
                                    <div class="text-center">
                                        <button id="login-btn" type="button" class="btn bg-gradient-primary w-100 my-4 mb-2">Sign in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script src="../material/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../material/assets/js/plugins/smooth-scrollbar.min.js"></script>

    <script src="../material/assets/js/material-dashboard.min.js?v=3.0.0"></script>


    <script src="../js/jquery-3.4.1.min.js"></script>

    <script>
        $(document).ready(() => {
            $('#login-btn').click((e) => {
                let username = $('#username').val();
                let password = $('#password').val();

                if (username && password) {
                    $.ajax({
                        url: "ajax/adminLoginAjax.php",
                        type: "POST",
                        data: {
                            username,
                            password
                        },
                        success(data) {
                            if (data === 'Successfull loggedin') {
                                $('.incorrect').html('');
                                window.location.href = 'http://localhost/ecomm/admin/dashboard.php';
                            } else {
                                $('.incorrect').html(data);
                            }
                        }
                    });
                } else {
                    $('.incorrect').html('Please fill all details');
                }
            });
        });
    </script>
</body>

</html>