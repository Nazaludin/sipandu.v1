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
                            <div class="row px-3">
                                <div class="col-12">
                                    <a href="<?= base_url('pelatihan/detail/' . json_decode($pelatihan)->courses->id); ?>" class="btn btn-outline-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-big-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M20 15h-8v3.586a1 1 0 0 1 -1.707 .707l-6.586 -6.586a1 1 0 0 1 0 -1.414l6.586 -6.586a1 1 0 0 1 1.707 .707v3.586h8a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1z"></path>
                                        </svg>
                                        Back</a>
                                </div>
                            </div>
                            <h4 class="card-title">Edit Pelatihan</h4>

                            <!-- Comment Row -->
                            <div class="row px-3">
                                <div class="col-12">
                                    <!-- <table class="table">
                                    <tbody> -->
                                    <form action="<?= base_url('pelatihan/detail/edit/proses/' . json_decode($pelatihan)->courses->id); ?>" method="post" enctype='multipart/form-data'>
                                        <?= csrf_field() ?>
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <label for="floatingInputNameCourse">Nama Pelatihan</label>
                                                <input type="text" class="form-control" id="floatingInputNameCourse" name="fullname" placeholder="Nama pelatihan" value="<?= json_decode($pelatihan)->courses->fullname; ?>" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label for="floatingInputCategoryCourse">Jenis Pelatihan</label>
                                                <select class="form-control" name="agama" id="floatingInputCategoryCourse" required>
                                                    <?php foreach ($kategori_pelatihan as $kp => $valueKP) { ?>
                                                        <option value="<?= $valueKP->id; ?>"><?= $valueKP->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <!-- <label for="floatingInputCategoryCourse">Jenis Pelatihan</label>
                                                <input type="text" class="form-control" id="floatingInputCategoryCourse" name="categoryname" placeholder="Jenis pelatihan" value="<?= json_decode($pelatihan)->courses->categoryname; ?>" required> -->
                                            </div>
                                            <div class="col-6">
                                                <label for="floatingInputBatch">Gelombang/batch</label>
                                                <select class="form-control" name="batch" id="floatingInputBatch" required>
                                                    <?php for ($i = 1; $i <= 4; $i++) { ?>
                                                        <option value="<?= $i; ?>">Gelombang <?= $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <label for="floatingInputStartCourse">Periode Pelatihan</label>
                                            </div>
                                            <div class="col-6">
                                                <label for="tanggalLahir">Periode Pendaftaran</label>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-3">
                                                <label for="floatingInputStartCourse">Mulai Pelatihan</label>
                                                <input type="date" class="form-control" id="floatingInputStartCourse" name="startdate" value="<?= json_decode($pelatihan)->courses->startdatetime; ?>" required autofocus>
                                            </div>
                                            <div class="col-3">
                                                <label for="floatingInputEndCourse">Akhir Pelatihan</label>
                                                <input type="date" class="form-control" id="floatingInputEndCourse" name="enddate" value="<?= json_decode($pelatihan)->courses->enddatetime; ?>" required autofocus>
                                            </div>
                                            <div class="col-3">
                                                <label for="floatingInputStartRegistration">Mulai Pendaftaran</label>
                                                <input type="date" class="form-control" id="floatingInputStartRegistration" name="start_registration" value="<?= json_decode($pelatihan)->courses->start_registration; ?>" required autofocus>
                                            </div>
                                            <div class="col-3">
                                                <label for="floatingInputEndRegistration">Akhir Pendaftaran</label>
                                                <input type="date" class="form-control" id="floatingInputEndRegistration" name="end_registration" value="<?= json_decode($pelatihan)->courses->end_registration; ?>" required autofocus>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label for="floatingInputTargetParticipant">Sasaran Pelatihan</label>
                                                <input type="text" class="form-control" id="floatingInputTargetParticipant" name="target_participant" placeholder="Sasaran Pelatihan" value="<?= json_decode($pelatihan)->courses->target_participant; ?>">
                                            </div>
                                            <div class="col-6">
                                                <label for="floatingInputPlace">Tempat Pelatihan</label>
                                                <input type="text" class="form-control" id="floatingInputPlace" name="place" placeholder="Tempat Pelatihan" value="<?= json_decode($pelatihan)->courses->place; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <!-- <div class="col-4"> -->

                                            <!-- <div class="row"> -->
                                            <div class="col-6">
                                                <label for="floatingInputQuota">Kuota</label>
                                                <input type="number" class="form-control" id="floatingInputQuota" name="quota" placeholder="Kuota" value="<?= json_decode($pelatihan)->courses->quota; ?>">
                                            </div>
                                            <!-- </div>
                                                <div class="row"> -->
                                            <div class="col-6">
                                                <label for="floatingInputContactPerson">Kontak Person</label>

                                                <input type="text" class="form-control" id="floatingInputContactPerson" name="contact_person" placeholder="Kontak Person" value="<?= json_decode($pelatihan)->courses->contact_person; ?>">
                                            </div>
                                            <!-- </div> -->
                                            <!-- </div> -->
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label for="floatingInputSchedule">Lampiran Jadwal</label>

                                                <input type="file" class="filepond form-control" id="floatingInputSchedule" name="jadwal">

                                                <!-- <script>
                                            // Get a reference to the file input element
                                            const inputElement = document.querySelector('input[type="file"]');

                                            // Create a FilePond instance
                                            const pond = FilePond.create(inputElement);
                                        </script> -->
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <label for="floatingInputSummary">Ringkasan</label>
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
                                        <br><br>
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

                                        <button type="submit" class="btn btn-primary">Simpan</button>

                                    </form>
                                    <!-- </tbody>
                                </table> -->
                                    <!-- RINGKASAN -->
                                    <!-- <div class="card card-round">
                                    <div class="card-body bg-green">
                                        <h4 class="card-title mt-4">Ringkasan :</h4>

                                    </div>
                                </div> -->
                                </div>
                            </div>
                            <!-- <div class="row px-3">
                            <div class="col-6">
                                <table class="table table-responsive table-bordered">
                                    <thead class="bg-success">
                                        <div>
                                            <th class="text-light fw-bold" scope="col">No.</th>
                                            <th class="text-light fw-bold" scope="col">Komponen Unduh</th>
                                            <th class="text-light fw-bold" scope="col">File</th>
                                        </div>
                                    </thead>
                                    <tbody>
                                        <div>
                                            <div></div>
                                            <div></div>
                                            <div><a href="http://">UNDUH</a></div>
                                        </div>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6">
                                <table class="table table-responsive table-bordered">
                                    <thead class="bg-success">
                                        <div>
                                            <th class="text-light fw-bold" scope="col">No.</th>
                                            <th class="text-light fw-bold" scope="col">Komponen Kelengkapan Administrasi</th>
                                        </div>
                                    </thead>
                                    <tbody>
                                        <div>
                                            <div>1.</div>
                                            <div>Pas Photo 4x6 (background merah)</div>
                                        </div>
                                        <div>
                                            <div>2.</div>
                                            <div>Surat Ijin Atasan</div>
                                        </div>
                                        <div>
                                            <div>3.</div>
                                            <div>Surat Pernyataan Paket Data</div>
                                        </div>
                                        <div>
                                            <div>4.</div>
                                            <div>Surat Tugas</div>
                                        </div>
                                    </tbody>
                                </table>
                            </div>
                        </div> -->
                            <!-- END tab pane ringkasan -->

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
<script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.js" integrity="sha512-vVx8x/L4dr4OfZ+2XZd50t8+sWlINSMO7y4+LcB4t8uF4f+wJ4jDMbFOWjmR+8HiaJp+nt0qyL0Cm4+FS6UJ0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('#home-tab').attr('class', 'nav-link active');
        $('#home').attr('class', 'tab-pane fade show active');
    });

    let provinsiSelect = new TomSelect('#select_provinsi', {
        hideSelected: true,
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        sortField: 'name',
        options: convertArray(dataProvinsi()),
        create: false,
        onChange: function(value) {
            console.log(value, provinsiSelect.getItem(value).innerText);
            $('#input-provinsi').val(provinsiSelect.getItem(value).innerText);
            kabupatenSelect.enable();
            // Mendapatkan daftar kabupaten berdasarkan kode provinsi yang dipilih
            let daftarKabupaten = convertArray(dataKabupaten(value));

            // Menghapus opsi lama di dropdown kabupaten
            kabupatenSelect.clearOptions();

            // Menambahkan opsi baru ke dropdown kabupaten
            kabupatenSelect.addOption(daftarKabupaten);


            // Reset nilai dropdown kecamatan
            kecamatanSelect.clearOptions();
            kecamatanSelect.setValue("");
        }
    });


    let kabupatenSelect = new TomSelect("#select_kabupaten", {
        hideSelected: true,
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        sortField: 'name',
        options: [],
        create: false,
        onChange: function(value) {
            console.log(value, kabupatenSelect.getItem(value).innerText);
            $('#input-kabupaten').val(kabupatenSelect.getItem(value).innerText);
            kecamatanSelect.enable();
            let daftarKecamatan = convertArray(dataKecamatan(value));

            // Menghapus opsi lama di dropdown kecamatan
            kecamatanSelect.clearOptions();

            // Menambahkan opsi baru ke dropdown kecamatan
            kecamatanSelect.addOption(daftarKecamatan);
        }
    });
    let kecamatanSelect = new TomSelect("#select_kecamatan", {
        hideSelected: true,
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        sortField: 'name',
        options: [],
        create: false,
        onChange: function(value) {
            console.log(value, kecamatanSelect.getItem(value).innerText);
            $('#input-kecamatan').val(kecamatanSelect.getItem(value).innerText);
        }
    });


    // Fungsi untuk mengambil data provinsi dari server
    function dataProvinsi() {
        var result = "";
        $.ajax({
            url: "service/provinsi",
            async: false,
            success: function(data) {
                result = data;
            }
        });
        return result;
    }
    console.log(dataProvinsi(), convertArray(dataProvinsi()));
    // Fungsi untuk mengambil data kabupaten dari server berdasarkan kode provinsi
    function dataKabupaten(kodeProvinsi) {
        var result = "";
        $.ajax({
            url: "service/kabupaten/" + kodeProvinsi,
            async: false,
            success: function(data) {
                result = data;
                console.log(kodeProvinsi, result);
            }
        });
        return result;
    }

    // Fungsi untuk mengambil data kecamatan dari server berdasarkan kode kabupaten
    function dataKecamatan(kodeKabupaten) {
        var result = "";
        $.ajax({
            url: "service/kecamatan/" + kodeKabupaten,
            async: false,
            success: function(data) {
                result = data;
            }
        });
        return result;
    }

    // Fungsi untuk mengkonversi data dari string JSON ke array
    function convertArray(data) {
        return JSON.parse(data);
    }
</script>