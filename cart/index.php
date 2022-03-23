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
        <title>Cart</title>

        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../css/index/responsive.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

    </head>

    <body>
        <?php
        include '../admin/includee/cdn.php';
        include '../includee/navbar1.php';

        include '../database.php';
        $obj = new Database();
        ?>


        <div class="container my-5 cart-container">
            <div class="row">
                <aside class="col-lg-9">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-borderless table-shopping-cart">
                                <thead class="text-muted">
                                    <tr class="small text-uppercase">
                                        <th scope="col">Product</th>
                                        <th scope="col" width="120">Quantity</th>
                                        <th scope="col" width="120">Price</th>
                                        <!-- <th scope="col" class="text-right d-none d-md-block" width="200"></th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = $obj->select('*', 'cart', "userlogin_userid={$_SESSION['userlogin']}");
                                    $total = 0;

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $productId = $row['product_product_id'];
                                            $result2 = $obj->select('*', 'productt', "product_id=" . $productId);
                                            $row2 = $result2->fetch_assoc();

                                            $result3 = $obj->select('*', 'image', "product_product_id=" . $productId);
                                            $image = $result3->fetch_assoc();


                                            $offerId = $row2['offer_idoffer'];
                                            $price = $row2['product_price'];
                                            if ($offerId != 0) {
                                                $result4 = $obj->select('*', 'offer', "idoffer=" . $offerId);
                                                $offer = $result4->fetch_assoc();

                                                $todaysDate = strtotime(date('Y-m-d'));
                                                $startDate = strtotime($offer['offer_startDate']);
                                                $endDate = strtotime($offer['offer_endDate']);

                                                if (
                                                    $todaysDate >= $startDate && $todaysDate <= $endDate
                                                ) {
                                                    $price = round($price - ($price * $offer['offer_discount'] / 100));
                                                }
                                            }
                                            $total += $row['cart_quantity'] * $price;
                                    ?>
                                            <tr data-id="<?php echo $row2['product_id']; ?>">
                                                <td>
                                                    <figure class="itemside align-items-center">
                                                        <div class="aside">
                                                            <img src="../admin/product/uploads/<?php echo $image['img_path']; ?>" class="img-sm">
                                                        </div>
                                                        <figcaption class="info">
                                                            <a href="http://localhost/ecomm/product/product.php?id=<?php echo $productId; ?>" class="title text-dark" data-abc="true"><?php echo $row2['product_name']; ?></a>
                                                        </figcaption>
                                                    </figure>
                                                </td>
                                                <td>
                                                    <select data-id="<?php echo $productId ?>" class="form-control product-cart-qty">
                                                        <?php
                                                        for ($i = 1; $i <= 10; $i++) {
                                                            if ($i == $row['cart_quantity']) {
                                                                echo '<option selected value="' . $i . '">' . $i . '</option>';
                                                            } else {
                                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                        <!-- <option selected value="<?php //echo $row['cart_quantity']; 
                                                                                        ?>"><?php //echo $row['cart_quantity']; 
                                                                                            ?></option> -->
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="price-wrap">
                                                        <var class="price"><?php echo $row['cart_quantity'] * $price; ?></var>
                                                    </div>
                                                </td>
                                                <td class="text-right">
                                                    <button class="btn btn-danger btn-remove" data-abc="true"> Remove</button>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo '<h5 class="h5 my-3 ml-2">No items in your cart</h5>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </aside>
                <aside class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <dl class="dlist-align">
                                <dt>Total price:</dt>
                                <dd class="text-right ml-3">Rs. <?php echo $total; ?></dd>
                            </dl>
                            <dl class="dlist-align">
                                <dt>Discount:</dt>
                                <dd class="text-right text-danger ml-3">- Rs. 0</dd>
                            </dl>
                            <dl class="dlist-align">
                                <dt>Total:</dt>
                                <dd class="text-right text-dark b ml-3"><strong class="h5 font-bold m-0">Rs. <?php echo $total; ?></strong></dd>
                            </dl>

                            <form action="checkout.php" method="POST">
                                <?php
                                $checkCart = $obj->select('*', 'cart', "userlogin_userid=" . $_SESSION['userlogin']);

                                $disabled = "disabled";
                                if ($checkCart->num_rows > 0) {
                                    $disabled = "dis";
                                }
                                ?>
                                <button type="submit" name="checkout-btn" class="<?php echo $disabled; ?> btn btn-primary w-100 my-1">
                                    <h6 class="h6 m-0">Checkout</h6>
                                </button>
                            </form>
                            <a href="../product/" class="text-light btn btn-success w-100 my-1">
                                <h6 class="h6 m-0">Continue Shopping</h6>
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
        <?php
        include '../includee/footer.php';
        ?>


        <script>
            $(document).ready(() => {
                // $('.checkout-btn').on('click', () => {
                //     window.location.href = "http://localhost/ecomm/cart/checkout.php";
                // })

                $('.btn-remove').on('click', (e) => {
                    const id = e.target.parentElement.parentElement.getAttribute('data-id');

                    const qty = e.target.parentElement.previousElementSibling.previousElementSibling.childNodes[1].value;

                    if (confirm('Are you sure ???')) {
                        $.post({
                            url: "getData.php",
                            data: {
                                id,
                                qty,
                                operation: "removeItem"
                            },
                            success(data) {
                                if (data == "Removed") {
                                    window.location.reload();
                                } else {
                                    alert('Please try again');
                                }
                            }
                        })
                    }
                })

                $('.product-cart-qty').on('change', (e) => {
                    const qty = e.target.value;
                    const productId = e.target.getAttribute("data-id")

                    $.post({
                        url: "getData.php",
                        data: {
                            qty,
                            productId,
                            operation: "update qty from cart"
                        },
                        success(data) {
                            if (data == "updated") {
                                window.location.reload()
                            }
                        }
                    })
                })
            })
        </script>
    </body>

    </html>

<?php
} else {
    include '../pagenotfound.php';
}
