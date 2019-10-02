<?php 
    if(isset($_POST['bought_amount'])){
        include_once "../config/Database.php";
        include_once "../models/Purchase.php";
        include_once "../models/Product.php";

        $database = new Database();
        $db = $database->connect();
    
        $purchase = new Purchase($db);

        $purchase->product_id = $_POST['id'];
        $purchase->amount = $_POST['bought_amount'];

        $product = new Product($db);

        if($purchase->create()){
            $product->buy($_POST['id'], $_POST['bought_amount']);

            header("Location:../views/transSuccess.html");
        }
        else{
            header("Location:../views/transFail.html");
        }
    }
    else{
        header("Location:../views/index.php");
    }
?>