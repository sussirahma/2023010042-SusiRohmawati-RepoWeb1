<?php
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
    <link rel="shortcut icon" href="assets/img/logo-2.png" type="image/x-icon">

    <title>CRAFT C</title>

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="assets/css/responsive.css" rel="stylesheet" />
</head>

<body>

    <!-- Login section with background -->
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="d-flex align-items-center justify-content-center h-100 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                        <form action="login_proses.php" method="POST" style="width: 23rem;">
                            <h3 class="fw-normal mb-3 pb-3 text-center" style="letter-spacing: 1px;">Log in</h3>

                            <?php
                            // Menampilkan pesan error jika ada
                            if (isset($_SESSION['error'])) {
                                echo '<div class="alert alert-danger text-center">' . $_SESSION['error'] . '</div>';
                                unset($_SESSION['error']); // Menghapus pesan error setelah ditampilkan
                            }
                            ?>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="username" id="form2Example18" class="form-control form-control-lg"
                                    name="username" required />
                                <label class="form-label" for="form2Example18">Username</label>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="password" id="form2Example28" class="form-control form-control-lg"
                                    name="password" required />
                                <label class="form-label" for="form2Example28">Password</label>
                            </div>

                            <div class="pt-1 mb-4">
                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-lg btn-block"
                                    type="submit">
                                    <i class="bi bi-person"></i> Login
                                </button>
                            </div>
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