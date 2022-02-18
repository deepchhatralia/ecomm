<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Product</title>

    <link rel="stylesheet" href="../css/style.css">

    <style>
        body {
            background-color: #F6F6F7 !important;
        }

        .con {
            background-color: #fff;
            border-radius: 3px;
            box-shadow: 1px 1px 3px 1px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 400ms;
        }

        .con:hover {
            /* transform: scale(1.03,1.05); */
            margin: -0.3px;
            font-weight: 600;
            font-size: 18px;
        }

        @media screen and (max-width:767px) {
            .row {
                margin-bottom: 0;
            }

            .col-md-6,
            .col-md-4 {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>

<body>

    <?php
    include '../includee/cdn.php';
    include '../includee/navbar.php';
    include '../includee/sidebar.php';

    include '../../database.php';
    $obj = new Database();
    ?>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-4 px-2 mb-4">
                <div class="p-3 con category">Category</div>
            </div>
            <div class="col-md-4 px-2 mb-4">
                <div class="p-3 con image">Image's</div>
            </div>
            <div class="col-md-4 px-2 mb-4">
                <div class="p-3 con offer">Offer</div>
            </div>
            <div class="col-md-4 px-2 mb-4">
                <div class="p-3 con product">Products</div>
            </div>
        </div>
    </div>

    <script src="../../js/jquery-3.4.1.min.js"></script>

    <script>
        document.querySelector('.fa-tachometer-alt').parentNode.parentNode.classList.remove('active')
        document.querySelector('.fa-plus-square').parentNode.parentNode.classList.add('active')

        $(document).ready(() => {
            $('.product').click(() => {
                window.location.href = "http://localhost/ecomm/admin/product/product.php"
            })

            $('.category').click(() => {
                window.location.href = "http://localhost/ecomm/admin/product/category.php"
            })

            $('.offer').click(() => {
                window.location.href = "http://localhost/ecomm/admin/product/offer.php"
            })

            $('.image').click(() => {
                window.location.href = "http://localhost/ecomm/admin/product/image.php"
            })
        })
    </script>
</body>

</html>