<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

    <style>
        #liveAlertPlaceholder {
            position: sticky;
            top: 0;
            left: 0;
            right: 0;
        }
    </style>
</head>

<body>
    <?php
    include '../includee/cdn.php';
    include '../includee/navbar.php';
    include '../includee/sidebar.php';
    include '../../database.php';
    include '../notification.php';

    $obj = new Database();
    ?>

    <div id="liveAlertPlaceholder"></div>

    <div class="container">
        <div class="row">
            <table id="myTable" class="display table my-5">
                <thead id="thead">
                    <th>ID</th>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Signup Date</th>
                </thead>
                <tbody id="tbody">
                    <?php
                    $result = $obj->select('*', 'userlogin');

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>
                                    <td>' . $row['userid'] . '</td>
                                    <td>' . $row['user_name'] . '</td>
                                    <td>' . $row['user_firstname'] . '</td>
                                    <td>' . $row['user_lastname'] . '</td>
                                    <td>' . $row['user_email'] . '</td>
                                    <td>' . $row['user_contact_number'] . '</td>
                                    <td>' . $row['signUpDate'] . '</td>
                                </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../../js/jquery-3.4.1.min.js"></script>

    <script>
        document.querySelector('.fa-tachometer-alt').parentNode.parentNode.classList.remove('active')
        document.querySelector('.userSidebarIcon').parentNode.parentNode.classList.add('active')

        $(document).ready(function() {

        })
    </script>
</body>

</html>