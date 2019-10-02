<?php
    include_once "../../config/Database.php";
    include_once "../../models/Product.php";
    include_once "../../models/Purchase.php";

    if(isset($_GET['id'])){
        $database = new Database();
        $db = $database->connect();
    
        $product = new Product($db);
        $product->show($_GET['id']);
    }
    else{
        header('Location:index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    
    <title>Document</title>
</head>
<body>

    <?php include_once "../../includes/ware_navbar.html" ?>

    <div class="container pt-3">
        <a href="index.php" class="btn btn-secondary mb-4">Back</a>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <img src="<?= "../../img/".$product->image?>" alt="No Image" height="250" class="card-fluid">
            </div>

            <div class="col-sm-6 col-md-8">
                <h2><?=$product->name?> • <span class="text-success"><?=$product->price?>$</span> </h2>
                <hr>
                <p><b>Company:</b> <?=$product->producer?></p>
                <p><b>Amount in warehouse:</b> <?=$product->amount?></p>
                <p><b>Description: </b><?=$product->description?></p>
            </div>
        </div>
    </div>

    <hr class="mx-5">

    <div class="container mt-2">
        <h2 class="text-center">Last Deliveries</h2>
    </div>
    
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>