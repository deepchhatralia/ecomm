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

                                                $price = round($row2['product_price'] - ($row2['product_price'] * $offer['offer_discount'] / 100));
                                            }
                                            $total += $row['cart_quantity'] * $price;
                                    ?>
                                            <tr data-id="<?php echo $row2['product_id']; ?>">
                                                <td>
                                                    <figure class="itemside align-items-center">
                                                        <div class="aside">
                                                            <img src="../admin/product/uploads/<?php echo $image['img_path']; ?>" class="img-sm">
                                                        </div>
                                                        <figcaption class="info"> <a href="#" class="title text-dark" data-abc="true"><?php echo $row2['product_name']; ?></a>
                                                        </figcaption>
                                                    </figure>
                                                </td>
                                                <td>
                                                    <select class="form-control">
                                                        <option selected value="<?php echo $row['cart_quantity']; ?>"><?php echo $row['cart_quantity']; ?></option>
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
                    <div class="card mb-3">
                        <div class="card-body">
                            <form>
                                <div class="form-group"> <label>Have coupon?</label>
                                    <div class="input-group"> <input type="text" class="form-control coupon" name="" placeholder="Coupon code"> <span class="input-group-append"> <button class="btn btn-primary btn-apply coupon">Apply</button> </span> </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
                                <dd class="text-right text-dark b ml-3"><strong>Rs. <?php echo $total; ?></strong></dd>
                            </dl>

                            <button class="btn btn-primary w-100 my-1">
                                <h6 class="h6 m-0">Checkout</h6>
                            </button>
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
                $('.btn-remove').on('click', (e) => {
                    const id = e.target.parentElement.parentElement.getAttribute('data-id');

                    if (confirm('Are you sure ???')) {
                        $.ajax({
                            url: "getData.php",
                            type: "POST",
                            data: {
                                id,
                                operation: "removeItem"
                            },
                            success(data) {
                                if (data) {
                                    window.location.reload()
                                } else {
                                    alert('Please try again')
                                }
                            }
                        })
                    }
                })
            })
        </script>
    </body>

    </html>

<?php
} else {
    include '../pagenotfound.php';
}