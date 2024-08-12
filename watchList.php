<?php
require "connection.php";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cart | watchlist</title>

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



            <?php require "header.php";

            if (isset($_SESSION["u"])) {
                $u = $_SESSION["u"]["email"];
            ?>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 border-1 border-secondary rounded ">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <br/>
                                    <label class="col-12 form-label fs-1 fw-bolder text-danger fw-bold bg-dark">watchlist &hearts;</label>
                                </div>
                                <div class="col-12 ">
                                    <hr class="hr-break-1" />
                                </div>
                                <div class="col-11 col-lg-2 border-0 border-end border-white border-1 border-primary">
                                    <!-- breadcum & -->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item text-white"><a class="fs-4 fw-bold" href="home.php">Home</a></li>
                                            <li class="breadcrumb-item fs-4 fw-bold" aria-current="page">Watchlist</li>
                                        </ol>
                                    </nav>

                                    <nav class=" nav  nav-pills flex-column">
                                        <a class="nav-link active fs-4" aria-current="page" href="#"> My Watchlist</a>
                                        <a class="nav-link fs-4 fw-bold text-black" href="cart.php">My Cart</a>

                                    </nav>
                                    <!-- breadcum & -->
                                </div>
                                <?php
                                $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $u . "'");
                                $watchlist_num = $watchlist_rs->num_rows;

                                if ($watchlist_num == 0) {
                                ?>
                                    <!-- no items -->
                                    <div class="col-12 col-lg-9">
                                        <div class="row">
                                            <div class="col-12 emptyView"></div>
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-1 mt-0 fw-bold">
                                                    You have no items in your watchList yet.
                                                </label>
                                            </div>
                                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3 ">
                                                <a href="home.php" class="btn btn-outline-warning mb-3 fs-3 fw-bold ">Start Shopping</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <br/>
                                                <hr class="hr-break-1" />
                                    
                                    <!-- no items -->
                                <?php
                                } else {
                                ?>
                                    <!-- have products -->

                                    <div class="col-12 col-lg-9">

                                        <div class="row g-2">

                                            <?php
                                            for ($x = 0; $x < $watchlist_num; $x++) {
                                                $watchlist_data = $watchlist_rs->fetch_assoc();
                                                $product_id = $watchlist_data["product_id"];
                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $product_id . "'");
                                                $product_data = $product_rs->fetch_assoc();
                                                $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "'");
                                                $img_data = $img_rs->fetch_assoc();
                                            ?>

                                                <br/><br/>
                                                <!-- card -->
                                                <div class="card lagecard mb-3 mx-0 mx-lg-5 col-12" style="background-color: #17141d; border-radius: 30px; box-shadow: -1rem 0 3rem #000;">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">
                                                            <img src="<?php echo $img_data["code"];  ?>" class="card-img-top card-img-top img-thumbnail" style="margin-top: 10px; margin-left: 15px; width:220px ; height: 220px; border-radius: 10px;  transition: 0.4s ease-out; position: relative;" />
                                                            <div class="newbar col-7">
                                                                <div class="emptybar"></div>
                                                                <div class="filledbar"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="card-body m-0">
                                                               
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
                                                                <h5 class="card-title fw-bold fs-2 text-white fw-bold"><?php echo $product_data["title"]; ?></h5>
                                                                <br />
                                                                <span class="fs-5  fw-bold text-white-50">Price :</span> &nbsp; &nbsp;
                                                                <span class="fs-5 fw-bold text-white">Rs.<?php echo $product_data["price"]; ?>.00</span>
                                                                <br />
                                                                <span class="fs-5  fw-bold text-white-50">Quantity :</span> &nbsp; &nbsp;
                                                                <span class="fs-5 fw-bold text-white"><?php echo $product_data["qty"]; ?> Items Available</span>
                                                                <br />
                                                                <span class="fs-5  fw-bold text-white-50">Seller :</span> &nbsp; &nbsp;
                                                                <br />
                                                                <span class="fs-5 fw-bold text-white">Akeel</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-3">
                                                            <div class="card-body d-grid d-lg-grid">
                                                                <br/><br/>
                                                                <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]) ?>' class="btn btn-outline-success rounded-pill col-12 ">Buy Now</a>
                                                                <br />
                                                                <a onclick="addToCart(<?php echo $product_data['id']; ?>);" class="btn btn-outline-primary rounded-pill col-12 mt-1">Add to Cart</a>
                                                                <br />
                                                                <a class="btn btn-outline-danger rounded-pill" onclick="removeFromWatchlist(<?php echo $watchlist_data['id']; ?>);">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- card -->
                                                <br/>
                                                <hr class="hr-break-1" />


                                            <?php
                                            }
                                            ?>
                                        </div>

                                    </div>

                                    <!-- have products -->

                                <?php
                                }
                                ?>



                            </div>
                        </div>
                    </div>
                </div>
                <?php require "footer.php"; ?>

        </div>
    </div>


    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>

<?php
            } else {

                echo "Please Sign In OR Register.  ";
            }
?>