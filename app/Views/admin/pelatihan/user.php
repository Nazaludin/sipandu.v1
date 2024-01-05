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
                        Pendaftar
                    </h2>
                    <ol class="breadcrumb mt-2" aria-label="breadcrumbs">
                        <li class="breadcrumb-item"><a href="<?= base_url('pelatihan'); ?>">Pelatihan</a></li>
                        <li class="breadcrumb-item "><a href="<?= base_url('pelatihan/detail/' . $id_pelatihan); ?>">Detail</a></li>
                        <li class="breadcrumb-item active"><a>Pendaftar</a></li>
                    </ol>
                </div>
                <!-- Page title actions -->

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

                                    <div class="align-self-end dropdown mb-2">
                                        <a class="dropdown-toggle text-secondary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><strong>Semua</strong></a>
                                        <div class="dropdown-menu " style="">
                                            <a class="dropdown-item" href="#">Diterima</a>
                                            <a class="dropdown-item" href="#">Ditolak</a>
                                            <a class="dropdown-item" href="#">Revisi</a>
                                            <a class="dropdown-item active" href="#">Semua</a>
                                        </div>
                                    </div>
                                    <div class="btn-group">
                                        <a href="<?= base_url('sync/simpeg'); ?>" class="btn btn-primary mx-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                                                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                                            </svg>
                                            Singkronisasi Data ke Simpeg</a>
                                        <div class="btn btn-primary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                        </div>
                                        <div class="dropdown-menu" style="width:fit-content;">
                                            <a class="dropdown-item" href="<?= base_url('pelatihan/rekap/pengguna/' . $id_pelatihan . '/1'); ?>">Diterima</a>
                                            <a class="dropdown-item" href="<?= base_url('pelatihan/rekap/pengguna/' . $id_pelatihan . '/2'); ?>">Semua</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-center align-middle">
                                    <thead class="text-center bg-dark">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Pengguna / Jabatan</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Sertifikat</th>
                                            <th scope="col">Aksi</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php if (isset($user)) {
                                            foreach ($user as $key => $value) { ?>

                                                <tr>
                                                    <th scope="row"><?= $key + 1; ?></th>
                                                    <td><b><?= $value['fullname']; ?></b> <br> <?= $value['jabatan']; ?></td>
                                                    <td>
                                                        <?php switch ($value['status_pelatihan']) {
                                                            case 'register':
                                                                echo '<span class="badge bg-orange-lt">Baru</span>';
                                                                break;
                                                            case 'renew':
                                                                echo '<span class="badge bg-orange-lt">Perbaikan</span>';
                                                                break;
                                                            case 'accept':
                                                                echo '<span class="badge bg-green-lt">Diterima</span>';
                                                                break;
                                                            case 'reject':
                                                                echo '<span class="badge bg-red-lt">Ditolak</span>';
                                                                break;
                                                            case 'revisi':
                                                                echo '<span class="badge bg-yellow-lt">Revisi</span>';
                                                                break;
                                                            case 'passed':
                                                                echo '<span class="badge bg-green-lt">Diterima</span>';
                                                                break;
                                                            default:
                                                                echo '';
                                                                break;
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($value['certificate_is_uploaded']) { ?>
                                                            <div class="row mx-1">
                                                                <div class="col-12 d-flex justify-content-start">
                                                                    <span class="badge bg-green-lt">Terupload</span>
                                                                </div>
                                                            </div>
                                                            <div class="row mx-1">
                                                                <div class="col-12 ps-3 d-flex justify-content-between">
                                                                    <p class="text-left"><strong>No :</strong> <?= $value['certificate_number']; ?></p>
                                                                    <a href="<?= base_url($value['certificate_file_location']); ?>" target="_blank">Lihat</a>
                                                                </div>
                                                            </div>

                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url('pelatihan/detail/user/regis/' . $id_pelatihan . '/' . $value['id']); ?>" class="btn btn-icon btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail Pengguna">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                                <path d="M12 9h.01"></path>
                                                                <path d="M11 12h1v4h1"></path>
                                                            </svg>
                                                        </a>
                                                        <?php if ($value['certificate_is_uploaded']) { ?>
                                                            <span data-bs-toggle="modal" data-bs-target="#modal-upload-certificate-edit" onclick="sendUserCourseIDEdit('<?= $value['id_user_course']; ?>','<?= $value['certificate_number']; ?>')">
                                                                <a class="btn btn-icon btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Unggah Ulang Setifikat">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-repeat" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                        <path d="M4 12v-3a3 3 0 0 1 3 -3h13m-3 -3l3 3l-3 3"></path>
                                                                        <path d="M20 12v3a3 3 0 0 1 -3 3h-13m3 3l-3 -3l3 -3"></path>
                                                                    </svg>
                                                                </a>
                                                            </span>
                                                        <?php } else {  ?>
                                                            <?php if ($value['status_pelatihan'] == 'accept' || $value['status_pelatihan'] == 'passed') { ?>
                                                                <span data-bs-toggle="modal" data-bs-target="#modal-upload-certificate" onclick="sendUserCourseID('<?= $value['id_user_course']; ?>')">
                                                                    <a class="btn btn-icon btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Unggah Setifikat">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                                                            <path d="M7 9l5 -5l5 5"></path>
                                                                            <path d="M12 4l0 12"></path>
                                                                        </svg>
                                                                    </a>
                                                                </span>
                                                            <?php }  ?>
                                                        <?php } ?>


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
<!-- Modal Tambah Dokumen Unduhan -->
<div class="modal modal-blur fade" id="modal-upload-certificate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-upload-certificate" action="" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Unggah Sertifikat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="floatingInputCertificate">Sertifikat Peserta</label>
                            <input type="file" class="form-control" id="floatingInputCertificate" name="certificate" accept="application/pdf" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="floatingInputCertificateNumber">Nomor Sertifikat</label>
                            <input type="text" class="form-control" id="floatingInputCertificateNumber" name="certificate_number" placeholder="Nomor Sertifikat" value="<?= old('certificate_number'); ?>" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit Dokumen Unduhan -->
<div class="modal modal-blur fade" id="modal-upload-certificate-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-upload-certificate-edit" action="" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Sertifikat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="floatingInputCertificateEdit">Sertifikat Peserta</label>
                            <input type="file" class="form-control" id="floatingInputCertificateEdit" name="certificate" accept="application/pdf" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="floatingInputCertificateNumberEdit">Nomor Sertifikat</label>
                            <input type="text" class="form-control" id="floatingInputCertificateNumberEdit" name="certificate_number" placeholder="Nomor Sertifikat" value="<?= old('certificate_number'); ?>" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    function sendUserCourseID(id_user_course) {
        $('#form-upload-certificate').attr('action', '<?= base_url('pelatihan/detail/user/insert/certificate/'); ?>' + id_user_course);
    }

    function sendUserCourseIDEdit(id_user_course, certificate_number) {
        $('#form-upload-certificate-edit').attr('action', '<?= base_url('pelatihan/detail/user/insert/certificate/'); ?>' + id_user_course);
        $('#floatingInputCertificateNumberEdit').val(certificate_number);
    }
</script>