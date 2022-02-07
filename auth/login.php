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

        <link rel="stylesheet" href="../css/index/style.css">
        <link rel="stylesheet" href="../css/index/responsive.css">
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
                    <h2 class="h2 mb-3 text-center">LOGIN</h2>
                    <div class="mb-3">
                        <div>
                            <h6 class="h6">Username</h6>
                        </div>
                        <div>
                            <input type="text" class="form-control" name="username" id="username">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div>
                            <h6 class="h6">Password</h6>
                        </div>
                        <div>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div style="width: 100%;">
                            <button class="btn btn-primary loginBtn" name="loginBtn">
                                <h6 class="h6 m-0">Login</h6>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php
        include '../includee/footer.php';
        ?>



        <!-- Jquery  -->
        <script src="../jquery.js"></script>

        <script>
            $(document).ready(() => {
                var alertPlaceholder = document.getElementById('liveAlertPlaceholder')

                function alert(message, type) {
                    var wrapper = document.createElement('div')
                    wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close alert-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                    alertPlaceholder.append(wrapper)
                }

                $('.loginBtn').click(() => {
                    var username = $('#username').val();
                    var password = $('#password').val();

                    if (username && password) {
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
                                    alert('Incorrect username or password', 'danger')

                                    setTimeout(() => {
                                        $('#liveAlertPlaceholder').html('')
                                        $('.loginBtn').removeClass('disabled')
                                    }, 3000);
                                }
                            }
                        });
                    } else {
                        alert('Please fill all details', 'error')

                        setTimeout(() => {
                            $('#liveAlertPlaceholder').html('')
                        }, 3000);
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