<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-fluid">

            <?php if (session()->has('message')) : ?>
                <div class="alert alert-important alert-success alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
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

            <?php if (session()->has('errors')) {
                foreach (session('errors') as $error) { ?>
                    <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                        <div class="d-flex">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                    <path d="M12 8v4"></path>
                                    <path d="M12 16h.01"></path>
                                </svg>
                            </div>
                            <div>
                                <?= $error; ?>
                            </div>
                        </div>
                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
            <?php }
            } ?>
            <?php if (session()->has('errors.edit.profil')) {
                foreach (session('errors.edit.profil') as $error) { ?>
                    <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                        <div class="d-flex">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                    <path d="M12 8v4"></path>
                                    <path d="M12 16h.01"></path>
                                </svg>
                            </div>
                            <div>
                                <?= $error; ?>
                            </div>
                        </div>
                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
            <?php }
            } ?>
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Profil
                    </div>
                    <h2 class="page-title">
                        Ubah Data Diri
                    </h2>
                    <ol class="breadcrumb mt-2" aria-label="breadcrumbs">
                        <li class="breadcrumb-item "><a href="<?= base_url('profil'); ?>">Profil</a></li>
                        <li class="breadcrumb-item active"><a>Edit</a></li>
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

                        <div class="card-header">
                            <h3 class="card-title">Ubah Data Diri</h3>
                        </div>
                        <div class="card-body">
                            <div class="row px-3">
                                <div class="col-12">
                                    <form action="<?= base_url('profil/edit/proses'); ?>" method="post">
                                        <?= csrf_field() ?>
                                        <h2 class="text-green mb-1">Identitas Diri</h2>
                                        <div class="row mt-0">
                                            <div class="col-lg-6 mb-3">
                                                <label for="fullnameEdit" class="form-label required">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="fullnameEdit" name="fullname" placeholder="Nama Lengkap" value="<?= $data->fullname ?>" autofocus>
                                                <small id="fullnameHelp" class="form-text text-muted">Tulis nama lengkap <b>tanpa gelar</b> dan <b>tidak disingkat</b>.</small>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="gelarDepanEdit" class="form-label">Gelar Depan</label>
                                                <input type="text" class="form-control" id="gelarDepanEdit" name="gelar_depan" placeholder="Gelar Depan" value="<?= $data->gelar_depan; ?>" autofocus>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="gelarBelakangEdit" class="form-label">Gelar Belakang</label>
                                                <input type="text" class="form-control" id="gelarBelakangEdit" name="gelar_belakang" placeholder="Gelar Belakang" value="<?= $data->gelar_belakang; ?>" autofocus>
                                            </div>

                                            <div class="col-lg-6 col-md-12 mb-3">
                                                <label for="nomorKTPEdit" class="form-label required">Nomor KTP</label>
                                                <input type="text" class="form-control" id="nomorKTPEdit" name="nik" placeholder="Nomor KTP" value="<?= $data->nik; ?>" autofocus>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="pendidikanTerakhirEdit" class="form-label required">Pendidikan Terakhir</label>
                                                <select class="select-control" name="pendidikan_terakhir" id="pendidikanTerakhirEdit" placeholder="Pilih pendidikan terakhir">
                                                    <option value=""></option>
                                                    <option value="SMA">SMA / sederajat</option>
                                                    <option value="D1">D1</option>
                                                    <option value="D2">D2</option>
                                                    <option value="D3">D3</option>
                                                    <option value="D4">D4</option>
                                                    <option value="S1">S1</option>
                                                    <option value="S2">S2</option>
                                                    <option value="S3">S3</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="jurusanEdit" class="form-label required">Jurusan</label>
                                                <input type="text" class="form-control" id="jurusanEdit" name="jurusan" placeholder="Jurusan" value="<?= $data->jurusan; ?>" autofocus>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="tempatLahirEdit" class="form-label required">Tempat Lahir</label>
                                                <input type="text" class="form-control" id="tempatLahiInsertr" name="tempat_lahir" placeholder="Tempat Lahir" value="<?= $data->tempat_lahir; ?>" autofocus>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="tanggalLahir" class="form-label required">Tanggal Lahir</label>
                                                <input type="date" class="form-control" id="tanggalLahir" name="tanggal_lahir" placeholder="myusername" value="<?= $data->tanggal_lahir; ?>" autofocus>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="agamaEdit" class="form-label required">Agama</label>
                                                <select class="select-control" name="agama" id="agamaEdit" placeholder="Pilih Agama...">
                                                    <option value=""></option>
                                                    <option value=" Islam">Islam</option>
                                                    <option value="Kristen Protestan">Kristen Protestan</option>
                                                    <option value="Kristen Katolik">Kristen Katolik</option>
                                                    <option value="Hindu">Hindu</option>
                                                    <option value="Buddha">Buddha</option>
                                                    <option value="Konghucu">Konghucu</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <div class="form-label required">Jenis Kelamin</div>
                                                <div>
                                                    <label class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="L" <?= $data->jenis_kelamin == 'L' ? 'checked' : ''; ?>>
                                                        <span class="form-check-label">Laki-laki</span>
                                                    </label>
                                                    <label class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="P" <?= $data->jenis_kelamin == 'P' ? 'checked' : ''; ?>>
                                                        <span class="form-check-label">Perempuan</span>
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title">Alamat Domisili</div>
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="namaJalanEdit" class="form-label required">Nama Jalan</label>
                                                        <input type="text" class="form-control" id="namaJalanEdit" name="nama_jalan_domisili" placeholder="Tulis alamat dengan nama jalan beserta nomornya" value="<?= $data->nama_jalan_domisili; ?>">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3 col-md-6 mb-3">
                                                        <label for="desaEdit" class="form-label required">Desa/Kelurahan</label>
                                                        <input type="text" class="form-control" id="desaEdit" name="desa_domisili" placeholder="Dasa" value="<?= $data->desa_domisili; ?>" autofocus>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 mb-3">
                                                        <label for="kecamatanEdit" class="form-label required">Kecamatan</label>
                                                        <select class="select-control" name="kecamatan_domisili" id="kecamatanEdit" placeholder="Pilih/tulis kecamatan domisili..." value="<?= $data->kecamatan_domisili; ?>">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 mb-3">
                                                        <label for="kabupatenEdit" class="form-label required">Kabupaten/Kota</label>
                                                        <select class="select-control" name="kabupaten_domisili" id="kabupatenEdit" placeholder="Pilih/tulis kabupaten domisili..." value="<?= $data->kabupaten_domisili; ?>">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 mb-3">
                                                        <label for="provinsiEdit" class="form-label required">Provinsi</label>
                                                        <select class="select-control" name="provinsi_domisili" id="provinsiEdit" placeholder="Pilih/tulis provinsi domisili..." value="<?= $data->provinsi_domisili; ?>">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <h2 class="text-green mb-1 mt-3">Pekerjaan</h2>
                                        <div class="row mt-0">
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="tipePegawaiEdit" class="form-label required">Tipe Pegawai</label>
                                                <select class="select-control" name="tipe_pegawai" id="tipePegawaiEdit" placeholder="Pilih tipe pegawai">
                                                    <option value=""></option>
                                                    <option value="ASN Kemenkes">ASN Kemenkes</option>
                                                    <option value="ASN Non Kemenkes">ASN Non Kemenkes</option>
                                                    <option value="Non ASN">Non ASN</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="nomorNIPEdit" class="form-label required">Nomor Induk Pegawai (NIP)</label>
                                                <input type="text" class="form-control" id="nomorNIPEdit" name="nip" placeholder="Nomor Induk Pegawai (NIP)" value="<?= $data->nip; ?>" autofocus>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="nomorNRPEdit" class="form-label required">Nomor Registrasi Pokok (NRP)</label>
                                                <input type="text" class="form-control" id="nomorNRPEdit" name="nrp" placeholder="Nomor Registrasi Pokok (NRP)" value="<?= $data->nrp; ?>" autofocus>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="nomorSTREdit" class="form-label required">Nomor STR</label>
                                                <input type="text" class="form-control" id="nomorSTREdit" name="nomor_str" placeholder="Nomor STR" value="<?= $data->nomor_str; ?>" autofocus>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="jabatanEdit" class="form-label required">Jabatan/Pekerjaan</label>
                                                <input type="text" class="form-control" id="jabatanEdit" name="jabatan" placeholder="Jabatan/Pekerjaan" value="<?= $data->jabatan; ?>" autofocus>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="pangkatEdit" class="form-label required">Pangkat/Golongan</label>
                                                <select class="select-control" name="pangkat_golongan" id="pangkatEdit" placeholder="Cari pangkat atau golongan...">
                                                    <option value=""></option>

                                                </select>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="jenisNakesEdit" class="form-label required">Jenis Nakes</label>
                                                <select class="select-control" name="jenis_nakes" id="jenisNakesEdit" placeholder="Cari pangkat atau golongan...">
                                                    <option value=""></option>

                                                </select>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="namaInstansiEdit" class="form-label required">Nama Instansi</label>
                                                <input type="text" class="form-control" id="namaInstansiEdit" name="nama_instansi" placeholder="Nama Instansi" value="<?= $data->nama_instansi; ?>" autofocus>
                                            </div>
                                        </div>

                                        <div class="row">
                                        </div>

                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="card-title">Alamat Instansi</div>
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="namaJalanInstansiEdit" class="form-label required">Nama Jalan</label>
                                                        <input type="text" class="form-control" id="namaJalanInstansiEdit" name="nama_jalan_instansi" placeholder="Tulis alamat dengan nama jalan instansi beserta nomornya" value="<?= $data->nama_jalan_instansi; ?>">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3 col-md-6 mb-3">
                                                        <label for="desaInstansiEdit" class="form-label required">Desa/Kelurahan</label>
                                                        <input type="text" class="form-control" id="desaInstansiEdit" name="desa_instansi" placeholder="Dasa" value="<?= $data->desa_instansi; ?>" autofocus>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 mb-3">
                                                        <label for="kecamatanInstansiEdit" class="form-label required">Kecamatan</label>
                                                        <select class="select-control" name="kecamatan_instansi" id="kecamatanInstansiEdit" placeholder="Pilih/tulis kecamatan instansi..." value="<?= $data->kecamatan_instansi; ?>">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 mb-3">
                                                        <label for="kabupatenInstansiEdit" class="form-label required">Kabupaten/Kota</label>
                                                        <select class="select-control" name="kabupaten_instansi" id="kabupatenInstansiEdit" placeholder="Pilih/tulis kabupaten instansi..." value="<?= $data->kabupaten_instansi; ?>">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 mb-3">
                                                        <label for="provinsiInstansiEdit" class="form-label required">Provinsi</label>
                                                        <select class="select-control" name="provinsi_instansi" id="provinsiInstansiEdit" placeholder="Pilih/tulis provinsi instansi..." value="<?= $data->provinsi_instansi; ?>">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6 d-flex justify-content-start">
                                                <a href="<?= base_url('profil'); ?>" class="btn btn-outline-primary">Batal</a>
                                            </div>
                                            <div class="col-6 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary mx-2">Ubah</button>
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
</div>

