<?php
require "connection.php";
?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>PowerGym | Home</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

</head>

<body style="background-color: #c4c4c4; background-image: linear-gradient(90deg,#c4c4c4 0%, #505050 100%);">

    <div class="container-fluid">
        <div class="row">

            <?php

            require "header.php";

            ?>

            <hr class="hr-break-1" />

            <div class="col-12 justify-content-center bg-white mt-0">
                <div class="row">
                    <h1 class="mb-0 text-center text-danger titleBold" style="font-size: 45px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">POWER GYM</h1>
                </div>
            </div>

            <div class="col-12 justify-content-center bg-light">
                <div class="row mb-3">

                    <div class="mt-0 mb-0 col-4 col-lg-1 offset-4 offset-lg-1 logo-img"></div>

                    <div class="col-8 col-lg-6">
                        <div class="input-group input-group-lg mt-4">

                            <select class="btn btn-outline-secondary dropdown-toggle fw-bold fs-5 border-3" type="button" data-bs-toggle="dropdown" id="basic_search_select" aria-expanded="false">
                                <option class="fw-bold fs-5 border-3" value="0" readonly>All Categories</option>

                                <?php

                                $categoryrs = Database::search("SELECT * FROM `category`");
                                $num = $categoryrs->num_rows;

                                for ($x = 0; $x < $num; $x++) {

                                    $cd = $categoryrs->fetch_assoc();

                                ?>
                                    <option class="fs-5 border-3" value=" <?php echo $cd["id"]; ?>"><?php echo $cd["name"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <input type="text" class="form-control fs-5 border-3" placeholder="Search Products..." aria-label="Text input with dropdown button" id="basic_search_txt" />
                        </div>
                    </div>
                    <div class="col-2 d-grid gap-2 mt-4">
                        <button class="btn btn-primary search-btn fs-5 border-3 fw-bold rounded-pill border-primary" type="button" onclick="basicSearch(0);">Search</button>
                    </div>
                    <div class="col-2 mt-4">
                        <div class="btn-group dropend">
                            <button type="button" class="btn btn-secondary dropdown-toggle fs-5 border-3 fw-bold" style="height: 44px;" data-bs-toggle="dropdown">

                            </button>
                            <ul class="dropdown-menu text-center" style="height: 42px;">
                                <a href="advancedSearch.php" class=" link titleRed link-1 fs-5 border-3 fw-bold titleRed">Advanced</a>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>


            <hr class="hr-break-1" />

            <div class="col-12" id="basicSearchResult">

                <div class="row">
                    <div class="col-6 col-lg-2" style="margin-left: 120px;">
                        <img class="img-fluid" src="resources/fyDP.gif" alt="investing">
                        <img class="img-fluid" src="resources/onl.gif" alt="investing">
                    </div>

                    <div class="col-8 d-none d-lg-block" style="margin-left: 25px;">
                        <div class="row">
                            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner offset-1" style="margin-right: 30px;">
                                    <div class="carousel-item active">
                                        <img src="resources/slider images/posterimg.png" class="d-block poster-img-1">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="resources/slider images/posterimg2.png" class="d-block poster-img-1">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="resources/slider images/posterimg3.png" class="d-block poster-img-1">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="hr-break-1" />

                <div class="col-12 bg-dark">
                    <div class="row">
                        <div class="col-5">
                            <img src="resources/posterlage.avif" style="background-size: cover;" />
                        </div>
                        <div class="col-7 text-center" style="justify-content: center;">
                            <br /><br /><br />
                            <span class="text-white fs-3">OUR PRODUCTS</span><br /><br />
                            <span class="text-white" style="font-size: 80px;">Quality we</span><br />
                            <span class="text-white" style="font-size: 80px;">stand by</span><br /><br />
                            <div class="col-4 offset-4">
                                <span class="text-white fs-5">Dietary supplements are taken for two purposes: health reason or for performance enhancement. The most common nutrients for fitness supplements include protein, amino acids, minerals and vitamins and are used to enhance your diet overall.

                                    We wanted to make the best products to match these needs. So, by using best ingredients and best practices, we achieved the best flavours – without any additional bullshit.</span>
                            </div>

                        </div>
                    </div>
                </div>

                <hr class="hr-break-1" />





                <div class="cardcoverdiv col-12" style="justify-content: center;">
                    <div class="smallcard" onclick="basicSearch(0);">
                        <h3 class="smallcardtitle">Proteins</h3>
                        <div class="bar">
                            <div class="emptybar"></div>
                            <div class="filledbar"></div>
                        </div>
                        <div class="circle">
                            <div class="col-3">
                                <div class="card col-6 col-lg-2 mt-2 mb-2  bg-light" style="width: 8rem;">

                                    <img src="resources/supplement images/whey3.jpeg" class="card-img-top card-img-top" />
                                </div>
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
                                    <circle class="stroke" cx="60" cy="60" r="50" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="smallcard" onclick="basicSearch(0);">
                        <h3 class="smallcardtitle">Gainers</h3>
                        <div class="bar">
                            <div class="emptybar"></div>
                            <div class="filledbar"></div>
                        </div>
                        <div class="circle">
                            <div class="col-3">
                                <div class="card col-6 col-lg-2 mt-2 mb-2  bg-light" style="width: 8rem;">

                                    <img src="resources/supplement images/mass1.jpeg" class="card-img-top card-img-top" />
                                </div>
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
                                    <circle class="stroke" cx="60" cy="60" r="50" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="smallcard" onclick="basicSearch(0);">
                        <h3 class="smallcardtitle">Collagens</h3>
                        <div class="bar">
                            <div class="emptybar"></div>
                            <div class="filledbar"></div>
                        </div>
                        <div class="circle">
                            <div class="col-3">
                                <div class="card col-6 col-lg-2 mt-2 mb-2  bg-light" style="width: 8rem;">

                                    <img src="resources/supplement images/collagen.jpeg" class="card-img-top card-img-top" />
                                </div>
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
                                    <circle class="stroke" cx="60" cy="60" r="50" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="smallcard" onclick="basicSearch(0);">
                        <h3 class="smallcardtitle">Vitamins</h3>
                        <div class="bar">
                            <div class="emptybar"></div>
                            <div class="filledbar"></div>
                        </div>
                        <div class="circle">
                            <div class="col-3">
                                <div class="card col-6 col-lg-2 mt-2 mb-2  bg-light" style="width: 8rem;">

                                    <img src="resources/supplement images/vitamins2.png" class="card-img-top card-img-top" />
                                </div>
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
                                    <circle class="stroke" cx="60" cy="60" r="50" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="hr-break-1" />
                <?php
                $categoryrs = Database::search("SELECT * FROM `category`");
                $num = $categoryrs->num_rows;

                for ($y = 0; $y < $num; $y++) {

                    $d = $categoryrs->fetch_assoc();

                ?>

                    <!-- Category name -->
                    <div class="col-12 bg-dark">
                        <a href="#" class="link text-warning link2 mx-4"><?php echo $d["name"]; ?></a>&nbsp;&nbsp;

                    </div>
                    <hr class="hr-break-1" />
                    <!-- Category name -->

                    <!-- Products -->

                    <div class="col-12 mb-3">

                        <div class="row">

                            <div class="col-12 col-lg-12">

                                <div class="row justify-content-center gap-2">

                                    <?php

                                    $productrs = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $d["id"] . "' AND `status_id`= '1' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0");

                                    $pn = $productrs->num_rows;

                                    for ($z = 0; $z < $pn; $z++) {

                                        $pd = $productrs->fetch_assoc();

                                    ?>

                                        <div class="card lagecard col-6 col-lg-2 mt-2 mb-2" style="width: 18rem; display: flex; background-color: #17141d; border-radius: 30px; box-shadow: -1rem 0 3rem #000; transition: 0.4s ease-out; position: relative;">

                                            <?php

                                            $imagers = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pd["id"] . "'");
                                            $image = $imagers->fetch_assoc();

                                            ?>



                                            <img src="<?php echo $image["code"];  ?>" class="card-img-top card-img-top img-thumbnail" style="width:200px ; height: 200px; display: flex; background-color: #17141d; border-radius: 10px; margin-top: 10px; margin-left: 15px; transition: 0.4s ease-out; position: relative;" />
                                            <div class="newbar">
                                                <div class="emptybar"></div>
                                                <div class="filledbar"></div>
                                            </div>
                                            <div class="card-body ms-0 m-0">
                                                <div class="col-12" style="height: 55px;">
                                                    <h5 class="card-title text-white"><?php echo $pd["title"];  ?>
                                                </div><br /><span class="badge bg-info text-black">New</span></h5><br />
                                                <span class="card-text text-primary">Rs. <?php echo $pd["price"];  ?></span>
                                                <br />


                                                <?php

                                                if ($pd["qty"] > 0) {

                                                ?>

                                                    <span class="card-text text-warning"><b>Out of Stock</b></span>
                                                    <br />
                                                    <span class="card-text text-success fw-bold"><?php echo $pd["qty"];  ?> Items Available</span>
                                                    <a href='<?php echo "singleProductView.php?id=" . ($pd["id"]) ?>' class="btn btn-outline-success rounded-pill col-12 ">Buy Now</a>
                                                    <a onclick="addToCart(<?php echo $pd['id']; ?>);" class="btn btn-outline-danger rounded-pill col-12 mt-1">Add to Cart</a>



                                                <?php



                                                } else {
                                                ?>

                                                    <span class="card-text text-danger"><b>Out of Stock</b></span>
                                                    <br />
                                                    <span class="card-text text-success fw-bold">00 Items Available</span>
                                                    <a href="#" class="btn btn-outline-success rounded-pill col-12 disabled">Buy Now</a>
                                                    <a href="#" class="btn btn-outline-danger rounded-pill col-12 mt-1 disabled">Add to Cart</a>



                                                <?php
                                                }
                                                $watchlist_rs = Database::search("SELECT *  FROM `watchlist` WHERE 
                                                `product_id`='" . $pd["id"] . "' AND `user_email`='" . $_SESSION["u"]["email"] . "'");
                                                $watchlist_num = $watchlist_rs->num_rows;

                                                if ($watchlist_num == 1) {
                                                ?>
                                                    <a class="btn btn-outline-secondary rounded-pill col-12 mt-1" onclick="addToWatchlist(<?php echo $pd['id']; ?>);"><i class="bi bi-heart-fill fs-5 text-danger" id="heart<?php echo $pd['id'];  ?>"></i></a>

                                                <?php
                                                } else {
                                                ?>
                                                    <a class="btn btn-outline-secondary rounded-pill col-12 mt-1" onclick="addToWatchlist(<?php echo $pd['id']; ?>);"><i class="bi bi-heart-fill fs-5 text-white" id="heart<?php echo $pd['id'];  ?>"></i></a>

                                                <?php
                                                }
                                                ?>




                                            </div>
                                        </div>


                                    <?php



                                    }

                                    ?>



                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Products -->
                    <hr class="hr-break-1" />

                <?php

                }

                ?>

                <div class="col-2 offset-5 d-grid gap-2 mt-4 btn btn-outline-light search-btn border-3 ">
                    <a onclick="basicSearch(0);" class="link-dark link2 fw-bold fs-4 mb-1">View All Products&nbsp; &rarr;</a>
                </div>
                <br />

            </div>

            <!--Start Sticky Icon-->
            <div class="sticky-icon">
                <a href="https://www.instagram.com/" class="Instagram"><i class="fab fa-instagram fs-2"></i> Instagram </a>
                <a href="https://www.facebook.com/" class="Facebook"><i class="fab fa-facebook-f fs-2"> </i> Facebook </a>
                <a href="https://www.google.com/" class="Google"><i class="fab fa-google-plus-g fs-2"> </i> Google + </a>
                <a href="https://www.youtube.com/" class="Youtube"><i class="fab fa-youtube fs-2"></i> Youtube </a>
                <a href="https://twitter.com/" class="Twitter"><i class="fab fa-twitter fs-2"> </i> Twitter </a>
            </div>
            <!--End Sticky Icon-->



            <?php

            require "footer.php";

            ?>

        </div>
    </div>

    <script src="script.js"></script>


</body>

</html>