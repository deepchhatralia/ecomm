<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile</title>

    <link rel="stylesheet" href="../modal.css">


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
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


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <input type="number" id="hidden-id" style="display: none;">
                <div class="modal-header my-modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                    <button type="button" class="btn-close modal-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                    <div class="row mb-3">
                        <label for="modal-company-address" class="col-sm-2 col-form-label">Company Name :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="modal-company-address">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="modal-company-contact" class="col-sm-2 col-form-label">Contact :</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="modal-company-contact">
                        </div>
                    </div>
                    <span id="error" style="color:red; font-size: 13px; transition: all 5s ease;"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                                            <th>Address</th>
                                            <th>Contact No.</th>
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
        <div class="row mb-3">
            <label for="company-address" class="col-sm-2 col-form-label">Company Address :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="company-address">
            </div>
        </div>
        <div class="row mb-3">
            <label for="company-contact" class="col-sm-2 col-form-label">Company Contact :</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="company-contact">
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-md-2">
                <button class="btn btn-primary w-100" id="add-company-btn">Add</button>
            </div>
        </div>
    </div>

    <!-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

    <script>
        document.querySelector('.fa-tachometer-alt').parentNode.parentNode.classList.remove('active')
        document.querySelector('.fa-box-open').parentNode.parentNode.classList.add('active')

        var toastTrigger = document.getElementById('liveToastBtn')
        var toastLiveExample = document.getElementById('liveToast')

        $(document).ready(() => {
            $('#table_id').DataTable({
                ordering: false,
                keys: true,
                search: {
                    return: true
                }
            })

            showData()
            $('.my-modal').fadeOut(1)

            function showData() {
                $.ajax({
                    url: "ajax/showData.php",
                    type: "POST",
                    data: {
                        operation: "select"
                    },
                    beforeSend() {
                        console.log('hello world');
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

            document.addEventListener('click', (e) => {
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
                            $('#modal-company-address').val(x[2])
                            $('#modal-company-contact').val(x[3])
                            $('#hidden-id').val(x[0])
                        }
                    })
                }

                if (e.target && e.target.id == "update-company-btn") {
                    const myid = $('#hidden-id').val()
                    const id = $('#modal-company-id').val()
                    const name = $('#modal-company-name').val()
                    const address = $('#modal-company-address').val()
                    const contact = $('#modal-company-contact').val()

                    if (id && name && address && contact) {
                        $.ajax({
                            url: "ajax/getData.php",
                            type: "POST",
                            data: {
                                myid,
                                id,
                                name,
                                address,
                                contact,
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
                const address = $('#company-address').val()
                const contact = $('#company-address').val()

                if (id && name && address && contact) {
                    $.ajax({
                        url: "ajax/addCompany.php",
                        type: "POST",
                        data: {
                            id,
                            name,
                            address,
                            contact
                        },
                        beforeSend() {
                            console.log('hello world');
                        },
                        success(data) {
                            if (data == 'Added') {
                                $('#company-id').val('')
                                $('#company-name').val('')
                                $('#company-address').val('')
                                $('#company-contact').val('')

                                showData()
                                showNotification('Success', 'Company added to database')
                            } else {
                                if (data == 'id') {
                                    showNotification('Error', 'ID already exist')
                                } else {
                                    showNotification('Error', 'Please try again...')
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