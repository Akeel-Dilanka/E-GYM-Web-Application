<?php
    require_once "stripe-php-master/init.php";

    $stripeDetails = array(
        "secretKey" => "sk_test_51LiNF2EfuNBU2VIP1jTFADR5Kw9PMpXZtWDRrEndtvqFt6V2wXtKsBKFkcA3LQZ8aQCeu3i6eyMf8MGXc0Cwbbtr00uxqSMr9J" ,
        "publishableKey" => "pk_test_51LiNF2EfuNBU2VIPr7oW9ZnyPNwpRgm3DoJOwg7ynXvUagfcMZzFXI6GGfaJvPlPBOFALBQhULqs8NuPwn23In8500Fb1RuIQ4"
    );

    \Stripe\Stripe::setApiKey($stripeDetails["secretKey"]);
?>