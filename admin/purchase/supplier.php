<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier</title>

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

    <button id="openModalBtn" class="d-none" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></button>

    <div class="modal myModal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                    <button type="button" class="btn-close modal-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <label for="modal-supplier-id" class="col-sm-2 col-form-label">Supplier ID :</label>
                            <div class="col-sm-10">
                                <input type="number" disabled class="form-control" id="modal-supplier-id">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="modal-supplier-name" class="col-sm-2 col-form-label">Supplier Name :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="modal-supplier-name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="modal-supplier-address" class="col-sm-2 col-form-label">Supplier Address :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="modal-supplier-address">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="modal-supplier-email" class="col-sm-2 col-form-label">Supplier Email :</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="modal-supplier-email">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="modal-supplier-contact" class="col-sm-2 col-form-label">Contact :</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="modal-supplier-contact">
                            </div>
                        </div>
                        <span id="error" style="color:red; font-size: 13px; transition: all 5s ease;"></span>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-close-btn" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="update-supplier-btn" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>





    <div class="container">
        <div class="row">
            <table id="myTable" class="display table my-5">
                <thead id="thead">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </thead>
                <tbody id="supplier">

                </tbody>
            </table>
        </div>
    </div>



    <div class="container my-5">
        <form id="my-form">
            <div class="row mb-3">
                <label for="supplier-name" class="col-sm-2 col-form-label">Supplier Name :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="supplier-name">
                </div>
            </div>
            <div class="row mb-3">
                <label for="supplier-address" class="col-sm-2 col-form-label">Supplier Address :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="supplier-address">
                </div>
            </div>
            <div class="row mb-3">
                <label for="supplier-email" class="col-sm-2 col-form-label">Supplier Email :</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="supplier-email">
                </div>
            </div>
            <div class="row mb-3">
                <label for="supplier-contact" class="col-sm-2 col-form-label">Supplier Contact :</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="supplier-contact">
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-md-4 d-flex justify-content-end">
                    <input type="reset" class="btn btn-secondary mx-2" id="reset">
                    <button class="btn btn-primary" id="add-supplier-btn">Add</button>
                </div>
            </div>
        </form>
    </div>



    <script src="../../js/jquery-3.4.1.min.js"></script>

    <script>
        document.querySelector('.fa-tachometer-alt').parentNode.parentNode.classList.remove('active')
        document.querySelector('.supplierSidebarIcon').parentNode.parentNode.classList.add('active')

        var toastTrigger = document.getElementById('liveToastBtn')
        var toastLiveExample = document.getElementById('liveToast')

        $(document).ready(function() {
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

            function loadSupplier() {
                $.post({
                    url: "ajax/supplier.php",
                    data: {
                        operation: "load supplier"
                    },
                    success(data) {
                        $('#supplier').html(data);
                    }
                })
            }
            loadSupplier();

            document.addEventListener('click', (e) => {
                e.preventDefault();
                if (e.target && e.target.id == "fa-edit") {
                    const id = e.target.getAttribute("data-id");

                    $.ajax({
                        url: "ajax/supplier.php",
                        type: "POST",
                        data: {
                            id,
                            operation: "select supplier"
                        },
                        beforeSend() {
                            $('.fa-edit').addClass('disabled')
                        },
                        success(data) {
                            $('.fa-edit').removeClass('disabled')

                            const x = JSON.parse(data)
                            $('#modal-supplier-id').val(x[0])
                            $('#modal-supplier-name').val(x[1])
                            $('#modal-supplier-address').val(x[2])
                            $('#modal-supplier-email').val(x[3])
                            $('#modal-supplier-contact').val(x[4])

                            $('#openModalBtn').click();
                        }
                    })
                }

                if (e.target && e.target.id == "update-supplier-btn") {
                    const id = $('#modal-supplier-id').val()
                    const name = $('#modal-supplier-name').val()
                    const address = $('#modal-supplier-address').val()
                    const email = $('#modal-supplier-email').val()
                    const contact = $('#modal-supplier-contact').val()

                    if (id && name && address && email && contact) {
                        $.ajax({
                            url: "ajax/supplier.php",
                            type: "POST",
                            data: {
                                id,
                                name,
                                address,
                                email,
                                contact,
                                operation: "update supplier"
                            },
                            success(data) {
                                if (data == "updated") {
                                    loadSupplier()
                                    $('.modal-close-btn').click()
                                    showNotification('Success', 'Company details updated')
                                    $('#error').text('')
                                } else {
                                    $('#error').text(data)
                                }
                            }
                        })
                    } else {
                        $('#error').text('Please fill all details')
                    }
                }

                if (e.target && e.target.id == "fa-trash-alt") {
                    const id = e.target.getAttribute("data-id");

                    if (confirm('Are yo sure to delete ???')) {
                        $.ajax({
                            url: "ajax/supplier.php",
                            type: "POST",
                            data: {
                                id,
                                operation: "delete supplier"
                            },
                            success(data) {
                                if (data == "deleted") {
                                    loadSupplier()
                                    showNotification('Success', 'Supplier details deleted')
                                } else {
                                    showNotification('Error', data)
                                }
                            }
                        })
                    }
                }

                return () => {}
            })

            $('#add-supplier-btn').on('click', (e) => {
                e.preventDefault()
                const name = $('#supplier-name').val()
                const address = $('#supplier-address').val()
                const email = $('#supplier-email').val()
                const contact = $('#supplier-contact').val()

                if (name && address && email && contact) {
                    $.post({
                        url: "ajax/supplier.php",
                        data: {
                            name,
                            address,
                            email,
                            contact,
                            operation: "add supplier"
                        },
                        beforeSend() {
                            $('#add-supplier-btn').addClass('disabled')
                        },
                        success(data) {
                            $('#add-supplier-btn').removeClass('disabled')

                            if (data == 'Added') {
                                $('#reset').click()

                                loadSupplier()
                                showNotification('Success', 'Supplier added to database')
                            } else {
                                showNotification('Error', data)
                            }
                        }
                    })
                } else {
                    showNotification('Error', 'Please fill all details')
                }

                return () => {}
            })
        })
    </script>
</body>

</html>