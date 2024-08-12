<?php

$qty =$_POST["pqty"];
$id =$_POST["pid"];

require "connection.php";

$product_rs=Database::search("SELECT * FROM `product` WHERE `id`='".$id."'");
$product_data=$product_rs->fetch_assoc();
$available_product_qty=$product_data["qty"];




if($qty <= 0){
    Database::iud("UPDATE `cart` SET `qty`='1' WHERE `product_id` ='".$id."'");
}else if($qty > $available_product_qty){
    Database::iud("UPDATE `cart` SET `qty`='".$available_product_qty."' WHERE `product_id` ='".$id."'");
}else if(0 < $available_product_qty){
    Database::iud("UPDATE `cart` SET `qty`='".$qty."' WHERE `product_id` ='".$id."'");
}







if($qty < 1){
echo "low_qty";
}else if ($available_product_qty < $qty){

echo "higher_qty";
}





?>