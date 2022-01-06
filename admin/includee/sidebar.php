<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <!-- Bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <style>
        #sidebar {
            width: 18vw;
        }

        .sidebar-items {
            margin: 0.2rem 0;
            padding: 0.6rem 1rem;
            width: 100% !important;
            cursor: pointer;
        }

        img {
            width: 8%;
        }

        .sidebar-items:hover {
            background-color: #4B49AC;
            color: #fff;
            border-radius: 5px;
            transition: all 500ms ease;
        }

        .sidebar-items:hover a {
            color: #fff;
        }

        .sidebar-item-name {
            margin-left: 0.4rem;
        }

        .active {
            background-color: #4B49AC;
            color: #fff;
            border-radius: 5px;
        }

        a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>
    <!-- Icons  -->
    <a href="https://icons8.com/icon/Yj5svDsC4jQA/dashboard-layout"></a>

    <div class="offcanvas offcanvas-start" id="sidebar" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel"></h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-1">
            <a href="http://localhost/ecomm/admin/dashboard.php">
                <div class="sidebar-items active">
                    <span><i class="fas fa-tachometer-alt"></i></span>
                    <span class="sidebar-item-name">Dashboard</span>
                </div>
            </a>
            <a href="http://localhost/ecomm/admin/product/">
                <div class="sidebar-items">
                    <span><i class="far fa-plus-square"></i></span>
                    <span class="sidebar-item-name">Manage Products</span>
                </div>
            </a>
            <!-- <a href="http://localhost/ecomm/admin/product/addCategory.php">
                <div class="sidebar-items">
                    <span><i class="far fa-plus-square category"></i></span>
                    <span class="sidebar-item-name">Add Category</span>
                </div>
            </a> -->
            <a href="http://localhost/ecomm/admin/allItems.php">
                <div class="sidebar-items">
                    <span><i class="fas fa-box-open"></i></span>
                    <span class="sidebar-item-name">All Items
                    </span>
                </div>
            </a>
            <a href="http://localhost/ecomm/admin/editDeleteItems.php">
                <div class="sidebar-items">
                    <span><i class="far fa-trash-alt"></i></span>
                    <span class="sidebar-item-name">Edit/Delete</span>
                </div>
            </a>
            <a href="http://localhost/ecomm/admin/orders.php">
                <div class="sidebar-items">
                    <span><i class="fas fa-sort-amount-up-alt"></i></span>
                    <span class="sidebar-item-name">Orders</span>
                </div>
            </a>
            <a href="http://localhost/ecomm/admin/logout.php">
                <div class="sidebar-items">
                    <span><i class="fas fa-sign-out-alt"></i></span>
                    <span class="sidebar-item-name">Logout</span>
                </div>
            </a>
        </div>
    </div>



</body>

</html>