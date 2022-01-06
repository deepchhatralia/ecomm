<?php

use function PHPSTORM_META\type;

session_start();
include 'includee/config.php';
include 'database.php';
$obj = new Database();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">

    <!-- Tailwind css  -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'includee/navbar.php'; ?>



    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <h2 class="sr-only">Products</h2>
            <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                <?php
                $result = $obj->select('*', 'product', 'product_stock >= 1');

                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $productId = $row["product_id"];
                        $productId = (int)$productId;
                        $row2 = $obj->select('img_path','image','product_product_id == '.$productId)
                ?>
                        <a href="product/product.php?q=<?php echo $productId; ?>" class="group">
                            <div class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
                                <!-- <img src="upload_img/<?php echo $row['product_img']; ?>" alt="" class="w-full h-full object-center object-cover group-hover:opacity-75"> -->
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="mt-1 ml-2 text-sm text-gray-700 font-medium">
                                    <?php echo $row['product_name']; ?>
                                </h3>
                                <p class="mt-1 mr-2 text-lg font-medium text-gray-900">
                                    <?php echo '₹ ' . $row['product_price']; ?>
                                </p>
                            </div>
                        </a>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script src="jquery.js"></script>

    <script>
        $('.dropdown-item').on('click', (e) => {
            const id = e.currentTarget.getAttribute('data-id')
            $.ajax({
                url: "loadCategory.php",
                type: "POST",
                data: {
                    id
                },
                success(data) {
                    $('.grid').html(data)
                }
            })
        })
    </script>


</body>

</html>