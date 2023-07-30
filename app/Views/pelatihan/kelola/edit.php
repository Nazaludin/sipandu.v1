<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.css" integrity="sha512-S/y7IBjKx4u8G4OhefTppBRoT59kk/LpsD8rT1jQxb1I7wErbsBxNOVLsKs6U9PZUaI6kAd1atUAKn6lFXn6gw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="<?= base_url('assets/libs/filepond/dist/filepond.css'); ?>">
<script src="<?= base_url('assets/libs/filepond/dist/filepond.js'); ?>"></script>
<script src="<?= base_url('assets/libs/filepond/dist/filepond-plugin-file-validate-size.js'); ?>"></script>
<script src="<?= base_url('assets/libs/filepond/dist/filepond-plugin-file-validate-type.js'); ?>"></script>
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Agenda Pelatihan</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Agenda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">

        <!-- ============================================================== -->
        <!-- Recent comment and chats -->


        <!-- column -->
        <div class="col-lg-12">
            <div class="card card-round">
                <div class="card-body">
                    <h4 class="card-title mt-4">Edit Pelatihan</h4>
                    <div class="row px-3">
                        <div class="col-12">
                            <a href="<?= base_url('pelatihan/kelola/detail/' . json_decode($pelatihan)->courses->id); ?>" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>
                    <!-- Comment Row -->
                    <div class="row px-3">
                        <div class="col-12">
                            <!-- <table class="table">
                                    <tbody> -->
                            <form action="<?= base_url('pelatihan/kelola/detail/edit/proses/' . json_decode($pelatihan)->courses->id); ?>" method="post" enctype='multipart/form-data'>
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
                                        <input type="text" class="form-control" id="floatingInputCategoryCourse" name="categoryname" placeholder="Jenis pelatihan" value="<?= json_decode($pelatihan)->courses->categoryname; ?>" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="floatingInputBatch">Gelombang/batch</label>
                                        <select class="form-control form-control-sm" name="batch" id="floatingInputBatch" required>
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
                                        <input type="date" class="form-control form-control-sm" id="floatingInputStartCourse" name="startdate" value="<?= json_decode($pelatihan)->courses->startdatetime; ?>" required autofocus>
                                    </div>
                                    <div class="col-3">
                                        <label for="floatingInputEndCourse">Akhir Pelatihan</label>
                                        <input type="date" class="form-control form-control-sm" id="floatingInputEndCourse" name="enddate" value="<?= json_decode($pelatihan)->courses->enddatetime; ?>" required autofocus>
                                    </div>
                                    <div class="col-3">
                                        <label for="floatingInputStartRegistration">Mulai Pendaftaran</label>
                                        <input type="date" class="form-control form-control-sm" id="floatingInputStartRegistration" name="start_registration" value="<?= json_decode($pelatihan)->courses->start_registration; ?>" required autofocus>
                                    </div>
                                    <div class="col-3">
                                        <label for="floatingInputEndRegistration">Akhir Pendaftaran</label>
                                        <input type="date" class="form-control form-control-sm" id="floatingInputEndRegistration" name="end_registration" value="<?= json_decode($pelatihan)->courses->end_registration; ?>" required autofocus>
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
                                <br><br>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="f">Nama Dokument Unduhan</label>

                                        <input type="text" class="form-control" id="f" name="name_uplaod_document" placeholder="Nama Dokument Unduhan Administrasi" value="">
                                    </div>
                                    <div class="col-6">
                                        <!-- <label for="floatingInputUploadDocument">Berkas Upload Peserta</label> -->
                                        <!-- <input type="file" class="filepond form-control" id="floatingInputUploadDocument" name="uplaod_document"> -->
                                        <label for="f">Berkas Ungghan Peserta</label>

                                        <input type="text" class="form-control" id="f" name="name_uplaod_document" placeholder="Nama Document Kelengkapan Administrasi" value="">

                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="floatingInputDownloadDocument">Berkas Uduhan Peserta</label>
                                        <input type="file" class="filepond form-control" id="floatingInputDownloadDocument" name="downlaod_document">
                                    </div>
                                    <div class="col-6">


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

        <!-- Modal -->
        <div class="modal fade" id="modal-foto-profil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?php echo base_url('profil/upload/foto'); ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="form-group">
                            <label for="image">Upload Image</label>
                            <input type="file" class="form-control-file" id="image" name="foto_profil">
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
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