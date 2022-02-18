<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>

    <link rel="stylesheet" href="css/product.css">

    <link rel="stylesheet" href="../modal.css">

<body>

    <?php

    include '../includee/cdn.php';
    include '../includee/navbar.php';
    include '../includee/sidebar.php';
    include '../notification.php';

    include '../../database.php';
    $obj = new Database();

    $result = $obj->select('*', 'productt');

    ?>

    <button id="openModalBtn" class="d-none" data-bs-toggle="modal" data-bs-target="#exampleModal"></button>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
                    <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="modal_product_id" style="display: none;">
                    <div class="col-md-12 mb-3">
                        <label for="modal_product_name">Product Name</label>
                        <input name="name" id="modal_product_name" type="text" class="form-control input">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="modal_product_desc">Description</label>
                        <textarea rows="5" name="desc" id="modal_product_desc" type="text" class="form-control input"></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="modal_product_feature">Feature</label>
                        <!-- <div class="modal-product-feature">
                            <input name="desc" id="modal_product_feature" type="text" class="form-control input">
                        </div> -->
                        <div class="col-sm-10">
                            <textarea name="content" class="modal-product-feature"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="modal-category">Category</label>
                        <?php
                        $result = $obj->select('*', 'product_category');
                        if ($result->num_rows > 0) {
                            echo '<select id="modal-category" class="form-select modal_product_category input"  name="category">';
                            echo '<option disabled selected>Select category</option>';
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';
                            }
                            echo '</select>';
                        }
                        ?>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="product_mrp">MRP</label>
                        <input name="mrp" id="modal_product_mrp" type="number" class="form-control input">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="product_stock">Stock</label>
                        <input name="stock" id="modal_product_stock" type="number" class="form-control input">
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="company_profile">Company</label>
                        <?php
                        $result = $obj->select('*', 'company_profile');
                        if ($result->num_rows > 0) {
                            echo '<select class="form-select modal_company_profile my-2 input" name="company_profile" id="company_profile">';
                            echo '<option disabled selected>Company</option>';
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['idcompany_profile'] . '">' . $row['company_name'] . '</option>';
                            }
                            echo '</select>';
                        }
                        ?>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="modal_product_offer">Offer</label>
                        <?php
                        $result = $obj->select('*', 'offer');
                        if ($result->num_rows > 0) {
                            echo '<select id="modal_product_offer" class="form-select my-2 input" name="modal_product_offer">';
                            echo '<option disabled selected>Offer</option>';
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['idoffer'] . '">' . $row['offer_name'] . '</option>';
                            }
                            echo '</select>';
                        }
                        ?>
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
                                            <th>Description</th>
                                            <th>Feature</th>
                                            <th>Price</th>
                                            <th>Offer Price</th>
                                            <th>Stock</th>
                                            <th>Category</th>
                                            <th>Company</th>
                                            <th>Offer</th>
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
                <label for="product_desc" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea rows="4" name="desc" id="product_desc" type="text" class="form-control input"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="product_feature" class="col-sm-2 col-form-label">Feature</label>
                <div class="col-sm-10">
                    <div class="product-feature-container">
                        <input id="product_feature" type="text" class="mb-1 form-control input product_feature">
                    </div>
                    <div class="d-flex justify-content-end">
                        <div class="btn btn-success" id="add-more-feature">
                            <h3 class="m-0">+</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="product_category" class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-10">
                    <?php
                    $result = $obj->select('*', 'product_category');
                    if ($result->num_rows > 0) {
                        echo '<select class="form-select product_category input"  name="category" id="product_category">';
                        echo '<option disabled selected>Select category</option>';
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';
                        }
                        echo '</select>';
                    }
                    ?>
                </div>
            </div>
            <div class="row mb-3">
                <label for="product_mrp" class="col-sm-2 col-form-label">MRP :</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="product_mrp">
                </div>
            </div>
            <div class="row mb-3">
                <label for="product_stock" class="col-sm-2 col-form-label">Stock :</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="product_stock">
                </div>
            </div>
            <div class="row mb-3">
                <label for="company_profile" class="col-sm-2 col-form-label">Company :</label>
                <div class="col-sm-10">
                    <?php
                    $result = $obj->select('*', 'company_profile');
                    if ($result->num_rows > 0) {
                        echo '<select class="form-select company_profile my-2 input" name="company_profile" id="company_profile">';
                        echo '<option disabled selected>Company</option>';
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['idcompany_profile'] . '">' . $row['company_name'] . '</option>';
                        }
                        echo '</select>';
                    }
                    ?>
                </div>
            </div>
            <div class="row mb-3">
                <label for="product_offer" class="col-sm-2 col-form-label">Offer :</label>
                <div class="col-sm-10">
                    <?php
                    $result = $obj->select('*', 'offer');
                    if ($result->num_rows > 0) {
                        echo '<select id="product_offer" class="form-select product_offer input" name="offer">';
                        echo '<option disabled selected>Select offer</option>';
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['idoffer'] . '">' . $row['offer_name'] . '</option>';
                        }
                        echo '</select>';
                    }
                    ?>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-md-4 d-flex justify-content-end">
                    <input type="reset" value="Reset" id="reset" class="mx-2 btn btn-secondary" />
                    <button class="btn btn-primary add-item-btn">Add</button>
                </div>
            </div>
        </form>
    </div>

    <script src="../../js/jquery-3.4.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- CKEditor  -->
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/12.3.1/classic/ckeditor.js"></script> -->

    <script>
        var editor;

        document.querySelector('.fa-tachometer-alt').parentNode.parentNode.classList.remove('active')
        document.querySelector('.productSidebarIcon').parentNode.parentNode.classList.add('active')


        var toastTrigger = document.getElementById('liveToastBtn')
        var toastLiveExample = document.getElementById('liveToast')

        $(document).ready(() => {
            $('#alert-success').hide()
            showData();

            ClassicEditor
                .create(document.querySelector('.modal-product-feature'), {
                    toolbar: ['bulletedList'],
                })
                .then(newEditor => {
                    editor = newEditor;
                })
                .catch(error => {
                    console.error(error);
                });

            $('#add-more-feature').click(() => {
                let featureContainer = "";
                let arr = $('.product_feature').map((i, e) => e.value).get();

                for (let i = 0; i < arr.length; i++) {
                    featureContainer += '<input id="product_feature" type="text" class="mb-1 form-control input product_feature" value="' + arr[i] + '">';
                }

                $('.product-feature-container').html(featureContainer + '<input type="text" class="mb-1 form-control input product_feature">')

            })

            // $('.modal-close').on('click', () => {
            //     editor.destroy()
            // })

            $('#update-item-btn').click((e) => {
                const id = $('#modal_product_id').val()
                const name = $('#modal_product_name').val()
                const desc = $('#modal_product_desc').val()
                const feature = editor.getData()
                const category = $('#modal-category').val()
                const price = $('#modal_product_mrp').val()
                const stock = $('#modal_product_stock').val()
                const company = $('.modal_company_profile').val()
                const offer = $('#modal_product_offer').val()

                if (name && desc && feature && category && price && stock && company && offer) {
                    $.ajax({
                        url: "showData/getData.php",
                        type: "POST",
                        data: {
                            id,
                            name,
                            desc,
                            feature,
                            category,
                            price,
                            stock,
                            company,
                            offer,
                            operation: 'update'
                        },
                        success(data) {
                            if (data) {
                                $('.modal-close').click()
                                // editor.destroy()
                                showData()
                                showNotification('Success', 'Product details updated')
                            } else {
                                showNotification('Error', 'Try again...')
                            }
                        }
                    })
                }
            })

            document.addEventListener('click', (e) => {
                if (e.target && e.target.id == 'fa-edit') {
                    const id = e.target.parentNode.parentNode.firstChild.nextSibling.innerText;

                    $.ajax({
                        url: "showData/getData.php",
                        type: "POST",
                        data: {
                            id,
                            operation: 'select'
                        },
                        success(data) {
                            const x = JSON.parse(data)

                            $('#modal_product_id').val(x[5])
                            $('#modal_product_name').val(x[0])
                            $('#modal_product_mrp').val(x[1])
                            $('.modal_product_category').val(x[2])
                            $('#modal_product_stock').val(x[3])
                            $('.modal_company_profile').val(x[4])
                            $('#modal_product_offer').val(x[6])
                            $('#modal_product_desc').val(x[7])
                            editor.setData(x[8])

                            $('#openModalBtn').click()
                        }
                    })
                }

                if (e.target && e.target.id == 'fa-trash-alt') {
                    const id = e.target.parentNode.parentNode.firstChild.nextSibling.innerText;

                    if (confirm('Are you sure you want to delete the record ???')) {
                        $.ajax({
                            url: "showData/getData.php",
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

            // to load the table asyncronously after an item is added
            function showData() {
                $.ajax({
                    url: "showData/showProduct.php",
                    success(data) {
                        $('tbody').html(data)
                    }
                })
            }

            $('#myForm').on('submit', (e) => {
                e.preventDefault();
                const input = $('.input')
                const product_name = $('#product_name').val()
                const desc = $('#product_desc').val();
                const feature = $('.product_feature').map((i, e) => e.value).get()
                const product_category = $('.product_category').val()
                const product_mrp = $('#product_mrp').val()
                const product_stock = $('#product_stock').val()
                const company_profile = $('.company_profile').val()
                const offer = $('#product_offer').val()

                if (product_name && feature.length >= 1 && desc && product_category && product_mrp && product_stock && company_profile && offer) {

                    $.ajax({
                        url: 'ajax/addItemAjax.php',
                        type: 'POST',
                        data: {
                            product_name,
                            desc,
                            feature,
                            product_mrp,
                            product_stock,
                            product_category,
                            company_profile,
                            offer
                        },
                        success(data) {
                            if (data !== 'Added') {
                                showNotification('Error', 'Please try again...')
                            } else {
                                showData();
                                $('.product-feature-container').html('<input type="text" id="product_feature" class="mb-1 form-control input product_feature">')
                                $('#reset').click()

                                showNotification('Success', 'Product added to database')
                            }
                        }
                    });


                } else {
                    showNotification('Error', 'Please fill all details')
                }
            })
        });
    </script>
</body>

</html>