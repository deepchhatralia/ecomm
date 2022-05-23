<?php
session_start();

if (isset($_SESSION['userlogin'])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Wishlist</title>

        <link rel="stylesheet" href="../css/index/responsive.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <style>
            .productImg {
                width: 12vw !important;
            }

            #liveAlertPlaceholder {
                position: sticky;
                top: 0;
                left: 0;
                right: 0;
                margin-bottom: 20px;
            }
        </style>
    </head>

    <body>
        <?php
        include '../admin/includee/cdn.php';

        include '../database.php';
        $obj = new Database();

        include '../includee/navbar1.php';

        ?>

        <div id="liveAlertPlaceholder"></div>

        <div class="container my-5">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr style="font-size: 2.5vh; text-align: center;">
                            <th scope="col">Product</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="wishlist-body">
                    </tbody>
                </table>
            </div>
        </div>


        <?php
        include '../includee/footer.php';
        ?>

        <!-- jQery -->
        <script src="../js/jquery-3.4.1.min.js"></script>
        <!-- bootstrap js -->
        <script src="../js/bootstrap.js"></script>

        <script>
            $(document).ready(() => {
                var alertPlaceholder = document.getElementById('liveAlertPlaceholder')

                function alert(message, type) {
                    var wrapper = document.createElement('div')
                    wrapper.innerHTML = '<div class="h6 m-0 alert alert-' + type + ' alert-dismissible" role="alert">' + message;

                    alertPlaceholder.append(wrapper)

                    setTimeout(() => {
                        $('#liveAlertPlaceholder').html('')
                    }, 10000);
                }

                function loadWishlist() {
                    $.post({
                        url: "ajax/wishlist.php",
                        data: {
                            operation: "load wishlist"
                        },
                        success(data) {
                            $('.wishlist-body').html(data);
                        }
                    })
                }

                loadWishlist();

                document.addEventListener('click', (e) => {
                    if (e.target && e.target.classList.contains('rm')) {
                        // $('.remove-item-wishlist').click((e) => {
                        const id = e.target.getAttribute("data-id");

                        $.ajax({
                            url: "ajax/wishlist.php",
                            type: "POST",
                            data: {
                                id,
                                operation: "removeItem"
                            },
                            success(data) {
                                if (data == "Removed from wishlist") {
                                    // window.location.reload()
                                    loadWishlist();
                                } else {
                                    alert("Please try again...", 'danger');
                                }
                            }
                        })
                    }

                    if (e.target && e.target.classList.contains('add')) {
                        const id = e.target.getAttribute("data-id");

                        $.ajax({
                            url: "ajax/addToCart.php",
                            type: "POST",
                            data: {
                                id,
                                operation: "addtocart"
                            },
                            beforeSend() {
                                $('.add-to-cart').addClass("disabled");
                            },
                            success(data) {
                                if (data == "Added to Cart") {
                                    $.post({
                                        url: "ajax/wishlist.php",
                                        data: {
                                            id,
                                            operation: "removeItem"
                                        },
                                        success(data) {
                                            alert("Added to Cart", 'success');
                                            loadWishlist();
                                        }
                                    })
                                } else {
                                    alert(data, 'danger')
                                }
                                setTimeout(() => {
                                    $('.add-to-cart').removeClass("disabled");
                                }, 3000);
                            }
                        })
                    }

                    return () => {};
                })
            })
        </script>
    </body>

    </html>

<?php
}
?>