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
                        EPP
                    </div>
                    <h2 class="page-title">
                        Template Instrumen
                    </h2>
                    <ol class="breadcrumb mt-2" aria-label="breadcrumbs">
                        <li class="breadcrumb-item"><a href="<?= base_url('epp'); ?>">Instrumen</a></li>
                        <li class="breadcrumb-item active"><a>Template</a></li>
                    </ol>

                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="<?= base_url('instrument/template/insert'); ?>" class="btn btn-primary d-none d-sm-inline-block">

                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Buat Template Baru
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
                            <div class="row">
                                <div class="col-12 d-flex justify-content-between mb-2">

                                    <!-- <div class="align-self-end dropdown mb-2">
                                        <a class="dropdown-toggle text-secondary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><strong>Semua</strong></a>
                                        <div class="dropdown-menu " style="">
                                            <a class="dropdown-item" href="#">Draft</a>
                                            <a class="dropdown-item" href="#">Publis</a>
                                            <a class="dropdown-item active" href="#">Semua</a>
                                        </div>
                                    </div> -->

                                    <!-- <div class="btn btn-primary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-list" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                                            <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                                            <path d="M9 12l.01 0"></path>
                                            <path d="M13 12l2 0"></path>
                                            <path d="M9 16l.01 0"></path>
                                            <path d="M13 16l2 0"></path>
                                        </svg>
                                        Rekap
                                    </div> -->
                                    <!-- <div class="dropdown-menu" style="width:fit-content;">
                                        <a class="dropdown-item" href="<?= base_url('pelatihan/rekap/1'); ?>">Bulan Ini</a>
                                        <a class="dropdown-item" href="<?= base_url('pelatihan/rekap/2'); ?>">Tahun Ini</a>
                                    </div> -->

                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <colgroup>
                                        <col style="width: 5%;">
                                        <col style="width: 30%;">
                                        <!-- Kolom lainnya -->
                                        <col style="width: 20%;">
                                        <!-- Kolom lainnya -->
                                    </colgroup>
                                    <thead class="text-center text-light bg-dark ">
                                        <tr>
                                            <th class="align-middle" scope="col">No</th>
                                            <th class="align-middle" scope="col">Nama</th>
                                            <!-- <th class="align-middle" scope="col">Mulai Pendaftaran / <br>Selesai Pendaftaran</th> -->
                                            <!-- <th class="align-middle" scope="col">Mulai Pelatihan / <br>Selesai Pelatihan</th>
                                            <th class="align-middle" scope="col">Jenis Pelatihan / Nama Pelatihan</th>
                                            <th class="align-middle" scope="col">Gel. / Batch</th> -->
                                            <!-- <th class="align-middle" scope="col">Pendaftar / <br> Kuota</th> -->
                                            <th class="align-middle" scope="col">Aksi</th>
                                            <!-- <th class="align-middle " scope="col">Detail</th> -->
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if (!empty($data)) {
                                            foreach ($data as $key => $value) { ?>

                                                <tr>
                                                    <th class="text-center"><?= $key + 1; ?></th>
                                                    <td><strong> <?= $value['name'] ?></strong></td>

                                                    <td class="text-center">
                                                        <a href="<?= base_url('instrument/template/preview/' . $value['id']); ?>" class="btn btn-icon btn-outline-primary position-relative m-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Lihat">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                            </svg>

                                                        </a>
                                                        <a href="<?= base_url('instrument/template/edit/' . $value['id']); ?>" class="btn btn-icon btn-outline-primary m-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                                <path d="M16 5l3 3"></path>
                                                            </svg>
                                                        </a>
                                                        <a href="<?= base_url('instrument/template/delete/' . $value['id']); ?>" class="btn btn-icon btn-outline-primary m-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M4 7h16" />
                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                <path d="M10 12l4 4m0 -4l-4 4" />
                                                            </svg>
                                                        </a>
                                                        <!-- <span data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> -->
                                                        <!-- <a class="btn btn-outline-primary m-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Gunakan Template">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M12 5l0 14" />
                                                                <path d="M5 12l14 0" />
                                                            </svg>
                                                            Gunakan
                                                        </a> -->
                                                        <!-- </span> -->
                                                        <!-- <div class="dropdown-menu">
                                                            <a class=" dropdown-item btn text-primary justify-content-start" href="<?= base_url('instrument/insert/'); ?>">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                                    <path d="M12 11l0 6" />
                                                                    <path d="M9 14l6 0" />
                                                                </svg>
                                                                Buat Baru
                                                            </a>
                                                            <a class="dropdown-item text-primary btn justify-content-start" data-bs-toggle="modal" data-bs-target="#modal-confirm-delete" onclick="sendIDPelatihan()">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-description" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                                    <path d="M9 17h6" />
                                                                    <path d="M9 13h6" />
                                                                </svg>
                                                                Buat Dengan Template
                                                            </a> -->
                            </div>
                            </td>

                            </tr>
                    <?php }
                                        }
                    ?>

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
<!-- Modal Konfrimasi Publish -->
<div class="modal modal-blur fade" id="modal-confirm-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-delete-course" action="" method="post">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                        <path d="M12 9v4" />
                        <path d="M12 17h.01" />
                    </svg>
                    <h3>Apakah Anda yakin?</h3>
                    <div class="text-secondary mb-2">Dengan menghapus pelatihan maka <strong>seluruh data pelatihan akan terhapus</strong> dari sistem.</div>
                    <br>
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="col">
                            <label class="form-check " style="text-align: left !important;">
                                <input id="checkbox-persetujuan" type="checkbox" class="form-check-input" name="delete_best" />
                                <span class="form-check-label">
                                    <strong>Hapus juga pelatihan dari Best. </strong>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col">
                                <a class="btn w-100" data-bs-dismiss="modal">Batal</a>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-danger w-100"> Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script>
    function sendIDPelatihan(id_pelatihan) {
        console.log("MASUK");
        $('#form-delete-course').attr('action', "<?= base_url('pelatihan/delete/'); ?>" + id_pelatihan);
    }
</script>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->