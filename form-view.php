<?php // This file is mostly containing things for your view / html ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
          <link rel="stylesheet" href="./css/style.css">
    <title>Penguin Fashion Boutique</title>
</head>
<body>
<div class="container">
    <h1>Hey Penguins!</h1>
    <h2>Ready to order?</h2>
    <?php // Navigation for when you need it ?>
    
<nav>
<ul class="nav">
<li class="nav-item">
<a class="nav-link active" href="?food=0">Order Merch</a>
</li>
<li class="nav-item">
<a class="nav-link" href="?food=1">Order Food</a>
</li>
</ul>
</nav>

    <form method="POST">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? ($_POST['email']) : ''; ?>">
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control"
                    value="<?php echo isset($_POST['street']) ? ($_POST['street']) : ''; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control"
                    value="<?php echo isset($_POST['streetnumber']) ? ($_POST['streetnumber']) : ''; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control"
                    value="<?php echo isset($_POST['city']) ? ($_POST['city']) : ''; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control"
                    value="<?php echo isset($_POST['zipcode']) ? ($_POST['zipcode']) : ''; ?>">
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            <?php if (!isset($_GET["food"]) || $_GET["food"] == 0): ?>
                        <?php foreach ($products as $i => $product): ?>
                                    <label>
                                    <?php // <?= is equal to <?php echo ?>
                                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> 
                                    <?php echo $product['name'] ?> -
                                    &euro; <?= number_format($product['price'], 2) ?></label><br />
                        <?php endforeach; ?>
            <?php elseif ($_GET['food'] == 1): ?>
                        <?php foreach ($fish as $i => $product): ?>
                                    <label>
                                    <?php // <?= is equal to <?php echo ?>
                                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> 
                                    <?php echo $product['name'] ?> -
                                    &euro; <?= number_format($product['price'], 2) ?></label><br />
                        <?php endforeach; ?>
       <?php endif; ?>

        </fieldset>

        <button type="submit" class="btn btn-primary">Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo isset($_SESSION['totalAmount']) ? number_format($_SESSION['totalAmount'], 2) : '0'; ?></strong> in merch .</footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
</body>
</html>