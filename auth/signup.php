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
        <title>Signup</title>

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

            /* .afterBorder:after {
                content: "";
                display: block;
                width: 3.6em;
                max-width: 70%;
                border-bottom: 0.15em solid #2C3A47;
                margin: 0 auto;
            } */
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


        <div class="container signup-container my-5">
            <div class="row d-flex align-items-center justify-content-center">
                <h3 class="h3 mb-4 text-center afterBorder font-bold">SIGNUP</h3>

                <div class="col-md-5">
                    <form action="" id="my-form">
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="firstname" class="h6">First Name</label>
                                <input type="text" id="firstname" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="lastname" class="h6">Last Name</label>
                                <input type="text" id="lastname" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="h6">Email</label>
                            <input type="email" id="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="contact" class="h6">Contact</label>
                            <input type="number" id="contact" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="h6">Username</label>
                            <input type="text" id="username" class="form-control">
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="password" class="h6">Password</label>
                                <input type="password" id="password" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="cpassword" class="h6">Confirm Password</label>
                                <input type="password" id="cpassword" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-6">
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
                            </div>
                            <div class="col-md-6">
                                <label for="city">City</label>
                                <select class="custom-select d-block w-100 form-select" id="city" required>
                                    <option value="0" selected disabled>Choose...</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="area">Area</label>
                                <select class="custom-select d-block w-100 form-select" id="area" required>
                                    <option value="0" selected disabled>Choose...</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="pincode">Pincode</label>
                                <input type="number" id="pincode" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input type="text" id="address" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="squestion" class="h6">Security Question</label>
                            <select id="squestion" class="form-select">
                                <option disabled selected>----------</option>
                                <option value="What city were you born in?">What city were you born in?</option>
                                <option value="In what city or town did your parents meet?">In what city or town did your parents meet?</option>
                                <option value="What was the make and model of your first car?">What was the make and model of your first car?</option>
                                <option value="What was the first concert you attended?">What was the first concert you attended?</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="sanswer" class="h6">Security Answer</label>
                            <input type="text" id="sanswer" class="form-control">
                        </div>
                        <!-- <div class="mb-3 row">
                            <div class="col-md-6 mb-3">
                                <label for="state" class="h6">State</label>
                                <select id="state" class="form-select">
                                    <option selected disabled value="0">----------</option> -->
                        <?php
                        // $result = $obj->select('*', 'state');
                        // if ($result->num_rows > 0) {
                        //     while ($row = $result->fetch_assoc()) {
                        //         echo '<option value="' . $row['idstate'] . '">' . $row['state_name'] . '</option>';
                        //     }
                        // }
                        ?>
                        <!-- </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="city" class="h6">City</label>
                                <select class="form-select" id="city">
                                    <option selected disabled value="0">----------</option>
                                </select>
                            </div>
                        </div> -->
                        <button type="reset" class="d-none" id="reset">Reset</button>
                        <div class="mt-4 d-flex justify-content-end">
                            <button type="submit" class="w-100 btn btn-primary signupBtn">
                                <h6 class="h6 m-0">Sign up</h6>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
        include '../includee/footer.php';
        ?>

        <script src="../jquery.js"></script>

        <script>
            $(document).ready(() => {
                var alertPlaceholder = document.getElementById('liveAlertPlaceholder')

                function alert(message, type) {
                    var wrapper = document.createElement('div')
                    wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close alert-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                    alertPlaceholder.append(wrapper)
                }

                function callAlert(msg, type) {
                    $('.signupBtn').addClass('disabled')
                    alert(msg, type)
                    setTimeout(() => {
                        $('.signupBtn').removeClass('disabled')
                        $('#liveAlertPlaceholder').html('')
                    }, 10000);
                }

                $('#my-form').on('submit', (e) => {
                    e.preventDefault()
                    const fname = $('#firstname').val();
                    const lname = $('#lastname').val();
                    const email = $('#email').val();
                    const contact = $('#contact').val()
                    const username = $('#username').val();
                    const password = $('#password').val();
                    const cpassword = $('#cpassword').val();
                    const areaId = $('#area').val()
                    const pincode = $('#pincode').val()
                    const address = $('#address').val()
                    const squestion = $('#squestion').val();
                    const sanswer = $('#sanswer').val();

                    if (fname && lname && email && contact && username && password && cpassword && areaId && address && squestion && sanswer) {
                        if (password.length < 8 || password.length > 20) {
                            callAlert('Password must be 8-20 characters long', 'danger')
                        } else if (password !== cpassword) {
                            callAlert('Password does not match', 'danger')
                        } else if (contact.length < 10 || contact.length > 10) {
                            alert('Enter valid contact number', 'danger')
                        } else {
                            $.ajax({
                                url: "loginSignup.php",
                                type: "POST",
                                data: {
                                    fname,
                                    lname,
                                    email,
                                    contact,
                                    username,
                                    password,
                                    areaId,
                                    pincode,
                                    address,
                                    squestion,
                                    sanswer,
                                    operation: "signup"
                                },
                                beforeSend: function() {
                                    $('.signupBtn').addClass('disabled')
                                },
                                success: function(data) {
                                    if (data == 'success') {
                                        $('#reset').click()

                                        $('.signupBtn').removeClass('disabled')
                                        $('#liveAlertPlaceholder').html('')
                                        window.location.href = 'login.php';
                                    } else {
                                        callAlert(data, 'danger')
                                    }
                                }
                            });
                        }
                    } else {
                        callAlert('Please fill all details', 'danger')
                    }
                });

                $('#state').on('change', () => {
                    const stateId = $('#state').val();
                    $('#area').html('<option value="0" selected disabled>Choose...</option>');

                    $.ajax({
                        url: "../cart/getCityArea.php",
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
                        url: "../cart/getCityArea.php",
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
            });
        </script>
    </body>

    </html>

<?php
} else {
    include '../pagenotfound.php';
}
?>