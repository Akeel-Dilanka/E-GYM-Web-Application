<?php

require "connection.php";

$product_id = $_GET["id"];

$product_rs = Database::search("SELECT *FROM `cart` WHERE `product_id` ='".$product_id."'");
$product_num =$product_rs->num_rows;

if($product_num== 1){
$product_data =  $product_rs->fetch_assoc();
$status_id=$product_data["status"];

if($status_id==1){
Database::iud("UPDATE `cart` SET `status`='0' WHERE `product_id` ='".$product_id."'");

echo "deactivated";

}else if($status_id== 0){
    Database::iud("UPDATE `cart` SET `status`='1' WHERE `product_id` ='".$product_id."'");
    
    echo "activated";
}
}else{
    echo "Something Went Wrong . Please try again ";
}


?>