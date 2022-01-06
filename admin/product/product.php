<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>

    <link rel="stylesheet" href="css/product.css">

<body>

    <?php

    include '../includee/cdn.php';
    include '../includee/navbar.php';
    include '../includee/sidebar.php';
    include '../notification.php';

    include '../../database.php';
    $obj = new Database();

    $result = $obj->select('*', 'product');

    ?>

    <div class="my-modal">
        <div class="my-modal-container">
            <div class="my-modal-header">
                <i class="fas fa-times close-my-modal" id="close-my-modal"></i>
            </div>
            <div>
                <form>
                    <div class="row">
                        <input type="text" id="modal_product_id" style="display: none;">
                        <div class="col-md-12 mb-3">
                            <label for="modal_product_name">Product Name</label>
                            <input name="name" id="modal_product_name" type="text" class="form-control input">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="modal_editor">Feature</label>
                            <textarea name="content" id="modal_editor"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <?php
                            $result = $obj->select('*', 'product_category');
                            if ($result->num_rows > 0) {
                                echo '<select class="form-select modal_product_category input"  name="category">';
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
                            <?php
                            $result = $obj->select('*', 'company_profile');
                            if ($result->num_rows > 0) {
                                echo '<select class="form-select modal_company_profile my-2 input" name="company_profile">';
                                echo '<option disabled selected>Company</option>';
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['idcompany_profile'] . '">' . $row['company_name'] . '</option>';
                                }
                                echo '</select>';
                            }
                            ?>
                        </div>
                        <div class="col-md-12 mb-2">
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
                    <div class="row upate-btn-container">
                        <div class="col-md-3">
                            <button class="w-100 btn btn-primary update-item-btn">Update</button>
                        </div>
                    </div>
                </form>
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
                                <table style="text-align: center;" id="order-listing" class="table">
                                    <thead>
                                        <tr>
                                            <th>Product ID</th>
                                            <th>Name</th>
                                            <th class="feature-col">Feature's</th>
                                            <th>Price</th>
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
            echo '<div class="container my-5"><h4>Inventory Empty</h4></div>';
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
                <label for="feature" class="col-sm-2 col-form-label">Feature</label>
                <!-- <div class="col-sm-10">
                    <textarea class="form-control" id="editor" rows="4"></textarea>
                </div> -->
                <div class="col-sm-10">
                    <textarea name="content" id="editor"></textarea>
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
                <div class="col-md-2">
                    <button class="btn btn-primary add-item-btn w-100">Add</button>
                </div>
            </div>
        </form>
    </div>

    <script src="../jquery.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <script>
        document.querySelector('.fa-tachometer-alt').parentNode.parentNode.classList.remove('active')
        document.querySelector('.fa-plus-square').parentNode.parentNode.classList.add('active')

        $(document).ready(() => {
            showData();
            $('.my-modal').fadeOut(1)

            var editor, modal_editor;

            ClassicEditor
                .create(document.getElementById('editor'), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
                    heading: {
                        options: [{
                                model: 'paragraph',
                                title: 'Paragraph',
                                class: 'ck-heading_paragraph'
                            },
                            {
                                model: 'heading1',
                                view: 'h1',
                                title: 'Heading 1',
                                class: 'ck-heading_heading1'
                            },
                            {
                                model: 'heading2',
                                view: 'h2',
                                title: 'Heading 2',
                                class: 'ck-heading_heading2'
                            }
                        ]
                    }
                })
                .then(newEditor => {
                    editor = newEditor;
                })
                .catch(error => {
                    console.error(error);
                });


            $('.update-item-btn').click((e) => {
                e.preventDefault()
                const id = $('#modal_product_id').val()
                const name = $('#modal_product_name').val()
                const product_feature = modal_editor.getData()
                const category = $('.modal_product_category').val()
                const price = $('#modal_product_mrp').val()
                const stock = $('#modal_product_stock').val()
                const company = $('.modal_company_profile').val()
                const offer = $('#modal_product_offer').val()

                $.ajax({
                    url: "showData/getData.php",
                    type: "POST",
                    data: {
                        id,
                        name,
                        product_feature,
                        category,
                        price,
                        stock,
                        company,
                        offer,
                        operation: 'update'
                    },
                    success(data) {
                        if (data) {
                            $('.my-modal').fadeOut(1)
                            showData()
                            showNotification('Success', 'Product details updated')
                            modal_editor.destroy()
                        } else {
                            showNotification('Error', 'Try again...')
                        }
                    }
                })
            })

            document.addEventListener('click', (e) => {
                if (e.target && e.target.id == 'fa-edit') {
                    const id = e.target.parentNode.parentNode.firstChild.nextSibling.innerText;

                    ClassicEditor
                        .create(document.getElementById('modal_editor'), {
                            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
                            heading: {
                                options: [{
                                        model: 'paragraph',
                                        title: 'Paragraph',
                                        class: 'ck-heading_paragraph'
                                    },
                                    {
                                        model: 'heading1',
                                        view: 'h1',
                                        title: 'Heading 1',
                                        class: 'ck-heading_heading1'
                                    },
                                    {
                                        model: 'heading2',
                                        view: 'h2',
                                        title: 'Heading 2',
                                        class: 'ck-heading_heading2'
                                    }
                                ]
                            }
                        })
                        .then(newEditor => {
                            modal_editor = newEditor;
                        })
                        .catch(error => {
                            console.error(error);
                        });

                    $('.my-modal').fadeIn(600)

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
                            modal_editor.setData(x[7])
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

                if (e.target && e.target.id == 'close-my-modal') {
                    modal_editor.destroy()
                    $('.my-modal').fadeOut(600)
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

            $('#alert-success').hide()

            var toastTrigger = document.getElementById('liveToastBtn')
            var toastLiveExample = document.getElementById('liveToast')

            $('#myForm').on('submit', (e) => {
                e.preventDefault();
                const input = $('.input')
                const product_name = $('#product_name').val()
                const product_feature = editor.getData();
                const product_category = $('.product_category').val()
                const product_mrp = $('#product_mrp').val()
                const product_stock = $('#product_stock').val()
                const company_profile = $('.company_profile').val()
                const offer = $('#product_offer').val()

                if (product_name && product_feature !== '<p?><br></p>' && product_category && product_mrp && product_stock && company_profile && offer) {
                    $.ajax({
                        url: 'ajax/addItemAjax.php',
                        type: 'POST',
                        data: {
                            product_name,
                            product_feature,
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
                                editor.setData('')
                                $('#product_name').val('')
                                $('#product_mrp').val('')
                                $('.product_category').val('Select category')
                                $('#product_stock').val('')
                                $('.company_profile').val('Company')
                                $('#product_offer').val('Select offer')

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