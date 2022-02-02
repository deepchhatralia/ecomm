<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image's</title>

    <?php
    include '../../database.php';
    $obj = new Database();
    include '../includee/cdn.php';
    include '../includee/navbar.php';
    include '../includee/sidebar.php';
    include '../notification.php';
    include '../../includee/config.php';
    ?>

    <style>
        .my-btn {
            padding: 5px;
            border-radius: 3px;
            color: #fff;
        }

        .my-btn:hover {
            cursor: pointer;
            transform: scaleY(1.0111);
        }

        .imgs-container {
            overflow: auto;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
        }

        .my-container {
            position: relative;
            width: 15%;
            display: inline-block;
        }

        .my-image {
            opacity: 1;
            display: block;
            width: 100%;
            height: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }

        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .my-container:hover .my-image {
            opacity: 0.3;
        }

        .my-container:hover .middle {
            opacity: 1;
        }
    </style>
</head>


<body>
    <div class="container my-5">
        <form id="my-form" method="post" enctype="multipart/form-data">
            <div class="input-group mb-3">
                <input type="file" name="fileToUpload" class="form-control" id="fileToUpload">
            </div>

            <div class="row mb-3">
                <label for="product" class="col-sm-2 col-form-label">Product</label>
                <div class="col-sm-10">
                    <select id="product" name="product" class="form-select">
                        <option selected disabled value="0">Select product</option>
                        <?php
                        $result = $obj->select('*', 'productt');
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value=" . $row['product_id'] . ">" . $row['product_name'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row justify-content-end">
                <div class="col-md-2">
                    <button class="btn btn-primary w-100" id="add">Add</button>
                </div>
            </div>
        </form>
    </div>

    <div class="content-wrapper container my-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="order-listing" class="table table-bordered">
                            <thead>
                                <tr>
                                    <!-- <th>Image ID</th> -->
                                    <th>Image's</th>
                                    <th>Product</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.querySelector('.fa-tachometer-alt').parentNode.parentNode.classList.remove('active')
        document.querySelector('.fa-plus-square').parentNode.parentNode.classList.add('active')

        $(document).ready(() => {
            showImage()
            var toastTrigger = document.getElementById('liveToastBtn')
            var toastLiveExample = document.getElementById('liveToast')

            function showImage() {
                $.ajax({
                    url: "showData/showImage.php",
                    type: "POST",
                    data: {
                        operation: "select"
                    },
                    beforeSend: function() {
                        $('tbody').html('<div class="spinner-border my-3" role="status">  <span class="visually-hidden">Loading...</span></div>')
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
                if (e.target && e.target.id == 'fa-edit') {
                    const id = e.target.parentNode.parentNode.firstChild.nextSibling.innerText;
                    console.log(id)
                }

                if (e.target && e.target.id == 'delete-img-btn') {
                    const id = e.target.getAttribute("data-id")

                    if (confirm('Are you sure to delete ???')) {
                        $.ajax({
                            url: "showData/getImage.php",
                            type: "POST",
                            data: {
                                id,
                                operation: "delete"
                            },
                            success(data) {
                                if (data === 'deleted') {
                                    showImage()
                                    showNotification('Success', 'Image deleted')
                                } else {
                                    showNotification('Error', 'Please try again...')
                                }
                            }
                        })
                    }
                }
            })

            $("#my-form").on('submit', (e) => {
                e.preventDefault();
                const file = $('#fileToUpload').val()
                const product = $('#product').val()

                if (file && product) {
                    $.ajax({
                        url: "ajax/uploadImage.php",
                        type: "POST",
                        data: new FormData(document.getElementById('my-form')),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            showNotification('Notification', data)
                            $('#fileToUpload').val('')
                            $('#product').val(0)
                            showImage()
                        }
                    });
                } else {
                    showNotification('Error', 'Please fill all fields')
                }
            })
        })
    </script>
</body>

</html>