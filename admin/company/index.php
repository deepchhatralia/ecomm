<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile</title>

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

    <button id="openModalBtn" class="d-none" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></button>

    <div class="modal myModal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <input type="number" id="hidden-id" style="display: none;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                    <button type="button" class="btn-close modal-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <label for="modal-company-id" class="col-sm-2 col-form-label">Company ID :</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="modal-company-id">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="modal-company-name" class="col-sm-2 col-form-label">Company Name :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="modal-company-name">
                            </div>
                        </div>
                        <!-- <div class="row mb-3">
                            <label for="modal-company-address" class="col-sm-2 col-form-label">Company Address :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="modal-company-address">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="modal-company-contact" class="col-sm-2 col-form-label">Contact :</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="modal-company-contact">
                            </div>
                        </div> -->
                        <span id="error" style="color:red; font-size: 13px; transition: all 5s ease;"></span>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-close-btn" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="update-company-btn" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="main-panel container my-5">
        <?php
        $result = $obj->select('*', 'company_profile');
        if ($result->num_rows > 0) {
        ?>
            <div class="content-wrapper">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table_id" data-order='[[ 1, "asc" ]]' data-page-length='10' class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Company ID</th>
                                            <th>Name</th>
                                            <!-- <th>Address</th>
                                            <th>Contact No.</th> -->
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
            echo '<div class="container my-5"><h4>No Company Details</h4></div>';
        }
        ?>
    </div>


    <div class="container my-5">
        <form id="my-form">
            <div class="row mb-3">
                <label for="company-id" class="col-sm-2 col-form-label">Company ID :</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="company-id">
                </div>
            </div>
            <div class="row mb-3">
                <label for="company-name" class="col-sm-2 col-form-label">Company Name :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="company-name">
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-md-4 d-flex justify-content-end">
                    <!-- <input type="reset" class="btn btn-secondary mx-2" id="reset"> -->
                    <button class="btn btn-primary" id="add-company-btn">Add</button>
                </div>
            </div>
        </form>
    </div>


    <script src="../../js/jquery-3.4.1.min.js"></script>

    <script>
        document.querySelector('.fa-tachometer-alt').parentNode.parentNode.classList.remove('active')
        document.querySelector('.companySidebarIcon').parentNode.parentNode.classList.add('active')

        var toastTrigger = document.getElementById('liveToastBtn')
        var toastLiveExample = document.getElementById('liveToast')

        $(document).ready(() => {
            $('#openModal').click(() => {
                $('.myModal').open()
            })
            showData()

            function showData() {
                $.ajax({
                    url: "ajax/showData.php",
                    type: "POST",
                    data: {
                        operation: "select"
                    },
                    success(data) {
                        $('tbody').html(data)
                    }
                })
            }

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

            $('.modal-close-btn').on('click', () => {
                $('#modal-form-reset').click();
                $('#error').html('');
            })

            document.addEventListener('click', (e) => {
                e.preventDefault();
                if (e.target && e.target.id == "fa-edit") {
                    const id = e.target.parentNode.parentNode.firstChild.nextSibling.innerText;

                    $.ajax({
                        url: "ajax/getData.php",
                        type: "POST",
                        data: {
                            id,
                            operation: "select"
                        },
                        success(data) {
                            const x = JSON.parse(data)
                            $('#modal-company-id').val(x[0])
                            $('#modal-company-name').val(x[1])
                            // $('#modal-company-address').val(x[2])
                            // $('#modal-company-contact').val(x[3])
                            $('#hidden-id').val(x[0])

                            $('#openModalBtn').click();
                        }
                    })
                }

                if (e.target && e.target.id == "update-company-btn") {
                    const myid = $('#hidden-id').val()
                    const id = $('#modal-company-id').val()
                    const name = $('#modal-company-name').val()
                    // const address = $('#modal-company-address').val()
                    // const contact = $('#modal-company-contact').val()

                    if (id && name) {
                        $.ajax({
                            url: "ajax/getData.php",
                            type: "POST",
                            data: {
                                myid,
                                id,
                                name,
                                operation: "update"
                            },
                            success(data) {
                                if (data == "updated") {
                                    showData()
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
                    const id = e.target.parentNode.parentNode.firstChild.nextSibling.innerText;

                    if (confirm('Are yo sure to delete ???')) {
                        $.ajax({
                            url: "ajax/getData.php",
                            type: "POST",
                            data: {
                                id,
                                operation: "delete"
                            },
                            success(data) {
                                if (data == "deleted") {
                                    showData()
                                    showNotification('Success', 'Company details deleted')
                                } else {
                                    showNotification('Error', data)
                                }
                            }
                        })
                    }
                }

                return () => {}
            })

            $('#add-company-btn').click(() => {
                const id = $('#company-id').val()
                const name = $('#company-name').val()
                // const address = $('#company-address').val()
                // const contact = $('#company-address').val()

                if (id && name) {
                    $.ajax({
                        url: "ajax/addCompany.php",
                        type: "POST",
                        data: {
                            id,
                            name,
                        },
                        beforeSend() {
                            console.log('hello world');
                        },
                        success(data) {
                            if (data == 'Added') {
                                $('#reset').click()

                                showData()
                                showNotification('Success', 'Company added to database')
                            } else {
                                if (data == 'id') {
                                    showNotification('Error', 'ID already exist');
                                } else if (data == 'company exist') {
                                    showNotification('Error', 'Company already exist');
                                } else {
                                    showNotification('Error', 'Please try again...');
                                }
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