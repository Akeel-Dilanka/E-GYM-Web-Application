<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    if (isset($_GET["id"])) {

        $pid = $_GET["id"];
        $uemail = $_SESSION["u"]["email"];

        $cartProduct_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $uemail . "'
        AND `product_id`='" . $pid . "'");
        $cart_product_num = $cartProduct_rs->num_rows;

        $Product_qty_rs = Database::search("SELECT `qty` FROM `product` WHERE `id`='".$pid."'");
        $product_qty_data = $Product_qty_rs->fetch_assoc();
       
        $product_qty = $product_qty_data["qty"];

        if($cart_product_num == 1){
             $cartProductData = $cartProduct_rs->fetch_assoc();
             $currentQty = $cartProductData["qty"];
             $newQty = (int)$currentQty + 1 ;

             if($product_qty >= $newQty){
                Database::iud("UPDATE `cart` SET `qty`='".$newQty."' WHERE`user_email`='" . $uemail . "'
                AND `product_id`='" . $pid . "'");

                echo "Product quantity Updated.";

             }else{
                echo "Invalid Product Quantity.";
             }
        }else{
            Database::iud("INSERT INTO `cart`(`product_id`,`user_email`,`qty`,`status`) VALUES ('".$pid."','".$uemail."','1','0')");
            echo "New Product Added To The Cart.";
        }

    }else{
        echo "Sorry For The Inconvient.";
    }
}else{
    echo "Please Log In OR Sign Up.";
}
