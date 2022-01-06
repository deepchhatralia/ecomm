<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Items</title>

    <!-- Tailwind CSS  -->
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
    include 'includee/navbar.php';
    include 'includee/sidebar.php';

    include '../database.php';
    $obj = new Database();

    $result = $obj->select('*', 'product');

    if ($result->num_rows > 0) {
    ?>


        <div class="table-responsive table-hover my-5 mx-3">
            <table class="table">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th>Product Id</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td><?php echo $row['product_id']; ?></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td><?php echo $row['product_price']; ?></td>
                            <td><?php echo $row['product_stock']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

    <?php
    } else {
        echo '<h1>Inventory Empty</h1>';
    }
    ?>



    <script>
        document.querySelector('.fa-tachometer-alt').parentNode.parentNode.classList.remove('active')
        document.querySelector('.fa-box-open').parentNode.parentNode.classList.add('active')
    </script>
</body>

</html>