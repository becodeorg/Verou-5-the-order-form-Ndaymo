<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

// We are going to use session variables so we need to enable sessions
session_start();

// Use this function when you need to need an overview of these variables
function whatIsHappening()
{
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

$city = $email = $street = $zipcode = "";

// TODO: provide some products (you may overwrite the example)
$products = [
    ['name' => 'B/W dad hat', 'price' => 15],
    ['name' => 'Love penguins tshirt', 'price' => 25],
    ['name' => 'Penguin beak mask', 'price' => 5],
    ['name' => 'Madagscar penguins hoodie', 'price' => 100]
];

$totalValue = 0;

function validate()
{
    // TODO: This function will send a list of invalid fields back
    $invalidFields = [];

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Check email
        if (empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $invalidFields[] = "Invalid email address.";
        }
        // Check address fields
        $addressFields = ["street", "streetnumber", "city", "zipcode"];
        foreach ($addressFields as $field) {
            if (empty($_POST[$field])) {
                $invalidFields[] = ucfirst($field) . " is required.";
            }
        }

        // Check product selection
        if (empty($_POST["products"])) {
            $invalidFields[] = "Select at least one product.";
        }

    }

    return $invalidFields;

}


function handleForm()
{ {
        // Assuming you have already defined your $products array
        global $products;

        // Validation
        $invalidFields = validate();

        if (!empty($invalidFields)) {
            // Handle errors: You can use these errors to display them in the form
            foreach ($invalidFields as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {
            // Process the order and display the shopping cart
            function processOrder($selectedProducts)
            {
                global $products;

                $totalAmount = 0;

                echo "<h3>You selected:</h3>";
                echo "<ul>";

                foreach ($selectedProducts as $productId => $quantity) {
                    if (isset($products[$productId])) {
                        $product = $products[$productId];
                        $productName = $product['name'];
                        $productPrice = $product['price'];

                        $subtotal = $quantity * $productPrice;
                        $totalAmount += $subtotal;

                        echo "<li>" . $productName . " - Quantity: " . $quantity . " - &euro;" . number_format($subtotal, 2) . "</li>";
                    }
                }

                echo "</ul>";

                // Display total amount
                echo "<p>Total Amount: &euro;" . number_format($totalAmount, 2) . "</p>";
            }

            $selectedProducts = isset($_POST['products']) ? $_POST['products'] : [];

            // Process the order and display the shopping cart
            processOrder($selectedProducts);
        }
    }
}



// Replace this if by an actual check for the form to be submitted
$formSubmitted = !empty($_POST);
if ($formSubmitted) {
    handleForm();
}


require 'form-view.php';