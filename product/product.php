<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>

    <!-- Font Awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</head>

<?php
session_start();
include '../database.php';
$obj = new Database();

// Navbar 
include '../includee/navbar.php';

if (isset($_GET['q'])) {
    $id = (int)$_GET['q'];
?>


    <body>
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body">
                </div>
            </div>
        </div>

        <!-- Navbar  -->
        <?php

        $result = $obj->select('*', 'product', "product_id = '{$id}'");
        $result2 = $obj->select('img_path','image',"product_product_id == {$id}");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }
        ?>

        <div class="container-fluid fluid-two mt-5 mb-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 d-flex flex-column">
                        <div class="main-image-container">
                            <img src="../upload_img/<?php echo $result2; ?>" id="mainImg" alt="">
                        </div>

                        <div class="other-images-container row my-3">
                            <div class="col-md-2">
                                <div><img src="../upload_img/hello.jpg" alt=""></div>
                            </div>
                            <div class="col-md-2">
                                <div><img src="../upload_img/hello.jpg" alt=""></div>
                            </div>
                            <div class="col-md-2">
                                <div><img src="../upload_img/hello.jpg" alt=""></div>
                            </div>
                            <div class="col-md-2">
                                <div><img src="../upload_img/hello.jpg" alt=""></div>
                            </div>
                            <div class="col-md-2">
                                <div><img src="../upload_img/hello.jpg" alt=""></div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-5 offset-md-1">
                        <div>
                            <h1><?php echo $row['product_feature_idproduct_feature']; ?></h1>
                            <p class="my-4"><?php echo $row['product_desc']; ?></p>
                        </div>
                        <hr>
                        <div class="my-3 d-flex justify-content-around">
                            <h6>M.R.P : <span id="mrp">₹ <?php echo $row['product_mrp']; ?></span></h6>
                            <h6>Price : <span id="price">₹ <?php echo $row['product_price']; ?></span></h6>
                            <?php
                            $save = $row['product_mrp'] - $row['product_price'];
                            ?>
                            <h6>You Save : ₹ <?php echo $save; ?></h6>
                        </div>
                        <p style="font-weight: 480; text-align:center;">FREE Delivery in Ahmedabad</p>


                        <div class="cod-container">
                            <div class="mx-3 d-flex flex-column align-items-center">
                                <img src="https://images-na.ssl-images-amazon.com/images/G/31/A2I-Convert/mobile/IconFarm/icon-cod._CB485937110_.png" alt="" id="cod">
                                <p>Cash on Delivery</p>
                            </div>
                            <div class="mx-3 d-flex flex-column align-items-center">
                                <img src="https://images-na.ssl-images-amazon.com/images/G/31/A2I-Convert/mobile/IconFarm/icon-returns._CB484059092_.png" alt="" id="replacement">
                                <p>7 Days Replacement</p>
                            </div>
                        </div>

                        <div class="rating-container mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <img class="mr-1 rate-icon" src="https://img.icons8.com/ios/30/000000/star--v2.png" alt="" />
                                <img class="mx-1 rate-icon" src="https://img.icons8.com/ios/30/000000/star--v2.png" alt="" />
                                <img class="mx-1 rate-icon" src="https://img.icons8.com/ios/30/000000/star--v2.png" alt="" />
                                <img class="mx-1 rate-icon" src="https://img.icons8.com/ios/30/000000/star--v2.png" alt="" />
                                <img class="mx-1 rate-icon" src="https://img.icons8.com/ios/30/000000/star--v2.png" alt="" />
                            </div>
                            <div>
                                <h6>Rating : 4.6</h6>
                            </div>
                        </div>



                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <button type="submit" name="addToCart" class="buy w-100 btn addToCart-btn btn-success">ADD TO CART</button>
                        </form>

                        <div class="mt-4 mb-2 feedback-container">
                            <h5>Reviews</h5>
                            <?php
                            $result = $obj->select('*','feedback',"product_id='{$id}'");
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    $id = $row['user_id'];
                                    $result2 = $obj->select('*','userlogin',"user_id={$id}");
                                    $row2 = $result2->fetch_assoc();
                            ?>
                            <div class="mb-2">
                                <div class="user-profile d-flex align-items-center mt-2">
                                    <i style="font-size: 30px;" class="mr-3 fa fa-user"></i>
                                    <h6><?php echo $row2['user_fullname']; ?></h6>
                                </div>
                                <p style="font-style: italic;"><?php echo $row['date']; ?></p>
                                <p><?php echo $row['feedback']; ?></p>
                            </div>
                            <?php
                                }
                            }else{
                                echo 'No reviews';
                            }
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Jquery -->
        <script src="../jquery.js"></script>

        <script>
            $(document).ready(() => {
                const addToCart = document.querySelector('.addToCart-btn')
                let click = 0

                addToCart.addEventListener('click', (e) => {
                    click += 1
                    e.preventDefault()
                    let id = '<?php echo $id; ?>'

                    $.ajax({
                        url: "addToCartAjax.php",
                        type: "POST",
                        data: {
                            id
                        },
                        success(data) {
                            if (click == 1) {
                                var toastTrigger = document.getElementById('liveToastBtn')
                                var toastLiveExample = document.getElementById('liveToast')
                                var toast = new bootstrap.Toast(toastLiveExample)
                                $('.toast-body').html(data)
                                toast.show()
                                setTimeout(() => {
                                    toast.hide()
                                    click = 0
                                }, 4000);
                            }
                        }
                    })
                })
            })

            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }

            const container = document.querySelector('.main-image-container');
            const img = document.getElementById('mainImg');

            container.addEventListener('mousemove', (e) => {
                const x = e.clientX - e.target.offsetLeft;
                const y = e.clientY - e.target.offsetTop;

                img.style.transformOrigin = `${x}px ${y}px`;
                img.style.transform = "scale(3)";
            });

            container.addEventListener('mouseleave', () => {
                img.style.transform = 'center center';
                img.style.transform = "scale(1)";
            });
        </script>




    </body>

</html>

<?php
} else {
    echo '<h1>Page not found</h1>';
}
?>