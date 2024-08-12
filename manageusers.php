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

if ($n == 1){
    $d = $resultSet->fetch_assoc();
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>PowerGym | Admin| Manage Users</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body style="background-color: #c4c4c4; background-image: linear-gradient(90deg,#c4c4c4 0%, #505050 100%);">

    <div class="container-fluid">
        <div class="row">
            
            <div class="col-12">
                    <div class="row">
                        <div class="col-12 text-center fw-bold mb-3 mt-0 bg-dark">
                            <h2 class="fs-1 text-danger fw-bold">Manage All Users</h2>
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
                                        <a class="nav-link fw-bold fs-4 active" href="#">Manage Users</a>
                                        <a class="nav-link fw-bold fs-4" href="adminpanel.php">Dashboard</a>
                                        <a class="nav-link fw-bold fs-4" href="manageProduct.php">Manage Product</a>
                                    </nav>
                                    <hr class="border border-1 border-white" />
                                </div>

                                <div class="col-12 mt-3 d-grid">
                                <hr class="border border-1 border-white" />
                                    <h5 class="text-white">From Date</h5>
                                    <input type="date" class="form-control" />
                                    <br/>
                                    <h5 class="text-white">To Date</h5>
                                    <input type="date" class="form-control" />
                                    <br/>
                                    <a class="btn btn-primary fw-bold mt-2 fs-5 rounded-pill" href="allsellingHistory.php">View Selling History</a>
                                    <hr class="border border-1 border-white" />
                                </div>

                            </div>
                        </div>

                    </div>
                </div>


            <div class="col-12 col-lg-9 mx-5">
                <div class="row">

                <hr class="hr-break-1" />

                    <div class="col-12 mb-3">
                        <div class="row">
                            <div class="col-2 col-lg-1 bg-dark py-2 text-end border border-1 border-light">
                                <span class="fs-5 fw-bold text-white">#</span>
                            </div>
                            <div class="col-2  bg-dark py-2 d-none  d-lg-block border border-1 border-light">
                                <span class="fs-5 fw-bold text-white">Profile Image</span>
                            </div>
                            <div class="col-4 col-lg-2 bg-dark py-2 border border-1 border-light">
                                <span class="fs-5 fw-bold text-white">User Name</span>
                            </div>
                            <div class="col-4 col-lg-2 bg-dark py-2 d-lg-block border border-1 border-light">
                                <span class="fs-5 fw-bold text-white">Email</span>
                            </div>
                            <div class="col-2  bg-dark py-2 d-none d-lg-block border border-1 border-light">
                                <span class="fs-5 fw-bold text-white">Mobile</span>
                            </div>
                            <div class="col-3  bg-dark py-2 d-none d-lg-block border border-1 border-light">
                                <span class="fs-5 fw-bold text-white">Registered Date</span>
                            </div>


                        </div>
                    </div>

                    <!--  -->

                    <?php

                    $page_no;
                    if (isset($_GET["page"])) {
                        $page_no = $_GET["page"];
                    } else {
                        $page_no = 1;
                    }

                    $user_rs = Database::search("SELECT * FROM `user` ");
                    $user_num = $user_rs->num_rows;
                    $result_per_page = 10;
                    $number_of_page = ceil($user_num / $result_per_page);
                    $page_first_result = ((int)$page_no - 1) * $result_per_page;

                    $view_user_rs = Database::search("SELECT * FROM `user` LIMIT  " . $result_per_page . " OFFSET " . $page_first_result);
                    $view_result_num = $view_user_rs->num_rows;
                    $c = 0;





                    ?>

                    <?php
                    while ($user_data = $view_user_rs->fetch_assoc()) {
                        $c = $c + 1;

                    ?>





                        <?php
                        $images_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $user_data["email"] . "' ");
                        $images_num = $images_rs->num_rows;
                        $image_data = $images_rs->fetch_assoc();
                        $userEmail = $image_data["user_email"];


                        ?>


                        <div class="col-12 mb-2">
                            <div class="row">

                                <div class="col-2 col-lg-1 bg-dark py-2 text-end">
                                    <span class="fs-5 fw-bold text-white"><?php echo $user_data["id"];  ?></span>
                                </div>



                                <div class="col-2  bg-light py-2 d-none  d-lg-block" onclick="ViewAdminMessage('<?php echo $userEmail  ?>')">

                                    <?php
                                    if ($images_num == 1) {
                                    ?>
                                        <img src="<?php echo $image_data["path"] ?>" style="height: 40px; margin-left: 80px;" />
                                    <?php
                                    } else {
                                    ?>
                                        <img src="resources/profile_img/62eaa573359cd.png" style="height: 40px; margin-left: 80px;" />
                                    <?php
                                    }
                                    ?>


                                </div>

                                <div class="col-4 col-lg-2 bg-dark py-2 ">
                                    <span class="fs-5 fw-bold text-white"><?php echo $user_data["fname"] . " " . $user_data["lname"];  ?></span>
                                </div>

                                <div class="col-4 col-lg-2 bg-light py-2 d-lg-block">
                                    <span class="fs-5 fw-bold "><?php echo $user_data["email"];  ?></span>
                                </div>

                                <div class="col-2  bg-dark py-2 d-none d-lg-block ">
                                    <span class="fs-5 fw-bold text-white"><?php echo $user_data["mobile"];  ?></span>
                                </div>

                                <div class="col-2  bg-light py-2 d-none d-lg-block">
                                    <span class="fs-5 fw-bold"><?php echo $user_data["join_date"]; ?></span>
                                </div>
                                <div class="col-2 col-lg-1 bg-light py-2  d-grid">

                                    <?php

                                    $s = $user_data["status"];
                                    if ($s == "1") {
                                    ?>
                                        <button class="btn btn-outline-danger rounded-pill" onclick="userBlock(<?php echo $user_data['id']; ?>);" id="blockuser<?php echo $user_data['id']; ?>">Unblock</button>
                                    <?php
                                    } else {
                                    ?>
                                        <button class="btn btn-outline-danger rounded-pill" onclick="userBlock(<?php echo $user_data['id']; ?>);" id="blockuser<?php echo $user_data['id']; ?>">Block</button>
                                    <?php
                                    }
                                    ?>

                                </div>



                            </div>
                        </div>
                        <!--  -->

                    <?php

                    }
                    ?>
                    <a href="<?php

                                if ($page_no >= $number_of_page) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($page_no + 1);
                                }

                                ?>">


                        &raquo;</a>
                    <!-- pagination -->
                    <div class="col-12 text-center">
                        <div class="pagination">
                            <a href="<?php if ($page_no <= 1) {
                                            echo "#";
                                        } else {
                                            echo "?page=" . ($page_no - 1);
                                        } ?>">&laquo;</a>

                            <?php
                            for ($page = 1; $page <= $number_of_page; $page++) {

                                if ($page == $page_no) {

                            ?>

                                    <a href="<?php echo "?page=" . ($page); ?>" class="active bg-warning text-black fw-bold"><?php echo $page ?></a>

                                <?php
                                } else {
                                ?>

                                    <a href="<?php echo "?page=" . ($page); ?>"><?php echo $page ?></a>

                            <?php
                                }
                            }
                            ?>

                            <a href="<?php
                                        if ($page_no >= $number_of_page) {
                                            echo "#";
                                        } else {
                                            echo "?page=" . ($page_no + 1);
                                        }

                                        ?>">

                                &raquo;</a>
                        </div>
                    </div>
                    <!-- pagination -->

                    <!-- modal -->

                    <!-- modal -->
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>

</body>

</html>