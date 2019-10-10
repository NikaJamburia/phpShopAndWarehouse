<?php
    include_once "../../config/Database.php";
    include_once "../../models/Producer.php";


    $database = new Database();
    $db = $database->connect();

    $producer = new Producer($db);
    $producers = $producer->read();
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

    <?php include_once "../../includes/admin_navbar.html" ?>

    <div class="container mt-3">
        <h1 class="text-center">Admin</h1>

        <form action="../../functions/createProduct.php" method="POST" class="form border rounded p-3">
            <h3>Add New Product</h3>
            <hr>

            <div class="row">

                <div class="form-group col-6">
                    <label for="name">Product Name:</label>
                    <input type="text" name="name" id="name" class="form-control" reqiured>
                </div>

                <div class="form-group col-6">
                    <label for="price">Price:</label>
                    <input type="number" name="price" id="price" class="form-control" reqiured>
                </div>

            </div>

            <div class="form-group">
                <label for="producer">Select Producer:</label>
                <select name="producer" id="producer" class="form-control" required>
                    <option value="" disabled selected>Company name...</option>

                    <?php foreach($producers as $prod){ ?>
                        <option value="<?=$prod['id']?>"> <?=$prod['name']?> </option>
                    <?php } ?>

                </select>
            </div>

            <div class="form-group">
                <label for="desc">Description:</label>
                <textarea name="desc" id="desc" cols="30" rows="10" class="form-control" required></textarea>
            </div>

            <label for="img">Image:</label> <br>
            <input type="file" name="img" id="img"> <br>

            <input type="submit" value="Add" class="btn btn-primary mt-2">

        </form>

        <form action="../../functions/createProducer.php" method="POST" class="form border rounded p-3 my-3">
            <h3>Add New Producer</h3>
            <hr>

            <div class="row">
                <div class="form-group col-6">
                    <label for="name">Producer Name:</label>
                    <input type="text" name="name" id="name" class="form-control" reqiured>
                </div>

                <div class="form-group col-6">
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" class="form-control" reqiured>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label for="address">Address:</label>
                    <input type="text" name="address" id="address" class="form-control" reqiured>
                </div>

                <div class="form-group col-6">
                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" id="phone" class="form-control" reqiured>
                </div>
            </div>

            <input type="submit" value="Add" class="btn btn-primary mt-2">

        </form>
    </div>

    
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>