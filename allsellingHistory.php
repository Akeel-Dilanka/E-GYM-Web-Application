<?php
require "connection.php";
session_start();

$email = $_SESSION["a"]["email"];

$resultSet = Database::search(" SELECT * FROM `user` INNER JOIN  `profile_image` ON 
`user`.`email`=`profile_image`.`user_email` INNER JOIN `user_has_address` ON 
`user`.`email` =`user_has_address`.`user_email` INNER JOIN `city` ON
`user_has_address`.`city_id` = `city`.`id` INNER JOIN `district` ON
`city`.`district_id` = `district`.`id` INNER JOIN `province`ON 
`district`.`province_id` = `province`.`id`  INNER JOIN `gender` ON 
`user`.`gender_id`=`gender`.`id` WHERE `user`.`email` = '" . $email . "'");

$n = $resultSet->num_rows;

if ($n == 1) {
    $d = $resultSet->fetch_assoc();
}

?>

<!DOCTYPE html>
<html lang>

<head>

    <title>PowerGym | View Selling History</title>
</head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />

<link rel="icon" href="resources/logo.svg" />
<link rel="stylesheet" href="bootstrap.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="style.css" />

<body style="background-color: #c4c4c4; background-image: linear-gradient(90deg,#c4c4c4 0%, #505050 100%);">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div class="row">
                    <div class="col-12 text-center fw-bold mb-3 mt-0 bg-dark">
                        <h2 class="fs-1 text-danger fw-bold">All Selling History</h2>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-2 m-3 my-0">
                <div class="row">

                    <div class="align-items-start col-12 border border-white rounded" style="background-color: #17141d; box-shadow: -1rem 0 3rem #000;">
                        <div class="row g-1 text-center m-2">

                            <div class="col-12">
                                <?php
                                if ($d["path"] == null) {
                                ?>
                                    <img src="resources/profile_img/default.svg" class="rounded mt-4" style="width: 150px;" />
                                <?php
                                } else {
                                ?>
                                    <img src="<?php echo $d["path"]; ?>" class="rounded mt-4" style="width: 150px;" />
                                <?php
                                }
                                ?>
                            </div>

                            <?php
                            $view_user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $_SESSION["a"]["email"] . "' ");
                            $view_result_data = $view_user_rs->fetch_assoc();
                            ?>

                            <div class="col-12 mt-3">
                                <h5 class="text-white"><?php echo $view_result_data["fname"] . " " . $view_result_data["lname"] ?></h5>
                            </div>

                            <div class="nav flex-column nav-pills me-3 mt-2">
                            <hr class="border border-1 border-white" />
                                <nav class="nav flex-column">
                                    <a class="nav-link fw-bold fs-4" href="adminpanel.php">Dashboard</a>
                                    <a class="nav-link fw-bold fs-4" href="manageusers.php">Manage Users</a>
                                    <a class="nav-link fw-bold fs-4" href="manageProduct.php">Manage Product</a>
                                </nav>
                                <hr class="border border-1 border-white" />
                            </div>

                            <div class="col-12 mt-3 d-grid">
                            <hr class="border border-1 border-white" />
                                <h5 class="text-white">From Date</h5>
                                <input type="date" class="form-control" />
                                <br />
                                <h5 class="text-white">To Date</h5>
                                <input type="date" class="form-control" />
                                <br />
                                <a class="btn btn-primary fw-bold mt-2 fs-5 rounded-pill active" href="#">View Selling History</a>
                                <hr class="border border-1 border-white" />
                            </div>

                        </div>
                    </div>

                </div>
            </div>


            <div class="col-12 col-lg-9 mx-5">
                <div class="row">
                    <!--  -->

                    
                    <div class="col-12 mt-3 mb-2 ">
                            <div class="row">

                                <div class="col-1 bg-black text-end border border-1 border-white">
                                    <label class="form-label fw-bold fs-5 text-white">Invoice ID</label>
                                </div>

                                <div class="col-3 bg-black text-end border border-1 border-white">
                                    <label class="form-label fw-bold fs-5 text-white">Product</label>
                                </div>

                                <div class="col-3 bg-black text-end border border-1 border-white">
                                    <label class="form-label fw-bold fs-5 text-white">Buyer</label>
                                </div>

                                <div class="col-2 bg-black text-end border border-1 border-white">
                                    <label class="form-label fw-bold fs-5 text-white">Amount</label>
                                </div>

                                <div class="col-1 bg-black text-end border border-1 border-white">
                                    <label class="form-label fw-bold fs-5 text-white">Quantity</label>
                                </div>

                                <div class="col-2 bg-black border border-1 border-white">
                                    <label class="form-label fw-bold fs-5 text-white">Delivery State</label>
                                </div>

                            </div>
                        </div>

                        <?php

                        $page_no;

                        if (isset($_GET["page"])) {
                            $page_no = $_GET["page"];
                        } else {
                            $page_no = 1;
                        }

                        $invoice_rs = Database::search("SELECT * FROM `invoice`");
                        $invoice_num = $invoice_rs->num_rows;

                        $results_per_page = 10;
                        $number_of_pages = ceil($invoice_num / $results_per_page);

                        $result_count = ((int)$page_no - 1) * $results_per_page;


                        $user_email = Database::search("SELECT * FROM `product`");
                        $user_data = $user_email->fetch_assoc();
                        $uemail = $user_data["user_email"];

                        $invoice_rs = Database::search("SELECT `invoice`.`id`,`product`.`title`,`user`.`fname`,`user`.`lname`,
            `invoice`.`total`,`invoice`.`qty`, `invoice`.`status` FROM `invoice` 
            INNER JOIN `user` ON `invoice`.`user_email` = `user`.`email` 
            INNER JOIN `product` ON `invoice`.`product_id` = `product`.`id` 
            LIMIT " . $results_per_page . " OFFSET " . $result_count . "");


                                            
                            while ($invoice_data = $invoice_rs->fetch_assoc()) {

                            ?>

                                <div class="col-12 mb-1">
                                    <div class="row">

                                        <div class="col-1 bg-secondary text-end">
                                            <label class="form-label fw-bold fs-5 text-white"><?php echo $invoice_data["id"]; ?></label>
                                        </div>

                                        <div class="col-3 bg-body text-end">
                                            <label class="form-label fw-bold fs-5 text-black"><?php echo $invoice_data["title"]; ?></label>
                                        </div>

                                        <div class="col-3 bg-secondary text-end">
                                            <label class="form-label fw-bold fs-5 text-white"><?php echo $invoice_data["fname"] . " " . $invoice_data["lname"]; ?></label>
                                        </div>

                                        <div class="col-2 bg-body text-end">
                                            <label class="form-label fw-bold fs-5 text-black">Rs. <?php echo $invoice_data["total"]; ?> .00</label>
                                        </div>

                                        <div class="col-1 bg-secondary text-end">
                                            <label class="form-label fw-bold fs-5 text-white"><?php echo $invoice_data["qty"]; ?></label>
                                        </div>

                                        <div class="col-2 bg-white d-grid">

                                            <?php


                                            
                                                $x = $invoice_data["status"];

                                                if ($x == 0) {
                                                ?>
                                                    <button class="btn btn-success mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $invoice_data['id']; ?>);" id="btn<?php echo $invoice_data['id']; ?>" disabled>Confirm Order</button>
                                                <?php
                                                } else if ($x == 1) {
                                                ?>
                                                    <button class="btn btn-warning mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $invoice_data['id']; ?>);" id="btn<?php echo $invoice_data['id']; ?>" disabled>Packing</button>
                                                <?php
                                                } else if ($x == 2) {
                                                ?>
                                                    <button class="btn btn-info mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $invoice_data['id']; ?>);" id="btn<?php echo $invoice_data['id']; ?>" disabled>Dispatch</button>
                                                <?php
                                                } else if ($x == 3) {
                                                ?>
                                                    <button class="btn btn-primary mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $invoice_data['id']; ?>);" id="btn<?php echo $invoice_data['id']; ?>" disabled>Shipping</button>
                                                <?php
                                                } else if ($x == 4) {
                                                ?>
                                                    <button class="btn btn-danger mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $invoice_data['id']; ?>);" id="btn<?php echo $invoice_data['id']; ?>" disabled>
                                                        Delivered</button>
                                            <?php
                                                }
                                            
                                            ?>





                                        </div>

                                    </div>
                                </div>
                    

            <?php

                            }
                        

            ?>

            <div class="offset-lg-4 col-12 col-lg-4 text-center mt-3 mb-3 d-flex justify-content-center">
                <div class="row">
                    <div class="pagination">
                        <a href="<?php if ($page_no <= 1) {
                                        echo "#";
                                    } else {
                                        echo "?page=" . ($page_no - 1);
                                    } ?>">&laquo;</a>

                        <?php
                        for ($page = 1; $page <= $number_of_pages; $page++) {
                            if ($page == $page_no) {
                        ?>
                                <a href="<?php echo "?page=" . ($page); ?>" class="active bg-warning text-black fw-bold"><?php echo $page; ?></a>
                            <?php
                            } else {
                            ?>
                                <a href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                        <?php
                            }
                        }
                        ?>

                        <a href="<?php if ($page_no >= $number_of_pages) {
                                        echo "#";
                                    } else {
                                        echo "?page=" . ($page_no + 1);
                                    } ?>">&raquo;</a>
                    </div>
                </div>
            </div>


                    <!--  -->
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>