<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

//we are going to use session variables so we need to enable sessions
session_start();

$totalValue = 0;

// check the inputs and their validity
$emailErr = $streetErr = $streetNumErr = $cityErr = $zipErr = "";
$invalidEmail = $streetNumIntErr = $zipIntErr = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// check email
    if (empty($_POST['email'])) {
        $emailErr = "* Email cannot be empty";
    } else {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email = htmlspecialchars($_POST['email']);
        } else {
            $invalidEmail = "* " . $_POST['email'] . " is not a valid email address";
        }
    }

// check street
    if (empty($_POST['street'])) {
    $streetErr = "*  Street cannot be empty";
    } else {
    $street = htmlspecialchars($_POST['street']);
    }

    // check street number
    if (empty($_POST['streetnumber'])) {
        $streetNumErr = "* Street number cannot be empty";
    } else {
        if(filter_var($_POST['streetnumber'], FILTER_VALIDATE_INT)) {
            $streetNum = htmlspecialchars($_POST['streetnumber']);
        } else {
            $streetNumIntErr = "* Street number must be a number";
        }
    }

    // check city
    if (empty($_POST['city'])) {
        $cityErr = "* City cannot be empty";
    } else {
        $city = htmlspecialchars($_POST['city']);
    }

    // check zipcode
    if (empty($_POST['zipcode'])) {
        $zipErr = "* Zipcode cannot be empty";
    } else {
        if(filter_var($_POST['zipcode'], FILTER_VALIDATE_INT)) {
            $zipcode = htmlspecialchars($_POST['zipcode']);
        } else {
            $zipIntErr = "* Zipcode must be a number";
        }
    }
}

//your products with their price.
$pizzas = [
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

$drinks = [
    ['name' => 'Water', 'price' => 1.8],
    ['name' => 'Sparkling water', 'price' => 1.8],
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 2.2],
];

// sets pizzas as default
$products = $pizzas;

// toggle between links
if (isset($_GET['food'])) {
    $value = $_GET['food'];
    if ($value == 'drinks') {
        $products = $drinks;
    }
};

// sets localhour
$localHour = date_create('now', new DateTimeZone('Europe/Brussels'))->format('G:i');

// check if express delivery is enabled
$standardDeliveryTime = date("G:i", strtotime('+1 hour', strtotime($localHour)));
$expressDeliveryTime = date("G:i", strtotime('+30 minutes', strtotime($localHour)));

if (isset($_POST['express_delivery'])) {
    $deliveryTime = $expressDeliveryTime;
    $totalValue += 5;
} else {
    $deliveryTime = $standardDeliveryTime;
}

// total price
if (isset($_POST['products'])) {
    $selectedProducts = $_POST['products'];

    foreach ($selectedProducts AS $i => $choice) {
        if ($choice > 0) {
            $totalValue += $choice * $products[$i]['price'];
        }
    }
    $_SESSION['total-price'] = $totalValue;
}

// alert if all inputs are correct add the price and the time of the delivery
if (isset($email, $street, $streetNum, $city, $zipcode, $totalValue, $deliveryTime)) {
    
    // session to store user's address
    $_SESSION["email"] = $email;
    $_SESSION["street"] = $street;
    $_SESSION["streetNum"] = $streetNum;
    $_SESSION["city"] = $city;
    $_SESSION["zipcode"] = $zipcode;

    if ($totalValue == 0) {
        $noOrder = "No product ordered. Invalid order.";
    } elseif ($totalValue == 5 && isset($_POST['express_delivery'])) {
        $noOrder = "No product ordered. Invalid order.";
    } else {
        $correctForm = "<h3>Buon appetito!</h3> </br>Your order placed with the email <strong>'$email'</strong> has been completed. </br>You payed <strong>&euro; $totalValue</strong></br> Your order has been sent to the following address: <strong>$street n° $streetNum, $city $zipcode</strong>.</br>Delivery is expected at: <strong>$deliveryTime</strong>";
    }
}

  // sets cookie for total revenue counter
if (!isset($_COOKIE['totalSpent'])) {
    setcookie('totalSpent', '0', time() + 5*24*3600);
} else {
    $value = $_COOKIE['totalSpent'] + $totalValue;
    setcookie('totalSpent', (string) $value, time() + 5*24*3600);
}

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

// whatIsHappening();

require './src/form-view.php';