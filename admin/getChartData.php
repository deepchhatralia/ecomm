<?php


if (isset($_POST['operation'])) {
    include '../database.php';
    $obj = new Database();

    $mon = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
    $whatMonth = [];
    $total = [];

    if ($_POST['operation'] == "total Sales" || $_POST['operation'] == "total Purchase" || $_POST['operation'] == "total Sales get month" || $_POST['operation'] == "total Purchase get month") {

        if ($_POST['what'] == 'sales') {
            $what = "order";
        } else {
            $what = "purchasee";
        }

        foreach ($mon as $val) {
            $result = $obj->select('*', $what, $what . "_date >= '2022-" . $val . "-01' AND " . $what . "_date <= '2022-" . $val . "-31'");

            if ($result->num_rows > 0) {
                array_push($whatMonth, $val);
                $monthTotal = 0;
                while ($row = $result->fetch_assoc()) {
                    $monthTotal += $row['total'];
                }
                array_push($total, $monthTotal);
            }
        }
        $whatMonth = json_encode($whatMonth);
        $total = json_encode($total);

        if ($_POST['operation'] == "total Sales get month" || $_POST['operation'] == "total Purchase get month") {
            echo $whatMonth;
        } else {
            echo $total;
        }
    }
}
