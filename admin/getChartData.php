<?php


if (isset($_POST['operation'])) {
    include '../database.php';
    $obj = new Database();

    $mon = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
    $whatMonth = [];
    $total = [];
    $monTotal = [];

    if ($_POST['operation'] == "total Sales" || $_POST['operation'] == "total Purchase" || $_POST['operation'] == "total Sales get month" || $_POST['operation'] == "total Purchase get month") {

        if ($_POST['what'] == 'sales') {
            $whatToSelect = "*";
            $what = "order";
        } else {
            $whatToSelect = "*";
            $what = "purchasee";
        }

        foreach ($mon as $val) {
            $result = $obj->select($whatToSelect, $what, $what . "_date >= '2022-" . $val . "-01' AND " . $what . "_date <= '2022-" . $val . "-31'");

            if ($result->num_rows > 0) {
                $monthTotal = 0;
                while ($row = $result->fetch_assoc()) {
                    $monthTotal += $row['total'];
                }
                array_push($whatMonth, $val);
                array_push($total, $monthTotal);

                $monTotal[$val] = $monthTotal;
            }
        }

        if ($_POST['operation'] == "total Sales get month" || $_POST['operation'] == "total Purchase get month") {
            echo json_encode($whatMonth);
        } else {
            echo json_encode($total);
        }
    } else if ($_POST['operation'] == "getNumberOfOrders" || $_POST['operation'] == "getOrderMonth") {
        foreach ($mon as $val) {
            $result = $obj->select("COUNT(*)", "order", "order_date >= '2022-" . $val . "-01' AND order_date <= '2022-" . $val . "-31'");

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                array_push($whatMonth, $val);
                array_push($total, $row['COUNT(*)']);

                $monthTotal[$val] = $row['COUNT(*)'];
            }
        }

        if ($_POST['operation'] == "getOrderMonth") {
            echo json_encode($whatMonth);
        } else {
            echo json_encode($total);
        }
    } else if ($_POST['operation'] == "topSellingProduct") {
        $assocArr = array();

        $result = $obj->select('*', 'productt');

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $result2 = $obj->select("SUM(order_quantity)", "order_detail", "product_id=" . $row['product_id']);

                if ($result->num_rows > 0) {
                    $row2 = $result2->fetch_assoc();

                    $assocArr[$row['product_name']] = (int)$row2['SUM(order_quantity)'];
                }
            }

            arsort($assocArr);
            if (count($assocArr) > 5) {
                $assocArr = array_slice($assocArr, 0, 5, true);
            }

            echo json_encode($assocArr);
        }
    }
} else {
    include '../pagenotfound.php';
}
