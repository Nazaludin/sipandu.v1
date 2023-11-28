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
                        Riwayat
                    </h2>
                    <ol class="breadcrumb mt-2" aria-label="breadcrumbs">
                        <li class="breadcrumb-item"><a>Pelatihan</a></li>
                        <li class="breadcrumb-item active"><a>Riwayat</a></li>
                    </ol>
                </div>
                <!-- Page title actions -->


            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-fluid">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover table-stripped ">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="align-middle">No</th>
                                            <th class="align-middle">Mulai Pelatihan/ <br>Selesai Pelatihan</th>
                                            <th class="align-middle">Jenis Pelatihan/ <br>Nama Pelatihan</th>
                                            <th class="align-middle">Gel. / <br>Batch</th>
                                            <th class="align-middle">No. Sertifikat</th>
                                            <th class="align-middle">Download Sertifikat</th>
                                            <th class="align-middle">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php if (isset(json_decode($pelatihan)->courses)) {
                                            $num = 0;
                                            foreach (json_decode($pelatihan)->courses as $key => $value) { ?>

                                                <tr>
                                                    <th class="text-center" scope="row"><?= ++$num; ?></th>
                                                    <td><b><?= $value->startdatetime; ?></b> <br> <?= $value->enddatetime; ?></td>
                                                    <td><b><?= $value->categoryname; ?></b> <br> <?= $value->fullname; ?></td>
                                                    <td class="text-center"><?= $value->batch; ?></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center">

                                                    </td>
                                                    <td class="text-center">
                                                        <a href="<?= base_url('instrument/fill/' . $value->id); ?>" class="btn btn-icon btn-outline-primary m-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                                <path d="M16 5l3 3"></path>
                                                            </svg>
                                                        </a>
                                                        <span data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <a class="btn btn-icon btn-outline-primary m-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Buat Instrument">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                    <path d="M12 5l0 14" />
                                                                    <path d="M5 12l14 0" />
                                                                </svg>
                                                            </a>
                                                        </span>
                                                    </td>

                                                </tr>
                                        <?php }
                                        } ?>

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