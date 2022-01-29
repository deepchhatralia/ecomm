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
        <title>My Account</title>

        <link rel="stylesheet" href="../css/index/responsive.css">
    </head>

    <body>
        <?php
        include '../admin/includee/cdn.php';
        include '../database.php';
        $obj = new Database();

        include '../includee/navbar1.php';
        ?>
        <h1 class="h1">Welcome, <?php echo $_SESSION['username']; ?></h1>

        <?php
        include '../includee/footer.php';
        ?>
    </body>

    </html>
<?php
} else {
    include '../pagenotfound.php';
}
