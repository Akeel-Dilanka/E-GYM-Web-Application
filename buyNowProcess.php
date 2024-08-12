<?php

session_start();
require "connection.php";

$pid = $_SESSION["p"];
$qty = $_POST["pqty"];

$uemail = $_SESSION["u"]["email"];
$order_id = uniqid();

$product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "' ");
$product_data = $product_rs->fetch_assoc();

$uprice = $product_data["price"];
$total = $uprice * $qty;

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `invoice`(`order_id`,`product_id`,`user_email`,`date`,`total`,`qty`,`status`) VALUES ('" . $order_id . "','" . $pid . "','" . $uemail . "','" . $date . "','" . $total . "','" . $qty . "','0')");

$new_qty = 0;
$new_qty = $product_data["qty"] - $qty;

Database::iud("UPDATE `product` SET `qty`= '" . $new_qty . "' WHERE `id` = '" . $pid . "' ");

echo $order_id;
