<?php

session_start();

require "connection.php";
if (isset($_SESSION["u"])) {

    $pageno;
    $email = $_SESSION["u"]["email"];
?>

    <!DOCTYPE html>

    <html>

    <head>
        <title>PowerGym | My Product</title>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css">

    </head>

    <body style="background-color: #c4c4c4; background-image: linear-gradient(90deg,#c4c4c4 0%, #505050 100%);">

        <div class="container-fluid">
            <div class="row">

                <!--header -->

                <div class="col-12 bg-dark">
                    <div class="row">

                        <div class="col-4 text-center">
                            <div class="row">
                                <div class="col-12 mt-5 my-lg-3">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item text-white"><a class="fs-4 fw-bold" href="home.php">Home</a></li>
                                            <li class="breadcrumb-item fs-4 fw-bold text-white" aria-current="page">My Products</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-center">
                            <div class="row">
                                <div class="col-12 mt-5 my-lg-3">
                                    <h1 class=" fs-1 text-danger fw-bold"> My Products</h1>
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


                <!--header -->
                <!--body-->

                <div class="col-12">
                    <div class="row">

                        <!--sort-->

                        <div class="col-11 col-lg-2 mx-3 my-3 border border-white rounded" style="background-color: #17141d; border-radius: 30px; box-shadow: -1rem 0 3rem #000;">
                            <div class="row">

                                <div class="col-12 mt-3 fs-5">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-3 text-white">Sort Products</label>
                                        </div>

                                        <div class="col-11 ">
                                            <div class="row">

                                                <div class="col-10">
                                                    <input type="text" class="form-control rounded-pill" placeholder="Search..." id="s" />
                                                </div>
                                                <div class="col-1 p-1">
                                                    <label class="form-label fs-3 bi bi-search text-white"></label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <hr class="text-white" width="80%" />
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-bold text-white">By Active Time</label>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input text-white" type="radio" name="flexRadioDefault" value="" id="n" />
                                                <label class="form-check-label text-white" for="n">
                                                    Newest to Oldest
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input text-white" type="radio" name="flexRadioDefault" value="" id="o" />
                                                <label class="form-check-label text-white" for="0">
                                                    Oldest to Newest
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <hr class="text-white" width="80%" />
                                        </div>

                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold text-white">By Price</label>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input text-white" type="radio" name="flexRadioDefault1" value="" id="l" />
                                                <label class="form-check-label text-white" for="l">
                                                    Low to High
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input text-white" type="radio" name="flexRadioDefault1" value="" id="h" />
                                                <label class="form-check-label text-white" for="h">
                                                    High to Low
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <hr class="text-white" width="80%" />
                                        </div>

                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold text-white">By Price Active Time</label>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault2" value="" id="b" />
                                                <label class="form-check-label text-white" for="b">
                                                    New Price
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault2" value="" id="u" />
                                                <label class="form-check-label text-white" for="u">
                                                    Old Price
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 text-center mt-3 mb-3">
                                            <div class="row g-2">
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-outline-success rounded-pill fw-bold" onclick="sortfunction();">Sort</button>
                                                </div>

                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-outline-danger rounded-pill fw-bold" onclick="clearsort();">Clear</button>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-12">
                                            <hr class="text-white" width="80%" />
                                        </div>

                                        <div class="col-12 text-center mt-3 mb-3">
                                            <div class="row g-2">
                                                <div class="col-12 d-grid">

                                                    <nav class=" nav  nav-pills flex-column">
                                                        <a class="nav-link active fs-5" aria-current="page" href="addproduct.php">Add Products</a>

                                                    </nav>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <!--sort-->
                        <!--products-->

                        <div class="col-12 col-lg-9 mt-3 mb-3">
                            <div class="row">

                                <div class="col-10 offset-1 text-center" id="sort">

                                    <div class="row justify-content-center mt-3">

                                        <?php
                                        if (isset($_GET["page"])) {

                                            $pageno = $_GET["page"];
                                        } else {

                                            $pageno = 1;
                                        }

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $email . "'");
                                        $product_num = $product_rs->num_rows;
                                        $product_data = $product_rs->fetch_assoc();

                                        $results_per_page = 6;
                                        $number_of_pages = ceil($product_num / $results_per_page);

                                        $page_results = ($pageno - 1) * $results_per_page;
                                        $selected_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $email . "' LIMIT " . $results_per_page . " OFFSET " . $page_results . "");
                                        $selected_num = $selected_rs->num_rows;

                                        for ($x = 0; $x < $selected_num; $x++) {

                                            $selected_data = $selected_rs->fetch_assoc();

                                        ?>
                                            <!--card-->

                                            <div class="card lagecard mb-3 mt-3 col-12 col-lg-6">
                                                <div class="row">
                                                    <div class="col-md-4 mt-4">

                                                        <?php
                                                        $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $selected_data["id"] . "'");

                                                        $product_img_data = $product_img_rs->fetch_assoc();

                                                        ?>
                                                        <img src="<?php echo $product_img_data["code"] ?>" class="img-fluid rounded-start" />
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body mb-2">
                                                            <h5 class="card-title text-white fw-bold"><?php echo $selected_data["title"]; ?></h5>
                                                            <span class="card-text fw-bold text-primary"><?php echo $selected_data["price"]; ?></span>
                                                            <br />
                                                            <span class="card-text fw-bold text-success"><?php echo $selected_data["qty"];  ?> Item left</span>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault<?php echo $selected_data["id"]; ?>" <?php if ($selected_data["status_id"] == 2) {
                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                } ?> onclick="changeStatus(<?php echo $selected_data['id']; ?>);">
                                                                <label class="form-check-label text-warning fw-bold" for="flexSwitchCheckDefault <?php echo $selected_data["id"]; ?>" id="switchLbl<?php echo $selected_data["id"]; ?>">

                                                                    <?php
                                                                    if ($selected_data["status_id"] == 2) {
                                                                        echo "Make Your Product Active";
                                                                    } else {
                                                                        echo "Make Your Product Deactive";
                                                                    }

                                                                    ?>
                                                                </label>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="row g-1">

                                                                        <div class="col-12 col-lg-6 d-grid">
                                                                            <button class="btn btn-outline-success rounded-pill fw-bold" onclick="sendId(<?php echo $selected_data['id']; ?>)">Update</button>
                                                                        </div>
                                                                        <div class="col-12 col-lg-6 d-grid">
                                                                            <button class="btn btn-outline-danger rounded-pill fw-bold">Delete</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--card-->
                                        <?php

                                        }

                                        ?>



                                    </div>
                                </div>

                                <!--pagination-->

                                <div class="offset-2 offset-lg-4 col-8 col-lg-4 text-center mb-3">

                                    <div class="pagination">
                                        <a href="
                                        <?php
                                        if ($pageno <= 1) {

                                            echo "#";
                                        } else {
                                            echo "?page=" . ($pageno - 1);
                                        }
                                        ?>
                                        ">&laquo;</a>
                                        <?php

                                        for ($page = 1; $page <= $number_of_pages; $page++) {
                                            if ($page == $pageno) {
                                        ?>
                                                <a href=" <?php echo "?page=" . ($page) ?>" class="active text-black bg-warning fw-bold"><?php echo $page; ?></a>
                                            <?php
                                            } else {
                                            ?>
                                                <a href="<?php echo "?page=" . ($page) ?>"><?php echo $page; ?></a>
                                        <?php
                                            }
                                        }

                                        ?>

                                        <a href="
                                        
                                        <?php
                                        if ($pageno >= $number_of_pages) {

                                            echo "#";
                                        } else {
                                            echo "?page=" . ($pageno + 1);
                                        }
                                        ?>
                                        ">&raquo;</a>
                                    </div>

                                </div>

                                <!--pagination-->

                            </div>
                        </div>

                        <!--products-->

                    </div>
                </div>



                <!--body-->

            </div>
        </div>

        <script src="script.js"></script>
    </body>


    </html>

<?php
} else {
?>

    <script>
        alert("please Sign In  First.")
        window.location = "index.php";
    </script>
<?php
}

?>