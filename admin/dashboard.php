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

        <!-- Dashboard CSS  -->
        <link rel="stylesheet" href="dashboard.css">
    </head>

    <body>
        <?php
        include 'includee/cdn.php';
        include 'includee/navbar.php';
        include 'includee/sidebar.php';

        include '../database.php';
        $obj = new Database();

        $sales = 0;
        $purchase = 0;

        $totalItems = 0;
        $totalDeliveredOrders = 0;
        $totalPendingOrders = 0;

        $result = $obj->select('COUNT(*)', 'productt');
        $row = $result->fetch_assoc();
        $totalItems = $row['COUNT(*)'];

        $result = $obj->select('COUNT(*)', 'order', "isCancel=0");
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

        $result = $obj->select('SUM(total)', 'order', "isCancel=0");
        if ($result->num_rows > 0) {
            $result = $result->fetch_assoc();
            $sales = $result['SUM(total)'];
        }

        $result = $obj->select('SUM(total)', 'purchasee', "isCancel=0");
        if ($result->num_rows > 0) {
            $result = $result->fetch_assoc();
            $purchase = $result['SUM(total)'];
        }
        ?>


        <div class="container-fluid fluid-two my-4">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-between">
                    <h2 class="h2 m-0">Welcome, Deep Chhatralia</h2>
                </div>
            </div>

            <div class="row my-4 grid-containers">
                <div class="col-md-12 flex-container main-flex">
                    <div class="d-flex mx-2 mb-1 grid-item1 grid-item flex">
                        <h2>Total Profit</h2>
                        <h1><?php echo 'Rs ' . $sales - $purchase; ?></h1>
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
                        <div class="orders-grid mb-1 grid-item">
                            <h4>Sales</h4>
                            <h4>Rs <?php echo $sales; ?></h4>
                        </div>

                        <div class="purchase-grid mb-1 grid-item">
                            <h4>Purchase</h4>
                            <h4>Rs <?php echo $purchase; ?></h4>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="my-5">
            <div class="d-flex align-items-center justify-content-evenly">
                <div class="chart-container" style="position: relative; height:50vh; width:40vw">
                    <canvas id="Sales"></canvas>
                </div>

                <div class="chart-container" style="position: relative; height:50vh; width:40vw">
                    <canvas id="Purchase"></canvas>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-evenly">
                <div class="chart-container" style="position: relative; height:50vh; width:40vw">
                    <canvas id="numberOfOrders"></canvas>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-evenly flex-column my-1">
            <h3>Top 5 Selling Products</h3>
            <div class="chart-container" style="position: relative; height:50vh; width:40vw">
                <canvas id="topSelling"></canvas>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

        <script src="../js/jquery-3.4.1.min.js"></script>


        <script>
            $(document).ready(() => {
                function drawGraph(canvasId, x, y, graphType, graphLabel, graphBorderColor) {
                    let myData = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]

                    for (let i = 0; i < x.length; i++) {
                        const temp = parseInt(x[i])
                        myData[temp - 1] = parseInt(y[i])
                    }

                    const myChart = new Chart(document.getElementById(canvasId), {
                        type: graphType,
                        data: {
                            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                            datasets: [{
                                label: graphLabel,
                                data: [...myData],
                                borderWidth: 1,
                                borderColor: graphBorderColor
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }

                function loadConstants() {
                    const arr = ['Sales', 'Purchase']

                    $.ajax({
                        url: "getChartData.php",
                        type: "POST",
                        data: {
                            operation: "topSellingProduct"
                        },
                        success(dataa) {
                            const x = JSON.parse(dataa)

                            // Chart declaration:
                            var myBarChart = new Chart(document.getElementById("topSelling"), {
                                type: 'pie',
                                data: {
                                    labels: Object.keys(x),
                                    datasets: [{
                                        fill: true,
                                        backgroundColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(54, 162, 235)',
                                            'rgb(255, 205, 86)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(255, 55, 130)'
                                        ],
                                        data: Object.values(x),
                                        borderWidth: [2, 2],
                                        hoverOffset: 4
                                    }]
                                },
                                options: {
                                    title: {
                                        display: true,
                                        text: 'Top 5 Selling Products',
                                        position: 'top'
                                    }
                                }
                            });
                        }
                    })

                    $.ajax({
                        url: "getChartData.php",
                        type: "POST",
                        data: {
                            operation: "getOrderMonth"
                        },
                        success(dataa) {
                            const x = JSON.parse(dataa)

                            $.ajax({
                                url: "getChartData.php",
                                type: "POST",
                                data: {
                                    operation: "getNumberOfOrders"
                                },
                                success(dataa) {
                                    const y = JSON.parse(dataa)
                                    drawGraph("numberOfOrders", x, y, "line", "Number of Orders", "rgba(255, 99, 132, 1)")
                                }
                            })
                        }
                    })

                    for (let i = 0; i < arr.length; i++) {
                        let hello = "total " + arr[i] + " get month"

                        $.ajax({
                            url: "getChartData.php",
                            type: "POST",
                            data: {
                                what: arr[i].toLocaleLowerCase(),
                                operation: hello
                            },
                            success(dataa) {
                                const x = JSON.parse(dataa)

                                hello = "total " + arr[i]

                                $.ajax({
                                    url: "getChartData.php",
                                    type: "POST",
                                    data: {
                                        what: arr[i].toLocaleLowerCase(),
                                        operation: hello
                                    },
                                    success(dataa) {
                                        const y = JSON.parse(dataa)

                                        drawGraph(arr[i], x, y, "bar", arr[i], "rgba(153, 102, 255, 1)")
                                    }
                                })
                            }
                        })
                    }
                }

                loadConstants()


            })
        </script>


        <!-- Bootstrap JS  -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>

    </html>

<?php

} else {
    include '../pagenotfound.php';
}

?>