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
                        Tambah
                    </h2>
                    <ol class="breadcrumb mt-2" aria-label="breadcrumbs">
                        <li class="breadcrumb-item"><a href="<?= base_url('pelatihan'); ?>">Pelatihan</a></li>
                        <li class="breadcrumb-item active"><a href="">Tambah</a></li>
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
                            <div class="row px-3 mb-3">
                                <h4 class="card-title">Tambah Pelatihan</h4>
                                <div class="col-12">
                                    <div class="hr-text text-green">Progres</div>
                                    <div class="col-12">
                                        <div class="steps steps-counter steps-primary">
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
                                                <div class="card row">
                                                    <div class="card-header">
                                                        <div class="col-9">
                                                            <h3 class="card-title">Dokumen Unduhan (Template)</h3>
                                                        </div>

                                                        <div class="col-3 d-flex justify-content-end">
                                                            <a class="btn my-0 py-1 mx-2" data-bs-toggle="modal" data-bs-target="#modal-download-document">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M3 12l3 0"></path>
                                                                    <path d="M12 3l0 3"></path>
                                                                    <path d="M7.8 7.8l-2.2 -2.2"></path>
                                                                    <path d="M16.2 7.8l2.2 -2.2"></path>
                                                                    <path d="M7.8 16.2l-2.2 2.2"></path>
                                                                    <path d="M12 12l9 3l-4 2l-2 4l-3 -9"></path>
                                                                </svg>
                                                                Pilih
                                                            </a>
                                                            <a class="btn my-0 py-1" data-bs-toggle="modal" data-bs-target="#modal-download-document-add">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4"></path>
                                                                    <path d="M13.5 6.5l4 4"></path>
                                                                    <path d="M16 19h6"></path>
                                                                    <path d="M19 16v6"></path>
                                                                </svg>
                                                                Tambah
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">

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
                                                                        <td class="text-end"><a href="<?= base_url($doc['link']); ?>" download="<?= $doc['name']; ?>">Unduh</a></td>
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
                                                    <div class="card-header">
                                                        <div class="col-9">
                                                            <h3 class="card-title">Dokumen Unggahan</h3>
                                                        </div>

                                                        <div class="col-3 d-flex justify-content-end">
                                                            <a class="btn my-0 py-1 mx-2" data-bs-toggle="modal" data-bs-target="#modal-upload-document">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M3 12l3 0"></path>
                                                                    <path d="M12 3l0 3"></path>
                                                                    <path d="M7.8 7.8l-2.2 -2.2"></path>
                                                                    <path d="M16.2 7.8l2.2 -2.2"></path>
                                                                    <path d="M7.8 16.2l-2.2 2.2"></path>
                                                                    <path d="M12 12l9 3l-4 2l-2 4l-3 -9"></path>
                                                                </svg>
                                                                Pilih
                                                            </a>
                                                            <a class="btn my-0 py-1" data-bs-toggle="modal" data-bs-target="#modal-upload-document-add">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4"></path>
                                                                    <path d="M13.5 6.5l4 4"></path>
                                                                    <path d="M16 19h6"></path>
                                                                    <path d="M19 16v6"></path>
                                                                </svg>
                                                                Tambah
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
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
                                            <div class="col-12 d-flex justify-content-between">
                                                <a href="<?= base_url('pelatihan/insert'); ?>" class="btn btn-outline-primary mx-2">Batal</a>
                                                <a href="<?= base_url('pelatihan/insert/publis/' . $id_pelatihan); ?>" type="button" class="btn btn-primary">Simpan Persyaratan</a>
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
            <form action="<?php echo base_url('pelatihan/detail/dokumen/download/update-to-course/' . $id_pelatihan); ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Dokumen Unduhan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">

                            <table class="table table-sm table-borderless table-hover table-striped align-middle" id="table-download-document">
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
                                                <span data-bs-toggle="modal" data-bs-target="#modal-download-document-edit" onclick="sendEditDownloadDocument('<?= $doc['id']; ?>','<?= $doc['name']; ?>','<?= base_url($doc['link']); ?>')">
                                                    <a class="btn btn-outline-primary btn-icon ms-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ubah">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                    </a>
                                                </span>
                                                <a href="<?= base_url('pelatihan/detail/dokumen/download/delete/' . $doc['id']); ?>" class="btn btn-outline-danger btn-icon ms-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M4 7l16 0"></path>
                                                        <path d="M10 11l0 6"></path>
                                                        <path d="M14 11l0 6"></path>
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                    </svg>
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
        <div class="modal-content">
            <form action="<?php echo base_url('pelatihan/detail/dokumen/download') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Dokumen Unduhan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="floatingInputDownloadDocument">Berkas Uduhan Peserta</label>
                            <input type="file" class="filepond form-control" id="floatingInputDownloadDocument" name="file_download_document" accept=".pdf,.docx">
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
<!-- Modal Edit Dokumen Unduhan -->
<div class="modal modal-blur fade" id="modal-download-document-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-edit-download-document" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Dokumen Unduhan</h5>
                    <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#modal-download-document"></button>
                </div>
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <div class="row mb-3">
                        <div class="col">
                            <a id="seeEditDownloadDocument" target="_blank">Lihat Dokumen</a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="fileEditDownloadDokument">Berkas Uduhan Peserta</label>
                            <input type="file" class="form-control" id="fileEditDownloadDokument" name="file_download_document" accept=".pdf,.docx">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="floatingEditDownloadDokument">Nama document Unduhan</label>
                            <input type="text" class="form-control" id="floatingEditDownloadDokument" name="name" placeholder="Nama document Unduhan Administrasi" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#modal-download-document">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary ms-auto">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- </div> -->
