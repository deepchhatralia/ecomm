<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase</title>

    <style>
        #liveAlertPlaceholder {
            position: sticky;
            top: 0;
            left: 0;
            right: 0;
        }
    </style>
</head>

<body>
    <?php
    include '../includee/cdn.php';
    include '../includee/navbar.php';
    include '../includee/sidebar.php';
    include '../../database.php';
    include '../notification.php';

    $obj = new Database();
    ?>

    <div id="liveAlertPlaceholder"></div>


    <div class="container my-5">

    </div>




    <script src="../../js/jquery-3.4.1.min.js"></script>

    <script>
        document.querySelector('.fa-tachometer-alt').parentNode.parentNode.classList.remove('active')
        document.querySelector('.purchaseSidebarIcon').parentNode.parentNode.classList.add('active')

        $(document).ready(function() {

        })
    </script>
</body>

</html>