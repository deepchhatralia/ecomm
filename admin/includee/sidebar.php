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
        /* #sidebar {
            width: 18vw;
        } */

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


    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">MENU</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <a href="http://localhost/ecomm/admin/dashboard.php">
                <div class="sidebar-items active">
                    <span class="mr-2"><i class="fas fa-tachometer-alt"></i></span>
                    <span class="sidebar-item-name">Dashboard</span>
                </div>
            </a>
            <a href="http://localhost/ecomm/admin/product/product.php">
                <div class="sidebar-items">
                    <span class="mr-2"><i class="far fa-plus-square productSidebarIcon"></i></span>
                    <span class="sidebar-item-name">Manage Products</span>
                </div>
            </a>
            <a href="http://localhost/ecomm/admin/product/image.php">
                <div class="sidebar-items">
                    <span class="mr-2"><i class="fa-solid fa-image imageSidebarIcon"></i></span>
                    <span class="sidebar-item-name">Manage Image's</span>
                </div>
            </a>
            <a href="http://localhost/ecomm/admin/product/category.php">
                <div class="sidebar-items">
                    <span class="mr-2"><i class="fas fa-box-open categorySidebarIcon"></i></span>
                    <span class="sidebar-item-name">Manage Category</span>
                </div>
            </a>
            <a href="http://localhost/ecomm/admin/product/offer.php">
                <div class="sidebar-items">
                    <span class="mr-2"><i class="fa-brands fa-buffer offerSidebarIcon"></i></span>
                    <span class="sidebar-item-name">Manage Offer</span>
                </div>
            </a>
            <a href="http://localhost/ecomm/admin/company/">
                <div class="sidebar-items">
                    <span class="mr-2"><i class="fas fa-box-open companySidebarIcon"></i></span>
                    <span class="sidebar-item-name">Company Profile</span>
                </div>
            </a>
            <a href="http://localhost/ecomm/admin/order">
                <div class="sidebar-items">
                    <span class="mr-2"><i class="fas fa-sort-amount-up-alt orderSidebarIcon"></i></span>
                    <span class="sidebar-item-name">Orders</span>
                </div>
            </a>
            <a href="http://localhost/ecomm/admin/purchase/">
                <div class="sidebar-items">
                    <span class="mr-2"><i class="fa-solid fa-cart-shopping purchaseSidebarIcon"></i></span>
                    <span class="sidebar-item-name">Purchase</span>
                </div>
            </a>
            <a href="http://localhost/ecomm/admin/report">
                <div class="sidebar-items">
                    <span class="mr-2"><i class="fa-solid fa-file reportSidebarIcon"></i></span>
                    <span class="sidebar-item-name">Reports</span>
                </div>
            </a>
            <a href="http://localhost/ecomm/admin/purchase/supplier.php">
                <div class="sidebar-items">
                    <span class="mr-2"><i class="fa-solid fa-user-tie supplierSidebarIcon"></i></span>
                    <span class="sidebar-item-name">Manage Supplier</span>
                </div>
            </a>
            <a href="http://localhost/ecomm/admin/user">
                <div class="sidebar-items">
                    <span class="mr-2"><i class="fa-solid fa-user userSidebarIcon"></i></span>
                    <span class="sidebar-item-name">Manage Users</span>
                </div>
            </a>
            <a href="http://localhost/ecomm/admin/logout.php" class="admin-logout-btn">
                <div class="sidebar-items">
                    <span class="mr-2"><i class="fas fa-sign-out-alt"></i></span>
                    <span class="sidebar-item-name">Logout</span>
                </div>
            </a>
        </div>
    </div>
</body>

</html>