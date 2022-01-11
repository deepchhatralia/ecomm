<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>

    <link rel="stylesheet" href="css/category.css">
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

    <div class="my-modal">
        <div class="my-modal-container">
            <div class="my-modal-header">
                <i class="fas fa-times close-my-modal" id="close-my-modal"></i>
            </div>
            <div>
                <form>
                    <div class="row">
                        <input type="text" class="d-none" id="modal_category_id">
                        <div class="col-md-12 mb-3">
                            <label for="modal_category">Category</label>
                            <input id="modal_category" type="text" class="form-control input">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="w-100 btn btn-primary update-item-btn">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container my-5 content-wrapper">
        <div class="col-md-6 mb-4">
            <div class="col-md-10 col-sm-12 mb-3">
                <label for="category">Category</label>
                <input type="text" id="category" class="form-control input">
            </div>
            <div class="col-md-2 col-sm-12">
                <button class="btn btn-primary w-100" id="add_btn">Add</button>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>Category ID</th>
                                    <th>Name</th>
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










    <script src="../jquery.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <script>
        document.querySelector('.fa-tachometer-alt').parentNode.parentNode.classList.remove('active')
        document.querySelector('.fa-plus-square').parentNode.parentNode.classList.add('active')

        var toastTrigger = document.getElementById('liveToastBtn')
        var toastLiveExample = document.getElementById('liveToast')

        $(document).ready(() => {
            showData()
            $('.my-modal').fadeOut(1)

            $('#add_btn').click(() => {
                const category = $('#category').val()

                if (category) {
                    $.ajax({
                        url: "ajax/addCategoryAjax.php",
                        type: "POST",
                        data: {
                            category,
                            operation: "add"
                        },
                        beforeSend: function() {
                            $('#add_btn').html('<div class="spinner-border text-white" role="status">  <span class="visually-hidden">Loading...</span></div>')
                        },
                        success(data) {
                            $('#add_btn').text('Add')
                            if (data !== 'Added') {
                                showNotification('Error', 'Please try again...')
                            } else {
                                showData()
                                $('.my-modal').fadeOut(600)

                                $('#category').val('')

                                showNotification('Success', 'Category added to database')
                            }
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

            $('.update-item-btn').click((e) => {
                e.preventDefault()
                const id = $('#modal_category_id').val()
                const name = $('#modal_category').val()

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
                            $('.my-modal').fadeOut(1)
                            showData()
                            showNotification('Success', 'Category updated')
                        } else {
                            showNotification('Error', 'Try again...')
                        }
                    }
                })
            })

            document.addEventListener('click', (e) => {
                if (e.target && e.target.id == 'fa-edit') {
                    const id = e.target.parentNode.parentNode.firstChild.nextSibling.innerText;

                    $('.my-modal').fadeIn(600)

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
                        }
                    })
                }

                if (e.target && e.target.id == 'fa-trash-alt') {
                    const id = e.target.parentNode.parentNode.firstChild.nextSibling.innerText;

                    if (confirm('Are you sure you want to delete the record ???')) {
                        $.ajax({
                            url: "showData/getCategory.php",
                            type: "POST",
                            data: {
                                id: id,
                                operation: 'delete'
                            },
                            success(data) {
                                if (data) {
                                    showNotification('Success', 'Product deleted from database')
                                    showData()
                                } else {
                                    showNotification('Error', 'Please try again...')
                                }
                            }
                        })
                    }
                }

                if (e.target && e.target.id == 'close-my-modal') {
                    $('.my-modal').fadeOut(600)
                }

            })
        })
    </script>
</body>

</html>