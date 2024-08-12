<?php
   
   require "connection.php";

   $f = $_POST["f"];
   $l = $_POST["l"];
   $e = $_POST["e"];
   $p = $_POST["p"];
   $m = $_POST["m"];
   $g = $_POST["g"];

   if(empty($f)){
      echo "please enter your First Name.";
   }else if (strlen($f)>50){
      echo "First Name must be less than 50 characters.";  
   }else if (empty($l)){
      echo "please enter your Last Name.";
   }else if (strlen($l)>50){
      echo "Last Name must be less than 50 characters.";  
   }else if(empty($e)){
      echo "please enter your Email Address.";
   }else if (strlen($e)>=100){
      echo "Email must be less than 100 characters.";  
   }else if(!filter_var($e,FILTER_VALIDATE_EMAIL)){
      echo "Invalid Email Address";
   }else if (empty($p)){
      echo "please enter your Password .";
   }elseif(strlen($p) < 5 || strlen($p) > 20){
      echo "Password length should be between 05 and 20";
   }else if (empty($m)){
      echo "please enter your Mobile Number.";
   }else if (strlen($m) != 10){
      echo "Mobile Number should contain 10 characters";
   }else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$m)){
      echo "Invalid Mobile Number";
   }else{

       $r = Database:: search("SELECT * FROM `user` WHERE `email`= '".$e."' OR
        `mobile`='".$m."'");
       $n = $r->num_rows;

       if($n > 0){
          echo "User with the same Email Address or Mobile Number already exists.";
       }else{
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `user` (`fname`,`lname`,`email`,`password`,`mobile`,
        `join_date`,`status`,`gender_id`)VALUES('".$f."','".$l."','".$e."','".$p."',
        '".$m."','".$date."','1','".$g."')");

        echo "Success";


       }
           
   }
   
?>