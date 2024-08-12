<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="col-12 bg-dark">
        <div class="row mt-4 mb-3">

            <div class="col-12 col-lg-3 offset-lg-1 align-self-start">

                <span class="text-lg-start label1 titleWhite"><b>Welcome</b>

                    <?php
                    session_start();
                    if (isset($_SESSION["u"])) {
                        $data = $_SESSION["u"];
                    ?>

                        <?php echo $data["fname"]; ?>

                </span> <span class="titleWhite">|</span>

                <span class="text-lg-start label2 text-primary" onclick="signout();">Sign Out</span>


            <?php
                    } else {

            ?>
                <a href="index.php">Sign In or Register</a>
            <?php

                    }

            ?>


           <span class="titleWhite">|</span>



            </div>

            <div class="col-12 col-lg-8 align-self-end" style="text-align: center;">

                <div class="row">

                    <div class="col-11 col-lg-9 offset-lg-1">

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link titleBold text-warning" href="home.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link titleBold " style="color: white;" href="myproduct.php">My Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link titleBold text-warning" href="watchList.php">Wish List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link titleBold" style="color: white;" href="sellingHistory.php">My Sellings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link titleBold text-warning" href="purchaseHistory.php">Purchase History</a>
                                <!-- purchaseHistory.php -->
                            </li>
                            <li class="nav-item">
                                <a class="nav-link titleBold" style="color: white;" href="message.php?email=<?php echo $data["email"]; ?>">Messages</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link titleBold text-warning" href="userprofile.php">My Profile</a>
                                <!-- userprofile.php -->
                            </li>
                        </ul>
                    </div>


                    <div class="col-1 col-lg-2 ms-5 ms-lg-0 mt-1 cart-icon titleWhite"><a href="cart.php"><i class="bi bi-cart3 titleWhite fs-5"></i></a></div>

                </div>
            </div>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>

</body>

</html>