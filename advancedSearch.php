<?php

require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>

    <title>PowerGym | Advance Search</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css">
</head>

<body style="background-color: #c4c4c4; background-image: linear-gradient(90deg,#c4c4c4 0%, #505050 100%);">
    <div class="container-fluid">
        <div class="row">
            <?php

            require "header.php";

            ?>

            <hr class="hr-break-1" />

            <div class="col-12 bg-light">
                <div class="row">
                    <div class="offset-lg-4 col-12 col-lg-4 mb-0 mt-0">

                        <div class="row">
                            <div class="col-2 mt-2 mb-3">
                                <div class="logo-img"> </div>
                            </div>

                            <div class="col-10 mt-2 mb-3 pt-3">
                                <span class="text-danger fw-bold mt-0 mb-0" style="font-size: 42px;">Advanced Search</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 bg-dark mt-3 mb-3">
                <div class="row">
                    <div class="offset-lg-1 col-12 col-lg-10">
                        <div class="row">

                            <div class="col-12 col-lg-10 mt-2 mb-3">
                                <input type="text" class="form-control fw-bold mt-4 rounded-pill" placeholder="Type keyword to Search..." id="s1" />
                            </div>
                            <div class="col-12 col-lg-2 mt-2 mb-3 d-grid">
                                <button class="btn btn-primary mt-4 rounded-pill" onclick="advancedSearch(0);">Search</button>
                            </div>
                            <div class="col-12">
                                <hr class="border border-3 border-light" />
                            </div>
                        </div>
                    </div>

                    <div class="offset-lg-2 col-12 col-lg-8">
                        <div class="row">

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 col-lg-4 mb-3">
                                        <select class="form-select btn btn-outline-warning fw-bold fs-5 border-3" id="c1" onchange="advancedSearch(0);">
                                            <option class="fw-bold fs-5 border-3" value="0">Select Category</option>

                                            <?php

                                            $category_rs = Database::search("SELECT * FROM `category`");
                                            $category_num = $category_rs->num_rows;
                                            for ($x = 0; $x < $category_num; $x++) {
                                                $category_data = $category_rs->fetch_assoc();
                                            ?>
                                                <option class="fs-5 border-3" value="<?php echo $category_data["id"]; ?>">
                                                    <?php echo $category_data["name"]; ?>
                                                </option>
                                            <?php
                                            }

                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-4 mb-3">
                                        <select class="form-select btn btn-outline-warning  fw-bold fs-5 border-3" id="b1" onchange="advancedSearch(0);">
                                            <option class="fw-bold fs-5 border-3" value="0">Select Brand</option>

                                            <?php

                                            $brand_rs = Database::search("SELECT * FROM `brand`");
                                            $brand_num = $brand_rs->num_rows;
                                            for ($y = 0; $y < $brand_num; $y++) {
                                                $brand_data = $brand_rs->fetch_assoc();
                                            ?>
                                                <option class="fs-5 border-3" value="<?php echo $brand_data["id"]; ?>">
                                                    <?php echo $brand_data["name"]; ?>
                                                </option>
                                            <?php
                                            }

                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-4 mb-3" onchange="advancedSearch(0);">
                                        <select class="form-select btn btn-outline-warning  fw-bold fs-5 border-3" id="m1">
                                            <option class="fw-bold fs-5 border-3" value="0">Select Model</option>

                                            <?php

                                            $model_rs = Database::search("SELECT * FROM `model`");
                                            $model_num = $model_rs->num_rows;
                                            for ($z = 0; $z < $model_num; $z++) {
                                                $model_data = $model_rs->fetch_assoc();
                                            ?>
                                                <option class="fs-5 border-3" value="<?php echo $model_data["id"]; ?>">
                                                    <?php echo $model_data["name"]; ?>
                                                </option>
                                            <?php
                                            }

                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <select class="form-select btn btn-outline-warning fw-bold fs-5 border-3" id="con" onchange="advancedSearch(0);">
                                            <option class="fw-bold fs-5 border-3" value="0">Select Condition</option>

                                            <?php

                                            $condition_rs = Database::search("SELECT * FROM `condition`");
                                            $condition_num = $condition_rs->num_rows;
                                            for ($p = 0; $p < $condition_num; $p++) {
                                                $condition_data = $condition_rs->fetch_assoc();
                                            ?>
                                                <option class="fs-5 border-3" value="<?php echo $condition_data["id"]; ?>">
                                                    <?php echo $condition_data["name"]; ?>
                                                </option>
                                            <?php
                                            }

                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <select class="form-select btn btn-outline-warning fw-bold fs-5 border-3" id="col" onchange="advancedSearch(0);">
                                            <option class="fw-bold fs-5 border-3" value="0">Select Color</option>

                                            <?php

                                            $color_rs = Database::search("SELECT * FROM `color`");
                                            $color_num = $color_rs->num_rows;
                                            for ($q = 0; $q < $color_num; $q++) {
                                                $color_data = $color_rs->fetch_assoc();
                                            ?>
                                                <option class="fs-5 border-3" value="<?php echo $color_data["id"]; ?>">
                                                    <?php echo $color_data["name"]; ?>
                                                </option>
                                            <?php
                                            }

                                            ?>

                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-3">
                                        <input type="text" class="form-control rounded-pill fw-bold mt-4" placeholder="Price from..." id="pf" onkeyup="advancedSearch(0);" />
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <input type="text" class="form-control rounded-pill fw-bold mt-4" placeholder="Price to..." id="pt" onkeyup="advancedSearch(0);" />
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 bg-dark mb-3" style="margin-top: -15px;">
                <div class="row">
                    <div class="offset-6 col-4 mt-3 mb-3">
                        <select class="form-select btn btn-outline-primary fw-bold fs-5 border-3 rounded-pill" id="sort" onchange="advancedSearch(0);">
                            <option class="fs-5 border-3" value="0">SORT BY</option>
                            <option class="fs-5 border-3" value="1">PRICE HIGH TO LOW</option>
                            <option class="fs-5 border-3" value="2">PRICE LOW TO HIGH</option>
                            <option class="fs-5 border-3" value="3">QUANTITY HIGH TO LOW</option>
                            <option class="fs-5 border-3" value="4">QUANTITY LOW TO HIGH</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card offset-lg-1 col-12 col-lg-10  bg-white mb-3 rounded" style="background-color: #c4c4c4; background-image: linear-gradient(90deg,#c4c4c4 0%, #505050 100%);">
                <div class="row">
                    <div class="offset-lg-1 col-12 col-lg-10 text-center">
                        <br/><br/>
                        <div class="row" id="view_area">

                            <div class="offset-5 col-2 mt-3">
                                <span class="text-white-50 fw-bold h1"><i class="bi bi-search fs-1"></i></span>
                            </div>
                            <div class="offset-3 col-6 mt-1 mb-5">
                                <span class="text-white-50 fw-bold h1">No Item Searched Yet..</span>
                            </div>

                        </div>
                    </div>

                </div>
            </div>


            <?php
            require "footer.php";
            ?>

        </div>

    </div>

    <script src="script.js"></script>
</body>

</html>