<!-- Modal Pilih Dokumen Unggahan -->
<div class="modal modal-blur fade" id="modal-upload-document" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

        <div class="modal-content">
            <form action="<?php echo base_url('pelatihan/detail/dokumen/upload/update-to-course/' . $id_pelatihan); ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Dokumen Uggahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">

                            <table class="table table-sm table-borderless table-hover table-striped align-middle">
                                <colgroup>
                                    <col style="width: 10%;">
                                    <col style="width: 70%;">
                                    <col style="width: 20%;">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th class="text-center">Pilih</th>
                                        <th>Nama</th>
                                        <th class="text-left">Aksi</th>
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
                                            <td class="text-start">
                                                <span data-bs-toggle="modal" data-bs-target="#modal-upload-document-edit" onclick="sendEditUploadDocument('<?= $doc['id']; ?>','<?= $doc['name']; ?>')">
                                                    <a class="btn btn-outline-primary btn-icon ms-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ubah">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                    </a>
                                                </span>
                                                <a href="<?= base_url('pelatihan/detail/dokumen/upload/delete/' . $doc['id']); ?>" class="btn btn-outline-danger btn-icon ms-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M4 7l16 0"></path>
                                                        <path d="M10 11l0 6"></path>
                                                        <path d="M14 11l0 6"></path>
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                    </svg>
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
<!-- Modal Tambah Dokumen Unggahan -->
<div class="modal modal-blur fade" id="modal-upload-document-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?php echo base_url('pelatihan/detail/dokumen/upload'); ?>" method="POST">
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
                    <a class="btn btn-link link-secondary" data-bs-dismiss="modal">
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

<!-- Modal Ubah Dokumen Unggahan -->
<div class="modal modal-blur fade" id="modal-upload-document-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-edit-upload-document" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Dokumen Unggahan</h5>
                    <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#modal-upload-document"></button>
                </div>
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="floatingEditUploadDokument">Nama Dokumen Unggahan</label>
                            <input type="text" class="form-control" id="floatingEditUploadDokument" name="name_uplaod_document" placeholder="Nama document Unduhan Administrasi" value="" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-link link-secondary" data-bs-toggle="modal" data-bs-target="#modal-upload-document">
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
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    function sendEditUploadDocument(id_upload_document, name_document) {
        // $('#modal-upload-document-edit').modal('show');
        $('#form-edit-upload-document').attr('action', "<?= base_url('pelatihan/detail/dokumen/upload/edit/'); ?>" + id_upload_document);
        $('#floatingEditUploadDokument').val(name_document);
    }

    function sendEditDownloadDocument(id_download_document, name_document, link_document) {
        // $('#modal-upload-document-edit').modal('show');
        $('#form-edit-download-document').attr('action', "<?= base_url('pelatihan/detail/dokumen/download/edit/'); ?>" + id_download_document);
        $('#seeEditDownloadDocument').attr('href', link_document);
        $('#floatingEditDownloadDokument').val(name_document);
    }
</script>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->