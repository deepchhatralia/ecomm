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

        $result = $obj->select('*', 'wishlist', "userlogin_userid=" . $_SESSION['userlogin']);
        if ($result->num_rows > 0) {
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
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                $productId = $row['product_id'];
                                $result2 = $obj->select('*', 'image', 'product_product_id=' . $productId);
                                $img = "";
                                if ($result2->num_rows > 0) {
                                    $img = $result2->fetch_assoc();
                                    $img = $img['img_path'];
                                }
                                $result2 = $obj->select('*', 'productt', "product_id=" . $productId);
                                $productname = "";
                                if ($result2->num_rows > 0) {
                                    $productname = $result2->fetch_assoc();
                                    $productname = $productname['product_name'];
                                }
                                echo '<tr>
                                    <td class="d-flex align-items-center">
                                        <img class="mr-5 productImg" src="../admin/product/uploads/' . $img . '" alt="" />
                                        <h4 class="h4 m-0">' . $productname . '</h4>
                                    </td>
                                    <td class="text-center">
                                        <button class="add-to-cart btn btn-success" data-id="' . $productId . '"><i data-id="' . $productId . '" class="fa-solid fa-cart-arrow-down"></i></button>
                                        <button class="remove-item-wishlist m-0 btn btn-danger" data-id="' . $productId . '"><i data-id="' . $productId . '" class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php
        } else {
            echo '<div class="container my-5">
                <h4 class="h4">No items in your wishlist</h4>
            </div>';
        }
        ?>


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
                    }, 3000);
                }

                $('.remove-item-wishlist').click((e) => {
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
                                window.location.reload()
                            } else {
                                alert("Please try again...", 'danger');
                            }
                        }
                    })
                })

                $('.add-to-cart').on('click', (e) => {
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
                            if (data) {
                                alert(data, 'success')
                            } else {
                                alert(data, 'danger')
                            }
                            setTimeout(() => {
                                $('.add-to-cart').removeClass("disabled");
                            }, 3000);
                        }
                    })
                })
            })
        </script>
    </body>

    </html>

<?php
}
?>