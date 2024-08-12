<?php

session_start();
require "connection.php";
$payment=$_POST["payment"];
$shipping=$_POST["shipping"];


$_SESSION["payment"] = $payment;
$_SESSION["shipping"] = $shipping;

Database::iud("DELETE FROM `invoice_order_id`");


echo "success";

?>