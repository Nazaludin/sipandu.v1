<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Sipandu</title>
    <script defer data-api="/stats/api/event" data-domain="preview.tabler.io" src="/stats/js/script.js"></script>
    <base href="<?= base_url(); ?>">
    <meta name="msapplication-TileColor" content="" />
    <meta name="theme-color" content="" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/images/favicon.png'); ?>">
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
    <meta name="description" content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!" />
    <meta name="canonical" content="https://preview.tabler.io/layout-vertical.html">
    <meta name="twitter:image:src" content="https://preview.tabler.io/static/og.png">
    <meta name="twitter:site" content="@tabler_ui">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Tabler: Premium and Open Source dashboard template with responsive and high quality UI.">
    <meta name="twitter:description" content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!">
    <meta property="og:image" content="https://preview.tabler.io/static/og.png">
    <meta property="og:image:width" content="1280">
    <meta property="og:image:height" content="640">
    <meta property="og:site_name" content="Tabler">
    <meta property="og:type" content="object">
    <meta property="og:title" content="Tabler: Premium and Open Source dashboard template with responsive and high quality UI.">
    <meta property="og:url" content="https://preview.tabler.io/static/og.png">
    <meta property="og:description" content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!">
    <!-- CSS files -->
    <link href="<?= base_url('dist/css/tabler.min.css?1685973381'); ?>" rel="stylesheet" />
    <link href="<?= base_url('dist/css/tabler-flags.min.css?1685973381'); ?>" rel="stylesheet" />
    <link href="<?= base_url('dist/css/tabler-payments.min.css?1685973381'); ?>" rel="stylesheet" />
    <link href="<?= base_url('dist/css/tabler-vendors.min.css?1685973381'); ?>" rel="stylesheet" />
    <link href="<?= base_url('dist/css/demo.min.css?1685973381'); ?>" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet" />

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        html {
            height: 100%;
            background-color: rgba(237, 248, 255, 1);
        }

        /* body {
            height: 100%;
        } */

        .bg {

            background-image: url('../../assets/images/img-depan-invert.png');
            background-repeat: no-repeat;
            background-size: contain;
            height: 100%;
            width: 100%;
        }
    </style>
</head>

<?= $this->renderSection('pageStyles') ?>

<body class="bg-transparent bg">
    <script src="<?= base_url('dist/js/demo-theme.min.js?1685973381'); ?>"></script>
    <div class="page">

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

                <div class="row">

                    <!-- <div id="loginform"> -->
                    <!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->
                    <div class="col-6"></div>
                    <div class="col-5 card flex-row my-5 border-0 rounded-5 overflow-hidden bg-transparent">

                        <main role="main" class="container">
                            <?= $this->renderSection('main') ?>
                        </main><!-- /.container -->
                    </div>

                    <div class="col-1"></div>

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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"></script>

        <!-- Bootstrap tether Core JavaScript -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!-- <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script> -->
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


        <?= $this->renderSection('pageScripts') ?>

        <!-- Libs JS -->
        <script src="<?= base_url('dist/libs/apexcharts/dist/apexcharts.min.js?1685973381'); ?>" defer></script>
        <script src="<?= base_url('dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1685973381'); ?>" defer></script>
        <script src="<?= base_url('dist/libs/jsvectormap/dist/maps/world.js?1685973381'); ?>" defer></script>
        <script src="<?= base_url('dist/libs/jsvectormap/dist/maps/world-merc.js?1685973381'); ?>" defer></script>
        <!-- Tabler Core -->
        <script src="<?= base_url('dist/js/tabler.min.js?1685973381'); ?>" defer></script>
        <script src="<?= base_url('dist/js/demo.min.js?1685973381'); ?>" defer></script>

</body>

</html>