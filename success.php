<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resources/logo.svg" />
    <title>success</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap");
        .success-container {
            width:50%;
            position:absolute;
            top:30%;
            left:50%;
            transform:translate(-50%,-50%);
            color:#bdc3c7;
            font-weight:bold;
            font-family: "Poppins", sans-serif;
        }
    </style>
</head>
<body style="background-color: #c4c4c4; background-image: linear-gradient(90deg,#c4c4c4 0%, #505050 100%);">
      <div class="success-container">
        <?php
           if(isset($_GET["id"]) && isset($_GET["qty"]) && !empty($_GET["id"]) && !empty($_GET["qty"])){
            
            $pid = $_GET["id"];
            $qty = $_GET["qty"];

            $_SESSION["p"] = $pid;
               ?>
            <h3 class="text-white text-center">Your Transaction has been Successfully Completed</h3>
            <button class="btn btn-success container-fluid" onclick="buyNow(<?php echo $qty ?>);">Create Invoice</button>
          <?php
           }else{
            ?>

            <h3 class="text-white text-center">Your Transaction has been Successfully Completed</h3>
            <button class="btn btn-success container-fluid" onclick="allProductbuynow();">Create Invoice</button>

            <?php
           }
        ?>
      </div>  

      
      <script src="script.js"></script>
</body>
</html>