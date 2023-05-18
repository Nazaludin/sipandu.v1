<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description" content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Sipandu | Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <!-- Custom CSS -->
    <link href="../../dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<style>
    html {
        height: 100%;
        background-color: rgba(237, 248, 255, 1);
    }

    body {
        height: 100%;
    }

    .bg {

        background-image: url('../../assets/images/img-depan-invert.png');
        background-repeat: no-repeat;
        background-size: contain;
        /* background-image: linear-gradient(rgba(22, 31, 24, 0.40), rgba(22, 31, 24, 0.40)), url('../../assets/images/bapelkes.jpeg'); */
        /* background-size: cover; */
        /* background-color: rgba(0, 0, 0, 1); */
        /* -webkit-backdrop-filter: blur(3px); */
        /* backdrop-filter: blur(3px); */
        /* filter: brightness(40%); */
        height: 100%;
        width: 100%;
    }

    /* .img-bapelkes {
        background-image: linear-gradient(rgba(0, 0, 0, 0.0), rgba(0, 0, 0, 0.80)), url('../../assets/images/img-depan.png');
        background-size: cover;
        background-color: rgba(22, 31, 24, 0.4);
        -webkit-backdrop-filter: blur(3px);
        backdrop-filter: blur(3px);
       
        height: 300px;
        width: 500px;
    } */
</style>

<body class="bg-transparent bg">
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="page-wrapper bg-transparent">

            <!-- <div id="loginform"> -->
            <!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->
            <div class="row">
                <div class="card flex-row my-5 border-0 rounded-5 overflow-hidden bg-transparent">
                    <!-- <img src="../../assets/images/img-depan.png" alt="" style="width: 80%;"> -->
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-4">

                </div>
                <div class="col-lg-2"></div>
                <div class="col-lg-4">
                    <div class="card flex-row my-5 border-0 shadow rounded-5 overflow-hidden">
                        <div class="card-body p-4 p-sm-5">
                            <h1 class="card-title text-center mb-5 fw-bold fs-1">Login</h1>
                            <form action="<?php echo base_url('login/proses'); ?>" method="post">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInputEmail" name="email" placeholder="name@example.com">
                                    <label for="floatingInputEmail">Email</label>
                                </div>

                                <hr>

                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                                    <label for="floatingPassword">Password</label>
                                </div>


                                <div class="d-grid mb-2">
                                    <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit">Masuk</button>
                                </div>

                                <a class="d-block text-center mt-2 small" href="<?php echo base_url('registrasi'); ?>">Belum memiliki akun? Daftar</a>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>

            <!-- </body> -->
            <!-- </div> -->
            <div id="recoverform" hidden>
                <div class="text-center">
                    <span class="text-white">Enter your e-mail address below and we will send you instructions how to recover a password.</span>
                </div>
                <div class="row mt-3">
                    <!-- Form -->
                    <form class="col-12" action="index.html">
                        <!-- email -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-danger text-white h-100" id="basic-addon1"><i class="ti-email"></i></span>
                            </div>
                            <input type="text" class="form-control form-control-lg" placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <!-- pwd -->
                        <div class="row mt-3 pt-3 border-top border-secondary">
                            <div class="col-12">
                                <a class="btn btn-success text-white" href="#" id="to-login" name="action">Back To Login</a>
                                <button class="btn btn-info float-end" type="button" name="action">Recover</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $(".preloader").fadeOut();
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
        $('#to-login').click(function() {

            $("#recoverform").hide();
            $("#loginform").fadeIn();
        });
    </script>

</body>

</html>