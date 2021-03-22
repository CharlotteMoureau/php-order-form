<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="./style.css" rel="stylesheet">
    <title>Order Pizzas & drinks</title>
</head>
<body>
<div class="container">
    <div class="top">
        <h1>Order pizzas in restaurant "the Personal Pizza Processors"</h1>
    </div>

    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=pizzas">Order pizzas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=drinks">Order drinks</a>
            </li>
        </ul>
    </nav>

    <div class="alert alert-success" id="alert"><?php if(isset($correctForm)) {echo $correctForm;} ?></div>
    <div class="alert alert-danger" id="incorrect"><?php if(isset($noOrder)) {echo $noOrder;} ?></div>

    <div class="grid">
        <div class="grid-items">
        
            <form method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">E-mail:</label>
                        <input type="text" id="email" name="email" class="form-control" value="<?php if(isset($_SESSION["email"])) {echo $_SESSION["email"];} ?>"/>
                        <span class="error text-danger"><?php echo $emailErr;?></span>
                        <span class="error text-danger"><?php echo $invalidEmail;?></span>
                    </div>
                    <div></div>
                </div>

                <fieldset>
                    <legend>Address</legend>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="street">Street:</label>
                            <input type="text" name="street" id="street" class="form-control" value="<?php if(isset($_SESSION["street"])) {echo $_SESSION["street"];} ?>">
                            <span class="error text-danger"><?php echo $streetErr;?></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="streetnumber">Street number:</label>
                            <input type="text" id="streetnumber" name="streetnumber" class="form-control" value="<?php if(isset($_SESSION["streetNum"])) {echo $_SESSION["streetNum"];} ?>">
                            <span class="error text-danger"><?php echo $streetNumErr;?></span>
                            <span class="error text-danger"><?php echo $streetNumIntErr;?></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="city">City:</label>
                            <input type="text" id="city" name="city" class="form-control" value="<?php if(isset($_SESSION["city"])) {echo $_SESSION["city"];} ?>">
                            <span class="error text-danger"><?php echo $cityErr;?></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="zipcode">Zipcode</label>
                            <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?php if(isset($_SESSION["zipcode"])) {echo $_SESSION["zipcode"];} ?>">
                            <span class="error text-danger"><?php echo $zipErr;?></span>
                            <span class="error text-danger"><?php echo $zipIntErr;?></span>
                        </div>
                    </div>
                </fieldset>
        </div>
        <div class="grid-items">
        
            <fieldset>
                    <legend>Products</legend>
                    <?php foreach ($products AS $i => $product): ?>
                        <label class="text-content">
                            <input class="checkbox" type="number" value="0" onclick="isCheckbooxCheched()" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?> -
                            &euro; <?php echo number_format($product['price'], 2) ?></label><br/>
                    <?php endforeach; ?>
                </fieldset>
                
                <label>
                    <input type="checkbox" name="express_delivery" id="express" value="5" /> 
                    Express delivery (+ 5 EUR)
                </label>
                    
                <button type="submit" class="btn btn-primary">Order!</button>
            </form>
        </div>
    </div>         

    <footer>You already ordered <strong id="target">&euro; <?php if(isset($_COOKIE['totalSpent'])) { echo $_COOKIE['totalSpent'];} ?></strong> in pizza(s) and drinks.</footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
<script src="./index.js"></script>
</body>
</html>
