<?php 
require "connection.php";
session_start();

if(isset($_SESSION["u"])){


Database::iud("DELETE   FROM `invoice` ");

echo("Success");

}else{
    echo "Something went Wrong";
}