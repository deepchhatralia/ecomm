<?php


if (isset($_POST['operation'])) {
    include '../database.php';
    $obj = new Database();


    if (isset($_POST['operation']) && ($_POST['operation'] == "total sales" || $_POST['operation'] == "total sales get month")) {
        $mon = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
        $whatMonth = [];
        $total = [];

        foreach ($mon as $val) {
            $result = $obj->select('*', 'order', "order_date >= '2022-" . $val . "-01' AND order_date <= '2022-" . $val . "-31'");

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

        if ($_POST['operation'] == "total sales get month") {
            echo $whatMonth;
        } else {
            echo $total;
        }
    }
}
