<?php 
require "connection.php";

if(isset($_GET["id"])){

    $iid = $_GET["id"];
    $invoice_rs=Database::search("SELECT * FROM `invoice` WHERE `id` ='".$iid."'");
    $invoice_data=$invoice_rs->fetch_assoc();

    $invoice_id =$invoice_data["id"];



Database::iud("DELETE FROM `invoice` WHERE `id`='".$iid."'");

echo("Success");

}else{
    echo "Something went Wrong";
}