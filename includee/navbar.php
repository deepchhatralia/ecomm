<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <!-- Font awesome  -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

  <link href="../css/style.css" rel="stylesheet">

  <style>
    .tailwind-cart {
      transform: translateX(-100%);
    }
  </style>
</head>

<body>
  <div class="cartPopup" style="position: absolute; top: 12%; right: 3%;">
    <p></p>
  </div>


  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand">Hello World</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item mx-1">
            <a class="nav-link" aria-current="page" href="http://localhost/ecomm/">Home</a>
          </li>
          <?php
          include 'config.php';
          $sql = "SELECT * FROM `product_category`";
          $result = mysqli_query($conn, $sql);
          if ($_SERVER['REQUEST_URI'] == '/ecomm/') {
            if (mysqli_num_rows($result) > 0) {
              $sql2 = "SELECT * FROM `product`";
              $result2 = mysqli_query($conn, $sql2);
              if (mysqli_num_rows($result2) > 0) {
          ?>
                <li class="dropdown nav-item mx-1">
                  <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Category
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" data-id="0" href="#">All</a>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo '<a class="dropdown-item" data-id="' . $row['category_id'] . '" href="#">' . $row['category_name'] . '</a>';
                    }
                    ?>
                  </div>
                </li>
            <?php
              }
            }
          }
          if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            ?>
            <li class="nav-item menuItem cursor-pointer mx-1"><a data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" class="nav-link open-cart">Cart</a></li>

            <li class="nav-item menuItem mx-1"><a class="nav-link" href="http://localhost/ecomm/product/allOrders.php">Orders</a></li>

            <li class="nav-item menuItem mx-1"><a id="logoutBtn" class="nav-link" href="#">Logout</a></li>
          <?php
          } else {
          ?>
            <li class="nav-item menuItem mx-1"><a class="nav-link" href="http://localhost/ecomm/login.php">Login</a></li>

            <li class="nav-item menuItem mx-1"><a class="nav-link" href="http://localhost/ecomm/signup.php">Signup</a></li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- </div> -->


  <!-- Cart  -->
  <?php
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

  ?>

    <div class="fixed inset-0 overflow-hidden tailwind-cart" aria-labelledby="slide-over-title" role="dialog" aria-modal="true" style="z-index:1000;">
      <div class="absolute inset-0 overflow-hidden">
        <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex">
          <div class="w-screen max-w-md">
            <div class="h-full flex flex-col bg-white shadow-xl overflow-y-scroll">
              <div class="flex-1 py-6 overflow-y-auto px-4 sm:px-6">
                <div class="flex items-start justify-between">
                  <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">
                    Cart
                  </h2>
                  <div class="ml-3 h-7 flex items-center">
                    <button type="button" class="-m-2 p-2 text-gray-400 hover:text-gray-500 close-cart">
                      <span class="sr-only">Close panel</span>
                      <!-- Heroicon name: outline/x -->
                      <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                  </div>
                </div>

                <div class="mt-8">
                  <div class="flow-root">
                    <ul role="list" class="-my-6 divide-y divide-gray-200 cartItemsContainer">

                    </ul>
                  </div>
                </div>
              </div>

              <div class="border-t border-gray-200 py-6 px-4 sm:px-6 cartBuyContainer">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php
  }
  ?>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  <!-- <script src="../jquery.js"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
    $(document).ready(function() {
      const hamburger = document.getElementById('hamburger')
      const navbarMenu = document.getElementById('navbar-menu')
      const logoutBtn = document.getElementById('logoutBtn')
      const tailwindCart = document.querySelector('.tailwind-cart')
      const closeCart = document.querySelector('.close-cart')

      function loadData() {
        $.ajax({
          url: "http://localhost/ecomm/product/loadCart.php",
          type: "POST",
          data: {},
          success(data) {
            $('.cartItemsContainer').html(data);
            tailwindCart.style.transform = 'translateX(0%)'
          }
        });
      }

      closeCart.addEventListener('click', () => {
        tailwindCart.style.transform = 'translateX(-100%)'
      })

      document.querySelector('.open-cart').addEventListener('click', (e) => {
        loadData();
      });

      logoutBtn.addEventListener('click', () => {
        if (confirm('Logout ???')) {
          window.location.href = 'http://localhost/ecomm/logout.php';
        }
      });


    });
  </script>


  <!-- Bootstrap javascript  -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>