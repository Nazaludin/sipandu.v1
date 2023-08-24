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
                            <div class="row justify-content-start mb-2">
                                <div class="col-auto">
                                    <a href="<?= base_url('pelatihan/detail/' . json_decode($pelatihan)->courses->id); ?>" class="btn btn-ghost-white border-0 shadow-none" aria-label="Button">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M15 6l-6 6l6 6"></path>
                                        </svg>
                                        Back</a>
                                </div>
                            </div>
                            <div class="row px-2">
                                <div class="col-auto">
                                    <h3 class="card-title pt-3">Edit Pelatihan</h3>
                                </div>
                            </div>
                            <!-- Comment Row -->
                            <div class="row px-2">
                                <div class="col-12">
                                    <!-- <table class="table">
                                    <tbody> -->
                                    <form action="<?= base_url('pelatihan/detail/edit/proses/' . json_decode($pelatihan)->courses->id); ?>" method="post" enctype='multipart/form-data'>
                                        <?= csrf_field() ?>
                                        <div class="hr-text hr-text-left mb-3 mt-1">Data Pelatihan</div>
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <label for="floatingInputFullnameCourse" class="form-label mb-0">Nama Lengkap Pelatihan</label>
                                                <input type="text" class="form-control" id="floatingInputFullnameCourse" name="fullname" placeholder="Nama lengkap pelatihan" value="<?= json_decode($pelatihan)->courses->fullname; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label for="floatingInputShortnameCourse" class="form-label mb-0">Nama Singkat Pelatihan</label>
                                                <input type="text" class="form-control" id="floatingInputShortnameCourse" name="fullname" placeholder="Nama singkat pelatihan" value="<?= json_decode($pelatihan)->courses->shortname; ?>" required>
                                            </div>
                                            <div class="col-4">
                                                <label for="floatingInputCategoryCourse" class="form-label mb-0">Jenis Pelatihan</label>
                                                <select class="select-control" name="catgoryid" id="floatingInputCategoryCourse" placeholder="Pilih/tulis kategori pelatihan..." required oninvalid="this.setCustomValidity('Mohon pilih kategori pelatihan ada input ini')" oninput="this.setCustomValidity('')">
                                                    <option value=""></option>
                                                    <?php foreach ($kategori_pelatihan as $kp => $valueKP) { ?>
                                                        <option value="<?= $valueKP->id; ?>" <?= (json_decode($pelatihan)->courses->categoryid == $valueKP->id) ? 'selected' : '' ?>><?= $valueKP->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-2">
                                                <label for="floatingInputBatch" class="form-label mb-0">Gelombang/batch</label>
                                                <select class="select-control" name="batch" id="floatingInputBatch" placeholder="Pilih/tulis gelombang..." required oninvalid="this.setCustomValidity('Mohon pilih gelombang ada input ini')" oninput="this.setCustomValidity('')">
                                                    <option value=""></option>
                                                    <?php for ($i = 1; $i <= 4; $i++) { ?>
                                                        <option value="<?= $i; ?>" <?= (json_decode($pelatihan)->courses->batch == $i) ? 'selected' : '' ?>>Gelombang <?= $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label for="floatingInputTargetParticipant" class="form-label mb-0">Sasaran Pelatihan</label>
                                                <input type="text" class="form-control" id="floatingInputTargetParticipant" name="target_participant" placeholder="Sasaran Pelatihan" value="<?= json_decode($pelatihan)->courses->target_participant; ?>">
                                            </div>
                                            <div class="col-4">
                                                <label for="floatingInputPlace" class="form-label mb-0">Tempat Pelatihan</label>
                                                <input type="text" class="form-control" id="floatingInputPlace" name="place" placeholder="Tempat Pelatihan" value="<?= json_decode($pelatihan)->courses->place; ?>">
                                            </div>
                                            <div class="col-2">
                                                <label for="floatingInputQuota" class="form-label mb-0">Kuota</label>
                                                <input type="number" class="form-control" id="floatingInputQuota" name="quota" placeholder="Kuota" value="<?= json_decode($pelatihan)->courses->quota; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-5">
                                            <div class="col-6">
                                                <label for="floatingInputContactPerson" class="form-label mb-0">Kontak Person</label>
                                                <input type="text" class="form-control" id="floatingInputContactPerson" name="contact_person" placeholder="Kontak Person" value="<?= json_decode($pelatihan)->courses->contact_person; ?>">
                                            </div>
                                            <div class="col-6 custom-file">
                                                <label for="floatingInputSchedule" class="form-label mb-0">Lampiran Jadwal</label>
                                                <input type="file" class="form-control custom-file-input" id="floatingInputSchedule" name="jadwal" lang="id">
                                            </div>

                                        </div>

                                        <div class="hr-text hr-text-left my-3">Waktu Pelaksanaan</div>
                                        <div class="row mb-5">
                                            <div class="col-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <h3 class="card-title">Periode Pendaftaran</h3>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-6">
                                                                <label for="floatingInputStartRegistration" class="form-label mb-0">Mulai Pendaftaran</label>
                                                                <input type="date" class="form-control" id="floatingInputStartRegistration" name="start_registration" value="<?= json_decode($pelatihan)->courses->startdatetime; ?>" required autofocus>
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="floatingInputEndRegistration" class="form-label mb-0">Akhir Pendaftaran</label>
                                                                <input type="date" class="form-control" id="floatingInputEndRegistration" name="end_registration" value="<?= json_decode($pelatihan)->courses->enddatetime; ?>" required autofocus>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <h3 class="card-title">Periode Pelatihan</h3>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">

                                                            <div class="col-6">
                                                                <label for="floatingInputStartCourse" class="form-label mb-0">Mulai Pelatihan</label>
                                                                <input type="date" class="form-control" id="floatingInputStartCourse" name="startdate" value="<?= json_decode($pelatihan)->courses->start_registration; ?>" required autofocus>
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="floatingInputEndCourse" class="form-label mb-0">Akhir Pelatihan</label>
                                                                <input type="date" class="form-control" id="floatingInputEndCourse" name="enddate" value="<?= json_decode($pelatihan)->courses->end_registration; ?>" required autofocus>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hr-text hr-text-left my-3">Detail Pelatihan</div>

                                        <div class="row mb-5">
                                            <div class="col-12">
                                                <label for="floatingInputSummary" class="form-label mb-0">
                                                    <h3> Ringkasan </h3>
                                                </label>
                                                <textarea class="form-control" name="summary" id="floatingInputSummary" cols="30" rows="10"><?= json_decode($pelatihan)->courses->summary; ?></textarea>
                                            </div>
                                        </div>
                                        <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/libs/tinymce/tinymce.min.js" defer></script>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                let options = {
                                                    selector: '#floatingInputSummary',
                                                    height: 300,
                                                    menubar: false,
                                                    statusbar: false,
                                                    plugins: [
                                                        'advlist autolink lists link image charmap print preview anchor',
                                                        'searchreplace visualblocks code fullscreen',
                                                        'insertdatetime media table paste code help wordcount'
                                                    ],
                                                    toolbar: 'undo redo | formatselect | ' +
                                                        'bold italic backcolor | alignleft aligncenter ' +
                                                        'alignright alignjustify | bullist numlist outdent indent | ' +
                                                        'removeformat',
                                                    content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }'
                                                }
                                                if (localStorage.getItem("tablerTheme") === 'dark') {
                                                    options.skin = 'oxide-dark';
                                                    options.content_css = 'dark';
                                                }
                                                tinyMCE.init(options);
                                            })
                                        </script>
                                        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
                                        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
                                        <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
                                        <script>
                                            let catgeoryCourseSelect = new TomSelect('#floatingInputCategoryCourse', {
                                                hideSelected: true,
                                                valueField: 'value',
                                                labelField: 'name',
                                                searchField: 'name',
                                                create: false,
                                            });
                                            let batchSelect = new TomSelect('#floatingInputBatch', {
                                                hideSelected: true,
                                                valueField: 'value',
                                                labelField: 'name',
                                                searchField: 'name',
                                                create: false,
                                            });
                                        </script>
                                        <div class="hr-text hr-text-left my-3">Dokumen Persyaratan</div>

                                        <div class="row mb-5">
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
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                                    <path d="M16 5l3 3"></path>
                                                                </svg>
                                                                Edit
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
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                                    <path d="M16 5l3 3"></path>
                                                                </svg>
                                                                Edit
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

                                        <input type="hidden" name="publish" id="input-publis" value="false">
                                        <button type="submit" id="button-submit" class="btn btn-primary" hidden></button>
                                        <div class="row">
                                            <div class="col-6 d-flex justify-content-start">
                                                <a href="<?= base_url('pelatihan/detail/' . json_decode($pelatihan)->courses->id); ?>" class="btn btn-outline-primary">Batal</a>
                                            </div>
                                            <div class="col-6 d-flex justify-content-end">
                                                <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-confirm-publish">
                                                    Simpan & Publish
                                                </a>
                                                <button type="button" class="btn btn-success mx-2" onclick="$('#button-submit').click()">Simpan</button>
                                                <!-- <button type="button" class="btn btn-danger" onclick="savePublish()">Simpan & Publish</button> -->
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
                        <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                Batal
                            </a></div>
                        <div class="col"><button type="button" class="btn btn-danger w-100" onclick="savePublish()">
                                Lanjut
                            </button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function savePublish() {
        $('#input-publis').val('true');
        $('#button-submit').click();
    }
</script>
<!-- Modal Pilih Dokumen Unduhan -->
<div class="modal modal-blur fade" id="modal-download-document" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

        <div class="modal-content">
            <form action="<?php echo base_url('pelatihan/detail/dokumen/download/update-to-course/' . json_decode($pelatihan)->courses->id); ?>" method="POST" enctype="multipart/form-data">
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
        <form action="<?php echo base_url('pelatihan/detail/dokumen/download/' . json_decode($pelatihan)->courses->id); ?>" method="POST" enctype="multipart/form-data">
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
        <form action="<?php echo base_url('pelatihan/detail/dokumen/upload/update-to-course/' . json_decode($pelatihan)->courses->id); ?>" method="POST" enctype="multipart/form-data">

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
            <form action="<?php echo base_url('pelatihan/detail/dokumen/upload/' . json_decode($pelatihan)->courses->id); ?>" method="POST">
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