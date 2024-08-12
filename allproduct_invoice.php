<?php
require "connection.php";
?>


<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PowerGym | Invoice</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

    <link rel="icon" href="resources/logo.svg" />

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

</head>

<body class="mt-2 bg-white">

    <div class="container-fluid">
        <div class="row">

            <?php require "header.php"; ?>

            <div class="col-12">
                <hr />
            </div>

            <div class="col-12 btn btn-toolbar justify-align-content-start">
                <button class="btn btn-dark me-2" onclick="printInvoice();"><i class="bi bi-printer-fill"></i> Print</button>
            </div>
            <div class="col-12 btn btn-toolbar justify-align-content-start">
                <button class="btn btn-danger me-2"><i class="bi bi-file-pdf-fill"></i> Export as PDF</button>
            </div>

            <div class="col-12">
                <hr />
            </div>

            <?php
            $invoice_order_id = Database::search("SELECT * FROM `invoice_order_id` ");
            $order_num = $invoice_order_id->num_rows;

            for ($x = 0; $x < $order_num; $x++) {
                $invoice_data = $invoice_order_id->fetch_assoc();
                $product_order_id = $invoice_data["order_id"];

                $order_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id` ='" . $product_order_id . "'");
                $order_datas = $order_rs->fetch_assoc();
            }
            ?>

            <div class="col-12" id="page">
                <div class="row">

                    <div class="col-6">
                        <div class="ms-5 invoiceHeaderImage"></div>
                    </div>

                    <div class="col-6">
                        <div class="row">

                            <div class="col-12 text-warning text-end">
                                <h2>PowerGym</h2>
                            </div>

                            <div class="col-12 fw-bold text-end">
                                <span>Negombo Rd,Kurunegala,Sri Lanka.</span><br />
                                <span>+94 717 797999</span><br />
                                <span>powergym@gmail.com</span>
                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        <hr class="border border-1 border-danger" />
                    </div>
                    <div class="col-12 fw-bold text-center bg-white text-decoration-underline ">
                        <h1 class="text-danger fw-bold">INVOICE</h1>
                    </div>

                    <div class="col-12">
                        <hr class="border border-1 border-danger" />
                    </div>

                    <div class="col-12 mb-4">
                        <div class="row">

                            <div class="col-6">
                                <h2><?php $_SESSION["u"]["fname"] . "" . $_SESSION["u"]["lname"]; ?></h2>
                                <?php
                                $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON user_has_address.city_id = city.id WHERE user_has_address.user_email = '" . $_SESSION["u"]["email"] . "' ");
                                $address_data = $address_rs->fetch_assoc();
                                ?>
                                <span><?php echo $address_data["line1"] . "," . $address_data["line2"] . "," . $address_data["name"] . "."; ?></span><br />
                                <span class="fw-bold"><?php echo $_SESSION["u"]["email"]; ?></span>
                            </div>

                            <div class="col-6 text-end mt-4">

                                <span class="fw-bold">Date & Time of Invoice :</span>&nbsp;

                                <span class="fw-bold"><?php echo $order_datas["date"]; ?></span>
                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        <hr class="border border-1 border-dark" />
                    </div>

                    <div class="col-12">
                        <table class="table">

                            <thead>
                                <tr class="border border-1 border-white">
                                    <th>#</th>
                                    <th>Order ID & Product</th>
                                    <th class="text-end">Unit Price</th>
                                    <th class="text-end">Quantity</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php

                                $invoice_order_ids = Database::search("SELECT * FROM `invoice_order_id` ");
                                $order_nums = $invoice_order_ids->num_rows;
                                $total = 0;
                                for ($x = 0; $x < $order_nums; $x++) {

                                    $invoice_datas = $invoice_order_ids->fetch_assoc();
                                    $product_order_ids = $invoice_datas["order_id"];

                                    $order_rss = Database::search("SELECT * FROM `invoice` WHERE `order_id` ='" . $product_order_ids . "'");
                                    $order_data = $order_rss->fetch_assoc();

                                    $total = $total + ($order_data["total"]);


                                ?>


                                    <tr style="height: 72px;" class="bg-warning">
                                        <td class="bg-dark text-white fs-3"><?php echo $order_data["id"]; ?></td>
                                        <td>
                                            <span class="fw-bold text-danger bg-warning text-decoration-underline p-2"><?php echo $order_data["order_id"]; ?></span>
                                            <br />
                                            <?php
                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $order_data["product_id"] . "' ");
                                            $product_data = $product_rs->fetch_assoc();
                                            ?>
                                            <span class="fw-bold fs-3 text-black bg-warning p-2"><?php echo $product_data["title"]; ?></span>
                                        </td>
                                        <td class="fw-bold fs-6 text-end pt-3 bg-dark text-white">Rs. <?php echo $product_data["price"]; ?> .00</td>
                                        <td class="fw-bold fs-6 text-end pt-3"><?php echo $order_data["qty"]; ?></td>
                                        <td class="fw-bold fs-6 text-end bg-dark text-white">Rs. <?php echo $order_data["total"]; ?> .00</td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>

                            <tfoot>

                                <tr>
                                    <td colspan="3" class="border-0"></td>
                                    <td class="fs-5 text-end shadow">SUBTOTAL</td>
                                    <td class="text-end shadow">Rs. <?php echo $total; ?> .00</td>
                                </tr>

                                <tr>
                                    <td colspan="3" class="border-0"></td>
                                    <td class="fs-5 text-end shadow">Shipping</td>
                                    <td class="text-end shadow">Rs. <?php echo $_SESSION["shipping"]; ?> .00</td>
                                </tr>

                                <tr>
                                    <td colspan="3" class="border-0"></td>
                                    <td class="fs-5 text-end shadow">DISCOUNT</td>
                                    <td class="text-end shadow">Rs.
                                        <?php
                                        $discount;
                                        if ( $_SESSION["payment"] > "150000") {
                                            $discount = ($_SESSION["payment"] / 100) * 1;
                                            echo $discount;
                                        } else if ($_SESSION["payment"] > "300000") {
                                            $discount = ($_SESSION["payment"] / 100) * 2;
                                            echo $discount;
                                        } else if ($_SESSION["payment"] > "500000") {
                                            $discount = ($_SESSION["payment"] / 100) * 5;
                                            echo $discount;
                                        } else {
                                            $discount = 0;
                                            echo $discount;
                                        }

                                        ?>
                                        .00</td>
                                </tr>

                                <tr>
                                    <td colspan="3" class="border-0"></td>
                                    <td class="fs-5 text-end border-danger text-primary fw-bold">GRAND TOTAL</td>
                                    <td class="fs-5 text-end border-danger text-primary fw-bold">Rs. <?php echo $_SESSION["payment"] - $discount ?> .00</td>
                                </tr>

                            </tfoot>

                        </table>
                    </div>



                    <div class="col-12 mt-3 mb-3 border-0 border-start border-5 border-danger rounded bg-secondary">
                        <div class="row">
                            <div class="col-12 mt-3 mb-3">
                                <label class="form-label fw-bold fs-5">NOTICE :</label>
                                <label class="form-label fs-6">Purchased items can return before 7 days of Delivery.</label>
                            </div>
                        </div>
                    </div>


                    <div class="col-12">
                        <hr class="border border-1 border-danger" />
                    </div>

                    <div class="col-12 text-center mb-3">
                        <label class="form-label fs-5 text-black-50 fw-bold">
                            Invoice was created on a computer is valid without a Signature and Seal.
                        </label>
                    </div>

                    <div class="col-12">
                        <hr class="border border-1 border-danger" />
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