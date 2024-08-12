<?php
require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>PowerGym | Purchase History</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

    <link rel="icon" href="resources/logo.svg" />

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body style="background-color: #c4c4c4; background-image: linear-gradient(90deg,#c4c4c4 0%, #505050 100%);">
    <div class="container-fluid">
        <div class="row">
            <?php require "header.php" ?>

            <?php

            if (isset($_SESSION["u"])) {

                $email = $_SESSION["u"]["email"];

            ?>

                <div class="col-12 text-center mb-3 mt-2 bg-dark">
                    <span class="fs-1 fw-bold text-danger text-center">Purchase History</span>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 d-none d-lg-block">
                            <div class="row">

                                <div class="col-1 bg-black text-end border border-1 border-white">
                                    <label class="form-label fw-bold fs-5 text-white">#</label>
                                </div>
                                <div class="col-3 bg-black text-end border border-1 border-white">
                                    <label class="form-label fw-bold fs-5 text-white">Order Details</label>
                                </div>
                                <div class="col-1 bg-black text-end border border-1 border-white">
                                    <label class="form-label fw-bold fs-5 text-white">Quantity</label>
                                </div>
                                <div class="col-2 bg-black text-end border border-1 border-white">
                                    <label class="form-label fw-bold fs-5 text-white">Amount</label>
                                </div>
                                <div class="col-2 bg-black text-end border border-1 border-white">
                                    <label class="form-label fw-bold fs-5 text-white">Purchased Date & Time</label>
                                </div>
                                <div class="col-3"></div>
                                <div class="col-12">
                                <hr class="hr-break-1" />
                                </div>

                            </div>
                        </div>

                        <!--  -->

                        <?php

                        $productrs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $email . "'");

                        $pd = $productrs->num_rows;


                        $invoiceproductrs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $email . "'");

                        $in = $invoiceproductrs->num_rows;

                        for ($z = 0; $z < $in; $z++) {

                            $pd = $productrs->fetch_assoc();
                            $ipd = $invoiceproductrs->fetch_assoc();

                        ?>


                            <div class="col-12">
                                <div class="row ">
                                    <div class="col-12 col-lg-1 bg-dark text-center text-lg-start border border-1 border-secondary">
                                        <label class="form-label text-white fs-6 py-5"><?php echo $ipd["order_id"];   ?></label>
                                    </div>
                                    <div class="col-12 col-lg-3 ">
                                        <div class="row g-1">

                                            <div class="card mx-0 my-2" style="width: 500px;">
                                                <div class="row g-0">

                                                    <?php

                                                    $imagers = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $ipd["product_id"] . "'");
                                                    $image = $imagers->fetch_assoc();

                                                    ?>

                                                    <div class="col-md-4">
                                                        <img src="<?php echo $image["code"];  ?>" class="img-fluid rounded-start" />
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <?php
                                                            $producttitlers = Database::search("SELECT * FROM `product` WHERE `id`='" . $ipd["product_id"] . "'");
                                                            $ptd = $producttitlers->fetch_assoc();

                                                            $useremailrs = Database::search("SELECT * FROM `user` WHERE `email`='" . $ipd["user_email"] . "'");
                                                            $uemail = $useremailrs->fetch_assoc();

                                                            ?>
                                                            <h5 class="card-title fw-bold"><?php echo $ptd["title"];  ?></h5>
                                                            <p class="card-text"><b>Seller : </b><?php echo $uemail["fname"] ?> <?php echo $uemail["lname"]  ?></p>
                                                            <p class="card-text"><b>Price : </b><?php echo $ptd["price"];   ?></p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-1 text-center text-lg-center bg-white border border-1 border-secondary">
                                        <label class="form-label fs-4 pt-5"><?php echo $ipd["qty"];   ?></label>
                                    </div>
                                    <div class="col-12 col-lg-2 text-center text-lg-center bg-dark border border-1 border-secondary">
                                        <label class="form-label fs-5 pt-5 text-white fw-bold">Rs. <?php echo ($ptd["price"] * $ipd["qty"]) + $ptd["delivery_fee_other"];   ?> .00</label>
                                    </div>

                                    <div class="col-12 col-lg-2 text-center text-lg-center bg-white border border-1 border-secondary">
                                        <label class="form-label fs-5 pt-5 px-3 fw-bold"><?php echo $ipd["date"];   ?></label>
                                    </div>

                                    <div class="col-12 col-lg-3">
                                        <div class="row">

                                            <div class="col-6 d-grid">
                                                <button class="btn btn-dark rounded mt-5 fs-5 rounded-pill" onclick="addFeedback(<?php echo $ptd['id'];  ?>)">
                                                    <i class="bi bi-info-circle-fill"></i> Feedback
                                                </button>
                                            </div>

                                            <?php

                                            $removeFeedrs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $ipd['order_id'] . "'");
                                            $removeFeed = $removeFeedrs->fetch_assoc();

                                            ?>

                                            <div class="col-6 d-grid">
                                                <button class="btn btn-danger rounded mt-5 fs-5 rounded-pill" onclick="removeFeedback(<?php echo $removeFeed['id'];   ?>)">
                                                    <i class="bi bi-trash-fill"></i> Delete
                                                </button>
                                            </div>

                                            <div class="col-12">
                                            <hr class="hr-break-1" />
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!--  -->
                            <div class="modal fade" id="feedbackModal<?php echo $ptd["id"];  ?>" tabindex="-1" aria-labelledby="exampleModelLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModelLabel"><?php echo $ptd['title'];  ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <textarea class="form-control" id="feedtxt<?php echo $ptd["id"];  ?>" cols="30" rows="10"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary" onclick="saveFeedBack(<?php echo $ptd['id']; ?>)">Save FeedBack</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  -->

                        <?php
                        }


                        ?>

                        <!--  -->


                    </div>
                </div>
                <div class="col-12">
                <hr class="hr-break-1" />
                </div>

                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-10 col-lg-9 d-none d-lg-block"></div>
                        <div class="col-12 col-lg-3 d-grid">
                            <button class="btn btn-danger rounded fs-5" onclick="allFeedbackRemove();">
                                <i class="bi bi-trash-fill"></i>
                                Clear All Record
                            </button>
                        </div>
                    </div>
                </div>

                <!-- modal -->
                <div class="modal fade" id="feedbackModal"></div>
                <!-- modal -->

                <?php require "footer.php" ?>
        </div>
    </div>

<?php
            }

?>


<script src="script.js"></script>
</body>

</html>