<?php
    include_once "../../config/Database.php";
    include_once "../../models/Product.php";
    include_once "../../models/Purchase.php";
    include_once "../../models/Message.php";

    $database = new Database();
    $db = $database->connect();

    $prod = new Product($db);
    $products = $prod->read();

    $purchase = new Purchase($db);
    $purchases = $purchase->read();

    $message = new Message($db);
    $messages = $message->read();
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

    <div class="container mt-3">

        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#products">Products</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#purchases">Purchases <span class="badge badge-danger"><?=$purchases->rowCount()?></span></a></li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages">Messages <span class="badge badge-danger"><?=$messages->rowCount()?></span></a></li>
        </ul>

        <div class="tab-content mt-2">

            <div id="products" class="tab-pane fade in active">
                <table class="table table-bordered">
                    <thead>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Producer</th>
                        <th>Amount</th>
                    </thead>
                    <tbody>
                        <?php while($row = $products->fetch()){ ?>
                            <tr>
                                <td><?=$row['id']?></td>
                                <td><a href="showProduct.php?id=<?=$row['id']?>"><?=$row['name']?></a></td>
                                <td><?=$row['producer_name']?></td>
                                <td><?=$row['amount']?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div id="purchases" class="tab-pane fade">
                <h3>Unapproved Purchases</h3>
                <table class="table table-bordered">
                    <thead>
                        <th>Id</th>
                        <th>Client info</th>
                        <th>Product</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <?php while($row = $purchases->fetch()){ ?>
                            <tr>
                                <td><?=$row['id']?></td>
                                <td>Client info</td>
                                <td><a href="showProduct.php?id=<?=$row['id']?>"><?=$row['product_name']?></a></td>
                                <td><?=$row['amount']?></td>
                                <td>
                                    <a href="../../functions/approvePurchase.php?id=<?=$row['id']?>" class="btn btn-sm btn-success">Approve</a>
                                    <a href="../../functions/declinePurchase.php?id=<?=$row['id']?>" class="btn btn-sm btn-danger">Decline</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div id="messages" class="tab-pane fade">
                <h3>Recent Messages</h3>

                <?php while($row = $messages->fetch()){ ?>
                
                <div class="card mt-4">
                    <div class="card-head">
                        <h5 class="card-header">
                            <a href="showProduct.php?id=<?=$row['product_id']?>">Product: <?=$row['product_id']?></a>

                            <button id="delMsgBtn" class="close">
                                <span class="float-right">&times;</span>
                            </button>
                        </h5>
                        
                    </div>
                    
                    <div class="card-body">
                        <div class="row">
                            <p class="col-10">
                                <?=$row['body']?>
                                <br>
                                <small><?=$row['recieved_at']?></small>
                            </p>
                            
                            <div class="col-2 clearfix">
                                <a href="deliveryForm.php?product_id=<?=$row['product_id']?>" class="float-right btn btn-sm btn-primary">Request Delivery</a>
                            </div>
                        </div>
                    </div>

                </div>

                <?php } ?>

            </div>

        </div>

    </div>
    
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>