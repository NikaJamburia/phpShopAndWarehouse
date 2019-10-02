<?php
    include_once "../../config/Database.php";
    include_once "../../models/Product.php";
    include_once "../../models/Delivery.php";
    include_once "../../models/Producer.php";

    $database = new Database();
    $db = $database->connect();



    $delivery = new Delivery($db);
    $deliveries = $delivery->read();

    $producer = new Producer($db);
    $producers = $producer->read();

    if(isset($_GET['product_id'])){
        $prod = new Product($db);
        $prod->show($_GET['product_id']);

        $producerDefault = new Producer($db);
        $producerDefault->show($prod->producer_id);

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

    <div class="container mt-3 mb-4 border rounded py-3">
        <h3>Request new delivery</h3>

        <form action="../../functions/requestDelivery.php" method="post" id="form" class="form mt-1">
            <div class="row">

                <div class="col-4">
                    <div class="form-group">
                        <label for="producer">Select company</label>
                        <select class="form-control" id="producerSelect" name="producer" id="producer">

                            <?php if(isset($_GET['product_id'])){ ?>
                                <option value="<?=$producerDefault->id?>"  selected><?=$producerDefault->name?></option>
                            <?php }else{ ?>
                                <option value="" disabled selected>Company name...</option>
                            <?php } ?>

                            <?php while($row = $producers->fetch()){ ?>
                                <option value="<?=$row['id']?>"><?=$row['name']?></option>
                            <?php } ?>
                        </select>
                        <small class="text-danger" id="producerError"></small>
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label for="product">Select product</label>
                        <select class="form-control" id="productSelect" <?php if(!isset($_GET['product_id'])){ echo "disabled";} ?> name="product">

                            <?php if(isset($_GET['product_id'])){ ?>
                                <option value="<?=$prod->id?>"  selected><?=$prod->name?></option>
                            <?php }else{ ?>
                                <option value="" id="productSelectPlaceHolder" disabled selected>Select company first</option>
                            <?php } ?>

                        </select>
                        <small class="text-danger" id="productError"></small>
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" name="amount" id="amount">
                        <small class="text-danger" id="amountError"></small>
                    </div>
                </div>

            </div>
            <input type="submit" value="Request" id="submitBtn" class="btn btn-primary">
        </form>
    </div>

    <div class="container p-0">
        <h4>All deliveries</h4>

        <table class="table table-bordered">
            <thead>
                <th>id</th>
                <th>Product</th>
                <th>Company</th>
                <th>Amount</th>
                <th>Date</th>
            </thead>
            <tbody>
                <?php while($row = $deliveries->fetch()){ ?>

                    <tr>
                        <td><?=$row['id']?></td>
                        <td><a href="showProduct.php?id=<?=$row['product_id']?>"><?=$row['product_name']?></a></td>
                        <td><?=$row['producer_name']?></td>
                        <td><?=$row['amount']?></td>
                        <td><?=$row['delivery_date']?></td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="../../js/requestDeliveryValidation.js"></script>
    
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>