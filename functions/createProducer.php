<?php 
    if(isset($_POST['name'])){
        include_once "../config/Database.php";
        include_once "../models/Producer.php";
    
        $database = new Database();
        $db = $database->connect();
    
        $producer = new Producer($db);
        $producer->name = $_POST['name'];
        $producer->email = $_POST['email'];
        $producer->address = $_POST['address'];
        $producer->phone = $_POST['phone'];

    
        if($producer->create()){
            header('Location:../views/admin/index.php?msg=ProducerCreated');
        }
        else{
            header('Location:../views/admin/index.php?msg=ProducerNotCreated');
        }
    }
    else{
        header('Location:../views/admin/index.php');
    }

?>