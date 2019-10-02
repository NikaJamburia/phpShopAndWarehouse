<?php 

    if(isset($_POST['producer_id'])){
        include_once "../../config/Database.php";
        include_once "../../models/Product.php";
    
        $database = new Database();
        $db = $database->connect();
    
        $product = new Product($db);
        $products = $product->read_by_producer($_POST['producer_id']);

        echo json_encode($products->fetchAll());

    }

?>