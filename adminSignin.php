<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PowerGym | Admins | Sign In</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

</head>

<body style="background-color: #020202; background-image: linear-gradient(90deg,#020202 44%, #798489 125%);">

    <div class="container-fluid justify-content-center" style="margin-top: 150px;">
        <div class="row align-content-center">

        <div class="col-5 d-none d-lg-block background"></div>
        <div class="col-lg-1"></div>
            <div class="col-12 col-lg-5 ">
                
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center title01 titleWhite">Hi, Welcome to PowerGym Admins.</p>
                    </div>
                </div>
            </div>

            <div class="col-12 p-3">
                <div class="row">

                    

                    <div class="col-6 col-lg-12 d-block">
                        <div class="row g-2">

                            <div class="col-12">
                                <p class="title02 titleRed">Sign In to Your Account.</p>
                            </div>

                            <div class="col-12">
                                <label class="form-label titleBlue titleBold">Email</label>
                                <input type="email" class="form-control" id="em" />
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-outline-primary fw-bold" onclick="adminVerification();">
                                    Send Verification Code to Login
                                </button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-outline-danger fw-bold">Back to Customer Login</button>
                            </div>

                            <div class="col-12 text-center d-none d-lg-block fixed-bottom">
                                <p class="fw-bold text-white-50">&copy; 2022 PowerGym.lk All Rights Reserved.</p>
                            </div>

                            <!-- modal-- -->
                            <div class="modal" tabindex="-1" id="verificationModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Admin Verification</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label class="form-label">Enter the verification code you got by an email</label>
                                            <input type="text" class="form-control" id="vcode" />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- modal-- -->

                        </div>
                    </div>

                </div>
            </div>

        </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>