<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css" />

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
        <div class="row">
            <div class="col-md-3 my-3">
                <button class="btn btn-primary report-btn" id="salesreport">Sales Report</button>
            </div>
            <div class="col-md-3 my-3">
                <button class="btn btn-primary report-btn" id="purchasereport">Purchase Report</button>
            </div>
            <div class="col-md-3 my-3">
                <button class="btn btn-primary report-btn" id="topproducts">Top Selling Products</button>
            </div>
            <div class="col-md-3 my-3">
                <button class="btn btn-primary report-btn" id="salesbystate">State Wise Sales</button>
            </div>
            <div class="col-md-3 my-3">
                <button class="btn btn-primary report-btn" id="salesbystate">State Wise Sales</button>
            </div>
            <div class="col-md-3 my-3">

            </div>
        </div>
    </div>




    <script src="../../js/jquery-3.4.1.min.js"></script>


    <script>
        document.querySelector('.fa-tachometer-alt').parentNode.parentNode.classList.remove('active')
        document.querySelector('.reportSidebarIcon').parentNode.parentNode.classList.add('active')


        $(document).ready(function() {
            // $('#myTable').DataTable();
            var alertPlaceholder = document.getElementById('liveAlertPlaceholder')

            function alert(message, type) {
                $('.generate').addClass('disabled');

                var wrapper = document.createElement('div')
                wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close alert-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                alertPlaceholder.append(wrapper)

                setTimeout(() => {
                    $('#liveAlertPlaceholder').html('');
                    $('.generate').removeClass('disabled');
                }, 2000);
            }

            // function generateReport(op, yr, mon) {
            //     $.post({
            //         url: "generateReport.php",
            //         data: {
            //             operation: op,
            //             yr,
            //             mon
            //         },
            //         success(data) {
            //             // const x = JSON.parse(data)

            //             // $('#thead').html(x[0]);
            //             $('#myTable').removeClass('d-none');
            //             $('#tbody').html(data);
            //         }
            //     })
            // }

            // $('#topProducts').on('click', () => {
            //     window.location.href = "http://localhost/ecomm/reportTest/index.php?q=topproducts";
            // })

            $('.report-btn').on('click', (e) => {
                window.location.href = "http://localhost/ecomm/reportTest/index.php?q=" + e.target.id;
            })

            // $('#salesReport').on('click', (e) => {
            //     e.preventDefault()
            //     const year = $('#year').val();
            //     const month = $('#month').val();

            //     if (year && month) {
            //         if (year.length < 4 || year.length > 4) {
            //             alert("Invalid year", 'danger');
            //         } else {
            //             generateReport("sales report", year, month)
            //         }
            //     } else {
            //         alert('Fill all fields', 'danger')
            //     }
            // })
        });

        // gross sales
        // gross profit
        // % gross profit to gross sales 
        // net profit
        // % net profit to gross sales
    </script>
</body>

</html>