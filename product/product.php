<?php
session_start();
if (!isset($_GET['id'])) {
    include '../pagenotfound.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../css/index/responsive.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">

    <style>
        /* * {
            border: 1px solid black !important;
        } */

        .container {
            font-family: 'Rubik', sans-serif;
        }

        .product-img-container img {
            width: 100%;
            max-width: 100px;
            height: auto;
            /* margin: 0 5px; */
            cursor: pointer;
        }

        .price-container h1 {
            font-weight: 800 !important;
        }

        .desc-container .description {
            font-size: 15px;
            /* height: auto; */
            max-height: 29vh;
            overflow: hidden;
        }

        .view-more-less {
            cursor: pointer;
        }

        #addToCart {
            background-color: rebeccapurple;
            color: #fff;
            letter-spacing: 3px;
            cursor: pointer;
            border: none;
            border-radius: 3px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
        }

        #addToCart:hover {
            transition: all 1s ease;
            box-shadow: none;
            transform: scale(1.01);
        }

        .main-product-img img {
            height: 60vh;
        }

        /* .main-product-img img:hover {
            transform: scale(1.5);
            transition: all 2s;
        }  */


        .fa,
        .far {
            margin-right: 5px;
        }

        .rating .fa,
        .rating .far {
            font-size: 22px;
        }

        .rating-num {
            margin-top: 0px;
            font-size: 60px;
        }

        .progress {
            margin-bottom: 5px;
        }

        .progress-bar {
            text-align: left;
        }

        .rating-desc .col-md-3 {
            padding-right: 0px;
        }

        .sr-only {
            margin-left: 5px;
            overflow: visible;
            clip: auto;
        }

        .feedback-container {
            max-height: 50vh;
            overflow: auto;
        }

        .feedback-date {
            font-size: 12px;
            font-style: italic;
        }

        #liveAlertPlaceholder {
            position: sticky;
            top: 0;
            left: 0;
            right: 0;
            margin-bottom: 20px;
        }
    </style>

    <link type="text/css" rel="stylesheet" href="../magiczoomplus-trial/magiczoomplus/magiczoomplus.css" />

    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
</head>

