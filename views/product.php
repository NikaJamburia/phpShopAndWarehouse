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
    
        $product->show($_GET['product']);

    ?>

    <div class="container pt-3">
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <img src="<?= "../img/".$product->image?>" alt="No Image" height="250" class="card-fluid">
            </div>

            <div class="col-sm-6 col-md-8">
                <h2><?=$product->name?> • <span class="text-success"><?=$product->price?>$</span> </h2>
                <hr>
                <p><b>Company:</b> <?=$product->producer?></p>
                <p><b>Availability:</b> <?php if ($product->amount > 0){echo "<span class='text-success'>In Stock</span>";} else{echo "<span class='text-danger'>Out of Stock</span>";} ?></p>
                <input type="hidden" id="amount" value="<?=$product->amount?>">
                <p><b>Description: </b><?=$product->description?></p>

                <?php 
                    if ($product->amount > 0){
                ?>
                <div class="border rounded p-2">
                    <form action="../functions/buy.php" method="post" class="form-inline" id='form'>
                        <input type="number" placeholder="Amount" name="bought_amount" class="form-control mr-sm-2" style="width:120px;" id="buyingamount">
                        <input type="hidden" name="id" value="<?=$product->id?>">
                        <input type="hidden" name="previous_amount" value="<?=$product->amount?>">
                        <button type="submit" class="btn btn-md btn-primary" name="in" id="buybtn">Buy</button>
                    </form>
                    <p style="color:red; margin-bottom:2px;" hidden id="error">error</p>
                </div>
                <?php }else{ ?>
                <div class="border rounded p-2">
                    <form action="" class="form-inline">
                        <input readonly type="number" placeholder="Amount" class="form-control mr-sm-2" style="width:120px;" id="">
                        <a href="#" class="btn btn-md btn-primary disabled">Buy</a>
                    </form>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('buybtn').addEventListener('click', function(e){
            e.preventDefault();
            document.getElementById('error').setAttribute('hidden', 'true');

            a = parseInt(document.getElementById('amount').value);
            b = parseInt(document.getElementById('buyingamount').value);

            if(document.getElementById('buyingamount').value == ""){
                document.getElementById('error').innerHTML = "Specify the amount";
                document.getElementById('error').removeAttribute('hidden');
                return 0;
            }

            if(a-b < 0){
                alert("There are only "+document.getElementById('amount').value+" pieces left in stock!");
            }
            else{
                document.getElementById('form').submit();
            }
        });
    </script>

    
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>