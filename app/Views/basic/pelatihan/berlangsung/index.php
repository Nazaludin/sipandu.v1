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
                        Berlangsung
                    </h2>
                    <ol class="breadcrumb mt-2" aria-label="breadcrumbs">
                        <li class="breadcrumb-item"><a>Pelatihan</a></li>
                        <li class="breadcrumb-item active"><a>Berlangsung</a></li>
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
                                <table class="table table-bordered  table-hovertable-bordered ">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="align-middle">No</th>
                                            <th class="align-middle">Kondisi</th>
                                            <th class="align-middle">Periode Pelatihan</th>
                                            <th class="align-middle">Jenis Pelatihan/Nama Pelatihan</th>
                                            <th class="align-middle">Sasaran Peserta</th>
                                            <th class="align-middle">Tempat Pelaksanaan</th>
                                            <th class="align-middle">Gel. / Batch</th>
                                            <th class="align-middle">Kuota</th>
                                            <th class="align-middle">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php if (isset(json_decode($pelatihan)->courses)) {
                                            foreach (json_decode($pelatihan)->courses as $key => $value) { ?>

                                                <tr>
                                                    <th class="text-center" scope="row"><?= $key + 1; ?></th>
                                                    <td class="text-center"><?= $value->condition; ?></td>
                                                    <td><b><?= $value->startdatetime; ?></b> <br> <?= $value->enddatetime; ?></td>
                                                    <td><b><?= $value->categoryname; ?></b> <br> <?= $value->fullname; ?></td>
                                                    <td class="text-center"><?= $value->target_participant; ?></td>
                                                    <td class="text-center"><?= $value->place; ?></td>
                                                    <td class="text-center"><?= $value->batch; ?></td>
                                                    <td class="text-center"><?= $value->quota; ?></td>
                                                    <td class="text-center">
                                                        <a href="<?= base_url('pelatihan/berlangsung/detail/' . $value->id); ?>" class="btn btn-icon btn-outline-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                                <path d="M12 9h.01"></path>
                                                                <path d="M11 12h1v4h1"></path>
                                                            </svg>
                                                        </a>
                                                        <a class="btn btn-icon btn-outline-primary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dots-vertical" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                                <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                                <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                            </svg>
                                                        </a>
                                                        <div class="dropdown-menu ">
                                                            <a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#modal-confirm-cancel" onclick="sendValuesCancel(<?= $value->id; ?>)">Batal Mengikuti</a>
                                                            <!-- <a class="dropdown-item text-danger" href="<?= base_url('pelatihan/batal/' . $value->id); ?>" data-bs-toggle="modal" data-bs-target="#modal-confirm-cancel">Batal Mengikuti</a> -->
                                                            <!-- <a class="dropdown-item" href="#">Publis</a> -->
                                                            <!-- <a class="dropdown-item active" href="#">Semua</a> -->
                                                        </div>
                                                        <a href="<?= 'http://best-bapelkes.jogjaprov.go.id/course/view.php?id=' . $value->id; ?>" class="btn btn-outline-primary" target="_blank">
                                                            Best
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-big-right-lines ms-1 me-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M12 9v-3.586a1 1 0 0 1 1.707 -.707l6.586 6.586a1 1 0 0 1 0 1.414l-6.586 6.586a1 1 0 0 1 -1.707 -.707v-3.586h-3v-6h3z" />
                                                                <path d="M3 9v6" />
                                                                <path d="M6 9v6" />
                                                            </svg>
                                                        </a>
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
<!-- Modal Konfrimasi Batal -->
<div class="modal modal-blur fade" id="modal-confirm-cancel" tabindex="-1" role="dialog" aria-hidden="true">
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
                <div class="text-secondary">Dengan membatalkan pelatihan brarti Anda tidak dapat mengikuti pelatihan dan semua persyaratan yang anda kirim akan terhapus dari sistem.</div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col"><a class="btn w-100" data-bs-dismiss="modal">
                                Kembali
                            </a></div>
                        <input type="hidden" id="url-cancel" value="<?= base_url('pelatihan/batal/'); ?>">
                        <div class="col"><a id="button-confirm-cancel" class="btn btn-danger w-100"> Lanjut</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function sendValuesCancel(id) {
        var url = document.getElementById('url-cancel').value;
        document.getElementById('button-confirm-cancel').href = url + id;
    }
</script>