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
                        Pelatihan Riwayat
                    </div>
                    <h2 class="page-title">
                        Detail
                    </h2>
                    <ol class="breadcrumb mt-2" aria-label="breadcrumbs">
                        <li class="breadcrumb-item"><a>Pelatihan</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('pelatihan/riwayat'); ?>">Riwayat</a></li>
                        <li class="breadcrumb-item active"><a>Detail</a></li>
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
                        <div class="card-body">
                            <div class="row justify-content-between mb-2 ">

                                <div class="col-auto">
                                    <a href="<?= base_url('pelatihan/riwayat'); ?>" class="btn btn-ghost-white border-0 shadow-none" aria-label="Button">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M15 6l-6 6l6 6"></path>
                                        </svg>
                                        Back</a>
                                </div>
                                <div class="col-auto">
                                    <!-- <a href="<?= base_url('pelatihan/detail/user/' . json_decode($pelatihan)->courses->id); ?>" class="btn btn-warning position-relative" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Pendaftar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        </svg>
                                        Pendaftar
                                        <?php if (!empty(json_decode($pelatihan)->courses->registrar)) {   ?>
                                            <span class="badge bg-red text-red-fg badge-notification badge-pill"><?= json_decode($pelatihan)->courses->registrar; ?></span>
                                        <?php } ?>
                                    </a>
                                    <a class="btn btn-danger mx-2" data-bs-toggle="modal" data-bs-target="#modal-confirm-publish">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-share-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M8 9h-1a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-8a2 2 0 0 0 -2 -2h-1"></path>
                                            <path d="M12 14v-11"></path>
                                            <path d="M9 6l3 -3l3 3"></path>
                                        </svg>
                                        Publish
                                    </a>
                                    <a href="<?= base_url('pelatihan/detail/edit/' . json_decode($pelatihan)->courses->id); ?>" class="btn btn-outline-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                            <path d="M16 5l3 3"></path>
                                        </svg>
                                        Edit</a> -->
                                </div>
                            </div>
                            <!-- </div> -->

                            <div class="row px-2">
                                <div class="col-auto">
                                    <h3 class="card-title  pt-3">Detail Pelatihan</h3>
                                </div>
                            </div>
                            <!-- Comment Row -->
                            <div class="row px-3 mb-4">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <table class="table table-light">
                                                <colgroup>
                                                    <col style="width: 30%;">
                                                    <col style="width: 70%;">
                                                    <col>
                                                </colgroup>
                                                <tbody>
                                                    <tr>
                                                        <td>Tahun Pelaksanaan</td>
                                                        <td>: <?= json_decode($pelatihan)->courses->year; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jenis Pelatihan</td>
                                                        <td>: <?= json_decode($pelatihan)->courses->categoryname; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama Pelatihan</td>
                                                        <td>: <?= json_decode($pelatihan)->courses->fullname; ?></td>
                                                    <tr>
                                                    <tr>
                                                        <td>Nama Singkat</td>
                                                        <td>: <?= json_decode($pelatihan)->courses->shortname; ?></td>
                                                    <tr>
                                                        <td>Gelombang/batch</td>
                                                        <td>: <?= json_decode($pelatihan)->courses->batch ?? ''; ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Periode Pendaftaran</td>
                                                        <td>: <b><?= json_decode($pelatihan)->courses->start_registration; ?></b> s/d <b><?= json_decode($pelatihan)->courses->end_registration; ?></b> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Periode Pelatihan</td>
                                                        <td>: <b><?= json_decode($pelatihan)->courses->startdatetime; ?></b> s/d <b><?= json_decode($pelatihan)->courses->enddatetime; ?></b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <table class="table table-light">
                                                <colgroup>
                                                    <col style="width: 30%;">
                                                    <col style="width: 70%;">
                                                    <col>
                                                </colgroup>
                                                <tbody>
                                                    <tr>
                                                        <td>Sasaran Pelatihan</td>
                                                        <td>: <?= json_decode($pelatihan)->courses->target_participant; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tempat Pelaksanaan</td>
                                                        <td>: <?= json_decode($pelatihan)->courses->place; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kuota</td>
                                                        <td>: <?= json_decode($pelatihan)->courses->quota; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Metode</td>
                                                        <td>: <?= json_decode($pelatihan)->courses->method; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Kontak Person</td>
                                                        <td>: <?= json_decode($pelatihan)->courses->contact_person; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lampiran Jadwal</td>
                                                        <td>:<a href="<?= base_url(json_decode($pelatihan)->courses->schedule_file_location); ?>" download="<?= json_decode($pelatihan)->courses->schedule_file_name ?>"> Unduh</a> </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    <!-- RINGKASAN -->
                                    <div class="card card-round mt-3">
                                        <div class="card-body">
                                            <h4 class="card-title mt-0">Ringkasan :</h4>
                                            <?= json_decode($pelatihan)->courses->summary; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row px-3">
                                <div class="col-6">
                                    <table class="table table-responsive table-bordered">
                                        <thead class="bg-success">
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-start">Komponen Unduh</th>
                                                <th class="text-center">File</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($list_course_donwload_document as $d => $doc) { ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <?= $d + 1; ?>
                                                    </td>
                                                    <td class="text-start">
                                                        <?= $doc['name']; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="<?= base_url($doc['link']); ?>" download="<?= $doc['name']; ?>">Unduh</a>
                                                    </td>
                                                </tr>
                                            <?php  } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-6">
                                    <table class="table table-responsive table-bordered">
                                        <thead class="bg-success">
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-start">Komponen Kelengkapan Administrasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($list_course_upload_document as $d => $doc) { ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <?= $d + 1; ?>
                                                    </td>
                                                    <td class="text-start">
                                                        <?= $doc['name']; ?>
                                                    </td>

                                                </tr>
                                            <?php  } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="row px-3">
                                <?php if (!empty($uploaded_document)) { ?>
                                    <div class="col-12">
                                        <div class="card card-round mt-3">
                                            <div class="card-body">
                                                <h4 class="card-title mt-0">Dokumen Terupload :</h4>
                                                <table class="table  table-borderless table-hover table-striped align-middle">
                                                    <colgroup>
                                                        <col style="width: 5%;">
                                                        <col style="width: 850%;">
                                                        <col style="width: 10%;">
                                                        <col>
                                                    </colgroup>
                                                    <thead>
                                                        <th>No</th>
                                                        <th>Jenis Dokumen</th>
                                                        <th>Lihat</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($uploaded_document as $key => $value) { ?>
                                                            <tr>
                                                                <td><?= $key + 1 ?></td>
                                                                <td><?= $value['name']; ?></td>
                                                                <td>
                                                                    <a href="<?= base_url($value['link']); ?>" target="_blank">Lihat</a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- END tab pane ringkasan -->

                        </div>
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