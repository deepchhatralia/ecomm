<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquiry</title>

    <!-- Custom styles for this template -->
    <!-- <link href="css/index/style.css" rel="stylesheet" /> -->
    <!-- responsive style -->
    <link href="css/index/responsive.css" rel="stylesheet" />
</head>

<body>
    <?php
    include 'admin/includee/cdn.php';
    include 'database.php';
    $obj = new Database();

    include 'includee/navbar1.php';
    ?>

    <div id="liveAlertPlaceholder"></div>

    <div class="container signup-container my-5">
        <div class="row d-flex align-items-center justify-content-center">
            <h3 class="h3 mb-4 text-center">ENQUIRY</h3>

            <div class="col-md-5">
                <form action="" id="my-form">
                    <div class="mb-3 row">
                        <div class="col-md-6 mb-3">
                            <label for="fname" class="h6">First Name</label>
                            <input type="text" required maxlength="40" id="fname" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lname" class="h6">Last Name</label>
                            <input type="text" required maxlength="50" id="lname" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="contact">Contact</label>
                            <input type="number" required max="9999999999" id="contact" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="enquiry">Leave a message</label>
                            <textarea id="enquiry" cols="30" maxlength="390" rows="5" class="form-control" required></textarea>
                        </div>
                    </div>
                    <button class="d-none" id="reset-form" type="reset">Reset</button>
                    <button type="submit" class="w-100 btn btn-success">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    include 'includee/footer.php';
    ?>

    <script src="js/jquery-3.4.1.min.js"></script>

    <script>
        $(document).ready(() => {
            var alertPlaceholder = document.getElementById('liveAlertPlaceholder')

            function alert(message, type) {
                var wrapper = document.createElement('div')
                wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                alertPlaceholder.append(wrapper)

                setTimeout(() => {
                    $('#liveAlertPlaceholder').html('')
                }, 3000);
            }

            $('#my-form').on('submit', (e) => {
                e.preventDefault()
                const fname = $('#fname').val()
                const lname = $('#lname').val()
                const contact = $('#contact').val()
                const enquiry = $('#enquiry').val()

                if (fname && lname && contact && enquiry) {
                    $.ajax({
                        url: "addEnquiry.php",
                        type: "POST",
                        data: {
                            fname,
                            lname,
                            contact,
                            enquiry
                        },
                        success(data) {
                            if (data) {
                                $('#reset-form').click();
                                alert(data, 'success')
                            } else {
                                alert('Try again...', 'danger')
                            }
                        }
                    })
                }
            })
        })
    </script>
</body>

</html>