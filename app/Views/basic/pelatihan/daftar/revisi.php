<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-fluid">
            <?php if (session()->has('message')) : ?>
                <div class="alert alert-important alert-success alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
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
                        Pelatihan Daftar
                    </div>
                    <h2 class="page-title">
                        Revisi Dokumen
                    </h2>
                    <ol class="breadcrumb mt-2" aria-label="breadcrumbs">
                        <li class="breadcrumb-item"><a>Pelatihan</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('pelatihan/daftar'); ?>">Daftar</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('pelatihan/daftar/detail/' . $id_pelatihan); ?>">Detail</a></li>
                        <li class="breadcrumb-item active"><a href="#">Revisi</a></li>
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
                        <form action="<?php echo base_url('pelatihan/daftar/revisi/proses/' . $id_pelatihan); ?>" method="POST" enctype="multipart/form-data">

                            <div class="card-body">
                                <div class="row justify-content-between mb-2 ">

                                    <div class="col-auto">
                                        <a href="<?= base_url('pelatihan/daftar/detail/' . $id_pelatihan); ?>" class="btn btn-ghost-white border-0 shadow-none" aria-label="Button">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M15 6l-6 6l6 6"></path>
                                            </svg>
                                            Back</a>
                                    </div>

                                </div>
                                <?= csrf_field() ?>

                                <div class="row px-3 mb-2">

                                    <div class="col-12 my-2">
                                        <!-- <div class="card"> -->
                                        <div class="card-body p-0">
                                            <h3 class="card-title mb-2">Revisi Dokumen Pelatihan</h3>
                                            <div class="card bg-yellow-lt text-dark mb-3">
                                                <div class="card-body m-1">
                                                    <div class="card-subheader h3 m-0 text-warning">Perhatian!</div>
                                                    <ul>
                                                        <li>
                                                            Dokumen yang Anda unggah mungkin tidak sesuai, dokumen yang tidak sesuai dijelaskan oleh komentar Admin di bawah.
                                                        </li>
                                                        <li>
                                                            Perbaiki dokumen dengan mengupload ulang dokumen pada isian yang disediakan.
                                                        </li>
                                                        <li>
                                                            Dokumen pesyaratan yang diunggah harus memiliki format <strong>pdf</strong> dengan ukuran dokumen <strong>tidak melebihi 5mb</strong>.
                                                        </li>
                                                        <li>
                                                            Dokumen revisi diperbaiki Anda dapat mengeklik tombol <strong>Simpan</strong> untuk melanjutkan proses revisi dokumen.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <?php if (!empty($comment)) { ?>
                                    <div class="row px-3 mb-2">
                                        <div class="col-12">
                                            <div class="card-body p-0">
                                                <h3 class="card-title mb-2">Komentar Admin</h3>
                                                <div class="card bg-red-lt text-dark mb-3">
                                                    <div class="card-body m-1 py-1">
                                                        <div class="card-subheader h3 m-0 text-red">Pesan :</div>
                                                        <p><?= $comment; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <!-- Comment Row -->
                                <div class="row px-3 mb-4">
                                    <h3 class="card-title mb-0">Dokumen Persyaratan</h3>
                                    <?php foreach ($uploaded_document as $d => $doc) {  ?>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="card  ">
                                                <div class="card-body pt-1">
                                                    <span class="d-flex justify-content-between my-2">
                                                        <h3 class="card-title py-1 my-1"><?= $doc['name']; ?></h3>
                                                        <?php if (isset($doc['link'])) { ?>
                                                            <a class="btn py-1 my-1" href="<?= base_url($doc['link']); ?>" target="_blank">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-list" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                                                                    <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                                                                    <path d="M9 12l.01 0"></path>
                                                                    <path d="M13 12l2 0"></path>
                                                                    <path d="M9 16l.01 0"></path>
                                                                    <path d="M13 16l2 0"></path>
                                                                </svg>
                                                                <strong>Lihat</strong>
                                                            </a>
                                                        <?php } ?>
                                                    </span>
                                                    <input type="file" class="form-control" id="f" name="<?= $doc['id']; ?>" accept="application/pdf">
                                                </div>
                                            </div>
                                        </div>
                                    <?php  } ?>

                                </div>

                                <div class="row px-0">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                                            Simpan
                                        </button>
                                    </div>
                                </div>


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