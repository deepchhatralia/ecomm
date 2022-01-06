<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feature</title>

    <link rel="stylesheet" href="../../css/style.css">

    <link rel="stylesheet" href="css/feature.css">
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


    <div class="my-modal">
        <div class="my-modal-container">
            <div class="my-modal-header">
                <i class="fas fa-times close-my-modal" id="close-my-modal"></i>
            </div>
            <div>
                <form>
                    <div class="row">
                        <input type="text" id="modal_product_feature_id" style="display: none;">
                        <div class="col-md-12 mb-3">
                            <label for="modal_feature_name">Feature</label>
                            <input name="name" id="modal_feature_name" type="text" class="form-control input">
                        </div>
                        <div class="col-md-12 mb-2">
                            <?php
                            $result = $obj->select('*', 'product');
                            if ($result->num_rows > 0) {
                                echo '<select class="form-select modal_product_id my-2 input" id="modal_product_id" name="modal_product_id">';
                                echo '<option disabled selected>Company</option>';
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['product_id'] . '">' . $row['product_name'] . '</option>';
                                }
                                echo '</select>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <button class="w-100 btn btn-primary update-feature-btn">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="main-panel container my-5">
        <?php
        $result = $obj->select('*', 'product_feature');
        if ($result->num_rows > 0) {
        ?>
            <div class="content-wrapper">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table style="text-align: center;" id="order-listing" class="table">
                                    <thead>
                                        <tr>
                                            <th>Feature ID</th>
                                            <th>Feature</th>
                                            <th>Product</th>
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
            echo '<div class="container my-5"><h4>No features</h4></div>';
        }
        ?>
    </div>

    <div class="container my-5">
        <div class="row mb-3">
            <label for="feature" class="col-sm-2 col-form-label">Feature :</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="feature" rows="4"></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="product" class="col-sm-2 col-form-label">Product :</label>
            <div class="col-sm-10">
                <?php
                $result = $obj->select('*', 'product');
                if ($result->num_rows > 0) {
                    echo '<select class="form-select product my-2 input" id="product" name="product">';
                    echo '<option disabled selected>Product</option>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['product_id'] . '">' . $row['product_name'] . '</option>';
                    }
                    echo '</select>';
                }
                ?>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-md-2">
                <button class="btn btn-primary w-100" id="add-feature-btn">Add</button>
            </div>
        </div>
    </div>


    <script>
        document.querySelector('.fa-tachometer-alt').parentNode.parentNode.classList.remove('active')
        document.querySelector('.fa-plus-square').parentNode.parentNode.classList.add('active')

        $(document).ready(() => {
            showData();
            $('.my-modal').fadeOut(1)

            $('#alert-success').hide()

            var toastTrigger = document.getElementById('liveToastBtn')
            var toastLiveExample = document.getElementById('liveToast')

            $('#add-feature-btn').click(() => {
                const feature = $('#feature').val()
                const product = $('#product').val()

                if (feature && product) {
                    $.ajax({
                        url: "ajax/addfeature.php",
                        type: "POST",
                        data: {
                            feature,
                            product
                        },
                        success(data) {
                            if (data == 'Added') {
                                $('#feature').val('')
                                $('#product').val('Select product')
                                showData()
                                showNotification('Success', 'Product feature added to database')
                            } else {
                                showNotification('Error', 'Please try again...')
                            }
                        }
                    })
                } else {
                    showNotification('Error', 'Please fill all details')
                }

                return () => {}
            })

            document.addEventListener('click', (e) => {
                if (e.target && e.target.id == 'fa-edit') {
                    const id = e.target.parentNode.parentNode.firstChild.nextSibling.innerText;

                    $('.my-modal').fadeIn(600)

                    $.ajax({
                        url: "showData/getFeature.php",
                        type: "POST",
                        data: {
                            id,
                            operation: 'select'
                        },
                        success(data) {
                            const x = JSON.parse(data)

                            $('#modal_product_feature_id').val(x[0])
                            $('#modal_feature_name').val(x[1])
                            $('.modal_product_id').val(x[2])
                        }
                    })
                }

                if (e.target && e.target.id == 'fa-trash-alt') {
                    const id = e.target.parentNode.parentNode.firstChild.nextSibling.innerText;

                    if (confirm('Are you sure you want to delete the record ???')) {
                        $.ajax({
                            url: "showData/getFeature.php",
                            type: "POST",
                            data: {
                                id: id,
                                operation: 'delete'
                            },
                            success(data) {
                                if (data) {
                                    showNotification('Success', 'Product feature deleted from database')
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

            $('.update-feature-btn').click((e) => {
                e.preventDefault()
                const id = $('#modal_product_feature_id').val()
                const feature = $('#modal_feature_name').val()
                const product_id = $('#modal_product_id').val()

                $.ajax({
                    url: "showData/getFeature.php",
                    type: "POST",
                    data: {
                        id,
                        feature,
                        product_id,
                        operation: 'update'
                    },
                    success(data) {
                        if (data) {
                            $('.my-modal').fadeOut(1)
                            showData()
                            showNotification('Success', 'Product details updated')
                        } else {
                            showNotification('Error', 'Try again...')
                        }
                    }
                })
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
                    url: "showData/showFeature.php",
                    success(data) {
                        $('tbody').html(data)
                    }
                })
            }
        })
    </script>
</body>

</html>