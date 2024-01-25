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
                        Kelola Pengguna
                    </div>
                    <h2 class="page-title">
                        Tambah Pengguna
                    </h2>
                    <ol class="breadcrumb mt-2" aria-label="breadcrumbs">
                        <li class="breadcrumb-item active"><a>Tembah Pengguna</a></li>
                    </ol>

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

                            <div class="col-12 my-2">
                                <!-- <div class="card"> -->
                                <div class="card-body p-0">
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-between mb-2">
                                            <h3 class="card-title mb-2">Unggah File Pengguna</h3>
                                            <!-- <div class="align-self-end dropdown mb-2">
                                        <a class="dropdown-toggle text-secondary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><strong>Semua</strong></a>
                                        <div class="dropdown-menu " style="">
                                            <a class="dropdown-item" href="#">Draft</a>
                                            <a class="dropdown-item" href="#">Publis</a>
                                            <a class="dropdown-item active" href="#">Semua</a>
                                        </div>
                                    </div> -->

                                            <a href="<?= base_url('pengguna/template/download'); ?>" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-download" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                    <path d="M12 17v-6" />
                                                    <path d="M9.5 14.5l2.5 2.5l2.5 -2.5" />
                                                </svg>
                                                Unduh Template Isian
                                            </a>
                                            <!-- <div class="dropdown-menu" style="width:fit-content;">
                                        <a class="dropdown-item" href="<?= base_url('pelatihan/rekap/1'); ?>">Bulan Ini</a>
                                        <a class="dropdown-item" href="<?= base_url('pelatihan/rekap/2'); ?>">Tahun Ini</a>
                                    </div> -->
                                        </div>
                                    </div>
                                    <div class="card bg-yellow-lt text-dark mb-3">
                                        <div class="card-body m-1">
                                            <div class="card-subheader h3 m-0 text-warning">Perhatian!</div>
                                            <ul>
                                                <li>
                                                    Fitur ini berfungsi untuk menambahkan pengguna ke akun best dan sipandu secara <strong>multiple</strong>.
                                                </li>
                                                <li>
                                                    Anda harus <strong>mengunduh template isian pengguna</strong> terlebih dahulu kemudian isi sesuai dengan kolom yang telah tersedia.
                                                </li>
                                                <li>
                                                    Jika file sudah siap untuk diunggah maka Anda dapat <strong>mengunggah pada fomulir upload</strong> dibawah ini.
                                                </li>
                                                <li>
                                                    Tunggu proses hingga selesai dan Anda akan mendapatkan <strong>file status proses penambahan pengguna</strong> yang telah dilakukan.
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card bg-red-lt text-dark mb-3">
                                        <div class="card-body m-1">
                                            <div class="card-subheader h3 m-0 text-warning">Peringatan!</div>
                                            <ul>
                                                <li>
                                                    Jika dalam file Excel terdapat <strong>pengguna yang sudah terdaftar</strong> baik di Sipandu maupun Best, maka akan dilakukan pembaharuan data. Ini berarti <strong>kata sandi dan seluruh data diri pengguna </strong> akan <strong>diubah</strong> sesuai dengan isian dalam excel.
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <h3 class="card-title">Unggah File</h3>
                                <form action="<?php echo base_url('pengguna/template/upload'); ?>" method="POST" enctype="multipart/form-data">
                                    <div class="col-12 d-flex justify-content-between mb-2">
                                        <?= csrf_field() ?>

                                        <input type="file" class="form-control" id="f" name="file_pengguna" accept=".xls, .xlsx" required>
                                        <button type="submit" class="btn btn-primary mx-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                <path d="M12 11v6" />
                                                <path d="M9.5 13.5l2.5 -2.5l2.5 2.5" />
                                            </svg>
                                            Unggah
                                        </button>
                                    </div>
                                </form>
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