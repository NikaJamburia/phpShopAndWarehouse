<?php 
    if(isset($_GET['id'])){
        $pur_id = $_GET['id'];
        include_once "../config/Database.php";
        include_once "../models/Purchase.php";
        include_once "../models/Product.php";

        $database = new Database();
        $db = $database->connect();
    
        $purchase = new Purchase($db);

        if($purchase->delete($pur_id)){

            // MAIL FUNCTIONS

            header("Location:../views/warehouse/index.php?msg=app");
        }
    }
    else{
        header("Location:../views/index.php");
    }
?>