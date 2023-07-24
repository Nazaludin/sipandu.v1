<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.css" integrity="sha512-S/y7IBjKx4u8G4OhefTppBRoT59kk/LpsD8rT1jQxb1I7wErbsBxNOVLsKs6U9PZUaI6kAd1atUAKn6lFXn6gw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        <!-- ============================================================== -->
        <div class="row">
            <!-- column -->
            <div class="col-lg-12">
                <div class="card card-round">
                    <div class="card-body">
                        <h4 class="card-title mt-4">Detail Pelatihan</h4>
                        <div class="row px-3">
                            <div class="col-6">
                                <a href="<?= base_url('http://localhost:8080/pelatihan/kelola'); ?>" class="btn btn-outline-primary">Back</a>
                            </div>
                            <div class="col-6">
                                <a href="<?= base_url('http://localhost:8080/pelatihan/kelola/detail/edit/' . json_decode($pelatihan)->courses->id); ?>" class="btn btn-outline-primary">Edit</a>
                            </div>
                        </div>
                        <!-- Comment Row -->
                        <div class="row px-3">
                            <div class="col-12">
                                <table class="table">
                                    <tbody>
                                        <tr class="row">
                                            <td class="col-2">Tahun Pelaksanaan</td>
                                            <td class="col-10">: <?= json_decode($pelatihan)->courses->year; ?></td>
                                        </tr>
                                        <tr class="row">
                                            <td class="col-2">Jenis Pelatihan</td>
                                            <td class="col-10">: <?= json_decode($pelatihan)->courses->categoryname; ?></td>
                                        </tr>
                                        <tr class="row">
                                            <td class="col-2">Nama Pelatihan</td>
                                            <td class="col-10">: <?= json_decode($pelatihan)->courses->fullname; ?></td>
                                        </tr>
                                        <tr class="row">
                                            <td class="col-2">Gelombang/batch</td>
                                            <td class="col-10">: <?= json_decode($pelatihan)->courses->batch ?? ''; ?> </td>
                                        </tr>
                                        <tr class="row">
                                            <td class="col-2">Periode Pelatihan</td>
                                            <td class="col-10">: <b><?= json_decode($pelatihan)->courses->startdatetime; ?></b> s/d <b><?= json_decode($pelatihan)->courses->enddatetime; ?></b></td>
                                        </tr>
                                        <tr class="row">
                                            <td class="col-2">Periode Pendaftaran</td>
                                            <td class="col-10">: <b><?= json_decode($pelatihan)->courses->start_registration; ?></b> s/d <b><?= json_decode($pelatihan)->courses->end_registration; ?></b> </td>
                                        </tr>
                                        <tr class="row">
                                            <td class="col-2">Sasaran Pelatihan</td>
                                            <td class="col-10">: <?= json_decode($pelatihan)->courses->target_participant; ?></td>
                                        </tr>
                                        <tr class="row">
                                            <td class="col-2">Tempat Penyelenggaraan</td>
                                            <td class="col-10">: <?= json_decode($pelatihan)->courses->place; ?></td>
                                        </tr>
                                        <tr class="row">
                                            <td class="col-2">Kuota</td>
                                            <td class="col-10">: <?= json_decode($pelatihan)->courses->quota; ?></td>
                                        </tr>
                                        <tr class="row">
                                            <td class="col-2">Kontak Person</td>
                                            <td class="col-10">: <?= json_decode($pelatihan)->courses->contact_person; ?></td>
                                        </tr>
                                        <tr class="row">
                                            <td class="col-2">Lampiran Jadwal</td>
                                            <td class="col-10">: </td>
                                        </tr>

                                    </tbody>
                                </table>
                                <!-- RINGKASAN -->
                                <div class="card card-round">
                                    <div class="card-body bg-green">
                                        <h4 class="card-title mt-4">Ringkasan :</h4>
                                        <?= json_decode($pelatihan)->courses->summary; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row px-3">
                            <div class="col-6">
                                <table class="table table-responsive table-bordered">
                                    <thead class="bg-success">
                                        <tr>
                                            <th class="text-light fw-bold" scope="col">No.</th>
                                            <th class="text-light fw-bold" scope="col">Komponen Unduh</th>
                                            <th class="text-light fw-bold" scope="col">File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td><a href="http://">UNDUH</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6">
                                <table class="table table-responsive table-bordered">
                                    <thead class="bg-success">
                                        <tr>
                                            <th class="text-light fw-bold" scope="col">No.</th>
                                            <th class="text-light fw-bold" scope="col">Komponen Kelengkapan Administrasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td>Pas Photo 4x6 (background merah)</td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>Surat Ijin Atasan</td>
                                        </tr>
                                        <tr>
                                            <td>3.</td>
                                            <td>Surat Pernyataan Paket Data</td>
                                        </tr>
                                        <tr>
                                            <td>4.</td>
                                            <td>Surat Tugas</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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