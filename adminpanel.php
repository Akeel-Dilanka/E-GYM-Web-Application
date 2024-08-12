<?php
session_start();
require "connection.php";

if (isset($_SESSION["a"])) {

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

    <html>

    <head>

        <title>PowerGym | Admin Panel</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/logo.svg" />

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

    </head>

    <body style="background-color: #c4c4c4; background-image: linear-gradient(90deg,#c4c4c4 0%, #505050 100%);">

        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 text-center fw-bold mb-3 mt-0 bg-dark">
                            <h2 class="fs-1 text-danger fw-bold">Dashboard</h2>
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
                                        <a class="nav-link fw-bold fs-4 active" href="#">Dashboard</a>
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
                                    <a class="btn btn-primary fw-bold mt-2 fs-5 rounded-pill" href="allsellingHistory.php">View Selling History</a>
                                    <hr class="border border-1 border-white" />
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-lg-9 mx-5">
                    <div class="row">

                        <div class="col-12 bg-dark rounded-pill">
                            <div class="row m-1">

                                <div class="col-12 col-lg-2 text-center mt-1 mb-1">
                                    <label class="form-label fs-4 fw-bold text-white">Total Active Time</label>
                                </div>

                                <?php

                                $start_date = new DateTime("2022-11-01 00:00:00");

                                $tdate = new DateTime();
                                $tz = new DateTimeZone("Asia/Colombo");
                                $tdate->setTimezone($tz);

                                $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));

                                $difference = $end_date->diff($start_date);

                                ?>

                                <div class="col-12 col-lg-10 text-end mt-1 mb-1">
                                    <label class="form-label fs-4 fw-bold text-white">
                                        <?php

                                        echo $difference->format('%Y') . " Years " . $difference->format('%m') . " Months " .
                                            $difference->format('%d') . " Days " . $difference->format('%H') . " Hours " .
                                            $difference->format('%i') . " Minutes " . $difference->format('%s') . " Seconds ";

                                        ?>
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="hr-break-1" />
                        </div>

                        <div class="col-12 bg-light" style="border-radius:20px;">
                            <div class="row g-1 mt-2 mx-1 my-1">

                                <div class="col-12 col-lg-4 px-1 ">
                                    <div class="row g-1">
                                        <div class="setu">
                                            <div class="butto">

                                                <?php

                                                $today = date("Y-m-d");
                                                $this_month = date("m");
                                                $this_year = date("y");

                                                $a = "0";
                                                $b = "0";
                                                $c = "0";
                                                $d = "0";
                                                $e = "0";

                                                $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                                $invoice_num = $invoice_rs->num_rows;

                                                for ($x = 0; $x < $invoice_num; $x++) {

                                                    $invoice_data = $invoice_rs->fetch_assoc();

                                                    $e = $e + $invoice_data["qty"];

                                                    $f = $invoice_data["date"];
                                                    $split_date = explode(" ", $f);
                                                    $pdate = $split_date[0];

                                                    if ($pdate == $today) {
                                                        $a = $a + $invoice_data["total"];
                                                        $c = $c + $invoice_data["qty"];
                                                    }

                                                    $split_result = explode("-", $pdate);
                                                    $pyear = $split_result[0];
                                                    $pmonth = $split_result[1];

                                                    if ($pyear == $this_year) {
                                                        if ($pmonth == $this_month) {
                                                            $b = $b + $invoice_data["total"];
                                                            $d = $d + $invoice_data["qty"];
                                                        }
                                                    }
                                                }


                                                ?>

                                                <div class="titl"><span class="fs-5">Rs. <?php echo $a ?>.00</span></div>

                                                <div class="conten"><span class="fs-2 fw-bold">Daily Earnings</span></div>


                                                <div class="colo insid-radiu"></div>
                                                <div class="whitee insid-radiu"></div>
                                                <div class="ico bg-primary border border-2 border-dark"><i class="bi bi-cash-coin fs-1 fas"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4 px-1 ">
                                    <div class="row g-1">
                                        <div class="setu">
                                            <div class="butto">

                                                <div class="titl"><span class="fs-5">Rs. <?php echo $b ?>.00</span></div>

                                                <div class="conten"><span class="fs-2 fw-bold">Monthly Earnings</span></div>


                                                <div class="colo insid-radiu"></div>
                                                <div class="whitee insid-radiu"></div>
                                                <div class="ico bg-secondary border border-2 border-dark"><i class="bi bi-cash-stack fs-1 fas"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4 px-1 ">
                                    <div class="row g-1">
                                        <div class="setu">
                                            <div class="butto">

                                                <div class="titl"><span class="fs-5"><?php echo $c ?> Items</span></div>

                                                <div class="conten"><span class="fs-2 fw-bold">Today Sellings</span></div>


                                                <div class="colo insid-radiu"></div>
                                                <div class="whitee insid-radiu"></div>
                                                <div class="ico bg-success border border-2 border-dark"><i class="bi bi-bag-check fs-1 fas"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4 px-1 ">
                                    <div class="row g-1">
                                        <div class="setu">
                                            <div class="butto">

                                                <div class="titl"><span class="fs-5"><?php echo $d ?> Items</span></div>

                                                <div class="conten"><span class="fs-2 fw-bold">Monthly Sellings</span></div>


                                                <div class="colo insid-radiu"></div>
                                                <div class="whitee insid-radiu"></div>
                                                <div class="ico bg-warning border border-2 border-dark"><i class="bi bi-basket2 fs-1 fas"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4 px-1 ">
                                    <div class="row g-1">
                                        <div class="setu">
                                            <div class="butto">

                                                <div class="titl"><span class="fs-5"><?php echo $e ?> Items</span></div>

                                                <div class="conten"><span class="fs-2 fw-bold">Total Sellings</span></div>


                                                <div class="colo insid-radiu"></div>
                                                <div class="whitee insid-radiu"></div>
                                                <div class="ico bg-info border border-2 border-dark"><i class="bi bi-cart4 fs-1 fas"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4 px-1 ">
                                    <div class="row g-1">
                                        <div class="setu">
                                            <div class="butto">

                                                <?php
                                                $user_rs = Database::search("SELECT * FROM `user`");
                                                $user_num = $user_rs->num_rows;
                                                ?>
                                                <div class="titl"><span class="fs-5"><?php echo $user_num ?> Members</span></div>

                                                <div class="conten"><span class="fs-2 fw-bold">Total Engagements</span></div>


                                                <div class="colo insid-radiu"></div>
                                                <div class="whitee insid-radiu"></div>
                                                <div class="ico bg-danger border border-2 border-dark"><i class="bi bi-people fs-1 fas"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="hr-break-1" />
                        </div>

                        <!-- card1 -->
                        <div class="offset-1 col-10 col-lg-4 mt-3 mb-3 card card-circle">
                            <div class="row g-1">


                                <div class="col-12 card-icon">
                                    <i class="bi bi-trophy-fill fs-1 mt-4 text-warning"></i>
                                </div>
                                <div class="col-12 card-body">
                                    <h5 class="card-title">Mostly Sold Item</h5>
                                </div>

                                <?php

                                $freq_rs = Database::search("SELECT `product_id`, COUNT(`product_id`) AS `value_occurrence` 
                            FROM `invoice` WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY `value_occurrence` DESC LIMIT 1");

                                $freq_num = $freq_rs->num_rows;

                                if ($freq_num > 0) {

                                    $freq_data = $freq_rs->fetch_assoc();

                                    $proimg = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $freq_data["product_id"] . "'");
                                    $code = $proimg->fetch_assoc();

                                    $product_Details = Database::search("SELECT * FROM `product` WHERE `id`='" . $freq_data["product_id"] . "'");
                                    $pdetails = $product_Details->fetch_assoc();

                                    $qtyrs = Database::search("SELECT SUM(`qty`) AS `total` FROM `invoice` WHERE `product_id`='" . $freq_data["product_id"] . "'
                                AND `date` LIKE '%" . $today . "%'");
                                    $qtytotal = $qtyrs->fetch_assoc();

                                ?>

                                    <div class="card-body">

                                        <div class="col-12 text-center">
                                            <img src="<?php echo $code["code"]; ?>" class="img-fluid rounded-top" style="height: 250px;" />
                                            <hr />
                                        </div>
                                        <div class="col-12 text-center btn btn-primary">
                                            <span class="fs-6"><?php echo $pdetails["title"]; ?></span>
                                            <br />
                                            <span class="fs-6"><?php echo $qtytotal["total"]; ?> Items</span>
                                            <br />
                                            <span class="fs-6">Rs. <?php echo $pdetails["price"]; ?>.00</span>
                                            <br />
                                        </div>

                                    </div>

                                <?php
                                }
                                ?>
                            </div>


                        </div>

                        <!-- card1 -->


                        <!-- card2 -->
                        <div class="offset-1 col-10 col-lg-4 mt-3 mb-3 card card-circle">
                            <div class="row g-1">


                                <div class="col-12 card-icon">
                                    <i class="bi bi-trophy-fill fs-1 mt-4 text-warning"></i>
                                </div>
                                <div class="col-12 card-body">
                                    <h5 class="card-title">Most famouse Seller</h5>
                                </div>

                                <?php

                                $freq_rs = Database::search("SELECT `product_id`, COUNT(`product_id`) AS `value_occurrence` 
                            FROM `invoice` WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY `value_occurrence` DESC LIMIT 1");

                                $freq_num = $freq_rs->num_rows;

                                if ($freq_num > 0) {

                                    $freq_data = $freq_rs->fetch_assoc();

                                    $proimg = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $freq_data["product_id"] . "'");
                                    $code = $proimg->fetch_assoc();

                                    $product_Details = Database::search("SELECT * FROM `product` WHERE `id`='" . $freq_data["product_id"] . "'");
                                    $pdetails = $product_Details->fetch_assoc();

                                    $qtyrs = Database::search("SELECT SUM(`qty`) AS `total` FROM `invoice` WHERE `product_id`='" . $freq_data["product_id"] . "'
                                AND `date` LIKE '%" . $today . "%'");
                                    $qtytotal = $qtyrs->fetch_assoc();

                                ?>

                                <?php

                                $profileimg = Database::search("SELECT * FROM `profile_image` 
                            WHERE `user_email`='" . $pdetails["user_email"] . "'");
                                $pcode = $profileimg->fetch_assoc();

                                $userDetails = Database::search("SELECT * FROM `user` 
                            WHERE `email`='" . $pdetails["user_email"] . "'");
                                $udetails = $userDetails->fetch_assoc();

                                ?>
                                <div class="card-body">

                                    <div class="col-12 text-center">
                                        <img src="<?php echo $pcode["path"]; ?>" class="img-fluid rounded-top" style="height: 250px;" />
                                        <hr />
                                    </div>
                                    <div class="col-12 text-center btn btn-primary">
                                        <span class="fs-5 fw-bold">
                                            <?php echo $udetails["fname"] . " " . $udetails["lname"] ?>
                                        </span>
                                        <br />
                                        <span class="fs-6"><?php echo $pdetails["user_email"]; ?></span>
                                        <br />
                                        <span class="fs-6"><?php echo $udetails["mobile"]; ?></span>
                                        <br />
                                    </div>

                                </div>

                                <?php
                                }
                                ?>

                            </div>


                        </div>

                        <!-- card2 -->


                    </div>
                </div>

            </div>
        </div>

        <script src="script.js"></script>
    </body>

    </html>

<?php
} else {
?>

    <script>
        alert("Please Sign In First");
        window.location = "adminSignin.php";
    </script>

<?php
}
?>