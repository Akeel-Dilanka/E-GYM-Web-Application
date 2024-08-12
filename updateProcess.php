<?php

session_start();
require "connection.php";

if (isset($_SESSION["p"]["id"])) {

    $product_id = $_SESSION["p"]["id"];

    $title = $_POST["t"];
    $qty = $_POST["q"];
    $dwc = $_POST["dwc"];
    $doc = $_POST["doc"];
    $description = $_POST["d"];
    // $image = $_FILES["i"];

    Database::iud("UPDATE `product` SET `title` = '" . $title . "' , `qty` = '" . $qty . "' , `delivery_fee_colombo` = '" . $dwc . "' , `delivery_fee_other` = '" . $doc . "' ,`description` = '" . $description . "' WHERE `id` = '" . $product_id . "' ");

    echo "Product Update Successfully";

    $allowed_img_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

    if (isset($_FILES["i1"])) {

        Database::iud("DELETE FROM `images` WHERE `product_id`='" . $product_id . "' ");

        for ($a = 0; $a < 3; $a++) {

            $code = uniqid();

            if (isset($_FILES["i" . $a])) {

                $image = $_FILES["i" . $a];

                $file_extention = $image["type"];

                if (in_array($file_extention, $allowed_img_extentions)) {

                    $newExtention;

                    if ($file_extention == "image/jpg") {
                        $newExtention = ".jpg";
                    } else if ($file_extention == "image/jpeg") {
                        $newExtention = ".jpeg";
                    } else if ($file_extention == "image/png") {
                        $newExtention = ".png";
                    } else if ($file_extention == "image/svg") {
                        $newExtention = ".svg";
                    }


                    $file_name = "resources//product_image//" . $code . $newExtention;
                    move_uploaded_file($image["tmp_name"], $file_name);

                    Database::iud("INSERT INTO `images`(`code`,`product_id`) VALUES('" . $file_name . "','" . $product_id . "')");

                    if ($a == 2) {
                        echo "Product image saved successfully";
                    }
                } else {

                    echo "Invalid image type.";
                }
            }
        }
    }
}
