<?php 
    include_once "../config/Database.php";
    include_once "../models/Message.php";

    $database = new Database();
    $db = $database->connect();

    $message = new Message($db);


?>