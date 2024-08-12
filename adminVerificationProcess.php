<?php

require "connection.php";
require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["em"])){

    if(empty($_POST["em"])){
        echo "Please Enter your Email Address";
    }else{

        $email = $_POST["em"];

        $adminrs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $email . "' ");
        $admin_num = $adminrs->num_rows;

        if ($admin_num == 1) {
        $code = uniqid();

            Database::iud("UPDATE `admin` SET  `code` = '" . $code . "' WHERE `email` = '" . $email . "' ");

        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'akeeldfernando@gmail.com'; 
            $mail->Password = 'password'; 
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('akeeldfernando@gmail.com', 'eGym'); 
            $mail->addReplyTo('akeeldfernando@gmail.com', 'eGym'); 
            $mail->addAddress($email); 
            $mail->isHTML(true);
            $mail->Subject = 'PowerGym Forget Password Verification Code'; 
            $bodyContent = '<div style="background-color: antiquewhite; width: 40vw; hight: 40vh; border-radius: 40px; overflow: hidden; box-shadow: 0px 7px 22px 0px rgba(0, 0, 0, .1);">
            <div style="background-color: #0fd59f; width: 100%; height: 60px; font-size: 23px; font-family: $font-title; height: 60px; line-height: 60px; margin: 0; text-align: center; color: white;">Your Verification code</div>
            <h3 style="color:black; text-align: center;"> Enter this verification code in field: </h3>
            <div><h1 style="color:green; text-align: center;"> '.$code.' </h1></div>
            <h3 style="color:black; font-style: italic; opacity: 0.3; text-align: center;"> Verification code is valid only for 30 minutes </h3>
            </div>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'success';
            }
            
    }else{
        echo "Email address not found";
    }

    }
}else{
    echo"Please enter your email address";
}
