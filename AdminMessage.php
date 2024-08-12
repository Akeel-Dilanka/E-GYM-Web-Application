<?php


require "connection.php";

$email = $_GET["email"];

?>

<!DOCTYPE html>

<html>

<head>

    <title>PowerGym | Admin Messages</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

</head>

<body onload="refresher('<?php echo $email ?>');" style="background-color: #616161; background-image: linear-gradient(90deg,#616161 0%,#e0e0e0 100% );">

    <div class="container-fluid">
        <div class="row" >



        <div class="col-12">
                    <div class="row">
                        <div class="col-12 text-center fw-bold mb-3 mt-0 bg-dark">
                            <h2 class="fs-1 text-danger fw-bold">Message Box</h2>
                        </div>
                    </div>
                </div>
        


            <div class="col-12">
                <hr>
            </div>

            <div class="col-12 col-lg-2 m-3 my-0">
                    <div class="row">

                        <div class="align-items-start col-12 border border-white rounded" style="background-color: #17141d; box-shadow: -1rem 0 3rem #000;">
                            <div class="row g-1 text-center m-2">

                                <div class="nav flex-column nav-pills me-3 mt-2">
                                    <hr class="border border-1 border-white" />
                                    <nav class="nav flex-column">
                                        <a class="nav-link fw-bold fs-4" href="adminpanel.php">Dashboard</a>
                                        <a class="nav-link fw-bold fs-4" href="manageusers.php">Manage Users</a>
                                        <a class="nav-link fw-bold fs-4" href="manageProduct.php">Manage Product</a>
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

            <div class="col-12 py-5 px-4">
                <div class="row rounded shadow overflow-hidden">
                    <div class=" col-5 px-0">
                        <div class="bg-white">

                            <div class="bg-light px-4 py-2">
                                <h5 class="mb-0 py-1 fw-bold">Recent</h5>
                            </div>

                            <div class="messages_box">

                                <div class="list-group  rounded-0" id="rcv">


                                </div>
                            </div>



                        </div>
                    </div>

                    <!-- message box -->
                    <div class="col-7 px-0">
                        <div class="row px-4 py-5 chat_box  " id="chatrow">

                        </div>
                    </div>
                    <!-- message box -->


                    <!-- text -->

                    <div class="offset-6 col-5 px-0 ">
                        <div class="row bg-dark border border-1 border-light">

                            <div class="col-12 py-2">
                                <div class="row">
                                    <div class="input-group bg-dark">
                                        <input type="text" placeholder="Type your message..." aria-describedby="button-addon2" class="form-control rounded-0 border-0  py-3 bg-dark text-light" id="msgtxt" />
                                        <div class="input-group-append">

                                            <button id="button-addon2" class="btn btn-link fs-1 bg-light" onclick="sendAdminMessage('<?php echo $email ?>');">
                                                <i class="bi bi-send-fill fs-3 text-dark"></i>
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- text -->
                </div>

                </div>
    </div>
          
        </div>
    </div>
   

    <script src="script.js"></script>
</body>

</html>