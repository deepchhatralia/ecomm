<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>

    <link rel="stylesheet" href="../modal.css">

    <style>
        .container {
            display: flex;
        }

        .category-img {
            width: 100%;
            height: auto;
        }

        @media screen and (max-width:995px) {
            .container {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body>
    <?php

    include '../includee/cdn.php';
    include '../includee/navbar.php';
    include '../includee/sidebar.php';
    include '../notification.php';

    include '../../database.php';
    $obj = new Database();

    $result = $obj->select('*', 'product_category');
    ?>

    <button id="openModalBtn" class="d-none" data-bs-toggle="modal" data-bs-target="#exampleModal"></button>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="modal-form" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                        <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="text" class="d-none" id="modal_category_id" name="modal_category_id">
                            <div class=" col-md-12 mb-3">
                                <label for="modal_category">Category</label>
                                <input id="modal_category" name="modal_category" type=" text" class="form-control input">
                            </div>
                        </div>
                        <div class="row">
                            <input type="text" style="display: none;" id="modal_category_image" name="modal_category_image">

                            <div class=" col-md-12 mb-3">
                                <label for="modal_category_img">Category Image</label>
                                <input type="file" id="modal_category_img" name="modal_category_img" class="form-control input">
                                <span class="error" style="font-size: 12px; color: red; font-style: italic;">Only select an image if you want to upload new one</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="w-100 btn btn-primary update-item-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container my-5 content-wrapper">
        <div class="col-md-6 mb-4">
            <form id="my-form" method="post" enctype="multipart/form-data">
                <div class="col-lg-10 col-sm-12 mb-3">
                    <label for="category">Category</label>
                    <input type="text" id="category" class="form-control input" name="category">
                </div>
                <div class="col-lg-10 col-sm-12 mb-3">
                    <label for="fileToUpload">Category Image</label>
                    <input type="file" name="fileToUpload" class="form-control" id="fileToUpload">
                </div>
                <div class="col-md-4 d-flex justify-content-end">
                    <button class="btn btn-primary w-100" name="submit" id="add_btn">Add</button>
                    <input type="reset" class="btn btn-secondary mx-2 d-none" id="reset">
                </div>
            </form>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="order-listing" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Category ID</th>
                                    <th>Name</th>
                                    <th>Category Image</th>
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

    <script src="../../js/jquery-3.4.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <script>
        document.querySelector('.fa-tachometer-alt').parentNode.parentNode.classList.remove('active')
        document.querySelector('.categorySidebarIcon').parentNode.parentNode.classList.add('active')

        var toastTrigger = document.getElementById('liveToastBtn')
        var toastLiveExample = document.getElementById('liveToast')

        $(document).ready(() => {
            showData()

            $('#my-form').on('submit', (e) => {
                e.preventDefault();
                const category = $('#category').val()
                const file = $('#fileToUpload').val()

                if (category && file) {
                    $.ajax({
                        url: "ajax/addCategoryAjax.php",
                        type: "POST",
                        data: new FormData(document.getElementById('my-form')),
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $('#add_btn').html('<div class="spinner-border text-white" role="status">  <span class="visually-hidden">Loading...</span></div>')
                        },
                        success(data) {
                            $('#reset').click()
                            $('#add_btn').text('Add')

                            showNotification('Notification', data)

                            showData()
                        }
                    })
                } else {
                    showNotification('Error', 'Please fill all details')
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
                    url: "showData/showCategory.php",
                    beforeSend: function() {
                        $('tbody').html('<div class="spinner-border my-3" role="status">  <span class="visually-hidden">Loading...</span></div>')
                    },
                    success(data) {
                        $('tbody').html(data)
                    }
                })
            }

            $('#modal-form').on('submit', (e) => {
                e.preventDefault()
                const id = $('#modal_category_id').val()
                const name = $('#modal_category').val()
                const img = $('#modal_category_img').val()

                if (name) {
                    if (img) {
                        $.ajax({
                            url: "showData/getCategory.php",
                            type: "POST",
                            data: new FormData(document.getElementById('modal-form')),
                            contentType: false,
                            cache: false,
                            processData: false,
                            success(data) {
                                $('.modal-close').click()
                                showData()
                                showNotification('Notification', data)
                            }
                        })
                    } else {
                        $.ajax({
                            url: "showData/getCategory.php",
                            type: "POST",
                            data: {
                                id,
                                name,
                                operation: 'update'
                            },
                            success(data) {
                                if (data) {
                                    $('.modal-close').click()
                                    showData()
                                    showNotification('Success', 'Category updated')
                                } else {
                                    showNotification('Error', 'Try again...')
                                }
                            }
                        })
                    }
                }
            })

            document.addEventListener('click', (e) => {
                if (e.target && e.target.id == 'fa-edit') {
                    const id = e.target.parentNode.parentNode.firstChild.nextSibling.innerText;

                    $.ajax({
                        url: "showData/getCategory.php",
                        type: "POST",
                        data: {
                            id,
                            operation: 'select'
                        },
                        success(data) {
                            const x = JSON.parse(data)

                            $('#modal_category_id').val(x[0])
                            $('#modal_category').val(x[1])
                            $('#modal_category_image').val(x[2])

                            $('#openModalBtn').click()
                        }
                    })
                }

                if (e.target && e.target.id == 'fa-trash-alt') {
                    const id = e.target.parentNode.parentNode.firstChild.nextSibling.innerText;

                    if (confirm('Are you sure you want to delete the category ???')) {
                        $.ajax({
                            url: "showData/getCategory.php",
                            type: "POST",
                            data: {
                                id: id,
                                operation: 'delete'
                            },
                            success(data) {
                                if (data == "deleted") {
                                    showNotification('Success', 'Category deleted from database')
                                    showData()
                                } else {
                                    showNotification('Error', data)
                                }
                            }
                        })
                    }
                }
            })
        })
    </script>
</body>

</html>