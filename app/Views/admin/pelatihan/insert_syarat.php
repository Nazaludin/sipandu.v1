<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
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
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card card-round">
                        <div class="card-body">
                            <div class="row px-3 mb-3">
                                <h4 class="card-title">Tambah Pelatihan</h4>
                                <div class="col-12">
                                    <div class="hr-text text-green">Progres</div>
                                    <div class="col-12">
                                        <div class="steps steps-counter steps-lime">
                                            <span class="step-item">
                                                Buat Pelatihan
                                            </span>
                                            <span class="step-item active">
                                                Persyaratan Pelatihan
                                            </span>
                                            <span class="step-item">
                                                Status Publikasi
                                            </span>
                                        </div>
                                    </div>
                                    <!-- <hr> -->
                                </div>
                                <!-- </div> -->
                                <!-- Comment Row -->
                                <div class="row px-3">
                                    <!-- <table class="table">
                                    <tbody> -->
                                    <form action="<?= base_url('pelatihan/insert/proses'); ?>" method="post" enctype='multipart/form-data'>
                                        <?= csrf_field() ?>
                                        <div class="hr-text hr-text-left mb-3">Data Pelatihan</div>
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <h3 class="card-title">Dokumen Unduhan (Template)</h3>
                                                            </div>
                                                            <div class="col-6 d-flex justify-content-end">
                                                                <a href="#" onclick="getDowloadDocument()" class="btn btn-primary btn-sm d-none d-sm-inline-block mx-1 my-2" data-bs-toggle="modal" data-bs-target="#modal-download-document">
                                                                    Pilih
                                                                </a>

                                                                <a href="#" class="btn btn-primary btn-sm d-none d-sm-inline-block mx-1 my-2" data-bs-toggle="modal" data-bs-target="#modal-download-document-add">

                                                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                        <path d="M12 5l0 14" />
                                                                        <path d="M5 12l14 0" />
                                                                    </svg> -->
                                                                    Baru
                                                                </a>
                                                            </div>

                                                        </div>
                                                        <table class="table table-sm table-borderless">
                                                            <thead>

                                                                <tr>
                                                                    <th class="text-center">No</th>
                                                                    <th>Nama</th>
                                                                    <th class="text-end">File</th>
                                                                    <!-- <th class="text-center">Aksi</th> -->
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($list_course_donwload_document as $d => $doc) {  ?>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <?= $d + 1; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?= $doc['name']; ?>
                                                                        </td>
                                                                        <td class="text-end"><a href="<?= base_url($doc['link']); ?>" download>Unduh</a></td>
                                                                        <!-- <td class="text-center"> -->

                                                                        </td>
                                                                    </tr>
                                                                <?php  } ?>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <h3 class="card-title">Dokumen Unggahan</h3>
                                                            </div>
                                                            <div class="col-8 d-flex justify-content-end">
                                                                <a href="#" class="btn btn-primary btn-sm d-none d-sm-inline-block mx-1 my-2" data-bs-toggle="modal" data-bs-target="#modal-upload-document">
                                                                    Pilih
                                                                </a>

                                                                <a href="#" class="btn btn-primary btn-sm d-none d-sm-inline-block mx-1 my-2" data-bs-toggle="modal" data-bs-target="#modal-upload-document-add">

                                                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                        <path d="M12 5l0 14" />
                                                                        <path d="M5 12l14 0" />
                                                                    </svg> -->
                                                                    Baru
                                                                </a>
                                                            </div>

                                                        </div>
                                                        <table class="table table-sm table-borderless">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">No</th>
                                                                    <th>Nama</th>
                                                                    <!-- <th class="text-center">Aksi</th> -->
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php foreach ($list_course_upload_document as $d => $doc) {  ?>

                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <?= $d + 1; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?= $doc['name']; ?>
                                                                        </td>
                                                                        <!-- <td class="text-end">
                                                                            
                                                                            </td> -->
                                                                    </tr>
                                                                <?php  } ?>


                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row justify-content-end">
                                            <div class="col-12 d-flex justify-content-end">
                                                <a href="<?= base_url('pelatihan/insert'); ?>" class="btn btn-outline-primary mx-2">Batal</a>
                                                <button type="submit" class="btn btn-primary">Buat Pelatihan</button>
                                            </div>
                                        </div>

                                    </form>

                                </div>
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


<!-- Modal Pilih Dokumen Unduhan -->
<div class="modal modal-blur fade" id="modal-download-document" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

        <div class="modal-content">
            <form action="<?php echo base_url('pelatihan/detail/dokumen/download/update-to-course/' . $pelatihan_id); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Dokumen Unduhan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">

                            <table class="table table-sm table-borderless" id="table-download-document">
                                <thead>
                                    <tr>
                                        <th class="text-center">Pilih</th>
                                        <th>Nama</th>
                                        <th class="text-end">Lihat</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?= csrf_field() ?>

                                    <?php foreach ($list_donwload_document as $d => $doc) { ?>
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" name="<?= $doc['id']; ?>" value="true" id="" class="form-check-input-sm" <?= (isset($doc['check'])) ? 'checked' : ''; ?>>
                                            </td>
                                            <td>
                                                <?= $doc['name']; ?>
                                            </td>
                                            <td class="text-end"><a href="<?= base_url($doc['link']); ?>" target="_blank">Lihat</a></td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-primary btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-upload-document-add">
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    <?php  } ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- Modal Tambah Dokumen Unduhan -->
<div class="modal modal-blur fade" id="modal-download-document-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form action="<?php echo base_url('pelatihan/detail/dokumen/download/' . $pelatihan_id); ?>" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Dokumen Unduhan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="floatingInputDownloadDocument">Berkas Uduhan Peserta</label>
                            <input type="file" class="filepond form-control" id="floatingInputDownloadDocument" name="file_download_document">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="f">Nama document Unduhan</label>
                            <input type="text" class="form-control" id="f" name="name" placeholder="Nama document Unduhan Administrasi" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        Simpan
                    </button>
                </div>
        </form>
    </div>
</div>
</div>
<!-- Modal Pilih Dokumen Unggahan -->
<div class="modal modal-blur fade" id="modal-upload-document" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form action="<?php echo base_url('pelatihan/detail/dokumen/upload/update-to-course/' . $pelatihan_id); ?>" method="POST" enctype="multipart/form-data">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Dokumen Uggahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">

                            <table class="table table-sm table-borderless">
                                <thead>
                                    <tr>
                                        <th class="text-center">Pilih</th>
                                        <th>Nama</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?= csrf_field() ?>

                                    <?php foreach ($list_upload_document as $d => $doc) {  ?>
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" name="<?= $doc['id']; ?>" value="true" id="" class="form-check-input-sm" <?= (isset($doc['check'])) ? 'checked' : ''; ?>>
                                            </td>
                                            <td>
                                                <?= $doc['name']; ?>
                                            </td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-primary btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-upload-document-add">
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    <?php  } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        Simpan
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>
<!-- Modal Tambah Dokumen Unggahan -->
<div class="modal modal-blur fade" id="modal-upload-document-add">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?php echo base_url('pelatihan/detail/dokumen/upload/' . $pelatihan_id); ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Dokumen Unggahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="f">Nama Dokumen Unggahan</label>
                            <input type="text" class="form-control" id="f" name="name_uplaod_document" placeholder="Nama document Unduhan Administrasi" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        Simpan
                    </button>
            </form>
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->