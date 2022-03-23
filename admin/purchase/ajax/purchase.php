<?php
session_start();
if (isset($_SESSION['admin_loggedin']) && isset($_POST['operation'])) {
    include '../../../database.php';
    $obj = new Database();

    if ($_POST['operation'] == "show purchase") {
        $output = "";
        $result = $obj->sql("SELECT * from purchasee join dealer on purchasee.dealer_id=dealer.iddealer");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['product_added']) {
                    $productAdded = "yes";
                } else {
                    $productAdded = "no";
                }

                $output .= '<tr>
                        <td>' . $row['purchase_id'] . '</td>
                        <td>' . $row['product_name'] . '</td>
                        <td>' . $row['qty'] . '</td>
                        <td>' . $row['total'] . '</td>
                        <td>' . $row['dealer_name'] . '</td>
                        <td>' . $productAdded . '</td>
                        <td>' . $row['purchasee_date'] . '</td>
                        <td style="font-size: 13px;">
                            <button id="fa-edit" class="mb-1 my-btn bg-success edit-btn" data-id="' . $row['purchase_id'] . '"><i class="far fa-edit mx-1"></i> Edit</button> 
                            <button id="fa-trash-alt" class="mb-1 my-btn bg-danger delete-btn" data-id="' . $row['purchase_id'] . '"><i class="fas fa-trash-alt mx-1"></i> Delete</button>
                        </td>
                    </tr>';
            }
            echo $output;
        } else {
            echo "No purchase yet";
        }
    }

    if ($_POST['operation'] == "insert purchase") {
        $name = $_POST['name'];
        $qty = $_POST['qty'];
        $total = $_POST['total'];
        $dealer = $_POST['dealer'];

        $result = $obj->insert('purchasee', ['product_name' => $name, 'qty' => $qty, 'total' => $total, 'dealer_id' => $dealer]);

        if ($result) {
            echo "inserted";
        }
    }

    if ($_POST['operation'] == "update purchase") {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $qty = $_POST['qty'];
        $total = $_POST['total'];
        $dealer = $_POST['dealer'];

        $result = $obj->update('purchasee', ['product_name' => $name, 'qty' => $qty, 'total' => $total, 'dealer_id' => $dealer], "purchase_id=" . $id);

        if ($result) {
            echo "updated";
        }
    }

    if ($_POST['operation'] == "select purchase") {
        $id = $_POST['id'];

        $result = $obj->select('*', "purchasee", "purchase_id=" . $id);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $arr = [$row['purchase_id'], $row['product_name'], $row['qty'], $row['total'], $row['dealer_id']];

            echo json_encode($arr);
        }
    }

    if ($_POST['operation'] == "delete purchase") {
        $id = $_POST['id'];

        $result = $obj->delete('purchasee', 'purchase_id=' . $id);

        if ($result) {
            echo "deleted";
        }
    }
} else {
    include '../../../pagenotfound.php';
}
