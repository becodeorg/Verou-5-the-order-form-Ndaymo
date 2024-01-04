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


    }

    return $invalidFields;


}
function handleForm()
{
    // Validation
    $invalidFields = validate();

    if (!empty($invalidFields)) {
        // Handle errors: You can use these errors to display them in the form
        foreach ($invalidFields as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        var_dump($_POST);


        // For now, let's just print a success message
        echo "<div class='alert alert-success'>Order confirmed! Penguins are on their way!</div>";
    }
}

// Replace this if by an actual check for the form to be submitted
$formSubmitted = !empty($_POST);
if ($formSubmitted) {
    handleForm();
}


require 'form-view.php';