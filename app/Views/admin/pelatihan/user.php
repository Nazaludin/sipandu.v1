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
                        <li class="breadcrumb-item active"><a href="#">Pendaftar</a></li>
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
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-center align-middle">
                                    <thead class="text-center bg-dark">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Pengguna / Jabatan</th>
                                            <th scope="col">Status</th>
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
                                                            case 'accept':
                                                                echo '<span class="badge bg-green-lt">Diterima</span>';
                                                                break;
                                                            case 'reject':
                                                                echo '<span class="badge bg-red-lt">Ditolak</span>';
                                                                break;
                                                            case 'revisi':
                                                                echo '<span class="badge bg-yellow-lt">Revisi</span>';
                                                                break;
                                                            default:
                                                                echo '';
                                                                break;
                                                        } ?></td>

                                                    <td>
                                                        <a href="<?= base_url('pelatihan/detail/user/regis/' . $id_pelatihan . '/' . $value['id']); ?>" class="btn btn-icon btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail Pengguna">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                                <path d="M12 9h.01"></path>
                                                                <path d="M11 12h1v4h1"></path>
                                                            </svg>
                                                        </a>
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
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.js" integrity="sha512-vVx8x/L4dr4OfZ+2XZd50t8+sWlINSMO7y4+LcB4t8uF4f+wJ4jDMbFOWjmR+8HiaJp+nt0qyL0Cm4+FS6UJ0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function sendUserCourseID(id_user_course) {
        $('#form-upload-certificate').attr('action', '<?= base_url('pelatihan/detail/user/insert/certificate/'); ?>' + id_user_course);
    }


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