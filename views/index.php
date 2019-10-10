<?php
    include_once "../config/Database.php";
    include_once "../models/Product.php";
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

    <?php include_once "../includes/navbar.html" ?>

    <?php
        $database = new Database();
        $db = $database->connect();
        
    
        $product = new Product($db);
    
        $products = $product->read();

        if($products->rowCount() > 0){
            
    ?>

    <div class="container-fluid">

        <div class="row">

            <?php while($row = $products->fetch()){ ?>
            <div class="col-md-3">
                <div class="card mt-2 ">
                    <img src="<?= "../img/".$row['image'] ?>" alt="No Image" height="250" class="card-img-top">

                    <div class="card-body">
                        <h4 class="card-title"><?= $row['name'] ?></h4>
                        <p class="card-text"><?= $row['description'] ?></p>

                        <div class="clearfix">
                            <h5 class="float-left text-success"><?= $row['price']?> $</h5>
                            <a href="product.php?product=<?= $row['id'] ?>" class="btn btn-sm btn-outline-primary float-right">Product page</a>
                        </div>
                    </div>
                </div>
            </div> 
            <?php } ?>

        </div>

    </div>

    <?php }else{
        echo "<p> No Products </p>";
    } ?>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>