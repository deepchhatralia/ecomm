<?php include '../includee/config.php'; ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>

    <!-- Tailwind CSS  -->
    <link rel="stylesheet" href="../css/style.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media screen and (max-width:350px) {
            .login-container {
                margin: 2rem 0.6rem 1.5rem;
            }

            .login-btn-container {
                display: block;
            }

            .login-btn-container .login-btn {
                width: 100%;
            }

            .login-btn-container a {
                display: block;
                margin-top: 0.3rem;
            }
        }
    </style>
</head>

<body>
    <?php include 'includee/cdn.php'; ?>

    <div class="w-full max-w-xs login-container">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Username
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
                <p class="text-red-500 text-xs italic incorrect"></p>
            </div>
            <div class="flex items-center justify-between login-btn-container">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline login-btn" type="button">
                    Login
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                    Forgot Password?
                </a>
            </div>
        </form>
    </div>



    <script src="../js/jquery-3.4.1.min.js"></script>

    <script>
        $(document).ready(() => {
            $('.login-btn').click((e) => {
                let username = $('#username').val();
                let password = $('#password').val();

                if (username === '' || password === '') {
                    if (username === '') {
                        $('#username').attr('placeholder', 'Enter username');
                    }

                    if (password === '') {
                        $('#password').attr('placeholder', 'Enter password');
                    }
                } else {
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
                }
            });
        });
    </script>
</body>

</html>