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

    <link rel="stylesheet" href="../modal.css">
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


    <button id="openModalBtn" class="d-none" data-bs-toggle="modal" data-bs-target="#exampleModal"></button>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
                    <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="modal_purchase_id" style="display: none;">
                    <div class="col-md-12 mb-3">
                        <label for="modal_product_name">Product Name</label>
                        <input id="modal_product_name" type="text" class="form-control input">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="modal_qty">Quantity</label>
                        <input name="name" id="modal_qty" type="number" class="form-control input">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="modal_total">Total</label>
                        <input id="modal_total" type="number" class="form-control input">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="modal_dealer">Dealer</label>
                        <select id="modal_dealer" class="form-select">
                            <?php
                            $result = $obj->select('*', 'dealer');
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['iddealer'] . '">' . $row['dealer_name'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-close" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="update-item-btn" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <div class="main-panel container my-5">
        <?php
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
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Dealer</th>
                                            <th>Product Added</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } else {
            echo '<div class="container my-5"><h3>Inventory Empty</h3></div>';
        }
        ?>
    </div>

    <div class="container my-5">
        <form id="myForm">
            <div class="row mb-3">
                <label for="product_name" class="col-sm-2 col-form-label">Product Name :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="product_name">
                </div>
            </div>
            <div class="row mb-3">
                <label for="qty" class="col-sm-2 col-form-label">Quantity :</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="qty">
                </div>
            </div>
            <div class="row mb-3">
                <label for="total" class="col-sm-2 col-form-label">Total :</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="total">
                </div>
            </div>
            <div class="row mb-3">
                <label for="product_offer" class="col-sm-2 col-form-label">Dealer :</label>
                <div class="col-sm-10">
                    <select id="dealer" class="form-select">
                        <option disabled selected>Select</option>
                        <?php
                        $result = $obj->select('*', 'dealer');
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['iddealer'] . '">' . $row['dealer_name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-md-4 d-flex justify-content-end">
                    <input type="reset" value="Reset" id="reset" class="mx-2 btn btn-secondary" />
                    <button class="btn btn-primary add-purchase-btn">Add</button>
                </div>
            </div>
        </form>
    </div>



    <script src="../../js/jquery-3.4.1.min.js"></script>

    <script>
        document.querySelector('.fa-tachometer-alt').parentNode.parentNode.classList.remove('active')
        document.querySelector('.purchaseSidebarIcon').parentNode.parentNode.classList.add('active')

        var toastTrigger = document.getElementById('liveToastBtn');
        var toastLiveExample = document.getElementById('liveToast');

        $(document).ready(function() {
            $('#alert-success').hide()
            showData();

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

            // to load the table asyncronously after an item is added
            function showData() {
                $.post({
                    url: "ajax/purchase.php",
                    data: {
                        operation: "show purchase"
                    },
                    success(data) {
                        $('tbody').html(data)
                    }
                })
            }

            $('#myForm').on('submit', (e) => {
                e.preventDefault();

                const name = $('#product_name').val();
                const qty = $('#qty').val();
                const total = $('#total').val();
                const dealer = $('#dealer').val();

                if (name && qty && total && dealer) {
                    $.post({
                        url: 'ajax/purchase.php',
                        data: {
                            name,
                            qty,
                            total,
                            dealer,
                            operation: "insert purchase"
                        },
                        success(data) {
                            if (data !== 'inserted') {
                                showNotification('Error', 'Please try again...')
                            } else {
                                showData();
                                $('#reset').click()

                                showNotification('Success', 'Purchase added to database')
                            }
                        }
                    });


                } else {
                    showNotification('Error', 'Please fill all details')
                }
            })

            $('#update-item-btn').click((e) => {
                const id = $('#modal_purchase_id').val()
                const name = $('#modal_product_name').val()
                const qty = $('#modal_qty').val()
                const dealer = $('#modal_dealer').val()
                const total = $('#modal_total').val()

                if (id && name && qty && dealer && total) {
                    $.post({
                        url: "ajax/purchase.php",
                        data: {
                            id,
                            name,
                            qty,
                            dealer,
                            total,
                            operation: 'update purchase'
                        },
                        success(data) {
                            if (data == "updated") {
                                $('.modal-close').click()
                                // editor.destroy()
                                showData()
                                showNotification('Success', 'Purchase details updated')
                            } else {
                                showNotification('Error', 'Try again...')
                            }
                        }
                    })
                }
            })

            document.addEventListener('click', (e) => {
                if (e.target && e.target.id == 'fa-edit') {
                    const id = e.target.getAttribute("data-id");

                    $.post({
                        url: "ajax/purchase.php",
                        data: {
                            id,
                            operation: 'select purchase'
                        },
                        success(data) {
                            const x = JSON.parse(data)

                            $('#modal_purchase_id').val(x[0])
                            $('#modal_product_name').val(x[1]);
                            $('#modal_qty').val(x[2]);
                            $('#modal_total').val(x[3]);
                            $('#modal_dealer').val(x[4]);

                            $('#openModalBtn').click()
                        }
                    })
                }

                if (e.target && e.target.id == 'fa-trash-alt') {
                    const id = e.target.getAttribute("data-id");

                    if (confirm('Are you sure you want to delete the record ???')) {
                        $.ajax({
                            url: "ajax/purchase.php",
                            type: "POST",
                            data: {
                                id: id,
                                operation: 'delete purchase'
                            },
                            success(data) {
                                if (data == "deleted") {
                                    showNotification('Success', 'Product deleted from database')
                                    showData()
                                } else {
                                    showNotification('Error', 'Please try again...')
                                }
                            }
                        })
                    }
                }
                return () => {};
            })
        })
    </script>
</body>

</html>