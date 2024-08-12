<?php require "connection.php";  ?>

<!DOCTYPE html>
<html>

<head>
    <title>Cart | PowerGym</title>

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

            require "header.php";

            if (isset($_SESSION["u"])) {
                $uemail = $_SESSION["u"]["email"];

                $total = 0;
                $subTotal = 0;
                $shipping = 0;

            ?>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 border-1 border-secondary rounded ">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <br />
                                    <label class="col-12 form-label fs-1 fw-bolder text-danger fw-bold bg-dark">Cart <i class="bi bi-cart3 fs-2"></i></label>
                                </div>

                                <div class="col-12 ">
                                    <hr class="hr-break-1" />
                                </div>
                                <div class="col-11 col-lg-2 border-0 border-end border-white border-1 border-primary">
                                    <!-- breadcum & -->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item text-white"><a class="fs-4 fw-bold" href="home.php">Home</a></li>
                                            <li class="breadcrumb-item fs-4 fw-bold" aria-current="page">Cart</li>
                                        </ol>
                                    </nav>

                                    <nav class=" nav  nav-pills flex-column">
                                        <a class="nav-link active fs-4" aria-current="page" href="#"> My Cart</a>
                                        <a class="nav-link fs-4 fw-bold text-black" href="watchList.php">My Watchlist</a>

                                    </nav>
                                    <!-- breadcum & -->
                                </div>
                                <?php
                                $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $uemail . "'");
                                $cart_num = $cart_rs->num_rows;

                                $cart_result = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $uemail . "' AND `status`='1'");
                                $cart_number = $cart_result->num_rows;

                                if ($cart_num == 0) {
                                ?>

                                    <!-- empty -->

                                    <div class="col-12 col-lg-9">
                                        <div class="row">
                                            <div class="col-12 emptycart"></div>
                                            <div class="col-12 text-center mb-2">
                                                <img src="resources/emptycart.svg" style="width:200px ;" />
                                            </div>

                                            <div class="col-12 text-center mb-2">
                                                <label class="form-label fs-1">You have no item your Cart</label>
                                            </div>

                                            <div class="col-12 col-lg-4 offset-0 offset-lg-4 d-grid mb-4">
                                                <a href="home.php" class="btn btn-outline-warning fs-3 fw-bold">Start Shoping</a>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- empty -->
                                <?php
                                } else {

                                    $cart_rst = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $uemail . "'");
                                    $cart_status = $cart_rst->fetch_assoc();

                                    $pdqty_rs = Database::search("SELECT * FROM `product` INNER JOIN `cart` ON product.id = cart.product_id WHERE product.qty = 0 AND cart.product_id=product.id AND cart.user_email= '" . $uemail . "'");
                                    $qtyrow_num = $pdqty_rs->num_rows;


                                ?>

                                    <div class="col-12 col-lg-9">

                                        <div class="row g-2">

                                            <div class=" col-lg-4 offset-lg-0 form-check">
                                                <?php

                                                if ($qtyrow_num == 0) {
                                                ?>
                                                <input class="form-check-input" type="checkbox" id="flexCheckDefault" <?php if ($cart_num == $cart_number) {
                                                                                                                                echo "checked";
                                                                                                                            } ?> onclick="changeAllCartStatus();">
                                                
                                                    
                                                <?php
                                                } else {

                                                ?>
                                                <input class="form-check-input" type="checkbox" disabled>

                                                    <?php
                                                }

                                                ?>
                                                <label class="fw-bold text-black fs-5" for="">
                                                    Select All Products
                                                </label>
                                            </div>
                                            <div class="col-12 ">
                                                <hr class="hr-break-1" />
                                            </div>

                                            <?php
                                            for ($x = 0; $x < $cart_num; $x++) {

                                                $cart_data = $cart_rs->fetch_assoc();
                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id` ='" . $cart_data["product_id"] . "'");

                                                $product_data = $product_rs->fetch_assoc();

                                                if ($cart_data["status"] == 1) {
                                                    $total = $total + ($product_data["price"] * $cart_data["qty"]);
                                                }

                                                $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $uemail . "'");
                                                $address_data = $address_rs->fetch_assoc();
                                                $city_id = $address_data["city_id"];

                                                $district_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $city_id . "'");
                                                $district_data = $district_rs->fetch_assoc();
                                                $district_id = $district_data["district_id"];

                                                $ship = 0;
                                                if ($district_id == 1) {
                                                    $ship = $product_data["delivery_fee_colombo"];
                                                    if ($cart_data["status"] == 1) {
                                                        $shipping = $shipping + $product_data["delivery_fee_colombo"];
                                                    }
                                                } else {
                                                    $ship = $product_data["delivery_fee_other"];
                                                    if ($cart_data["status"] == 1) {
                                                        $shipping = $shipping + $product_data["delivery_fee_other"];
                                                    }
                                                }
                                                $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");

                                                $user_data = $user_rs->fetch_assoc();

                                            ?>
                                                <!-- have product -->



                                                <br />

                                                <div class="card lagecard mb-3 mx-5 col-12" style="background-color: #17141d; border-radius: 30px; box-shadow: -1rem 0 3rem #000;">
                                                    <div class="row g-0">

                                                        <div class="col-md-12 mt-3 mb-3">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="fw-bold text-white-50 fs-5">Seller :</span>
                                                                    <span class="fw-bold text-black fs-5 text-white">
                                                                        <?php echo $user_data["fname"] . "" . $user_data["lname"]; ?>
                                                                    </span> &nbsp;
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="col-md-4">

                                                            <?php
                                                            $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "'");
                                                            $img_data = $img_rs->fetch_assoc();
                                                            ?>

                                                            <span class="d-inline-block " tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $product_data["description"]; ?>" title="Product Description">


                                                                <img src="<?php echo $img_data["code"];  ?>" class="card-img-top card-img-top img-thumbnail" style="margin-top: 10px; margin-left: 15px; width:220px ; height: 220px; border-radius: 10px;  transition: 0.4s ease-out; position: relative;" />
                                                                <div class="col-md-6">
                                                                    <div class="newbar col-md-6">
                                                                        <div class="emptybar"></div>
                                                                        <div class="filledbar"></div>

                                                                        <br />

                                                                        <!-- check box -->

                                                                        <?php
                                                                        if ($product_data["qty"] == 0) {
                                                                        ?>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" disabled type="checkbox">

                                                                            </div>
                                                                        <?php
                                                                        } else {

                                                                        ?>
                                                                            <div class="form-check ">
                                                                                <input class="form-check-input" type="checkbox" id="flexCheckDefault<?php echo $cart_data["product_id"]; ?>" <?php if ($cart_data["status"] == 1) {
                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                } ?> onclick="changeCartStatus(<?php echo $cart_data['product_id']; ?>);">

                                                                            </div>
                                                                        <?php
                                                                        }
                                                                        ?>


                                                                        <!-- check box -->

                                                                    </div>

                                                                </div>
                                                            </span>

                                                        </div>


                                                        <div class="col-md-5">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-12 my-2 ">
                                                                        <span class="badge text-center">
                                                                            <i class="bi bi-star-fill  text-warning fs-5"></i>
                                                                            <i class="bi bi-star-fill  text-warning fs-5"></i>
                                                                            <i class="bi bi-star-fill  text-warning fs-5"></i>
                                                                            <i class="bi bi-star-fill  text-warning fs-5"></i>
                                                                            <i class="bi bi-star-half  text-warning fs-5"></i>
                                                                            &nbsp;&nbsp;&nbsp;

                                                                            <label class="fs-5 text-white fw-bold">4.5 Stars</label>

                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <br />
                                                                <h3 class="card-title text-white"> <?php echo $product_data["title"]; ?> </h3>


                                                                <br />

                                                                <span class=" fw-bold text-white-50 fs-5"> Price : </span> &nbsp;
                                                                <span class=" fw-bold fs-5 text-white"> Rs. <?php echo $product_data["price"]; ?>.00</span>

                                                                <br /><br />

                                                                <div class="col-12">
                                                                    <span class=" fw-bold text-white-50 fs-5">Quantity : </span>
                                                                    <input type="number" class="border-1 fs-5 fw-bold text-start " style="outline: none;" pattern="[0-9]" value="<?php echo $cart_data["qty"] ?>" onkeyup='check_qty(<?php echo $product_data["id"] ?>);' onclick='check_qty(<?php echo $product_data["id"] ?>);' id="qtyvalue<?php echo $product_data["id"] ?>" />


                                                                </div>
                                                                <br />

                                                                <span class=" fw-bold text-white-50 fs-5"> Available Quantity : </span> &nbsp;

                                                                <input type="text" value="<?php echo $product_data["qty"]; ?>" id="av_qty<?php echo $product_data["id"] ?>" class="fw-bold text-white-50 fs-5" style="background-color: #17141d; border: none;" disabled />
                                                                <br /><br />

                                                                <span class=" fw-bold text-white-50 fs-5">Delivery Fee : </span> &nbsp;
                                                                <span class=" fw-bold text-white-50 fs-5"> Rs.<?php echo $ship; ?>.00</span>


                                                            </div>
                                                        </div>


                                                        <div class="col-md-3">
                                                            <br /><br /><br />
                                                            <div class="card-body d-grid">
                                                                <?php
                                                                if ($product_data["qty"] == 0) {
                                                                ?>
                                                                    <a href="#" class="btn btn-outline-success mb-2 rounded-pill disabled">Not Available</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <?php
                                                                } else {

                                                                ?>
                                                                    <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]) ?>' class="btn btn-outline-success mb-2 rounded-pill">Buy Now</a>&nbsp;&nbsp;&nbsp;&nbsp;

                                                                <?php
                                                                }
                                                                ?>
                                                                <a href="#" class="btn btn-outline-danger mb-2 rounded-pill" onclick="deleteFromCart(<?php echo $cart_data['id']; ?>);">Remove</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </div>
                                                        </div>

                                                        <hr />

                                                        <div class="col-md-12 mt-3 mb-3">
                                                            <div class="row">
                                                                <div class="col-6 col-md-6">
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="fw-bold fs-5 text-white-50">Request Total <i class="bi bi-info-circle"></i></span>
                                                                </div>
                                                                <div class="col-6 col-md-6 text-end">
                                                                    <span class="fw-bold fs-5 text-white-50"> Rs. <?php echo ($product_data["price"] * $cart_data["qty"]) + $ship ?>.00</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                                </div>

                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>

                                                <br />
                                                <hr class="hr-break-1" />
                                                <br />

                                                <!-- have product -->

                                        <?php
                                            }
                                        }
                                        ?>

                                        </div>

                                    </div>


                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <hr class="hr-break-1" />
                <br />
                <div class="col-12 col-lg-4 offset-lg-4 border border-2 border-white" style="background-color: #17141d; border-radius: 30px; box-shadow: -1rem 0 3rem #000;">
                    <div class="row m-2">

                        <div class="col-12">
                            <label class="form-label fs-2 fw-bold text-white">Summary</label>
                        </div>

                        <div class="col-12">
                            <hr class="text-white" />
                        </div>

                        <div class="col-6 mb-3">
                            <span class="fs-5 fw-bold text-white">items (<?php echo $cart_number; ?>)</span>
                        </div>

                        <div class="col-6 text-end mb-3">
                            <span class="fs-5 fw-bold text-white">Rs.<?php echo $total ?> .00</span>
                        </div>

                        <div class="col-6">
                            <span class="fs-5 fw-bold text-white">Shipping</span>
                        </div>

                        <div class="col-6 text-end">
                            <span class="fs-5 fw-bold text-white">Rs.<?php echo $shipping ?>.00</span>
                        </div>

                        <div class="col-12 mt-3">
                            <hr class="text-white" />
                        </div>

                        <div class="col-6 mt-2">
                            <span class="fs-3 fw-bold text-white">Total</span>
                        </div>

                        <div class="col-6 mt-2 text-end">
                            <span class="fs-3 fw-bold text-white">Rs. <?php echo $total + $shipping ?>.00</span>
                        </div>

                        <div class="col-12 mt-3 mb-3 d-grid">
                            <button class="btn btn-outline-danger fs-5 fw-bold rounded-pill" onclick="checkout();">CHECKOUT</button>
                        </div>

                    </div>
                </div>
                <br /><br />
                <hr class="hr-break-1" />
                <br />
                <?php require "footer.php"; ?>

        </div>
    </div>


    <script src="script.js" ;></script>

    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
    <script src="bootstrap.js"></script>
</body>

</html>

<?php
            } else {
                echo "Please Sign In first. ";
            }
?>