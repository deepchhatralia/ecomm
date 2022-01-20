<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>

    <link rel="stylesheet" href="../modal.css">

    <style>
        .beforesend {
            display: flex;
            align-items: center;
            justify-content: center;
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

    <div class="main-panel container my-5">
        <?php
        $result = $obj->select('*', 'order');
        if ($result->num_rows > 0) {
        ?>
            <div class="content-wrapper">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table style="text-align: center;" id="order-listing" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Transaction ID</th>
                                            <th>Order ID</th>
                                            <th>User</th>
                                            <th>Shipping Address</th>
                                            <th>Order Date</th>
                                            <th>CGST</th>
                                            <th>SGST</th>
                                            <th>Total</th>
                                            <th>Cancelled</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="order-table"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        } else {
            echo '<div class="container my-5"><h3>No Orders Found</h3></div>';
        }
        ?>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table style="text-align: center;" id="order-listing" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Order Detail ID</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="order-detail-table"></tbody>
                        </table>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>



    <script>
        document.querySelector('.fa-tachometer-alt').parentNode.parentNode.classList.remove('active')
        document.querySelector('.fa-sort-amount-up-alt').parentNode.parentNode.classList.add('active')

        var toastTrigger = document.getElementById('liveToastBtn')
        var toastLiveExample = document.getElementById('liveToast')

        $(document).ready(() => {
            showData()

            document.addEventListener('click', (e) => {
                if (e.target && e.target.id == "fa-edit") {
                    const id = e.target.getAttribute('data-id')

                    $.ajax({
                        url: "ajax/getData.php",
                        type: "POST",
                        data: {
                            id,
                            operation: "select"
                        },
                        beforeSend() {
                            $('#order-detail-table').html('Hello')
                        },
                        success(data) {
                            $('#order-detail-table').html(data)
                        }
                    })
                }
            })

            function showNotification(msgHeader, msgBody) {
                var toast = new bootstrap.Toast(toastLiveExample)

                if (msgHeader === 'Success') {
                    $('.toast-header i').addClass('rounded me-2 fas fa-check-circle')
                } else {
                    $('.toast-header i').addClass('rounded me-2 fas fa-exclamation-triangle')
                }

                $('.toast-header strong').html(msgHeader);
                $('.toast-body').html(msgBody)
                toast.show()

                setTimeout(() => {
                    toast.hide()
                }, 3000);
            }

            function showData() {
                $.ajax({
                    url: "ajax/showData.php",
                    type: "POST",
                    data: {
                        operation: "select"
                    },
                    beforeSend() {
                        $('#order-table').html('Hello World')
                    },
                    success(data) {
                        $('#order-table').html(data)
                    }
                })
            }

        })
    </script>
</body>

</html>