<?php

session_start();

if(isset($_SESSION['userlogin'])){
    if(isset($_POST['id'])){
        $id = $_POST['id'];

        include '../database.php';
        $obj = new Database();

        $result = $obj->select('*','order_detail',"order_detil_id=".$id);

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();

            
        }else{
            echo "Order not found";
        }
    }else{
        include '../pagenotfound.php';
    }
}else{
    include '../pagenotfound.php';
}
