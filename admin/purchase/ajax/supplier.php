<?php

session_start();

if (isset($_SESSION['admin_loggedin'])) {
    if (isset($_POST['operation'])) {
        include '../../../database.php';
        $obj = new Database();

        if ($_POST['operation'] == "load supplier") {
            $result = $obj->select('*', 'dealer');

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>
                        <td>' . $row['iddealer'] . '</td>
                        <td>' . $row['dealer_name'] . '</td>
                        <td>' . $row['dealer_address'] . '</td>
                        <td>' . $row['dealer_email'] . '</td>
                        <td>' . $row['dealer_contact'] . '</td>
                        <td style="font-size: 13px;">
                            <button id="fa-edit" class="mb-1 my-btn bg-success edit-btn" data-id="' . $row['iddealer'] . '"><i class="far fa-edit mx-1"></i> Edit</button> 
                            <button id="fa-trash-alt" class="mb-1 my-btn bg-danger delete-btn" data-id="' . $row['iddealer'] . '"><i class="fas fa-trash-alt mx-1"></i> Delete</button>
                        </td>
                    </tr>';
                }
            }
        }

        if ($_POST['operation'] == "select supplier") {
            $id = (int)$_POST['id'];

            $result = $obj->select('*', 'dealer', "iddealer = {$id}");

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                $name = $row['dealer_name'];
                $address = $row['dealer_address'];
                $email = $row['dealer_email'];
                $contact = $row['dealer_contact'];

                $arr = array($id, $name, $address, $email, $contact);
                echo json_encode($arr);
            }
        }

        if ($_POST['operation'] == "update supplier") {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];


            $result = $obj->update('dealer', ['iddealer' => $id, 'dealer_name' => $name, 'dealer_address' => $address, 'dealer_email' => $email, 'dealer_contact' => $contact], "iddealer={$id}");

            if ($result) {
                echo "updated";
            } else {
                if (mysqli_errno($obj->connection()) == 1062) {
                    echo "ID already exist";
                } else {
                    echo "Please try again...";
                }
            }
        }

        if ($_POST['operation'] == "add supplier") {
            $name = $_POST['name'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];

            $result = $obj->select('*', 'dealer', "dealer_name='{$name}'");


            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (strtolower($name) == strtolower($row['dealer_name'])) {
                    echo 'Dealer already exist';
                } else {
                    $result = $obj->insert('dealer', ['dealer_name' => $name, 'dealer_address' => $address, 'dealer_email' => $email, 'dealer_contact' => $contact]);

                    if ($result) {
                        echo 'Added';
                    } else {
                        echo $result;
                    }
                }
            } else {
                $result = $obj->insert('dealer', ['dealer_name' => $name, 'dealer_address' => $address, 'dealer_email' => $email, 'dealer_contact' => $contact]);

                if ($result) {
                    echo 'Added';
                } else {
                    echo $result;
                }
            }
        }

        if ($_POST['operation'] == "delete supplier") {
            $result = $obj->delete('dealer', "iddealer=" . $_POST['id']);

            if (mysqli_errno($obj->connection()) == 1451) {
                echo "Can't delete. Products from this supplier available in stock";
            } else {
                echo "deleted";
            }
        }
    } else {
        include '../../../pagenotfound.php';
    }
} else {
    include '../../../pagenotfound.php';
}
