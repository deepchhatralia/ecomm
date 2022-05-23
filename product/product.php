<?php
session_start();
if (!isset($_GET['id'])) {
    include '../pagenotfound.php';
} else {
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

            .feedback-input {
                border-bottom: 1px solid gray;
                padding: 10px 7px;
                margin-bottom: 10px;
            }

            .feedback-input:focus {
                outline: none;
            }

            .feedback-input::placeholder {
                color: gray;
            }

            #submit-feedback {
                margin-bottom: 10px;
                padding: 0 10px;
                border-bottom: 1px solid gray;
            }

            #submit-feedback:hover {
                background-color: lightgray;
                transition: all 600ms ease;
                font-weight: 800;
            }

            .rating {
                float: left;
            }

            /* :not(:checked) is a filter, so that browsers that don’t support :checked don’t 
   follow these rules. Every browser that supports :checked also supports :not(), so
   it doesn’t make the test unnecessarily selective */
            .rating:not(:checked)>input {
                position: absolute;
                top: -9999px;
                clip: rect(0, 0, 0, 0);
            }

            .rating:not(:checked)>label {
                float: right;
                width: 1em;
                padding: 0 .1em;
                overflow: hidden;
                white-space: nowrap;
                cursor: pointer;
                font-size: 200%;
                line-height: 1.2;
                color: #ddd;
                text-shadow: 1px 1px #bbb, 2px 2px #666, .1em .1em .2em rgba(0, 0, 0, .5);
            }

            .rating:not(:checked)>label:before {
                content: '★ ';
            }

            .rating>input:checked~label {
                color: #f70;
                text-shadow: 1px 1px #c60, 2px 2px #940, .1em .1em .2em rgba(0, 0, 0, .5);
            }

            .rating:not(:checked)>label:hover,
            .rating:not(:checked)>label:hover~label {
                color: gold;
                text-shadow: 1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0, 0, 0, .5);
            }

            .rating>input:checked+label:hover,
            .rating>input:checked+label:hover~label,
            .rating>input:checked~label:hover,
            .rating>input:checked~label:hover~label,
            .rating>label:hover~input:checked~label {
                color: #ea0;
                text-shadow: 1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0, 0, 0, .5);
            }

            .rating>label:active {
                position: relative;
                top: 2px;
                left: 2px;
            }

            /* end of Lea's code */

            /*
 * Clearfix from html5 boilerplate
 */

            .clearfix:before,
            .clearfix:after {
                content: " ";
                /* 1 */
                display: table;
                /* 2 */
            }

            .clearfix:after {
                clear: both;
            }

            /*
 * For IE 6/7 only
 * Include this rule to trigger hasLayout and contain floats.
 */

            .clearfix {
                *zoom: 1;
            }

            /* my stuff */
            #status,
            button {
                margin: 20px 0;
            }
        </style>

        <!-- <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> -->
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

            $productDesc = $row['product_desc'];
            $offerId = $row['offer_idoffer'];

            $price = $row['product_price'];
            if ($offerId != 0) {
                $result = $obj->select('*', 'offer', "idoffer=" . $offerId);
                $row2 = $result->fetch_assoc();

                $todaysDate = strtotime(date('Y-m-d'));
                $startDate = strtotime($row2['offer_startDate']);
                $endDate = strtotime($row2['offer_endDate']);

                if ($todaysDate >= $startDate && $todaysDate <= $endDate) {
                    $price = round($row['product_price'] - ($row['product_price'] * $row2['offer_discount'] / 100));
                }
            }

            $img = $obj->select('*', 'image', "product_product_id=" . $id);

            $company = $obj->select('*', 'company_profile', "idcompany_profile=" . $row['company_profile_idcompany_profile']);
            if ($company->num_rows > 0) {
                $companyRow = $company->fetch_assoc();
                $company = $companyRow['company_name'];
            } else {
                $company = "";
            }

            $arr = [];
            $imgId = [];
            if ($img->num_rows > 0) {

                while ($imgrow = $img->fetch_assoc()) {
                    array_push($imgId, $imgrow['idimage']);
                    array_push($arr, $imgrow['img_path']);
                }
            }
        ?>

            <div id="liveAlertPlaceholder"></div>

            <div class="container mt-4" style="margin-bottom: 20vh;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="main-product-img my-3 d-flex align-items-center justify-content-center">
                            <img data-id="<?php echo $imgId[0]; ?>" class="other-img" src="../admin/product/uploads/<?php echo $arr[0]; ?>" alt="">
                        </div>

                        <?php
                        if (count($arr) > 1) {
                        ?>
                            <div class="product-img-container d-flex align-items-center justify-content-between flex-wrap">
                                <?php
                                for ($i = 1; $i < count($arr); $i++) {
                                ?>
                                    <img data-id="<?php echo $imgId[$i]; ?>" class="other-img" src="../admin/product/uploads/<?php echo $arr[$i]; ?>" alt="">
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="col-md">
                        <div class="d-flex align-items-center justify-content-between">

                            <h2 class="h2 my-3">
                                <?php echo $row['product_name']; ?> <span class="h6"><?php echo "by " . $company; ?></span>
                            </h2>
                            <?php
                            if (isset($_SESSION['userlogin'])) {
                                $wishlist = $obj->select('*', 'wishlist', 'product_id=' . $row['product_id'] . ' AND userlogin_userid=' . $_SESSION['userlogin']);

                                if ($wishlist->num_rows > 0) {
                                    echo '<h5 data-id="' . $row['product_id'] . '" class="h5 fs-3 m-0 heart-container"><i id="full-heart" class="fas fa-heart m-0 cursor-pointer"></i></h5>';
                                } else {
                                    echo '<h5 data-id="' . $row['product_id'] . '" class="h5 fs-3 m-0 heart-container"><i id="empty-heart" class="far fa-heart m-0 cursor-pointer"></i></h5>';
                                }
                            }
                            ?>
                        </div>

                        <div class="price-container">
                            <?php
                            if ($row['product_price'] != $price) {
                                echo '<div class="d-flex align-items-end"><h1 class="h1">₹' . $price . '</h1>' . '<h4 class="h3 mx-2 text-muted"><strike>' . $row['product_price'] . '</strike></h4></div>';
                            } else {
                                echo '<h1 class="h1">₹' . $price . ' </h1>';
                            }
                            ?>
                        </div>

                        <div class="rating-container my-3">
                            <?php
                            $result2 = $obj->select('*', 'rating', 'product_id=' . $id);
                            $totalRatings = $result2->num_rows;
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

                        <div>
                            <p class="product-feature"><?php echo $row['product_feature'] ?><br /></p>
                        </div>

                        <div class="addToCart-container">
                            <?php
                            if ($row['product_stock'] < 8 && $row['product_stock'] > 0) {
                            ?>
                                <h5 id="howManyLeft" class="h5 text-danger">Hurry ! Only <?php echo $row['product_stock']; ?> left in stock</h5>
                            <?php
                            }
                            $addOut = "ADD TO CART";
                            $disabled = false;
                            if ($row['product_stock'] == 0) {
                                echo '<h5 class="h5 text-danger">Out of Stock</h5>';
                                $disabled = true;
                                $addOut = "OUT OF STOCK";
                            }
                            ?>

                            <button type="button" class="w-100 d-flex align-items-center justify-content-center py-2 my-3" id="addToCart">
                                <h4 class="h4 m-0"><?php echo $addOut; ?></h4>
                            </button>
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

                </div>
            </div>


            <div class="container" style="margin-bottom: 100px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="full">
                            <div class="tab_bar_section">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#description">
                                            <h5 class="h5 m-0">Description</h5>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#reviews">
                                            <?php
                                            $result3 = $obj->select('*', 'feedback', "product_id=" . $id);
                                            ?>
                                            <h5 class="h5 m-0">Reviews (<?php echo $result3->num_rows; ?>)</h5>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#ratings">
                                            <h5 class="h5 m-0">Ratings (<?php echo $totalRatings; ?>)</h5>
                                        </a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="description" class="tab-pane active p-3">
                                        <div class="product_desc">
                                            <p><?php echo $productDesc; ?></p>
                                        </div>
                                    </div>
                                    <div id="reviews" class="tab-pane fade p-3">
                                        <div class="product_review">
                                            <?php
                                            if (isset($_SESSION['userlogin'])) {
                                                $result = $obj->select('*', 'feedback', "userlogin_userid=" . $_SESSION['userlogin'] . " AND product_id=" . $id);

                                                if ($result->num_rows == 0) {
                                                    $result = mysqli_query($obj->connection(), "SELECT * from `order` JOIN `order_detail` ON `order`.`order_id`=`order_detail`.`order_order_id` WHERE `order_detail`.`product_id` = " . $id . " AND `order`.`userlogin_userid` = " . $_SESSION['userlogin']);

                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            if ($row['status'] == "Delivered") {
                                            ?>
                                                                <div class="d-flex">
                                                                    <input type="text" class="w-100 feedback-input" id="feedback-input" placeholder="Write feedback" />
                                                                    <button id="submit-feedback">SUBMIT</button>
                                                                </div>
                                                <?php
                                                            }
                                                        }
                                                    }
                                                }
                                            }

                                            if ($result3->num_rows > 0) {
                                                ?>
                                                <div class="row feedback-container">
                                                    <?php
                                                    while ($row3 = $result3->fetch_assoc()) {
                                                        $user = $obj->select('*', 'userlogin', "userid=" . $row3['userlogin_userid']);
                                                        $user = $user->fetch_assoc();
                                                    ?>
                                                        <div class="col-md-12 mb-2 d-flex">
                                                            <div class="d-flex w-100 justify-content-between align-items-center">
                                                                <div class="d-flex">
                                                                    <div class="mr-3">
                                                                        <i class="fas fa-user"></i>
                                                                    </div>
                                                                    <div>
                                                                        <div class="d-flex">
                                                                            <h6 class="h6 fw-bold m-0" style="letter-spacing: 1px;"><?php echo $user['user_firstname'] . " " . $user['user_lastname']; ?></h6>
                                                                            <span class="feedback-date ml-4 text-muted"><?php echo $row3['date']; ?></span>
                                                                        </div>
                                                                        <p style="font-size: 15px;"><?php echo $row3['feedback']; ?></p>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                if (isset($_SESSION['userlogin'])) {
                                                                    if ($_SESSION['userlogin'] == $row3['userlogin_userid']) {
                                                                ?>
                                                                        <button data-id="<?php echo $row3['feedback_id']; ?>" class="delete-feedback bg-danger text-light px-2 py-1 rounded">Delete</button>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <h6 class="h6">No feedbacks yet</h6>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div id="ratings" class="tab-pane fade p-3">
                                        <div class="product_ratings">
                                            <?php
                                            if (isset($_SESSION['userlogin'])) {
                                                $allowRating = 0;
                                                $result = $obj->select('*', 'rating', "userlogin_userid=" . $_SESSION['userlogin'] . " AND product_id=" . $id);

                                                if ($result->num_rows == 0) {
                                                    $result = mysqli_query($obj->connection(), "SELECT * from `order` JOIN `order_detail` ON `order`.`order_id`=`order_detail`.`order_order_id` WHERE `order_detail`.`product_id` = " . $id . " AND `order`.`userlogin_userid` = " . $_SESSION['userlogin']);

                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            if ($row['status'] == "Delivered") {
                                                                $allowRating = 1;
                                                            }
                                                        }
                                                    }

                                                    if ($allowRating) {
                                            ?>
                                                        <div id="status" style="margin-bottom:50px;">
                                                            <form data-id="<?php echo $id; ?>" id="ratingForm" class="d-flex">
                                                                <fieldset class="rating">
                                                                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Rocks!">5 stars</label>
                                                                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
                                                                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
                                                                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
                                                                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time">1 star</label>
                                                                </fieldset>
                                                                <button class="submit clearfix btn btn-success ml-5">Submit</button>
                                                            </form>
                                                        </div>
                                                <?php
                                                    }
                                                } else {
                                                    $row = $result->fetch_assoc();

                                                    echo '<div class="d-flex align-items-center">
                                                    <span class="mr-3">You rated : </span>';
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        if ($i <= $row['rating_star']) {
                                                            echo '<i style="font-size: 20px;" class="fa-solid fa-star"></i>';
                                                        } else {
                                                            echo '<i style="font-size: 20px;" class="fa-regular fa-star"></i>';
                                                        }
                                                    }
                                                    echo '</div>';
                                                }
                                            }

                                            if ($totalRatings > 0) {
                                                ?>
                                                <div class="row my-5">
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
                                                    <div class="col-xs-12 col-md-2 text-center">
                                                        <h1 class="rating-num"><?php echo $rating; ?></h1>
                                                        <div class="ratingg">
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
                                                            <span class="fa fa-user"></span><?php echo $totalRatings; ?> total votes
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <h6 class="h6">No ratings yet</h6>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php
            include '../includee/footer.php';
            ?>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

            <!-- jQery -->
            <script src="../js/jquery-3.4.1.min.js"></script>
            <!-- bootstrap js -->
            <script src="../js/bootstrap.js"></script>


            <script>
                $(document).ready(() => {
                    $("form#ratingForm").submit(function(e) {
                        e.preventDefault();
                        if ($("#ratingForm :radio:checked").length > 0) {
                            const star = $('input:radio[name=rating]:checked').val()
                            const product = $('#ratingForm').attr("data-id");

                            $.post({
                                url: "ajax/addToCart.php",
                                data: {
                                    star,
                                    product,
                                    operation: "add rating"
                                },
                                success(data) {
                                    if (data == "added") {
                                        window.location.reload();
                                    } else {
                                        alert("Please try again...", 'danger');
                                    }
                                }
                            })
                        }
                    });

                    var alertPlaceholder = document.getElementById('liveAlertPlaceholder')

                    function alert(message, type) {
                        var wrapper = document.createElement('div')
                        wrapper.innerHTML = '<div class="h6 m-0 alert alert-' + type + ' alert-dismissible" role="alert">' + message;

                        alertPlaceholder.append(wrapper)

                        setTimeout(() => {
                            $('#liveAlertPlaceholder').html('')
                        }, 3000);
                    }

                    function addRemoveWishlist(id, operationn) {
                        var x = true;
                        $.post({
                            url: "ajax/wishlist.php",
                            data: {
                                id,
                                operation: operationn
                            },
                            success(data) {
                                alert(data, 'success')
                                if (data == "Try again...") {
                                    x = false;
                                }
                            }
                        })
                        return x
                    }

                    $('#submit-feedback').on('click', () => {
                        const feedback = $('#feedback-input').val();

                        const url_string = window.location.href;
                        const url = new URL(url_string);
                        const productId = url.searchParams.get("id");

                        if (feedback && productId) {
                            $.ajax({
                                url: "ajax/feedback.php",
                                type: "POST",
                                data: {
                                    feedback,
                                    productId,
                                    operation: "add feedback"
                                },
                                success(data) {
                                    if (data == "Added") {
                                        window.location.reload();
                                    }
                                }
                            })
                        }
                    })

                    $('.delete-feedback').on('click', (e) => {
                        const feedbackId = e.target.getAttribute("data-id");

                        if (confirm("Are you sure to delete your feedback???")) {
                            $.ajax({
                                url: "ajax/feedback.php",
                                type: "POST",
                                data: {
                                    feedbackId,
                                    operation: "delete feedback"
                                },
                                success(data) {
                                    if (data == "Deleted") {
                                        window.location.reload();
                                    }
                                }
                            })
                        }
                    })

                    $('.other-img').on('click', (e) => {
                        const id = e.target.getAttribute('data-id');
                        const mainImgId = $('.main-product-img img').attr("data-id");
                        const mainImg = $('.main-product-img img').attr("src")

                        e.target.setAttribute("src", mainImg)
                        e.target.setAttribute("data-id", mainImgId)

                        $.ajax({
                            url: "ajax/getImage.php",
                            type: "POST",
                            data: {
                                id,
                                operation: "select image"
                            },
                            success(data) {
                                $('.main-product-img').html(data);
                                // console.log(data);
                            }
                        })
                    })

                    document.addEventListener('click', (e) => {
                        if (e.target && e.target.id == "empty-heart") {
                            const id = e.target.parentElement.getAttribute("data-id");

                            if (addRemoveWishlist(id, "addToWishlist")) {
                                $('.heart-container').html('<i id="full-heart" class="m-0 fas fa-heart cursor-pointer"></i>');
                            }
                        }
                        if (e.target && e.target.id == "full-heart") {
                            const id = e.target.parentElement.getAttribute("data-id");

                            if (addRemoveWishlist(id, "removeItem")) {
                                $('.heart-container').html('<i id="empty-heart" class="m-0 far fa-heart cursor-pointer"></i>');
                            }
                        }
                        return () => {}
                    })

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
                                $('#addToCart').attr('disabled', true);
                            },
                            success(data) {
                                if (data == "Out of stock") {
                                    $('#howManyLeft').html('OUT OF STOCK');
                                    $('#addToCart').attr('disabled', true);
                                    $('#addToCart h4').html('OUT OF STOCK');
                                } else {
                                    if (data == "Added to Cart") {
                                        alert(data, 'success')
                                    } else {
                                        alert(data, 'danger')
                                    }
                                    setTimeout(() => {
                                        $('#addToCart').attr('disabled', false);
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

<?php
}
?>