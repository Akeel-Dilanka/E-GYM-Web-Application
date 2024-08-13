<?php
    require_once "stripe-php-master/init.php";

    $stripeDetails = array(
        "secretKey" => "key" ,
        "publishableKey" => "key"
    );

    \Stripe\Stripe::setApiKey($stripeDetails["secretKey"]);
?>
