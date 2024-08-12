<?php 
require "connection.php";

if(isset($_GET["id"])){

    $bid = $_GET["id"];
    $brand_rs=Database::search("SELECT * FROM `brand` WHERE `id` ='".$bid."'");
    $brand_data=$brand_rs->fetch_assoc();

    $brand_id =$brand_data["id"];



Database::iud("DELETE FROM `brand` WHERE `id`='".$bid."'");

echo("Success");

}else{
    echo "Something went Wrong";
}




?>
