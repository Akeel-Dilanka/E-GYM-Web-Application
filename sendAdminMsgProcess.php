<?php

session_start();
require "connection.php";

if(isset($_SESSION["a"])){
    
    $sender = $_SESSION["a"]["email"];
    $recevera = $_POST["e"];
    $msg = $_POST["t"];
    

    
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");
    
    if(empty($msg)){
    echo "Please enter a message to send";
    }else{
        Database::iud("INSERT INTO `message`(`from`,`to`,`content`,`date_time`,`status`) 
    VAlUES ('".$sender."','".$recevera."','".$msg."','".$date."' ,'0')");
    
    echo ("success");
    }

}

?>