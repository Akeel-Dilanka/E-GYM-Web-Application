<?php

require "connection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];
    $product_rs = Database::search("SELECT product.id,product.category_id,product.model_has_brand_id,product.title,product.price,product.qty
    ,product.description,product.condition_id,product.status_id,product.user_email,model.name AS mname ,brand.name AS bname FROM product INNER JOIN
    model_has_brand ON model_has_brand.id = product.model_has_brand_id INNER JOIN  brand ON brand.id = model_has_brand.brand_id 
    INNER JOIN model ON model.id = model_has_brand.model_id WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {

        $product_data = $product_rs->fetch_assoc();





?>








        <!DOCTYPE html>
        <html>

        <head>

            <title>PowerGym | Single Product View</title>

            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <link rel="icon" href="resources/logo.svg" />
            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
            <link rel="stylesheet" href="style.css" />
        </head>

        <body style="background-color: #c4c4c4; background-image: linear-gradient(90deg,#c4c4c4 0%, #505050 100%);">


            <div class="container-fluid">
                <div class="row">
                    <?php
                    require "header.php"
                    ?>

                    <div class="col-12 mt-0 singleproduct">
                        <div class="row">
                            <div class="col-12 " style="padding: 11px;">
                                <div class="row">



                                    <div class="col-12 col-lg-2 offset-lg-2 order-2 order-lg-1">
                                        <ul>
                                            <?php

                                            $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "'");

                                            $product_img_num = $product_img_rs->num_rows;
                                            $img = array();


                                            if ($product_img_num != 0) {
                                                for ($x = 0; $x < $product_img_num; $x++) {
                                                    $product_img_data = $product_img_rs->fetch_assoc();

                                                    $img[$x] = $product_img_data["code"];
                                            ?>
                                                    <li class="d-flex flex-column justify-content-center align-items-center border border-2 border-dark mb-1">
                                                        <img src="<?php echo $img["$x"] ?>" class="img-thumbnail mt-1 mb-1" style="height: 200px; width: 200px;" id="productImg<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x;  ?>);" />
                                                    </li>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-2 border-dark  mb-1">
                                                    <img src="resources/empty.svg" class="img-thumbnail mt-1 mb-1" style="height: 200px; width: 200px;" />
                                                </li>

                                                <li class="d-flex flex-column justify-content-center align-items-center border border-2 border-dark  mb-1">
                                                    <img src="resources/empty.svg" class="img-thumbnail mt-1 mb-1" style="height: 200px; width: 200px;" />
                                                </li>

                                                <li class="d-flex flex-column justify-content-center align-items-center border border-2 border-dark  mb-1">
                                                    <img src="resources/empty.svg" class="img-thumbnail mt-1 mb-1" style="height: 200px; width: 200px;" />
                                                </li>

                                            <?php

                                            }


                                            ?>


                                        </ul>
                                    </div>
                                    <div class="col-lg-4 order-2 order-lg-1 offset-lg-1 d-none d-lg-block">
                                        <div class="row">
                                            <div class="img-hover-zoom col-12 align-items-center border border-2 border-dark bg-light">
                                                <div class="zoom mainImg" id="mainImg"></div>
                                            </div>

                                        </div>

                                    </div>


                                    <div class="card col-12 col-lg-10 offset-lg-1 order-3 mt-5" style="border-radius: 20px; background-color: #c4c4c4; background-image: linear-gradient(90deg,#c4c4c4 0%, #505050 100%);">
                                        <div class="row mt-4" style="background-color: #17141d; border-end-end-radius: 20px; border-bottom-left-radius: 20px;">
                                            <div class="col-12 col-lg-5 offset-1">
                                                <div class="row">

                                                    <div class="row">
                                                        <div class="col-12 my-2 mt-4">
                                                            <span class="badge text-center">
                                                                <i class="bi bi-star-fill  text-warning fs-5"></i>
                                                                <i class="bi bi-star-fill  text-warning fs-5"></i>
                                                                <i class="bi bi-star-fill  text-warning fs-5"></i>
                                                                <i class="bi bi-star-fill  text-warning fs-5"></i>
                                                                <i class="bi bi-star-half  text-warning fs-5"></i>
                                                                &nbsp;&nbsp;&nbsp;

                                                                <label class="fs-5 text-white fw-bold">4.5 Stars | 23 Ratings And Reviews</label>

                                                            </span>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-12 my-2">
                                                            <span class="fs-2 fw-bold  text-white "><?php echo $product_data["title"]; ?></span>
                                                        </div>
                                                    </div>

                                                    <div class=" row">
                                                        <div class="col-12 my-2 mt-3">
                                                            <?php
                                                            $price = $product_data["price"];
                                                            $addingPrice = ($price / 100) * 5;
                                                            $newprice = $price + $addingPrice;
                                                            $difference = $newprice - $price;
                                                            $percentage = ($difference / $price) * 100;
                                                            ?>
                                                            <span class=" text-danger"><del class="fs-3 fw-bold">Rs.<?php echo $newprice; ?> .00</del></span>
                                                            &nbsp;&nbsp; | &nbsp;&nbsp;
                                                            <span class="fs-3 fw-bold text-white">New Price&nbsp;&nbsp;Rs.<?php echo $product_data["price"]; ?>.00</span>
                                                            <br />

                                                            <span class="fs-5 fw-bold text-white">Save Rs.<?php echo $difference; ?>.00 (<?php echo $percentage; ?>%)</span>
                                                        </div>
                                                    </div>



                                                    <div class="row">
                                                        <div class="col-12 ">
                                                            <div class="row">
                                                                <div class="col-12 my-3">
                                                                    <div class="row g-2">

                                                                        <div class="border border-1 border-secondary rounded overflow-hidden float-start mt-1 position-relative product_qty bg-white">
                                                                            <div class="col-12">
                                                                                <span>Quantity : </span>
                                                                                <input type="text" class="border-0 fs-5 fw-bold text-start" style="outline: none;" pattern="[0-9]" value="1" onkeyup='check_value(<?php echo $product_data["qty"] ?>);' id="qtyInput" />

                                                                                <div class="position-absolute qty_buttons">
                                                                                    <div class="justify-content-center d-flex flex-column align-items-center border border-1 border-secondary qty_inc ">
                                                                                        <i class="bi bi-caret-up text-danger fs-3" onclick='qty_inc(<?php echo $product_data["qty"] ?>)'></i>
                                                                                    </div>
                                                                                    <div class="justify-content-center d-flex flex-column align-items-center border border-1 border-secondary qty_dec">
                                                                                        <i class="bi bi-caret-down text-danger fs-3" onclick="qty_dec();"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-12 mt-5">
                                                                                <div class="row">
                                                                                    <?php
                                                                                    if ($product_data["qty"] == 0) {
                                                                                    ?>
                                                                                        <div class="col-4 d-grid">
                                                                                            <button class="btn btn-outline-success fs-5 rounded-pill" disabled>Not Available</button>
                                                                                        </div>
                                                                                    <?php
                                                                                    } else {

                                                                                    ?>
                                                                                        <div class="col-4 d-grid">
                                                                                            <button class="btn btn-outline-success fs-5 rounded-pill" onclick="payNowProduct(<?php echo $pid ?>);">Buy Now</button>
                                                                                        </div>
                                                                                    <?php
                                                                                    }
                                                                                    ?>

                                                                                    <div class="col-4 d-grid">
                                                                                        <button class="btn btn-outline-danger fs-5 rounded-pill" onclick="addToCart(<?php echo $product_data['id']; ?>);">Add to Cart</button>
                                                                                    </div>
                                                                                    <div class="col-4 d-grid">
                                                                                        <?php

                                                                                        $watchlist_rs = Database::search("SELECT *  FROM `watchlist` WHERE `product_id`='" . $product_data["id"] . "' AND `user_email`='" . $_SESSION["u"]["email"] . "'");
                                                                                        $watchlist_num = $watchlist_rs->num_rows;

                                                                                        if ($watchlist_num == 1) {
                                                                                        ?>
                                                                                            <a class="btn btn-outline-secondary fs-3 rounded-pill col-12 mt-1" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);"><i class="bi bi-heart-fill fs-5 text-danger" id="heart<?php echo $product_data['id'];  ?>"></i></a>

                                                                                        <?php
                                                                                        } else {
                                                                                        ?>
                                                                                            <a class="btn btn-outline-secondary fs-3 rounded-pill col-12 mt-1" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);"><i class="bi bi-heart-fill fs-5 text-white" id="heart<?php echo $product_data['id'];  ?>"></i></a>

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
                                                        </div>
                                                    </div>

                                                    <hr />

                                                    <div class="row">
                                                        <div class="col-12 ">
                                                            <div class="row">
                                                                <div class="my-2 offset-lg-2 col-12 col-lg-8 border border-1 border-danger rounded">
                                                                    <div class="row bg-white">

                                                                        <div class="mt-0 mb-0 col-6 col-lg-5 qualitylogo"></div>

                                                                        <div class="col-6 col-lg-5 offset-lg-1">
                                                                            <br /><br />
                                                                            <div class="row">
                                                                                <div class="mt-0 mb-0 col-6 col-lg-5 discountlogo"></div>
                                                                                <div class="mt-0 mb-0 col-6 col-lg-5  bankcardlogo"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-5">
                                                <div class="row">





                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="col-12 mt-3">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label class="form-label fs-4 fw-bold text-white">Warenty :</label>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <label class="form-label fs-4 text-white">6 Months warrenty </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mt-3">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label class="form-label fs-4 fw-bold text-white">Return Policy :</label>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <label class="form-label fs-4 text-white">1 Months return policy </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mt-3">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label class="form-label fs-4 fw-bold text-white">In-stock :</label>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <label class="form-label fs-4 text-white"><?php echo $product_data["qty"]; ?> Items Available </label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>






                                                    <?php
                                                    $brand_rs = Database::search(
                                                        "SELECT `brand`.`name` AS 'bname', `model`.`name`AS 'mname'  FROM `brand` INNER JOIN `model_has_brand` ON  `brand`.`id`=`model_has_brand`.`brand_id` INNER JOIN `model` ON 
                                     `model`.`id`=`model_has_brand`.`model_id` INNER JOIN `product` ON `product`.`model_has_brand_id`=`model_has_brand`.`id` WHERE `product`.`id`='" . $pid . "'"
                                                    );

                                                    $brand_num = $brand_rs->num_rows;
                                                    for ($y = 0; $y < $brand_num; $y++) {
                                                        $brand_data = $brand_rs->fetch_assoc();
                                                    ?>


                                                        <div class="row mt-3">
                                                            <div class="col-12">
                                                                <div class="col-12 mt-3">
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <label class="form-label fs-4 fw-bold text-white">Brand :</label>
                                                                        </div>
                                                                        <div class="col-8">
                                                                            <label class="form-label fs-4 text-white"><?php echo $brand_data["bname"] ?> </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <label class="form-label fs-4 fw-bold text-white">Model :</label>
                                                                        </div>
                                                                        <div class="col-8">
                                                                            <label class="form-label fs-4 text-white"><?php echo $brand_data["mname"] ?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <label class="form-label fs-4 fw-bold text-white">Description :</label>
                                                                        </div>
                                                                        <div class="col-8 mb-3">
                                                                            <textarea cols="60" rows="10" class="form-control fs-4 " disabled><?php echo $product_data["description"] ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    <?php
                                                    }


                                                    ?>

                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <span class="col-6 fs-4 text-primary"><b>Seller :</b>Akeel</span>
                                                                <br />
                                                                <span class="col-6 fs-4 text-primary"><b>Sold :</b>10 Items</span>
                                                                <br />
                                                                <br />

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>



                                            </div>
                                        </div>


                                    </div>
                                </div>








                                <div class="col-12 bg-black ">
                                    <div class="row d-block me-0 ms-0 mt-4 mb-3">
                                        <div class="col-12">
                                            <span class="fs-3 fw-bold text-warning">Feedbacks...</span>
                                        </div>
                                        <hr class="hr-break-1" />
                                    </div>

                                </div>
                                <?php

                                $feedbackrs = Database::search("SELECT * FROM `feedback` WHERE `product_id` ='" . $product_data["id"] . "' ");
                                $fn = $feedbackrs->num_rows;
                                if ($fn == 0) {
                                ?>

                                    <div class="col-12" style="background-color: #c4c4c4; background-image: linear-gradient(90deg,#c4c4c4 0%, #505050 100%);">
                                        <div class="row g-1 mt-3 mb-3 justify-content-center gap-2">
                                            <div class="card col-12 col-lg-4  m-2 border border-1 border-white rounded mt-2 mb-2 rounded-pill" style="background-color: #17141d;">
                                                <div class="row m-4">
                                                    <div class="col-12 mt-3 mb-3">
                                                        <div class="mt-0 mb-0 col-12 feedbacklogo"></div>
                                                        <label class="col-12 form-label fs-5 text-center text-white">There are no Feedbacks to View...</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php

                                } else {

                                    for ($i = 0; $i < $fn; $i++) {
                                        $fd = $feedbackrs->fetch_assoc();
                                    ?>
                                        <div class="col-12" style="background-color: #c4c4c4; background-image: linear-gradient(90deg,#c4c4c4 0%, #505050 100%);">
                                            <div class="row g-1 mt-2 mb-2 justify-content-center gap-2">
                                                <div class="card col-12 col-lg-4 m-2 border border-1 border-white rounded rounded-pill" style="background-color: #17141d;">
                                                    <div class="row m-4">
                                                        <div class="col-12">
                                                            <span class="fs-6 fw-bold text-info"><?php echo $fd["user_email"];  ?></span>
                                                        </div>
                                                        <div class="col-12">
                                                            <span class="fs-5 text-white"><?php echo $fd["feed"];  ?></span>
                                                        </div>
                                                        <div class="col-12 fs-6 text-end">
                                                            <span class="text-white-50"><?php echo $fd["date"]; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }


                                ?>

                                <div class="col-12 bg-black">
                                    <div class="row d-block me-0 mt-4 mb-3 ms-0">
                                        <div class="col-12 ">
                                            <span class="fs-3 fw-bold text-warning">Related Items </span>
                                        </div>
                                        <hr class="hr-break-1" />
                                    </div>
                                </div>
                                <div class="col-12 mt-3 mb-1">
                                    <div class="row justify-content-center gap-2">


                                        <?php
                                        $related_rs = Database::search("SELECT * FROM `product` WHERE
                                     `category_id`='" . $product_data["category_id"] . "' AND `id`!='" . $product_data["id"] . "' LIMIT 6 ");

                                        $related_num = $related_rs->num_rows;
                                        for ($y = 0; $y < $related_num; $y++) {
                                            $related_data = $related_rs->fetch_assoc();


                                            $img = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $related_data["id"] . "'");
                                            $img = $img->fetch_assoc();



                                        ?>


                                            <div class="card lagecard col-6 col-lg-2 mt-4 mb-2" style="width: 18rem; display: flex; background-color: #17141d; border-radius: 30px; box-shadow: -1rem 0 3rem #000; transition: 0.4s ease-out; position: relative;">

                                                <img src="<?php echo $img["code"] ?>" class="card-img-top card-img-top img-thumbnail" style="width:200px ; height: 200px; display: flex; background-color: #17141d; border-radius: 10px; margin-top: 10px; margin-left: 15px; transition: 0.4s ease-out; position: relative;" />
                                                <div class="newbar">
                                                    <div class="emptybar"></div>
                                                    <div class="filledbar"></div>
                                                </div>

                                                <div class="card-body ms-0 m-0">
                                                    <div class="col-12" style="height: 60px;">
                                                        <h5 class="card-title text-white"><?php echo $related_data["title"] ?></h5>
                                                    </div><br /><span class="badge bg-info text-black">New</span></h5><br />
                                                    <span class="card-text text-primary">Rs.<?php echo $related_data["price"] ?>.00</span>
                                                    <br />


                                                    <?php

                                                    if ($related_data["qty"] > 0) {

                                                    ?>

                                                        <span class="card-text text-warning"><b>Out of Stock</b></span>
                                                        <br />
                                                        <span class="card-text text-success fw-bold"><?php echo $related_data["qty"];  ?> Items Available</span>
                                                        <a href='<?php echo "singleProductView.php?id=" . ($related_data["id"]) ?>' class="btn btn-outline-success rounded-pill col-12 ">Buy Now</a>
                                                        <a onclick="addToCart(<?php echo $related_data['id']; ?>);" class="btn btn-outline-danger rounded-pill col-12 mt-1">Add to Cart</a>



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
                                                `product_id`='" . $related_data["id"] . "' AND `user_email`='" . $_SESSION["u"]["email"] . "'");
                                                    $watchlist_num = $watchlist_rs->num_rows;

                                                    if ($watchlist_num == 1) {
                                                    ?>
                                                        <a class="btn btn-outline-secondary rounded-pill col-12 mt-1" onclick="addToWatchlist(<?php echo $related_data['id']; ?>);"><i class="bi bi-heart-fill fs-5 text-danger" id="heart<?php echo $related_data['id'];  ?>"></i></a>

                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a class="btn btn-outline-secondary rounded-pill col-12 mt-1" onclick="addToWatchlist(<?php echo $related_data['id']; ?>);"><i class="bi bi-heart-fill fs-5 text-white" id="heart<?php echo $related_data['id'];  ?>"></i></a>

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

                        <hr class="hr-break-1" />

                        <br />

                        <?php
                        require "footer.php"
                        ?>

                    </div>
                </div>


                <script src="script.js"></script>
        </body>

        </html>

<?php

    } else {
        echo "Sorry for the inconvenient.";
    }
} else {
    echo "Something went wrong. ";
}


?>