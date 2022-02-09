<?php

if (isset($_POST['operation'])) {
    session_start();

    include '../../database.php';
    $obj = new Database();

    if (isset($_POST['feedback']) && isset($_POST['productId']) && $_POST['operation'] == "add feedback") {
        $userId = $_SESSION['userlogin'];
        $feedback = $_POST['feedback'];
        $productId = $_POST['productId'];


        $result = $obj->insert('feedback', ['feedback' => $feedback, 'userlogin_userid' => $userId, 'product_id' => $productId]);

        if ($result) {
            echo "Added";
        }
    } else if (isset($_POST['feedbackId']) && $_POST['operation'] == "delete feedback") {
        $feedbackId = $_POST['feedbackId'];

        $result = $obj->delete('feedback', "feedback_id=" . $feedbackId);

        if ($result == 1) {
            echo "Deleted";
        }
    } else {
        include '../../pagenotfound.php';
    }
} else {
    include '../../pagenotfound.php';
}
