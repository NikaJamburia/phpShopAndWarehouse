<?php
    if(isset($_POST['producer'])){
        include_once "../config/Database.php";
        include_once "../models/Delivery.php";
        include_once "../models/Product.php";
    
        $database = new Database();
        $db = $database->connect();
    
        $delivery = new Delivery($db);
        $delivery->company_id = $_POST['producer'];
        $delivery->product_id = $_POST['product'];
        $delivery->amount = $_POST['amount'];

        if($delivery->create()){
            $product = new Product($db);
            $product->deliver($_POST['product'], $_POST['amount']);

            header("Location:../views/warehouse/deliveryForm.php");
        }

    }
?>