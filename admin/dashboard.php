<?php

session_start();

if (isset($_SESSION['admin_loggedin'])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>

        <!-- Bootstrap  -->
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

        <!-- Dashboard CSS  -->
        <link rel="stylesheet" href="dashboard.css">

        <!-- Google fonts  -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    </head>

    <body>
        <?php
        include 'includee/cdn.php';
        include 'includee/navbar.php';
        include 'includee/sidebar.php';

        include '../database.php';
        $obj = new Database();

        $quantity = 0;
        $productPrice = 0;
        $revenue = 0;
        $totalItems = 0;
        $totalDeliveredOrders = 0;
        $totalPendingOrders = 0;

        $result = $obj->select('COUNT(*)', 'productt');
        $row = $result->fetch_assoc();
        $totalItems = $row['COUNT(*)'];

        $result = $obj->select('COUNT(*)', 'order');
        $row = $result->fetch_assoc();
        $totalOrders = $row['COUNT(*)'];

        $result = $obj->select('COUNT(*)', 'order', "status='Ordered'");

        if ($result) {
            $row = $result->fetch_assoc();
            $totalPendingOrders = $row['COUNT(*)'];
        }

        $result = $obj->select('COUNT(*)', 'order', "status='Delivered'");
        if ($result) {
            $row = $result->fetch_assoc();
            $totalDeliveredOrders = $row['COUNT(*)'];
        }

        $result = $obj->select('*', 'order', "status='Delivered'");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $quantity = $row['quantity'];
                $productId = $row['product_id'];

                $result2 = $obj->select('*', 'productt', "product_id='{$productId}'");
                $row2 = $result2->fetch_assoc();
                $productPrice = $row2['product_price'];

                $revenue += ($productPrice * $quantity);
            }
        }
        ?>


        <div class="container-fluid fluid-two my-4">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-between">
                    <h3>Welcome, Deep Chhatralia</h3>
                </div>
            </div>

            <div class="row my-4 grid-containers">
                <div class="col-md-12 flex-container main-flex">
                    <div class="d-flex mx-2 mb-1 grid-item1 grid-item flex">
                        <h2>Total Revenue</h2>
                        <h1><?php echo 'Rs ' . $revenue; ?></h1>
                    </div>

                    <div class="flex-container flex-column flex">
                        <div class="flex-container one">
                            <div class="flex-container mx-2 mb-1 grid-item2 grid-item">
                                <h4>Total Items</h4>
                                <h4><?php echo $totalItems; ?></h4>
                            </div>
                            <div class="flex-container mx-2 mb-1 grid-item3 grid-item">
                                <h4>Orders</h4>
                                <h4><?php echo $totalOrders; ?></h4>
                            </div>
                        </div>
                        <div class="flex-container two">
                            <div class="flex-container mx-2 mb-1 grid-item4 grid-item">
                                <h4>Pending Orders</h4>
                                <h4><?php echo $totalPendingOrders; ?></h4>
                            </div>
                            <div class="flex-container mx-2 mb-1 grid-item5 grid-item">
                                <h4>Delivered</h4>
                                <h4><?php echo $totalDeliveredOrders; ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-md-12">
                    <div class="flex-container">
                        <div class="purchase-grid mb-1 grid-item">
                            <h4>Purchase</h4>
                            <h4>Rs 10000</h4>
                        </div>

                        <div class="orders-grid mb-1 grid-item">
                            <h4>Orders</h4>
                            <h4>Rs 20000</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <!-- Bootstrap JS  -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>

    </html>

<?php

} else {
    include '../pagenotfound.php';
}

?>