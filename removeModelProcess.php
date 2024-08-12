<?php 
require "connection.php";

if(isset($_GET["id"])){

    $mid = $_GET["id"];
    $model_rs=Database::search("SELECT * FROM `model` WHERE `id` ='".$mid."'");
    $model_data=$model_rs->fetch_assoc();

    $model_id =$model_data["id"];



Database::iud("DELETE FROM `model` WHERE `id`='".$mid."'");

echo("Success");

}else{
    echo "Something went Wrong";
}
