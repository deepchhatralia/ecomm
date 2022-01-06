<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <link rel="stylesheet" href="../css/style.css">

    <!-- Bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <style>
        tbody tr {
            cursor: pointer;
        }
    </style>

</head>

<body>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
            </div>
        </div>
    </div>

    <?php
    include 'includee/navbar.php';
    include 'includee/sidebar.php';

    include '../database.php';
    $obj = new Database();

    $result = $obj->select('*', 'orders');

    if ($result->num_rows > 0) {
    ?>

        <div class="table-responsive table-hover my-5 mx-3">
            <table class="table">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th>Order Id</th>
                        <th>Product</th>
                        <th>Customer</th>
                        <th>Phone No.</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Order Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $productId = $row['product_id'];
                        $result2 = $obj->select('*', 'products', "product_id='{$productId}'");
                        if ($result2->num_rows > 0) {
                            $row2 = $result2->fetch_assoc();
                            $product = $row2['product_name'];
                            $price = $row2['product_price'];
                    ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td><?php echo $row['order_id']; ?></td>
                                <td><?php echo $product; ?></td>
                                <td><?php echo $row['customer_name']; ?></td>
                                <td><?php echo $row['customer_number']; ?></td>
                                <td><?php echo $row['customer_email']; ?></td>
                                <td><?php echo substr($row['customer_address'], 0, 25) . "..."; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td><?php echo $row['quantity'] * $price; ?></td>
                                <td>
                                    <select class="status" name="status" id="status">
                                        <?php
                                        $arr = ['Ordered', 'Shipped', 'Delivered'];
                                        $status = $row['status'];
                                        for ($i = 0; $i < count($arr); $i++) {
                                            if ($arr[$i] == $status) {
                                        ?>
                                                <option value="<?php echo $arr[$i]; ?>" selected>
                                                    <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs"><?php echo $arr[$i]; ?></span>
                                                </option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="<?php echo $arr[$i]; ?>">
                                                    <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs"><?php echo $arr[$i]; ?></span>
                                                </option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><?php echo $row['order_date']; ?></td>
                                <td>
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </div>
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </div>
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

    <?php
    } else {
        echo '<h1>no records found</h1>';
    }
    ?>

    <script src="../jquery.js"></script>


    <script>
        document.querySelector('.fa-tachometer-alt').parentNode.parentNode.classList.remove('active')
        document.querySelector('.fa-sort-amount-up-alt').parentNode.parentNode.classList.add('active')

        $(document).ready(() => {
            const status = document.querySelectorAll('.status')
            var toastLiveExample = $('#liveToast')
            var toast = new bootstrap.Toast(toastLiveExample)


            for (let i = 0; i < status.length; i++) {
                status[i].addEventListener('change', () => {

                    const orderId = status[i].parentElement.parentElement.childNodes[1].innerHTML
                    const statusValue = status[i].value
                    $.ajax({
                        url: "ajax/updateStatusAjax.php",
                        type: "POST",
                        data: {
                            orderId,
                            statusValue
                        },
                        succcess(data) {
                            var toast = new bootstrap.Toast(toastLiveExample)
                            $('.toast-body').html(data)
                            toast.show()
                            setTimeout(() => {
                                toast.hide()
                            }, 2000);
                        }
                    })
                })
            }
        })
    </script>
</body>

</html>