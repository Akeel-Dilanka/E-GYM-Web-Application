<?php

require "connection.php";

$user_id = $_GET["id"];

$user_rs = Database::search("SELECT *FROM `user` WHERE `id` ='".$user_id."'");
$user_num =$user_rs->num_rows;

if($user_num == 1){

$user_data =  $user_rs->fetch_assoc();
$status_id=$user_data["status"];

if($status_id==1){
Database::iud("UPDATE `user` SET `status`='2' WHERE `id` ='".$user_id."'");

echo "deactivated";

}else if($status_id==2){
    Database::iud("UPDATE `user` SET `status`='1' WHERE `id` ='".$user_id."'");
    
    echo "activated";
}
}else{
    echo "Something Went Wrong . Please try again later";
}


?>