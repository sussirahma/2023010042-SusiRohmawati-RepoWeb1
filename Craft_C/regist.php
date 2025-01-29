<?php
// Mulai sesi jika diperlukan
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

    <title>CRAFT C - Register</title>

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="assets/imgcss/bootstrap.css" />

    <!-- Custom styles for this template -->
    <link href="assets/imgcss/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="assets/imgcss/responsive.css" rel="stylesheet" />
</head>

<body>

    <!-- Registration section with background -->
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <!-- Tombol close dengan z-index tinggi -->
                    <button class="btn btn-close position-absolute top-0 end-0 m-3"
                            onclick="window.location.href='index.php';" style="z-index: 9999;"></button>

                    <div class="d-flex align-items-center justify-content-center h-100 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                        <!-- Form untuk registrasi -->
                        <form action="register_process.php" method="POST" style="width: 23rem;">

                            <!-- Title -->
                            <h3 class="fw-normal mb-3 pb-3 text-center" style="letter-spacing: 1px;">Sign up</h3>

                            <!-- Your Email Input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="email" id="form3Example1c" class="form-control form-control-lg" name="email" required />
                                <label class="form-label" for="form3Example1c">Your Email</label>
                            </div>

                            <!-- Username Input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="form3Example2c" class="form-control form-control-lg" name="username" required />
                                <label class="form-label" for="form3Example2c">Username</label>
                            </div>

                            <!-- Password Input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="password" id="form3Example3c" class="form-control form-control-lg" name="password" required />
                                <label class="form-label" for="form3Example3c">Password</label>
                            </div>

                            <!-- Register Button with same style as login -->
                            <div class="pt-1 mb-4">
                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-lg btn-block"
                                        type="submit">Register</button>
                            </div>

                            <!-- Link to Login -->
                            <p>Already have an account? <a href="login.php" class="link-info">Login here</a></p>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>
