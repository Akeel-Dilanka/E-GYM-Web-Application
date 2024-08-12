<?php

require "connection.php";

if (isset($_POST["t"]) && isset($_POST["m"]) && isset($_POST["e"])) {

    $vcode = $_POST["t"];
    $mname = $_POST["m"];
    $uemail = $_POST["e"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $uemail . "'");
    $admin_num = $admin_rs->num_rows;

    if ($admin_num == 1) {

        $admin_data = $admin_rs->fetch_assoc();

        if ($vcode == $admin_data["code"]) {
            Database::iud("INSERT INTO `model` (`name`) VALUES ('" . $mname . "')");
            echo "success";
        } else {
            echo "Invalid Verification Code";
        }
    } else {
        echo "Something went wrong";
    }
}