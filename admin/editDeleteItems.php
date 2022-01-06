<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit/Delete Item</title>


    <!-- Tailwind CSS  -->
    <link rel="stylesheet" href="../css/style.css">

    <!-- Bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Main Quill library -->
    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

    <!-- Core build with no theme, formatting, non-essential modules -->
    <link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
    <!-- <script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script> -->


    <style>
        .modal-container {
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            z-index: 100;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            transform: translateY(-100%);
            transition: all 200ms;
        }

        .my-modal {
            background-color: #fff;
            border-radius: 5px;
            padding: 1rem;
            width: 50%;
            height: 75%;
            overflow: auto;
            position: relative;
            box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
            transform: translateY(-100%);
            transition: all 1s ease-out;
        }

        .my-modal::-webkit-scrollbar {
            display: none;
        }

        .my-modal .fa-times {
            font-size: 20px;
            cursor: pointer;
        }

        .save {
            cursor: pointer;
            background-color: rebeccapurple;
            color: #fff;
            padding: 0.3rem 2rem;
            border: none;
        }

        .editBtn,
        .deleteBtn {
            cursor: pointer;
        }

        #editor {
            height: 20vh;
        }
    </style>


</head>

<body>
    <?php
    include 'includee/navbar.php';
    include 'includee/sidebar.php';

    include '../database.php';
    $obj = new Database();

    ?>


    <!-- Toast  -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
            </div>
        </div>
    </div>


    <div class="modal-container my-class">
        <div class="my-modal">
            <div class="close-modal-container d-flex align-items-center justify-content-end">
                <i class="fas fa-times"></i>
            </div>
            <div class="modal-content-container p-3 my-2">
                <h5>Edit</h5>
                <form id="save-form">

                    <div class="mb-3 col-md-10">
                        <label for="product_name">Product Name</label>
                        <input type="text" class="form-control form-controll" name="name" id="product_name">
                    </div>
                    <div class="col-md-10 mb-3">
                        <label for="editor">Description</label>
                        <div>
                            <!-- <div id="toolbar"></div> -->
                            <div id="editor" class="input_desc" name="desc"></div>
                        </div>
                    </div>
                    <div class="col-md-10 mb-3">
                        <label for="product_mrp">MRP</label>
                        <input type="number" class="form-control form-controll" id="product_mrp" name="mrp">
                    </div>
                    <div class="col-md-10 mb-3">
                        <label for="product_price">Price</label>
                        <input type="number" name="price" class="form-control form-controll" id="product_price">
                    </div>
                    <div class="col-md-10 mb-3">
                        <label for="product_stock">Stock</label>
                        <input type="number" name="stock" class="form-control form-controll" id="product_stock">
                    </div>
                    <div class="col-md-10 mb-3">
                        <span style="display: block; font-size: 12px; color: rebeccapurple;" id="product_image"></span>
                        <input type="file" name="productImage" class="form-control" id="product_img">
                    </div>
                    <div class="col-md-10">
                        <button class="save" id="save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="table-responsive table-hover my-5 mx-3">
        <?php
        $result = $obj->select('*', 'products');

        if ($result->num_rows > 0) {
        ?>
            <table class="table">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th>Id</th>
                        <th>Product</th>
                        <th>Description</th>
                        <th>MRP</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $srno = 0;
                    while ($row = $result->fetch_assoc()) {
                        $srno++;
                    ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td>
                                <span data-productId="<?php echo $row['product_id']; ?>" class="srno font-medium"><?php echo $srno; ?></span>
                            </td>
                            <td>
                                <span class="font-medium"><?php echo $row['product_name']; ?></span>
                            </td>
                            <td>
                                <span class="font-medium"><?php echo substr($row['product_desc'], 0, 50) . "..."; ?></span>
                            </td>
                            <td>
                                <span class="font-medium"><?php echo $row['product_mrp']; ?></span>
                            </td>
                            <td>
                                <span class="font-medium"><?php echo $row['product_price']; ?></span>
                            </td>
                            <td>
                                <span class="font-medium"><?php echo $row['product_stock']; ?></span>
                            </td>
                            <td>
                                <div class="flex item-center">
                                    <div class="editBtn w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                    <div class="deleteBtn w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } else {
            echo '<span class="text-5xl font-medium">No Records Found</span>';
        }
        ?>
    </div>


    <script src="../jquery.js"></script>


    <script>
        document.querySelector('.fa-tachometer-alt').parentNode.parentNode.classList.remove('active')
        document.querySelector('.fa-trash-alt').parentNode.parentNode.classList.add('active')

        $(document).ready(() => {
            var toastLiveExample = $('#liveToast')
            var toast = new bootstrap.Toast(toastLiveExample)
            $('#alert-success').hide()

            var toolbarOptions = [
                ['bold', 'italic', 'underline'],
                [{
                    'header': [1, 2, 3, 4, false]
                }],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                [{
                    'size': ['small', false, 'large', 'huge']
                }]
            ]
            var quill = new Quill('#editor', {
                modules: {
                    toolbar: toolbarOptions
                },
                theme: 'snow'
            });

            // Enable all tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Can control programmatically too
            $('.ql-italic').mouseover();
            setTimeout(function() {
                $('.ql-italic').mouseout();
            }, 2500);


            $('.fa-times').click(() => {
                $('.modal-container').css('transform', 'translateY(-100%)')
                $('.my-modal').css('transform', 'translateY(-100%)')
            })

            const editBtn = document.querySelectorAll('.editBtn')
            for (let i = 0; i < editBtn.length; i++) {
                editBtn[i].addEventListener('click', (e) => {
                    productId = e.currentTarget.parentElement.parentElement.parentElement.firstElementChild.firstElementChild.getAttribute('data-productid');

                    $('.modal-container').css('transform', 'translateY(0%)')
                    $('.my-modal').css('transform', 'translateY(0%)')

                    $.ajax({
                        url: "ajax/getDetailsOrSave.php",
                        type: "POST",
                        data: {
                            productId
                        },
                        success(data) {
                            const x = JSON.parse(data)
                            $('#product_name').val(x[0])
                            $('#editor').html(x[1])
                            $('#product_mrp').val(x[2])
                            $('#product_price').val(x[3])
                            $('#product_stock').val(x[4])
                            $('#product_image').html(x[5])
                        }
                    })
                })
            }


            $('#save-form').on('submit', (e) => {
                e.preventDefault()

                const productName = $('#product_name').val()
                const productDesc = quill.root.innerHTML.trim()
                const productMrp = $('#product_mrp').val()
                const productPrice = $('#product_price').val()
                const productStock = $('#product_stock').val()
                const productImage = $('#product_image').val()
                const uploaded_img = $('#product_image').html()

                if (productName !== '' && productMrp !== '' && productPrice !== '' && productStock !== '') {
                    var myFormData = new FormData(document.getElementById('save-form'));
                    myFormData.append('uploaded_img', uploaded_img)
                    myFormData.append('id', productId)

                    $.ajax({
                        url: 'ajax/getDetailsOrSave.php',
                        type: 'POST',
                        processData: false, // important
                        contentType: false, // important
                        data: myFormData,
                        success(data) {
                            $('.modal-container').css('transform', 'translateX(-100%)')
                            $('.my-modal').css('transform', 'translateY(-100%)')

                            $('.toast-body').html('Edited')
                            toast.show()
                            setTimeout(() => {
                                toast.hide()
                            }, 2000);

                            setTimeout(() => {
                                window.location.reload()
                            }, 1000);
                        }
                    })
                } else {
                    const len = $('.form-controll').length
                    if (productDesc == '') {
                        $('#editor').style.border = '1px solid red'
                    } else {
                        for (let i = 0; i < len; i++) {
                            if ($('.form-controll').eq(i).val() == '') {
                                $('.form-controll')[i].style.border = '1px solid #e17055'
                            }
                        }
                    }
                }
            })



            $('.deleteBtn').click((e) => {
                const productId = e.currentTarget.parentElement.parentElement.parentElement.firstElementChild.firstElementChild.getAttribute('data-productid');

                if (confirm('Are you sure to delete ???')) {

                    $.ajax({
                        url: "ajax/deleteProductAjax.php",
                        type: "POST",
                        data: {
                            productId
                        },
                        success(data) {
                            if (data == 'deleted') {
                                $('.toast-body').html('Deleted')
                                toast.show()
                                setTimeout(() => {
                                    toast.hide()
                                    window.location.reload();
                                }, 2000);
                            } else {
                                if (data == 'active order') {
                                    $('.toast-body').html('<strong>Can\'t delete, there are active orders of this product</strong>')
                                    toast.show()
                                    setTimeout(() => {
                                        toast.hide()
                                    }, 4000);
                                } else {
                                    $('.toast-body').html('Try again...')
                                    toast.show()
                                    setTimeout(() => {
                                        toast.hide()
                                    }, 2000);
                                }
                            }
                        }
                    });
                }
            })
        });
    </script>
</body>

</html>