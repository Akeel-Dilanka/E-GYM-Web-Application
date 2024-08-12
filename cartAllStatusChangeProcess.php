<?php

require "connection.php";

$product_rs = Database::search("SELECT * FROM `cart`");
$product_num =$product_rs->num_rows;


$product_data =  $product_rs->fetch_assoc();
$status_id=$product_data["status"];

if($status_id==1){
Database::iud("UPDATE `cart` SET `status`='0' ");

echo "deactivated";

}else if($status_id== 0){
    Database::iud("UPDATE `cart` SET `status`='1' ");
    
    echo "activated";
}

?>