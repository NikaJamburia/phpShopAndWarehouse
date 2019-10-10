<?php 
    if(isset($_POST['name'])){
        include_once "../config/Database.php";
        include_once "../models/Product.php";
    
        $database = new Database();
        $db = $database->connect();
    
        $product = new Product($db);
        $product->name = $_POST['name'];
        $product->description = $_POST['desc'];
        $product->price = $_POST['price'];
        $product->producer_id = $_POST['producer'];
        $product->image = 'default.jpg';
    
        if($product->create()){
            header('Location:../views/admin/index.php?msg=ProductCreated');
        }
        else{
            header('Location:../views/admin/index.php?msg=ProductNotCreated');
        }
    }
    else{
        header('Location:../views/admin/index.php');
        var_dump($_POST);
    }

?>