<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offer</title>

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
            <div class="containerr my-5">
                <input type="text" id="modal-offer-id" style="display: none;">
                <div class="row mb-3">
                    <label for="modal-offer-name" class="col-sm-2 col-form-label">Offer Name :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="modal-offer-name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="modal-offer_editor" class="col-sm-2 col-form-label">Offer Detail :</label>
                    <div class="col-sm-10">
                        <textarea name="content" id="modal-offer_editor"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="modal-start-date" class="form-label">Start Date :</label>
                        <input type="date" class="form-control" id="modal-start-date">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="modal-end-date" class="form-label">End Date :</label>
                        <input type="date" class="form-control" id="modal-end-date">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="modal-discount" class="col-sm-2 col-form-label">Offer Discount :</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="modal-discount">
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-md-2">
                        <button class="btn btn-primary w-100" id="update-offer-btn">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="main-panel container my-5">
        <?php
        $result = $obj->select('*', 'offer');
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
                                            <th>Offer ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Discount</th>
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
            echo '<div class="container my-5"><h4>No Offers</h4></div>';
        }
        ?>
    </div>

    <div class="container my-5">
        <div class="row mb-3">
            <label for="offer-name" class="col-sm-2 col-form-label">Offer Name :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="offer-name">
            </div>
        </div>
        <div class="row mb-3">
            <label for="feature" class="col-sm-2 col-form-label">Offer Detail :</label>
            <div class="col-sm-10">
                <textarea name="content" id="offer_editor"></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <label for="start-date" class="form-label">Start Date :</label>
                <input type="date" class="form-control" id="start-date">
            </div>
            <div class="col-md-6 mb-3">
                <label for="end-date" class="form-label">End Date :</label>
                <input type="date" class="form-control" id="end-date">
            </div>
        </div>
        <div class="row mb-3">
            <label for="discount" class="col-sm-2 col-form-label">Offer Discount :</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="discount">
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-md-2">
                <button class="btn btn-primary w-100" id="add-offer-btn">Add</button>
            </div>
        </div>
    </div>

    <!-- CKEditor  -->
    <!-- <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/12.3.1/classic/ckeditor.js"></script> -->



    <script>
        document.querySelector('.fa-tachometer-alt').parentNode.parentNode.classList.remove('active')
        document.querySelector('.fa-plus-square').parentNode.parentNode.classList.add('active')

        $(document).ready(() => {
            showData();
            $('.my-modal').fadeOut(1)

            var editor, modal_editor;
            ClassicEditor
                .create(document.getElementById('offer_editor'), {
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

            $('#alert-success').hide()

            var toastTrigger = document.getElementById('liveToastBtn')
            var toastLiveExample = document.getElementById('liveToast')

            $('#add-offer-btn').click(() => {
                const name = $('#offer-name').val()
                const desc = editor.getData()
                const startDate = $('#start-date').val()
                const endDate = $('#end-date').val()
                const discount = $('#discount').val()

                if (name && desc && startDate && endDate && discount) {
                    $.ajax({
                        url: "ajax/addOffer.php",
                        type: "POST",
                        data: {
                            name,
                            desc,
                            startDate,
                            endDate,
                            discount
                        },
                        beforeSend() {
                            console.log(name, startDate, endDate, discount);
                        },
                        success(data) {
                            if (data == 'Added') {
                                $('#offer-name').val('')
                                editor.setData(' ')
                                $('#start-date').val('')
                                $('#end-date').val('')
                                $('#discount').val('')

                                showData()
                                showNotification('Success', 'Offer added to database')
                            } else {
                                console.log(data);
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

                    if (id !== '0') {
                        ClassicEditor
                            .create(document.getElementById('modal-offer_editor'), {
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
                            url: "showData/getOffer.php",
                            type: "POST",
                            data: {
                                id,
                                operation: 'select'
                            },
                            success(data) {
                                const x = JSON.parse(data)

                                $('#modal-offer-id').val(id)
                                $('#modal-offer-name').val(x[1])
                                modal_editor.setData(x[2])
                                $('#modal-start-date').val(x[3])
                                $('#modal-end-date').val(x[4])
                                $('#modal-discount').val(x[5])
                                console.log(x[0]);
                            }
                        })
                    }
                }

                if (e.target && e.target.id == 'fa-trash-alt') {
                    const id = e.target.parentNode.parentNode.firstChild.nextSibling.innerText;
                    if (id !== '0') {
                        if (confirm('Are you sure you want to delete the record ???')) {
                            $.ajax({
                                url: "showData/getOffer.php",
                                type: "POST",
                                data: {
                                    id: id,
                                    operation: 'delete'
                                },
                                success(data) {
                                    if (data) {
                                        showNotification('Success', 'Offer deleted from database')
                                        showData()
                                    } else {
                                        showNotification('Error', 'Please try again...')
                                    }
                                }
                            })
                        }
                    } else {
                        showNotification('Error', 'Sorry, can\'t delete')
                    }
                }

                if (e.target && e.target.id == 'close-my-modal') {
                    $('.my-modal').fadeOut(600)
                    modal_editor.destroy()
                }

            })

            $('#update-offer-btn').click((e) => {
                e.preventDefault()
                const id = $('#modal-offer-id').val()
                const name = $('#modal-offer-name').val()
                const desc = modal_editor.getData()
                const startDate = $('#modal-start-date').val()
                const endDate = $('#modal-end-date').val()
                const discount = $('#modal-discount').val()

                if (id && name && desc && startDate && endDate && discount) {
                    $.ajax({
                        url: "showData/getOffer.php",
                        type: "POST",
                        data: {
                            id,
                            name,
                            desc,
                            startDate,
                            endDate,
                            discount,
                            operation: 'update'
                        },
                        success(data) {
                            if (data) {
                                $('.my-modal').fadeOut(1)
                                modal_editor.destroy()
                                showData()
                                showNotification('Success', 'Product details updated')
                            } else {
                                showNotification('Error', 'Try again...')
                            }
                        }
                    })
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
                    url: "showData/showOffer.php",
                    success(data) {
                        $('tbody').html(data)
                    }
                })
            }
        })
    </script>
</body>

</html>
