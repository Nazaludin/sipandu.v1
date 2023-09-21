<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-fluid">
            <?php if (session()->has('message')) : ?>
                <div class="alert alert-important alert-success alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l5 5l10 -10"></path>
                            </svg>
                        </div>
                        <div>
                            <?= session('message') ?>
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            <?php endif ?>

            <?php if (session()->has('error')) : ?>
                <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <!-- Download SVG icon from http://tabler-icons.io/i/alert-circle -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                <path d="M12 8v4"></path>
                                <path d="M12 16h.01"></path>
                            </svg>
                        </div>
                        <div>
                            <?= session('error') ?>
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            <?php endif ?>
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Pelatihan
                    </div>
                    <h2 class="page-title">
                        Agenda
                    </h2>
                    <ol class="breadcrumb mt-2" aria-label="breadcrumbs">
                        <li class="breadcrumb-item"><a>Home</a></li>
                        <li class="breadcrumb-item"><a>Library</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="#">Data</a></li>
                    </ol>
                </div>


            </div>

        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-fluid">
            <div class="row row-deck row-cards">
                <div class="col-12">

                    <div class="card card-round">
                        <form action="<?php echo base_url('pelatihan/agenda/registrasi/proses/' . json_decode($pelatihan)->courses->id); ?>" method="POST" enctype="multipart/form-data">

                            <div class="card-body">
                                <h4 class="card-title">Detail Pelatihan</h4>
                                <div class="row px-3 justify-content-between">
                                    <div class="col-6 mb-4">
                                        <a href="<?= base_url('pelatihan/agenda'); ?>" class="btn btn-outline-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-big-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M20 15h-8v3.586a1 1 0 0 1 -1.707 .707l-6.586 -6.586a1 1 0 0 1 0 -1.414l6.586 -6.586a1 1 0 0 1 1.707 .707v3.586h8a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1z"></path>
                                            </svg>
                                            Back</a>
                                    </div>

                                </div>
                                <?= csrf_field() ?>

                                <!-- Comment Row -->
                                <div class="row px-3 mb-4">
                                    <?php foreach ($upload_document as $d => $doc) {  ?>
                                        <div class="col-6 my-2">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h3 class="card-title"><?= $doc['name']; ?></h3>
                                                    <input type="file" class="form-control" id="f" name="<?= $doc['id']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    <?php  } ?>

                                </div>


                                <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                                    Simpan
                                </button>
                                <!-- END tab pane ringkasan -->

                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Recent comment and chats -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->