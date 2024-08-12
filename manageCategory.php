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

    <title>PowerGym | Manage Category</title>
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
                        <h2 class="fs-1 text-danger fw-bold">Manage All Category</h2>
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
                                    <a class="nav-link fw-bold fs-4 active" href="#">Manage Category</a>
                                    <a class="nav-link fw-bold fs-4" href="adminpanel.php">Dashboard</a>
                                    <a class="nav-link fw-bold fs-4" href="manageusers.php">Manage Users</a>
                                    <a class="nav-link fw-bold fs-4" href="manageProduct.php">Manage Product</a>
                                    <a class="nav-link fw-bold fs-4" href="manageBrand.php">Manage Brand</a>
                                    <a class="nav-link fw-bold fs-4" href="manageModel.php">Manage Model</a>
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
                    <!--  -->

                    <hr class="hr-break-1" />

                    <div class="col-12 mb-3 ">
                        <div class="row g-4">

                            <div class="col-12 col-lg-3 border border-dark bg-warning" onclick="addNewCategory();" style="height: 60px;">
                                <div class="row">
                                    <div class="col-8 mt-2">
                                        <label class="form-label fw-bold fs-5 mt-1">Add New Category</label>
                                    </div>
                                    <div class="col-4 border-start border-secondary text-center mt-2">
                                        <label class="form-label fs-2"><i class="bi bi-shield-fill-plus fs-2 text-success"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <hr class="hr-break-1" />

                    <div class="col-12 mb-3 ">
                        <div class="row g-4">

                            <?php

                            $category_rs = Database::search("SELECT * FROM `category`");
                            $category_num = $category_rs->num_rows;

                            for ($i = 0; $i < $category_num; $i++) {
                                $category_data = $category_rs->fetch_assoc();

                            ?>

                                <div class="col-12 col-lg-3 border border-white bg-dark" style="height: 50px;">
                                    <div class="row">

                                        <div class="col-8 mt-2">
                                            <label class="form-label fw-bold fs-5 text-white"><?php echo $category_data["name"]; ?></label>
                                        </div>
                                        <div class="col-4 border-start border-white text-center mt-2">
                                            <label for="form-label fs-3" onclick="deleteFromCategory(<?php echo $category_data['id']; ?>);"><i class="bi bi-trash fs-4 text-danger"></i></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1"></div>

                            <?php
                            }
                            ?>

                        </div>
                    </div>

                    <!-- modal 2 -->
                    <div class="modal" tabindex="-1" id="addCategoryModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5>Add New Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12">
                                        <label>New Category Name : </label>
                                        <input type="text" class="form-control" id="n" />
                                    </div>
                                    <div class="col-12">
                                        <label>Your Email Address : </label>
                                        <input type="text" class="form-control" id="e" />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="categroyVerifyModal();">Add Category</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal 2 -->

                    <!-- modal 3 -->
                    <div class="modal" tabindex="-1" id="addCategoryModelVerification">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Verification</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12">
                                        <label class="form-label">Verification Code : </label>
                                        <input type="text" class="form-control" id="vtxt" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
                                    <button type="button" class="btn btn-primary" onclick="saveCategory();">Verify & Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal 3 -->

                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>