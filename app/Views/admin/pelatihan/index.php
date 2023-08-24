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
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="<?= base_url('pelatihan/insert'); ?>" class="btn btn-primary d-none d-sm-inline-block">

                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Pelatihan Baru
                        </a>
                        <a href="" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">

                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <style>
        th {
            background-color: red;
        }
    </style>
    <div class="page-body">
        <div class="container-fluid">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown">
                                <a class="dropdown-toggle text-secondary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Semua</a>
                                <div class="dropdown-menu " style="">
                                    <a class="dropdown-item" href="#">Draft</a>
                                    <a class="dropdown-item" href="#">Publis</a>
                                    <a class="dropdown-item active" href="#">Semua</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="text-center bg-dark">
                                        <tr>
                                            <th class="align-middle  bg-dark" scope="col">No</th>
                                            <th class="align-middle " scope="col">Kondisi</th>
                                            <th class="align-middle " scope="col">Mulai Pendaftaran / <br>Selesai Pendaftaran</th>
                                            <th class="align-middle " scope="col">Mulai Pelatihan / <br>Selesai Pelatihan</th>
                                            <th class="align-middle " scope="col">Jenis Pelatihan / Nama Pelatihan</th>
                                            <th class="align-middle " scope="col">Gel. / Batch</th>
                                            <th class="align-middle " scope="col">Pendaftar / <br> Kuota</th>
                                            <th class="align-middle " scope="col">Aksi</th>
                                            <!-- <th class="align-middle " scope="col">Detail</th> -->
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach (json_decode($pelatihan)->courses as $key => $value) { ?>

                                            <tr>
                                                <th><?= $key + 1; ?></th>
                                                <td style="width: 5%;"><?= $value->condition; ?></td>
                                                <td><b><?= $value->start_registration; ?></b> <br> <?= $value->end_registration; ?></td>
                                                <td><b><?= $value->startdatetime; ?></b> <br> <?= $value->enddatetime; ?></td>
                                                <td style="width: 10%;"><b><?= $value->categoryname; ?></b> <br> <?= $value->fullname; ?></td>
                                                <td class="text-center"><?= $value->batch; ?></td>
                                                <td class="text-center">
                                                    <?php if (!empty($value->quota)) {   ?>
                                                        <button class="btn btn-pill btn-outline-green"><?= $value->participant; ?> / <?= $value->quota; ?>
                                                        </button>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('pelatihan/detail/user/' . $value->id); ?>" class="btn btn-icon btn-outline-primary position-relative" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Pendaftar">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                                        </svg>
                                                        <?php if (!empty($value->registrar)) {   ?>
                                                            <span class="badge bg-red text-red-fg badge-notification badge-pill"><?= $value->registrar; ?></span>
                                                        <?php } ?>
                                                    </a>
                                                    <a href="<?= base_url('pelatihan/detail/' . $value->id); ?>" class="btn btn-icon btn-outline-primary ms-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                            <path d="M12 9h.01"></path>
                                                            <path d="M11 12h1v4h1"></path>
                                                        </svg>
                                                    </a>
                                                </td>

                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
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