<body>
    <?php
    include '../admin/includee/cdn.php';
    include '../database.php';
    $obj = new Database();


    $id = $_GET['id'];

    $result = $obj->select('*', 'productt', "product_id=" . $id);

    if ($result->num_rows > 0) {
        include '../includee/navbar1.php';

        $row = $result->fetch_assoc();

        $offerId = $row['offer_idoffer'];

        $price = $row['product_price'];
        if ($offerId != 0) {
            $result = $obj->select('*', 'offer', "idoffer=" . $offerId);
            $row2 = $result->fetch_assoc();

            $price = round($row['product_price'] - ($row['product_price'] * $row2['offer_discount'] / 100));
        }

        $img = $obj->select('*', 'image', "product_product_id=" . $id);

        $arr = [];
        if ($img->num_rows > 0) {

            while ($imgrow = $img->fetch_assoc()) {
                array_push($arr, $imgrow['img_path']);
            }
        }
    ?>

        <div id="liveAlertPlaceholder"></div>


        <div class="container mt-4" style="margin-bottom: 20vh;">
            <div class="row">
                <div class="col-md-6">
                    <div class="main-product-img my-3 d-flex align-items-center justify-content-center">
                        <img src="../admin/product/uploads/<?php echo $arr[0]; ?>" alt="">
                        <!-- <a href="" class="MagicZoom">
                            <img src="../admin/product/uploads/<?php //echo $arr[0]; 
                                                                ?>" />
                        </a> -->
                    </div>

                    <?php
                    if (count($arr) > 1) {
                    ?>
                        <div class="product-img-container d-flex align-items-center justify-content-between flex-wrap">
                            <?php
                            for ($i = 1; $i < count($arr); $i++) {
                            ?>
                                <img src="../admin/product/uploads/<?php echo $arr[$i]; ?>" alt="">
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <div class="col-md">
                    <h2 class="h2 my-3"><?php echo $row['product_name']; ?> <span class="h6">by GDRS</span>
                    </h2>

                    <div class="price-container">
                        <h1 class="h1">Rs. <?php echo $price; ?></h1>
                    </div>

                    <div class="rating-container my-3">
                        <?php
                        $result2 = $obj->select('*', 'rating', 'product_id=' . $id);

                        if ($result2->num_rows > 0) {
                            $rating = 0;
                            while ($row2 = $result2->fetch_assoc()) {
                                $rating = $rating + (int)$row2['rating_star'];
                            }
                            $rating = round($rating / $result2->num_rows);
                            $i = $rating;
                            $j = 5 - $i;
                            while ($i != 0) {
                                echo '<i class="fa fa-star" aria-hidden="true"></i>';
                                $i = $i - 1;
                            }
                            while ($j != 0) {
                                echo '<i class="far fa-star"></i>';
                                $j = $j - 1;
                            }
                        ?>
                            <span class="h5"><?php echo $rating; ?>/5</span>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="d-flex align-items-center justify-content-between">

                    </div>

                    <div>
                        <p class="product-feature"><?php echo $row['product_feature'] ?><br /></p>
                    </div>

                    <div class="addToCart-container">
                        <?php
                        if ($row['product_stock'] < 8) {
                        ?>
                            <h5 class="h5 text-danger">Hurry ! Only 5 left in stock</h5>
                        <?php
                        }
                        ?>

                        <div class="d-flex align-items-center justify-content-center py-2 my-3" id="addToCart">
                            <h4 class="h4 m-0">ADD TO CART</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-md-12 desc-container">
                    <h3 class="h3">Description</h3>

                    <div class="description">
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil quas exercitationem labore aut magnam reprehenderit vero dolorem maxime mollitia incidunt? Sint impedit rerum labore ducimus cumque at doloribus nulla obcaecati, minus Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, ab sed soluta debitis praesentium aut ducimus illo deleniti est tempora iste molestias? Modi asperiores similique vero velit tempora quia illum neque dolor accusantium reprehenderit aspernatur, quis hic reiciendis alias? Quia recusandae vel, ex ut sunt quaerat expedita voluptas quibusdam necessitatibus ipsa rerum aspernatur similique, sit amet nulla quo minima unde ipsum odit modi eligendi accusantium ducimus itaque. Libero, corrupti explicabo. Nihil totam omnis consectetur dolores est, excepturi repudiandae molestias eveniet vero illum alias ut, esse enim corporis maxime aperiam dignissimos nam rerum earum explicabo tempora! Ut enim dignissimos, dolores minima reiciendis totam voluptatibus eum, itaque inventore, aut recusandae! Quod dolorem eligendi veritatis ipsa sapiente enim dolore ex, ratione deserunt molestias quasi natus nisi possimus, odit incidunt error saepe quisquam beatae officiis explicabo at laboriosam reiciendis. Ut voluptatem ab, aspernatur voluptas non eos optio aliquid labore porro, accusamus a omnis reprehenderit. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque, animi provident id voluptatibus minima impedit at, nobis nisi possimus ut amet tempora quia totam eius repellendus mollitia ad consectetur labore nostrum deserunt magnam delectus. Veritatis exercitationem, commodi repellendus eos dolor qui asperiores, deleniti error quis fugiat, quam aperiam fuga magnam impedit amet tenetur animi eveniet incidunt ipsam. Nihil fugit repellendus impedit temporibus voluptates tempora rerum doloribus laudantium officia tenetur quod ipsum placeat non ex maiores doloremque reiciendis cum aliquam deserunt, eveniet culpa aperiam neque totam voluptate? Soluta quos voluptas adipisci iste quas deserunt enim, modi, libero nemo reiciendis perspiciatis alias.</p>
                    </div>

                    <div class="d-flex align-items-center justify-content-center my-2">
                        <h6 class="h6 view-more-less view-more">MORE <i class="fas fa-arrow-down"></i></h6>
                    </div>
                </div>
            </div>

            <?php
            $five = 0;
            $four = 0;
            $three = 0;
            $two = 0;
            $one = 0;
            $result3 = $obj->select('*', "rating", "product_id=" . $id);

            if ($result3->num_rows > 0) {
                while ($row3 = $result3->fetch_assoc()) {
                    if ($row3['rating_star'] == '5') {
                        $five += 1;
                    }
                    if ($row3['rating_star'] == '4') {
                        $four += 1;
                    }
                    if ($row3['rating_star'] == '3') {
                        $three += 1;
                    }
                    if ($row3['rating_star'] == '2') {
                        $two += 1;
                    }
                    if ($row3['rating_star'] == '1') {
                        $one += 1;
                    }
                }
                // echo $five . "<br/>" . $four . "<br/>" . $three . "<br/>" . $two . "<br/>" . $one . "<br/><br/>";

                $five = round($five * 100 / $result3->num_rows);
                $four = round($four * 100 / $result3->num_rows);
                $three = round($three * 100 / $result3->num_rows);
                $two = round($two * 100 / $result3->num_rows);
                $one = round($one * 100 / $result3->num_rows);

                $ratingArr = [$five, $four, $three, $two, $one];
            }
            // echo $five . "<br/>" . $four . "<br/>" . $three . "<br/>" . $two . "<br/>" . $one;
            ?>
            <div class="row">
                <div class="col-md-6">
                    <h2 class="h2 mb-5">Rating</h2>
                    <div class="well well-sm">
                        <?php
                        if ($result3->num_rows > 0) {
                        ?>
                            <div class="row mb-5">
                                <div class="col-xs-12 col-md-6">
                                    <div class="row rating-desc mx-1">
                                        <?php
                                        for ($val = 0; $val < count($ratingArr); $val++) {
                                        ?>
                                            <div class="col-xs-3 col-md-3 text-right">
                                                <span class="fa fa-star"></span><?php echo count($ratingArr) - $val; ?>
                                            </div>
                                            <div class="col-xs-8 col-md-9">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $ratingArr[$val]; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $ratingArr[$val]; ?>%">
                                                        <?php echo $ratingArr[$val]; ?>%
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                    <!-- end row -->
                                </div>
                                <div class="col-xs-12 col-md-6 text-center">
                                    <h1 class="rating-num"><?php echo $rating; ?></h1>
                                    <div class="rating">
                                        <?php
                                        $i = round($rating);
                                        $j = 5 - $i;

                                        while ($i != 0) {
                                            echo '<i class="fa fa-star" aria-hidden="true"></i>';
                                            $i = $i - 1;
                                        }
                                        while ($j != 0) {
                                            echo '<i class="far fa-star"></i>';
                                            $j = $j - 1;
                                        }
                                        ?>
                                    </div>
                                    <div>
                                        <span class="fa fa-user"></span><?php echo $result2->num_rows; ?> total votes
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                            echo "No ratings yet";
                        }
                        ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <h2 class="h2 mb-5">Feedback</h2>
                    <div class="row feedback-container">

                        <?php
                        $result3 = $obj->select('*', 'feedback', "product_id=" . $id);
                        if ($result3->num_rows > 0) {
                            while ($row3 = $result3->fetch_assoc()) {
                                $user = $obj->select('*', 'userlogin', "userid=" . $row3['userlogin_userid']);
                                $user = $user->fetch_assoc();
                        ?>
                                <div class="col-md-12 mb-2 d-flex">
                                    <div class="mr-3">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <div class="d-flex">
                                            <h6 class="h6 m-0"><?php echo $user['user_firstname'] . " " . $user['user_lastname']; ?></h6>
                                            <span class="feedback-date ml-4 text-muted"><?php echo $row3['date']; ?></span>
                                        </div>
                                        <p style="font-size: 15px;"><?php echo $row3['feedback']; ?></p>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo '<h6 class="h6">No feedbacks yet</h6>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>



        <?php
        include '../includee/footer.php';
        ?>

        <script src="../js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="../magiczoomplus-trial/magiczoomplus/magiczoomplus.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


        <script>
            $(document).ready(() => {

                var alertPlaceholder = document.getElementById('liveAlertPlaceholder')
                var alertTrigger = document.getElementById('liveAlertBtn')

                function alert(message, type) {
                    var wrapper = document.createElement('div')
                    wrapper.innerHTML = '<div class="h6 m-0 alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close close-alert" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                    alertPlaceholder.append(wrapper)
                }

                $('.view-more-less').click(() => {

                    if ($('.view-more-less').hasClass("view-more")) {
                        $('.description').css("max-height", "auto")
                        $('.view-more-less').html('LESS <i class="fas fa-arrow-up"></i>')

                        $('.view-more-less').removeClass('view-more')
                        $('.view-more-less').addClass('view-less')
                    } else {
                        $('.description').css("max-height", "29vh")
                        $('.view-more-less').html('MORE <i class="fas fa-arrow-down"></i>')

                        $('.view-more-less').removeClass('view-less')
                        $('.view-more-less').addClass('view-more')
                    }
                })

                $('#addToCart').on('click', () => {
                    let url = window.location.href
                    url = new URL(url);
                    const id = url.searchParams.get("id");

                    $.ajax({
                        url: "ajax/addToCart.php",
                        type: "POST",
                        data: {
                            id,
                            operation: "addtocart"
                        },
                        beforeSend() {
                            console.log('hello world');
                        },
                        success(data) {
                            if (data) {
                                alert(data, 'success')
                                setTimeout(() => {
                                    alertPlaceholder.innerHTML = '';
                                }, 3000);
                            } else {
                                alert('Please login to continue', 'danger')
                                setTimeout(() => {
                                    alertPlaceholder.innerHTML = '';
                                }, 3000);
                            }
                        }
                    })
                })
            })
        </script>

    <?php
    } else {
        include '../pagenotfound.php';
    }
    ?>
</body>

</html>