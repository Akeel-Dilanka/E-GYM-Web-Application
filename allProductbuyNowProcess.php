<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){


        $useremail = $_SESSION["u"]["email"];
        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $useremail . "' AND `status`='1'  ");
        $cart_num = $cart_rs->num_rows;

        for ($x = 0; $x < $cart_num; $x++) {

            $cart_data = $cart_rs->fetch_assoc();

            $productid = $cart_data["product_id"];
            $product_result = Database::search("SELECT * FROM `product` WHERE `id`='" . $productid . "'");
            $products_data = $product_result->fetch_assoc();
            $pprice = $products_data["price"];

            $cart_result = Database::search("SELECT * FROM `cart` WHERE `product_id`='" . $productid . "'");
            $cart_product_data = $cart_result->fetch_assoc();

            $product_qty = $cart_product_data["qty"];
            $product_price = $pprice * $product_qty;


            $productorder_id = uniqid();
            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            Database::iud("INSERT INTO `invoice`(`order_id`,`product_id`,`user_email`,`date`,`total`,`qty`,`status`) VALUES ('" . $productorder_id . "','" . $productid . "','" . $useremail . "','" . $date . "','" . $product_price . "','" . $product_qty. "','0')");
            Database::iud("INSERT INTO `invoice_order_id`(`order_id`) VALUES ('" . $productorder_id . "')");


            $new_qty = 0;
            $new_qty = $products_data["qty"] - $product_qty;

            Database::iud("UPDATE `product` SET `qty`= '". $new_qty ."' WHERE `id` = '". $productid."' ");

            echo $productorder_id ;
    
        }
    
}else{
    echo $productorder_id;
}

?>