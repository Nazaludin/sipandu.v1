<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Pelatihan
                    </div>
                    <h2 class="page-title">
                        Agenda
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
                            <h4 class="card-title">Detail Pelatihan</h4>
                            <div class="row px-3 justify-content-between mb-4">
                                <div class="col-1">
                                    <a href="<?= base_url('pelatihan'); ?>" class="btn btn-outline-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-big-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M20 15h-8v3.586a1 1 0 0 1 -1.707 .707l-6.586 -6.586a1 1 0 0 1 0 -1.414l6.586 -6.586a1 1 0 0 1 1.707 .707v3.586h8a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1z"></path>
                                        </svg>
                                        Back</a>
                                </div>
                                <div class="col-1">
                                    <a href="<?= base_url('pelatihan/detail/edit/' . json_decode($pelatihan)->courses->id); ?>" class="btn btn-outline-primary">Edit</a>
                                </div>
                            </div>
                            <!-- Comment Row -->
                            <div class="row px-3 mb-4">
                                <div class="col-12">
                                    <table class="table">
                                        <tbody>
                                            <tr class="row">
                                                <td class="col-2">Tahun Pelaksanaan</td>
                                                <td class="col-10">: </td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-2">Jenis Pelatihan</td>
                                                <td class="col-10">: <?= json_decode($pelatihan)->courses->categoryname; ?></td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-2">Nama Pelatihan</td>
                                                <td class="col-10">: <?= json_decode($pelatihan)->courses->fullname; ?></td>
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
                                        <div class="card-body">
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
                                                <th>No.</th>
                                                <th>Komponen Unduh</th>
                                                <th>File</th>
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
                                                <th>No.</th>
                                                <th>Komponen Kelengkapan Administrasi</th>
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

                                <div class="row px-3 justify-content-end">

                                    <div class="col-1">
                                        <a href="<?= base_url('pelatihan/agenda'); ?>" class="btn btn-outline-primary">Daftar Pelatihan</a>
                                    </div>

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