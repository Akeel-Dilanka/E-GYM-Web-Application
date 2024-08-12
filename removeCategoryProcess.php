<?php 
require "connection.php";

if(isset($_GET["id"])){

    $cid = $_GET["id"];
    $category_rs=Database::search("SELECT * FROM `category` WHERE `id` ='".$cid."'");
    $category_data=$category_rs->fetch_assoc();

    $category_id =$category_data["id"];



Database::iud("DELETE FROM `category` WHERE `id`='".$cid."'");

echo("Success");

}else{
    echo "Something went Wrong";
}

?>
