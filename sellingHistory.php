<?php

session_start();
require "connection.php";

$email = $_SESSION["u"]["email"];
?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PowerGym | Admin | Selling History</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

</head>

<body style="background-color: #c4c4c4; background-image: linear-gradient(90deg,#c4c4c4 0%, #505050 100%);">

    <div class="container-fluid">
        <div class="row">

            <!--header -->

            <div class="col-12">
                <div class="row">
                    <div class="col-12 bg-dark">
                        <div class="row">

                            <div class="col-4 text-center">
                                <div class="row">
                                    <div class="col-12 mt-5 my-lg-3">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item text-white"><a class="fs-4 fw-bold" href="home.php">Home</a></li>
                                                <li class="breadcrumb-item fs-4 fw-bold text-white" aria-current="page">Selling History</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <div class="row">
                                    <div class="col-12 mt-5 my-lg-3">
                                        <h1 class=" fs-1 text-danger fw-bold"> Selling History</h1>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="row">

                                    <div class="col-12 col-lg-8 text-end">
                                        <div class="row mt-2">

                                            <div class="col-12 mt-0 mt-lg-3">
                                                <span class="fw-bold text-white"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></span>
                                            </div>
                                            <div class="col-12">
                                                <span class="text-white"><?php echo $email; ?></span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4 mt-1 mb-1 text-center">

                                        <?php

                                        $profile_img_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $email . "'");
                                        $profile_img_num = $profile_img_rs->num_rows;

                                        if ($profile_img_num == 1) {

                                            $profile_img_data = $profile_img_rs->fetch_assoc();
                                        ?>
                                            <img src="<?php echo $profile_img_data["path"]; ?>" class="rounded-circle" width="80px" />


                                        <?php

                                        } else {
                                        ?>
                                            <img src="resources/Profile_img/user_icon.svg" class="rounded-circle" width="80px" />


                                        <?php
                                        }
                                        ?>

                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <!--header -->
            <div class="col-12">
                <div class="row" >
                    

                    <div class="col-2 bg-white mt-3 mb-3 shadow" style="background-color: #c4c4c4; background-image: linear-gradient(90deg,#c4c4c4 0%, #a3a3a3 100%);">
                        <div class="row">
                            

                            <div class="col-12  mt-3 mb-3">
                                <label class="form-label fs-4 fw-bold text-black">Search by Invoice ID</label>
                                <input class="form-control fs-5" type="text" placeholder="Invoice ID" />
                            </div>

                            <div class="col-12 mt-3 mb-3"></div>

                            <div class="col-12 mt-3 mb-3">
                                <label class="form-label fs-4 fw-bold text-black">From Date : </label>
                                <input class="form-control fs-5" type="date" />
                            </div>

                            <div class="col-12  mt-3 mb-3">
                                <label class="form-label fs-4 fw-bold text-black">To Date : </label>
                                <input class="form-control fs-5" type="date" />
                            </div>

                            <div class="col-12  mt-3 mb-4 d-grid">
                                <br />
                                <button class="btn btn-primary fw-bold fs-4">Find</button>
                            </div>

                        </div>
                    </div>

                    <div class="col-10 bg-light mt-3 mb-3 shadow" style="background-color: #c4c4c4; background-image: linear-gradient(90deg,#a3a3a3 0%, #505050 100%);">
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

                        $results = Database::search("SELECT `invoice`.`id`,`product`.`title`,`user`.`fname`,`user`.`lname`,
            `invoice`.`total`,`invoice`.`qty`, `invoice`.`status` FROM `invoice` 
            INNER JOIN `user` ON `invoice`.`user_email` = `user`.`email` 
            INNER JOIN `product` ON `invoice`.`product_id` = `product`.`id`
            LIMIT " . $results_per_page . " OFFSET " . $result_count . "");


                        $user_email = Database::search("SELECT * FROM `product`");
                        $user_data = $user_email->fetch_assoc();
                        $uemail = $user_data["user_email"];

                        $invoice_rs = Database::search("SELECT `invoice`.`id`,`product`.`title`,`user`.`fname`,`user`.`lname`,
            `invoice`.`total`,`invoice`.`qty`, `invoice`.`status` FROM `invoice` 
            INNER JOIN `user` ON `invoice`.`user_email` = `user`.`email` 
            INNER JOIN `product` ON `invoice`.`product_id` = `product`.`id` WHERE `user`.`email`='" . $_SESSION["u"]["email"] . "'
            LIMIT " . $results_per_page . " OFFSET " . $result_count . "");

                        if ($uemail == $_SESSION["u"]["email"]) {
                            while ($results_data = $results->fetch_assoc()) {

                        ?>

                                <div class="col-12 mb-1">
                                    <div class="row">

                                        <div class="col-1 bg-dark text-end">
                                            <label class="form-label fw-bold fs-5 text-white"><?php echo $results_data["id"]; ?></label>
                                        </div>

                                        <div class="col-3 bg-body text-end">
                                            <label class="form-label fw-bold fs-5 text-black"><?php echo $results_data["title"]; ?></label>
                                        </div>

                                        <div class="col-3 bg-dark text-end">
                                            <label class="form-label fw-bold fs-5 text-white"><?php echo $results_data["fname"] . " " . $results_data["lname"]; ?></label>
                                        </div>

                                        <div class="col-2 bg-body text-end">
                                            <label class="form-label fw-bold fs-5 text-black">Rs. <?php echo $results_data["total"]; ?> .00</label>
                                        </div>

                                        <div class="col-1 bg-dark text-end">
                                            <label class="form-label fw-bold fs-5 text-white"><?php echo $results_data["qty"]; ?></label>
                                        </div>

                                        <div class="col-2 bg-white d-grid">

                                            <?php


                                            if ($uemail == $_SESSION["u"]["email"]) {
                                                $x = $results_data["status"];

                                                if ($x == 0) {
                                            ?>
                                                    <button class="btn btn-success mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $results_data['id']; ?>);" id="btn<?php echo $results_data['id']; ?>">Confirm Order</button>
                                                <?php
                                                } else if ($x == 1) {
                                                ?>
                                                    <button class="btn btn-warning mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $results_data['id']; ?>);" id="btn<?php echo $results_data['id']; ?>">Packing</button>
                                                <?php
                                                } else if ($x == 2) {
                                                ?>
                                                    <button class="btn btn-info mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $results_data['id']; ?>);" id="btn<?php echo $results_data['id']; ?>">Dispatch</button>
                                                <?php
                                                } else if ($x == 3) {
                                                ?>
                                                    <button class="btn btn-primary mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $results_data['id']; ?>);" id="btn<?php echo $results_data['id']; ?>">Shipping</button>
                                                <?php
                                                } else if ($x == 4) {
                                                ?>
                                                    <button class="btn btn-danger mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $results_data['id']; ?>);" id="btn<?php echo $results_data['id']; ?>" disabled>
                                                        Delivered</button>
                                                <?php
                                                }
                                            } else {
                                                $x = $results_data["status"];

                                                if ($x == 0) {
                                                ?>
                                                    <button class="btn btn-success mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $results_data['id']; ?>);" id="btn<?php echo $results_data['id']; ?>" disabled>Confirm Order</button>
                                                <?php
                                                } else if ($x == 1) {
                                                ?>
                                                    <button class="btn btn-warning mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $results_data['id']; ?>);" id="btn<?php echo $results_data['id']; ?>" disabled>Packing</button>
                                                <?php
                                                } else if ($x == 2) {
                                                ?>
                                                    <button class="btn btn-info mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $results_data['id']; ?>);" id="btn<?php echo $results_data['id']; ?>" disabled>Dispatch</button>
                                                <?php
                                                } else if ($x == 3) {
                                                ?>
                                                    <button class="btn btn-primary mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $results_data['id']; ?>);" id="btn<?php echo $results_data['id']; ?>" disabled>Shipping</button>
                                                <?php
                                                } else if ($x == 4) {
                                                ?>
                                                    <button class="btn btn-danger mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $results_data['id']; ?>);" id="btn<?php echo $results_data['id']; ?>" disabled>
                                                        Delivered</button>
                                            <?php
                                                }
                                            }
                                            ?>





                                        </div>

                                    </div>
                                </div>

                            <?php

                            }
                        } else {
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


                                            if ($uemail == $_SESSION["u"]["email"]) {
                                                $x = $invoice_data["status"];

                                                if ($x == 0) {
                                            ?>
                                                    <button class="btn btn-success mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $invoice_data['id']; ?>);" id="btn<?php echo $invoice_data['id']; ?>">Confirm Order</button>
                                                <?php
                                                } else if ($x == 1) {
                                                ?>
                                                    <button class="btn btn-warning mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $invoice_data['id']; ?>);" id="btn<?php echo $invoice_data['id']; ?>">Packing</button>
                                                <?php
                                                } else if ($x == 2) {
                                                ?>
                                                    <button class="btn btn-info mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $invoice_data['id']; ?>);" id="btn<?php echo $invoice_data['id']; ?>">Dispatch</button>
                                                <?php
                                                } else if ($x == 3) {
                                                ?>
                                                    <button class="btn btn-primary mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $invoice_data['id']; ?>);" id="btn<?php echo $invoice_data['id']; ?>">Shipping</button>
                                                <?php
                                                } else if ($x == 4) {
                                                ?>
                                                    <button class="btn btn-danger mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $invoice_data['id']; ?>);" id="btn<?php echo $invoice_data['id']; ?>" disabled>
                                                        Delivered</button>
                                                <?php
                                                }
                                            } else {
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
                                            }
                                            ?>





                                        </div>

                                    </div>
                                </div>
                    </div>

            <?php

                            }
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


                </div>
            </div>

        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>