<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

//we are going to use session variables so we need to enable sessions
session_start();

function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

// test

$emailErr = $streetErr = $streetNumErr = $cityErr = $zipErr = "";
$invalidEmail = $streetNumIntErr = $zipIntErr = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST['email'])) {
        $emailErr = "* Email cannot be empty";
    } else {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email = $_POST['email'];
        } else {
            $invalidEmail = "* is not a valid email address";
        }
    }

    if (empty($_POST['street'])) {
      $streetErr = "*  Street cannot be empty";
    } else {
      $street = $_POST['street'];
    }

    if (empty($_POST['streetnumber'])) {
        $streetNumErr = "* Street number cannot be empty";
    } else {
        if(filter_var($_POST['zipcode'], FILTER_VALIDATE_INT)) {
            $streetNum = $_POST['zipcode'];
        } else {
            $streetNumIntErr = "* Street number must be a number";
        }
    }

    if (empty($_POST['city'])) {
        $cityErr = "* City cannot be empty";
    } else {
        $city = $_POST['city'];
    }

    if (empty($_POST['zipcode'])) {
        $zipErr = "* Zipcode cannot be empty";
    } else {
        if(filter_var($_POST['zipcode'], FILTER_VALIDATE_INT)) {
            $zipcode = $_POST['zipcode'];
        } else {
            $zipIntErr = "* Zipcode must be a number";
        }
    }
}

if(isset($email, $street, $streetNum, $city, $zipcode)) {
    $correctForm = "Your order placed with this email '$email' has been sent to the following address: $street $streetNum, $city $zipcode";
}

//your products with their price.
$products = [
    ['name' => 'Margherita', 'price' => 8],
    ['name' => 'Hawaï', 'price' => 8.5],
    ['name' => 'Salami pepper', 'price' => 10],
    ['name' => 'Prosciutto', 'price' => 9],
    ['name' => 'Parmiggiana', 'price' => 9],
    ['name' => 'Vegetarian', 'price' => 8.5],
    ['name' => 'Four cheeses', 'price' => 10],
    ['name' => 'Four seasons', 'price' => 10.5],
    ['name' => 'Scampi', 'price' => 11.5]
];

$products = [
    ['name' => 'Water', 'price' => 1.8],
    ['name' => 'Sparkling water', 'price' => 1.8],
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 2.2],
];

$totalValue = 0;

require 'form-view.php';