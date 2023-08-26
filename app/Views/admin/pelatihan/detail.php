<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-fluid">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Kelola
                    </div>
                    <h2 class="page-title">
                        Pelatihan
                    </h2>
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
                                    <a href="<?= base_url('pelatihan'); ?>" class="btn btn-ghost-white border-0 shadow-none" aria-label="Button">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M15 6l-6 6l6 6"></path>
                                        </svg>
                                        Back</a>
                                </div>
                                <div class="col-auto">
                                    <a href="<?= base_url('pelatihan/detail/user/' . json_decode($pelatihan)->courses->id); ?>" class="btn btn-warning position-relative" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Pendaftar">
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
                                        Edit</a>
                                </div>
                            </div>

                            <div class="row px-2">
                                <div class="col-auto">
                                    <h3 class="card-title  pt-3">Detail Pelatihan</h3>
                                </div>
                            </div>

                            <!-- Comment Row -->
                            <div class="row px-3 mb-4">
                                <div class="col-12">
                                    <table class="table">
                                        <tbody>
                                            <tr class="row">
                                                <td class="col-2">Tahun Pelaksanaan</td>
                                                <td class="col-10">: <?= json_decode($pelatihan)->courses->year; ?></td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-2">Jenis Pelatihan</td>
                                                <td class="col-10">: <?= json_decode($pelatihan)->courses->categoryname; ?></td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-2">Nama Pelatihan</td>
                                                <td class="col-10">: <?= json_decode($pelatihan)->courses->fullname; ?></td>
                                            <tr class="row">
                                                <td class="col-2">Gelombang/batch</td>
                                                <td class="col-10">: <?= json_decode($pelatihan)->courses->batch ?? ''; ?> </td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-2">Periode Pelatihan</td>
                                                <td class="col-10">: <b><?= json_decode($pelatihan)->courses->startdatetime; ?></b> s/d <b><?= json_decode($pelatihan)->courses->enddatetime; ?></b></td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-2">Periode Pendaftaran</td>
                                                <td class="col-10">: <b><?= json_decode($pelatihan)->courses->start_registration; ?></b> s/d <b><?= json_decode($pelatihan)->courses->end_registration; ?></b> </td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-2">Sasaran Pelatihan</td>
                                                <td class="col-10">: <?= json_decode($pelatihan)->courses->target_participant; ?></td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-2">Tempat Penyelenggaraan</td>
                                                <td class="col-10">: <?= json_decode($pelatihan)->courses->place; ?></td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-2">Kuota</td>
                                                <td class="col-10">: <?= json_decode($pelatihan)->courses->quota; ?></td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-2">Kontak Person</td>
                                                <td class="col-10">: <?= json_decode($pelatihan)->courses->contact_person; ?></td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-2">Lampiran Jadwal</td>
                                                <td class="col-10">:<a href=" <?= json_decode($pelatihan)->courses->contact_person; ?>" download> Unduh</a> </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <!-- RINGKASAN -->
                                    <div class="card card-round">
                                        <div class="card-body">
                                            <h4 class="card-title mt-4">Ringkasan :</h4>
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
                                                        <a href="<?= base_url($doc['link']); ?>" download>Unduh</a>
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
                                    </table>
                                </div>

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
    <!-- Modal Konfrimasi Publish -->
    <div class="modal modal-blur fade" id="modal-confirm-publish" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                        <path d="M12 9v4" />
                        <path d="M12 17h.01" />
                    </svg>
                    <h3>Apakah anda yakin?</h3>
                    <div class="text-secondary">Dengan melakukan publis maka data pelatihan akan muncul di semua laman pengguna pelatihan.</div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a class="btn w-100" data-bs-dismiss="modal">
                                    Batal
                                </a></div>
                            <div class="col"><a href="<?= base_url('pelatihan/status/edit/' . json_decode($pelatihan)->courses->id . '/3'); ?>" class="btn btn-danger w-100"> Lanjut</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>