<?php
use PHPMailer\PHPMailer\PHPMailer;
require "connection.php";

require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";



$new_model= $_POST["n"];
$user_email = $_POST["e"];

$model_rs = Database::search("SELECT * FROM `model` WHERE `name`LIKE '%".$new_model."%' ");
 $model_num= $model_rs->num_rows;

if($model_num == 0){

$code = uniqid();

Database::iud ("UPDATE `admin` SET `code`='".$code."' WHERE `email`='" .$user_email."' ");
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
$mail->addAddress($user_email); 
$mail->isHTML(true);
$mail->Subject = 'Admin Verification Code'; 
$bodyContent = '<div style="background-color: antiquewhite; width: 40vw; hight: 40vh; border-radius: 40px; overflow: hidden; box-shadow: 0px 7px 22px 0px rgba(0, 0, 0, .1);">
<div style="background-color: #0fd59f; width: 100%; height: 60px; font-size: 23px; font-family: $font-title; height: 60px; line-height: 60px; margin: 0; text-align: center; color: white;">Your Verification code</div>
<h3 style="color:black; text-align: center;"> Enter this verification code in field: </h3>
<div><h1 style="color:green; text-align: center;"> '.$code.' </h1></div>
<h3 style="color:black; font-style: italic; opacity: 0.3; text-align: center;"> Verification code is valid only for 30 minutes </h3>
</div>';
$mail->Body    = $bodyContent;

if(!$mail->send()){
    echo "Decline Email Sending Failed";
}else{
    echo "success";
}

}else{
    echo "This Model Exists";
}

?>