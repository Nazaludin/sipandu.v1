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
                        Agenda
                    </h2>
                    <ol class="breadcrumb mt-2" aria-label="breadcrumbs">
                        <li class="breadcrumb-item"><a>Home</a></li>
                        <li class="breadcrumb-item"><a>Library</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="#">Data</a></li>
                    </ol>
                </div>
                <!-- Page title actions -->
                <!-- <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <span class="d-none d-sm-inline">
                            <a href="#" class="btn">
                                New view
                            </a>
                        </span>
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">

                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Create new report
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">

                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                        </a>
                    </div>
                </div> -->

            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-fluid">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered  table-hovertable-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="align-middle">No</th>
                                            <th class="align-middle">Mulai Pelatihan/ Selesai Pelatihan</th>
                                            <th class="align-middle">Jenis Pelatihan/Nama Pelatihan</th>
                                            <th class="align-middle">Gel. / Batch</th>
                                            <th class="align-middle">No. Sertifikat</th>
                                            <th class="align-middle">Download Sertifikat</th>
                                        </tr>
                                    </thead>

                                    <tbody>


                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal-foto-profil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="<?php echo base_url('profil/upload/foto'); ?>" method="POST" enctype="multipart/form-data">
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