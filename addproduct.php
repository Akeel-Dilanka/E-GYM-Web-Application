<!DOCTYPE html>
<html>

<head>
    <title>PowerGym | Add Product</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body style="background-color: #c4c4c4; background-image: linear-gradient(90deg,#c4c4c4 0%, #505050 100%);">

    <div class="container-fluid">
        <div class="row gy-3">
            <?php
            require "header.php";
            ?>

            <?php

            require "connection.php";


            if (isset($_SESSION["u"])) {

            ?>


                <div class="col-12">
                    <div class="row">
                        <div class="col-12 text-center bg-dark">
                            <h2 class="h2 text-danger fw-bold mt-3">Add New Product</h2>
                        </div>
                        <br /><br /><br />
                        <hr class="hr-break-1" />
                        <div class="col-lg-12">
                            <div class="row">

                                <div class="col-12 col-lg-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">Select Product Category</label>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <select class="form-select" id="category">
                                                <option value="0">Select Category</option>
                                                <?php
                                                $category_rs =  Database::search("SELECT * FROM `category` ");
                                                $category_num = $category_rs->num_rows;

                                                for ($x = 0; $x < $category_num; $x++) {
                                                    $category_data = $category_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>
                                                <?php

                                                }

                                                ?>


                                            </select>

                                        </div>

                                    </div>

                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">Select Product Brand</label>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <select class="form-select" id="brand">
                                                <option value="0">Select Brand</option>
                                                <?php
                                                $brand_rs =  Database::search("SELECT * FROM `brand` ");
                                                $brand_num = $brand_rs->num_rows;

                                                for ($y = 0; $y < $brand_num; $y++) {
                                                    $brand_data = $brand_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $brand_data["id"]; ?>"><?php echo $brand_data["name"]; ?></option>
                                                <?php

                                                }

                                                ?>
                                            </select>

                                        </div>

                                    </div>

                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">Select Product Model</label>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <select class="form-select" id="model">
                                                <option value="0">Select Model</option>
                                                <?php
                                                $model_rs =  Database::search("SELECT * FROM `model` ");
                                                $model_num = $model_rs->num_rows;

                                                for ($z = 0; $z < $model_num; $z++) {
                                                    $model_data = $model_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $model_data["id"]; ?>"><?php echo $model_data["name"]; ?></option>
                                                <?php

                                                }

                                                ?>
                                            </select>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-12">
                                    <hr class="hr-break-1" />
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">
                                                Add a title to your product.
                                            </label>
                                        </div>
                                        <div class="offset-0 offset-lg-2  col-12 col-lg-8">
                                            <input type="text" class="form-control" id="title" />
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <hr class="hr-break-1" />
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-lg-4">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold lbl1">Select Price Condition</label>
                                                </div>
                                                <div class="offset-1 col-11 col-lg-3 ms-5 form-check ">
                                                    <input class="form-check-input" type="radio" name="condition" id="bn" checked />
                                                    <label class="form-check-label" for="bn">
                                                        New Price
                                                    </label>
                                                </div>
                                                <div class="offset-1 col-11 col-lg-3 ms-5 form-check ">
                                                    <input class="form-check-input" type="radio" name="condition" id="us" />
                                                    <label class="form-check-label" for="us">
                                                        Old Price
                                                    </label>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- myupdate -->
                                        <div class="col-12 col-lg-4">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold lbl1">Select Product Colour</label>
                                                </div>
                                                <div class=" offset-1 col-5 col-lg-4 offset-lg-0 form-check">
                                                    <input class="form-check-input" type="radio" name="clrradio" id="clr1">
                                                    <label class="form-check-label" id="clr1">
                                                        Sky Blue
                                                    </label>
                                                </div>
                                                <div class=" offset-1 col-5 col-lg-4 offset-lg-0 form-check">
                                                    <input class="form-check-input" type="radio" name="clrradio" id="clr2">
                                                    <label class="form-check-label" id="clr2">
                                                        Blue
                                                    </label>
                                                </div>
                                                <div class=" offset-1 col-5 col-lg-4 offset-lg-0 form-check">
                                                    <input class="form-check-input" type="radio" name="clrradio" id="clr3">
                                                    <label class="form-check-label" id="clr3">
                                                        Yellow
                                                    </label>
                                                </div>
                                                <div class=" offset-1 col-5 col-lg-4 offset-lg-0 form-check">
                                                    <input class="form-check-input" type="radio" name="clrradio" id="clr4">
                                                    <label class="form-check-label" id="clr4">
                                                        Green
                                                    </label>
                                                </div>
                                                <div class=" offset-1 col-5 col-lg-4 offset-lg-0 form-check">
                                                    <input class="form-check-input" type="radio" name="clrradio" id="clr5">
                                                    <label class="form-check-label" id="clr5">
                                                        Red
                                                    </label>
                                                </div>
                                                <div class=" offset-1 col-5 col-lg-4 offset-lg-0 form-check">
                                                    <input class="form-check-input" type="radio" name="clrradio" id="clr6">
                                                    <label class="form-check-label" id="clr6">
                                                        Silver
                                                    </label>
                                                </div>
                                                <div class=" offset-1 col-5 col-lg-4 offset-lg-0 form-check">
                                                    <input class="form-check-input" type="radio" name="clrradio" id="clr7">
                                                    <label class="form-check-label" id="clr7">
                                                        Black
                                                    </label>
                                                </div>
                                                <div class=" offset-1 col-5 col-lg-4 offset-lg-0 form-check">
                                                    <input class="form-check-input" type="radio" name="clrradio" id="clr8">
                                                    <label class="form-check-label" id="clr8">
                                                        White
                                                    </label>
                                                </div>
                                                <div class=" offset-1 col-5 col-lg-4 offset-lg-0 form-check">
                                                    <input class="form-check-input" type="radio" name="clrradio" id="clr9">
                                                    <label class="form-check-label" id="clr9">
                                                        Pink
                                                    </label>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- myupdate -->
                                        <!-- myupdate -->

                                        <div class="col-12 col-lg-4">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold lbl1">Add Product Quantity</label>
                                                </div>
                                                <div class="offset-0 offset-lg-0 col-12 col-lg-12">
                                                    <input type="number" class="form-control" value="0" min="0" id="qty" />
                                                </div>

                                            </div>
                                        </div>

                                        <!-- myupdate -->




                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr class="hr-break-1" />
                                </div>

                                <div class="col-12 ">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold lbl1">Cost Per Item</label>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Rs.</span>
                                                    <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="cost" />
                                                    <span class="input-group-text">.00</span>



                                                </div>

                                            </div>

                                        </div>

                                        <!--  -->
                                        <div class="col-12 col-lg-6">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold lbl1"> Approved Payment Method</label>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="offset-2 col-2 pm1"></div>
                                                        <div class="col-2 pm2"></div>
                                                        <div class="col-2 pm3"></div>
                                                        <div class="col-2 pm4"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--  -->

                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr class="hr-break-1" />
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">Delivery costs</label>
                                        </div>

                                        <div class="col-12 col-lg-6">
                                            <div class="row">
                                                <div class="col-12 offset-lg-1 col-lg-3">
                                                    <label> Delivery Cost Within Colombo</label>
                                                </div>

                                                <div class="col-12 col-lg-8">
                                                    <div class="input-group mb-3">
                                                        <!-- no code -->
                                                        <span class="input-group-text">Rs.</span>
                                                        <input type="text" class="form-control" aria-label="Amount(to the neares)" id="dwc" />
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                    <!-- no code -->
                                                    <div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="row">
                                                <div class="col-12 offset-lg-1 col-lg-3">
                                                    <label> Delivery Cost Out Of Colombo</label>
                                                </div>

                                                <div class="col-12 col-lg-8">
                                                    <div class="input-group mb-3">
                                                        <!-- no code -->
                                                        <span class="input-group-text">Rs.</span>
                                                        <input type="text" class="form-control" aria-label="Amount(to the neareset rupee )" id="doc" />
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                    <!-- no code -->
                                                    <div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="hr-break-1" />
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">Product Description</label>

                                        </div>
                                        <div class="col-12">
                                            <textarea class="form-control" cols="30" rows="25" id="description"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="hr-break-1" />
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">Add product Images</label>
                                        </div>
                                        <div class="offset-lg-3  col-12 col-lg-6">
                                            <div class="row ">
                                                <div class="col-4 border border-white rounded ">
                                                    <img class="img-fluid bg-white" src="resources/addproductimg.svg" id="preview0" />
                                                </div>
                                                <div class="col-4 border border-white rounded ">
                                                    <img class="img-fluid bg-white" src="resources/addproductimg.svg" id="preview1" />
                                                </div>
                                                <div class="col-4 border border-white rounded ">
                                                    <img class="img-fluid bg-white" src="resources/addproductimg.svg" id="preview2" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 offset-lg-3 col-lg-6 d-grid mt-3">
                                            <input type="file" accept="img/*" class="d-none" id="imageuploader" multiple />
                                            <label for="imageuploader" class="col-12 col-lg-6 offset-lg-3 btn btn-primary fs-5 rounded-pill" onclick="changeProductImage();">Upload Image</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <hr class="hr-break-1" />
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold lbl1">notice...</label>
                                    <br />
                                    <label class="form-label"> We are talking 5% of the product form price form every product as a service chearge.</label>
                                </div>

                                <div class="col-12">
                                    <hr class="hr-break-1" />
                                </div>

                                <div class="offset-lg-4 col-12 col-lg-4  d-grid mb-3 mt-2">
                                    <button class="btn btn-success rounded-pill fw-bold fs-4" onclick="addProduct();">Add Product</button>
                                </div>

                                <div class="col-12">
                                    <hr class="hr-break-1" />
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

<?php


            } else {

?>

    <script>
        window.location = "index.php";
    </script>

<?php

            }

?>