<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

<script>
    var agama = '<?= $data->agama; ?>';
    var pendidikan_terakhir = '<?= $data->pendidikan_terakhir; ?>';
    var tipe_pegawai = '<?= $data->tipe_pegawai; ?>';
    var pangkat_golongan = '<?= $data->pangkat_golongan; ?>';
    var jenis_nakes = '<?= $data->jenis_nakes; ?>';
    var provinsi_domisili = '<?= $data->provinsi_domisili; ?>';
    var kabupaten_domisili = '<?= $data->kabupaten_domisili; ?>';
    var kecamatan_domisili = '<?= $data->kecamatan_domisili; ?>';
    var provinsi_instansi = '<?= $data->provinsi_instansi; ?>';
    var kabupaten_instansi = '<?= $data->kabupaten_instansi; ?>';
    var kecamatan_instansi = '<?= $data->kecamatan_instansi; ?>';

    let agamaSelect = new TomSelect('#agamaEdit', {
        hideSelected: true,
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        create: false,
    });
    let pendidikanSelect = new TomSelect('#pendidikanTerakhirEdit', {
        hideSelected: true,
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        create: false,
    });
    let tipePegawaiSelect = new TomSelect('#tipePegawaiEdit', {
        hideSelected: true,
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        create: false,
    });
    let pangkatSelect = new TomSelect('#pangkatEdit', {
        hideSelected: true,
        valueField: 'nama',
        labelField: 'nama',
        searchField: 'nama',
        options: convertArray(dataPangkat()),
        create: false,
    });
    let jenisNakesSelect = new TomSelect('#jenisNakesEdit', {
        hideSelected: true,
        valueField: 'nama',
        labelField: 'nama',
        searchField: 'nama',
        options: convertArray(dataJenisNakes()),
        create: false,
    });
    let provinsiSelect = new TomSelect('#provinsiEdit', {
        hideSelected: true,
        valueField: 'nama',
        labelField: 'nama',
        searchField: 'nama',
        options: convertArray(dataProvinsi()),
        create: true,
    });
    let KabupatenSelect = new TomSelect('#kabupatenEdit', {
        hideSelected: true,
        valueField: 'nama',
        labelField: 'nama',
        searchField: 'nama',
        options: convertArray(dataKabupaten()),
        create: true,
    });
    let kecamatanSelect = new TomSelect('#kecamatanEdit', {
        hideSelected: true,
        valueField: 'nama',
        labelField: 'nama',
        searchField: 'nama',
        options: convertArray(dataKecamatan()),
        create: true,
    });
    let provinsiInstansiSelect = new TomSelect('#provinsiInstansiEdit', {
        hideSelected: true,
        valueField: 'nama',
        labelField: 'nama',
        searchField: 'nama',
        options: convertArray(dataProvinsi()),
        create: true,
    });
    let KabupatenInstansiSelect = new TomSelect('#kabupatenInstansiEdit', {
        hideSelected: true,
        valueField: 'nama',
        labelField: 'nama',
        searchField: 'nama',
        options: convertArray(dataKabupaten()),
        create: true,
    });
    let kecamatanInstansiSelect = new TomSelect('#kecamatanInstansiEdit', {
        hideSelected: true,
        valueField: 'nama',
        labelField: 'nama',
        searchField: 'nama',
        options: convertArray(dataKecamatan()),
        create: true,
    });

    if (agama !== '') {
        agamaSelect.setValue(agama);
    }
    if (pendidikan_terakhir !== '') {
        pendidikanSelect.setValue(pendidikan_terakhir);
    }
    if (tipe_pegawai !== '') {
        tipePegawaiSelect.setValue(tipe_pegawai);
    }
    if (pangkat_golongan !== '') {
        pangkatSelect.setValue(pangkat_golongan);
    }
    if (jenis_nakes !== '') {
        jenisNakesSelect.setValue(jenis_nakes);
    }
    if (provinsi_domisili !== '') {
        provinsiSelect.setValue(provinsi_domisili);
    }
    if (kabupaten_domisili !== '') {
        KabupatenSelect.setValue(kabupaten_domisili);
    }
    if (kecamatan_domisili !== '') {
        kecamatanSelect.setValue(kecamatan_domisili);
    }
    if (provinsi_instansi !== '') {
        provinsiInstansiSelect.setValue(provinsi_instansi);
    }
    if (kabupaten_instansi !== '') {
        KabupatenInstansiSelect.setValue(kabupaten_instansi);
    }
    if (kecamatan_instansi !== '') {
        kecamatanInstansiSelect.setValue(kecamatan_instansi);
    }
    // Fungsi untuk mengambil data provinsi dari server
    function dataProvinsi() {
        var result = "";
        $.ajax({
            url: "<?= base_url(); ?>/service/provinsi",
            async: false,
            success: function(data) {
                result = data;
                console.log(data);
            }
        });
        return result;
    }

    function dataKabupaten() {
        var result = "";
        $.ajax({
            url: "<?= base_url(); ?>/service/kabupaten",
            async: false,
            success: function(data) {
                result = data;
                console.log(data);
            }
        });
        return result;
    }

    function dataKecamatan() {
        var result = "";
        $.ajax({
            url: "<?= base_url(); ?>/service/kecamatan",
            async: false,
            success: function(data) {
                result = data;
                console.log(data);
            }
        });
        return result;
    }

    function dataPangkat() {
        var result = "";
        $.ajax({
            url: "<?= base_url(); ?>/service/pangkat-golongan",
            async: false,
            success: function(data) {
                result = data;
                console.log(data);
            }
        });
        return result;
    }

    function dataJenisNakes() {
        var result = "";
        $.ajax({
            url: "<?= base_url(); ?>/service/jenis-nakes",
            async: false,
            success: function(data) {
                result = data;
                console.log(data);
            }
        });
        return result;
    }

    // Fungsi untuk mengkonversi data dari string JSON ke array
    function convertArray(data) {
        return JSON.parse(data);
    }
</script>