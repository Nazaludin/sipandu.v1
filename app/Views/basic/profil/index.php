<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-fluid">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Overview
                    </div>
                    <h2 class="page-title">
                        Profil
                    </h2>

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
                <div class="col-4">
                    <div class="card">
                        <div class="card-body mt-4">
                            <!-- Comment Row -->
                            <div class="row px-3">
                                <img src="<?php echo isset($data->lokasi_foto) ? base_url($data->lokasi_foto) : '../../assets/images/users/default-profil.png' ?>" class="img-fluid mb-4 mx-auto" style="width: 300px; height: 400px; object-fit: cover;">
                                <style>
                                    .card-photo {
                                        max-width: 200px;
                                        height: auto;
                                        /* margin-: auto; */

                                    }

                                    .card-round {
                                        border-radius: 10px;
                                    }
                                </style>
                                <div class="">
                                    <a href="#" class="btn btn-primary" title="Upload new profile image" data-bs-toggle="modal" data-bs-target="#modal-foto-profil"> <i data-feather="edit"></i></a>
                                </div>

                                <h4 class="text-center"><?= $data->fullname; ?></h4>
                                <h5 class="text-center"><?= $data->jabatan; ?></h5>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card card-round">
                        <div class="card-body">
                            <!-- TAB -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Ringkasan</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Ubah Profil</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Ubah Password</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show " id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <h4 class="card-title mt-4">Detail Profil</h4>
                                    <!-- Comment Row -->
                                    <div class="row px-3">
                                        <div class="col-12">
                                            <table class="table table-responsive w-auto">
                                                <!-- <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">First</th>
                                                <th scope="col">Last</th>
                                                <th scope="col">Handle</th>
                                            </tr>
                                        </thead> -->


                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>NIP</td>
                                                        <td><?= $data->nip; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>Nomor KTP</td>
                                                        <td><?= $data->nik; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">3</th>
                                                        <td>Nama Lengkap</td>
                                                        <td><?= $data->gelar_depan; ?> <?= $data->fullname; ?> <?= $data->gelar_belakang; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">4</th>
                                                        <td>Jenis Kelamin</td>
                                                        <td><?php echo isset($data->jenis_kelamin) ? (($data->jenis_kelamin == 'L') ? 'Laki-laki' : 'Perempuan') : ''; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">5</th>
                                                        <td>Tempat/Tanggal Lahir</td>
                                                        <td><?= $data->tempat_lahir ?>, <?= $data->tanggal_lahir; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">6</th>
                                                        <td>Agama</td>
                                                        <td><?= $data->agama; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">7</th>
                                                        <td>Telepon Pribadi</td>
                                                        <td><?= $data->telepon; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">8</th>
                                                        <td>Email</td>
                                                        <td><?= $data->email; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">9</th>
                                                        <td>Tanggal/Waktu Daftar</td>
                                                        <td><?= $data->created_at; ?></td>
                                                    </tr>
                                                    <!-- <tr>
                                                    <th scope="row">3</th>
                                                    <td>Tanggal/Waktu Aktif</td>
                                                    <td>01 Mei 2023</td>
                                                </tr> -->
                                                    <tr>
                                                        <th scope="row">11</th>
                                                        <td>Pendidikan Terakhir</td>
                                                        <td><?= $data->pendidikan_terakhir; ?> | <?= $data->jurusan; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">11</th>
                                                        <td>Alamat Domisili</td>
                                                        <td><?php echo isset($data->nama_jalan_domisili) ? ($data->nama_jalan_domisili . ', ' . $data->desa_domisili . ', Kec. ' . $data->kecamatan_domisili . ', ' . $data->kabupaten_domisili . ', ' . $data->provinsi_domisili . '.') : ''; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">10</th>
                                                        <td>Jabatan/Pekerjaan</td>
                                                        <td><?= $data->jabatan; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">12</th>
                                                        <td>Tipe Pegawai</td>
                                                        <td><?= $data->tipe_pegawai; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">13</th>
                                                        <td>Jenis Nakes</td>
                                                        <td><?= $data->jenis_nakes; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">13</th>
                                                        <td>Pangkat/Golongan</td>
                                                        <td><?= $data->pangkat_golongan; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">14</th>
                                                        <td>Nama Instansi</td>
                                                        <td><?= $data->nama_instansi; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">14</th>
                                                        <td>Alamat Instansi</td>
                                                        <td><?php echo isset($data->nama_jalan_instansi) ? ($data->nama_jalan_instansi . ', ' . $data->desa_instansi . ', Kec. ' . $data->kecamatan_instansi . ', ' . $data->kabupaten_instansi . ', ' . $data->provinsi_instansi . '.') : ''; ?></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- END tab pane ringkasan -->

                                <!-- tab-pane ubah profil -->
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


                                    <form action="<?php echo base_url('profil/update'); ?>" method="post">
                                        <?= csrf_field() ?>

                                        <div class="row mt-4">
                                            <div class="col mb-3">
                                                <label for="NIP">NIP</label>
                                                <input type="text" class="form-control" id="NIP" name="nip" placeholder="NIP" required autofocus>
                                            </div>
                                            <div class="col mb-3">
                                                <label for="nomorKTP">Nomor KTP</label>
                                                <input type="text" class="form-control" id="nomorKTP" name="nik" placeholder="Nomor KTP" required autofocus>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">

                                                <label for="nama">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="nama" name="fullname" placeholder="Nama Lengkap" required autofocus>

                                            </div>
                                            <div class="col mb-3">
                                                <label for="jenisKelamin">Jenis Kelamin</label>
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="radio" name="jenis_kelamin" id="lakiLaki" name="jenis_kelamin" value="L">
                                                        <label for="lakiLaki">
                                                            Laki-Laki
                                                        </label>
                                                    </div>
                                                    <div class="col">
                                                        <input type="radio" name="jenis_kelamin" id="Perempuan" name="jenis_kelamin" value="P">
                                                        <label for="Perempuan">
                                                            Perempuan
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">

                                                <label for="tempatLahir">Tempat Lahir</label>
                                                <input type="text" class="form-control" id="tempatLahir" name="tempat_lahir" placeholder="Tempat Lahir" required autofocus>

                                            </div>
                                            <div class="col mb-3">

                                                <label for="tanggalLahir">Tanggal Lahir</label>
                                                <input type="date" class="form-control" id="tanggalLahir" name="tanggal_lahir" placeholder="myusername" required autofocus>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="agama">Agama</label>
                                                <select class="form-control" name="agama" id="agama" required>
                                                    <option value="islam">Islam</option>
                                                    <option value="kristenProtestan">Kristen Protestan</option>
                                                    <option value="katolik">Katolik</option>
                                                    <option value="hindu">Hindu</option>
                                                    <option value="buddha">Buddha</option>
                                                    <option value="konghucu">Konghucu</option>
                                                </select>
                                            </div>
                                            <div class="col mb-3">
                                                <label for="telepon">Telepon</label>
                                                <input type="tel" class="form-control" id="telepon" name="telepon" placeholder="08xxxxxxxxxxxx" required autofocus>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="pendidikanTerakhir">Pendidikan Terakhir</label>
                                                <select class="form-control" name="pendidikan_terakhir" id="pendidikanTerakhir" required>
                                                    <option value="sd">SD</option>
                                                    <option value="smp">SMP</option>
                                                    <option value="sma">SMA / sederajat</option>
                                                    <option value="d1">D1</option>
                                                    <option value="d2">D2</option>
                                                    <option value="d3">D3</option>
                                                    <option value="d3">D4</option>
                                                    <option value="s1" selected>S1</option>
                                                    <option value="s2">S2</option>
                                                    <option value="s3">S3</option>
                                                </select>
                                            </div>
                                            <div class="col mb-3">
                                                <label for="status_kerja">Status</label>
                                                <input type="text" class="form-control" id="status_kerja" name="status_kerja" placeholder="" required autofocus>
                                            </div>
                                            <div class="col mb-3">
                                                <label for="spesialisasi">Spesialisasi</label>
                                                <input type="text" class="form-control" id="spesialisasi" name="spesialisasi" placeholder="" required autofocus>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="jabatan">Jabatan/Pekerjaan</label>
                                                <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="" required autofocus>
                                            </div>
                                            <div class="col mb-3">
                                                <label for="pangkat">Pangkat/Golongan</label>
                                                <input type="text" class="form-control" id="pangkat" name="pangkat" placeholder="" required autofocus>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="namaInstansi">Nama Instansi</label>
                                                <input type="text" class="form-control" id="namaInstansi" name="nama_instansi" placeholder="" required autofocus>
                                            </div>
                                            <div class="col mb-3">
                                                <label for="teleponInstansi">Telepon Instansi</label>
                                                <input type="text" class="form-control" id="teleponInstansi" name="telepon_instansi" placeholder="" required autofocus>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="alamatInstansi">Alamat Instansi</label>
                                                <textarea class="form-control" id="alamatInstansi" name="alamat_instansi"></textarea>
                                            </div>
                                        </div>
                                        <div hidden disabled>

                                            <!-- PROVINSI -->
                                            <!-- KABUPATEN -->
                                            <!-- KECAMATAN -->
                                            <!-- <label for="select_provinsi" class="h1 text-style1 col-sm-4 col-form-label">Provinsi</label>
                                        <select id="select_provinsi" class="select-control text-style1 transparent-select" value="<? old('provinsi'); ?>" placeholder="Cari Provinsi.." autocomplete="off" required oninvalid="this.setCustomValidity('Mohon pilih/cari provisi pada input ini')" oninput="this.setCustomValidity('')"></select>

                                        <label for="select_kabupaten" class="h1 text-style1 col-sm-4  col-form-label">Kabupaten</label>
                                        <select id="select_kabupaten" class="select-control text-style1" value="<?= old('kabupaten'); ?>" placeholder="Cari Kabupaten..." autocomplete="off" required oninvalid="this.setCustomValidity('Mohon pilih/cari kabupaten pada input ini')" oninput="this.setCustomValidity('')"></select>

                                        <label for="select_kecamatan" class="h1 text-style1 col-sm-4  col-form-label">Kecamatan</label>
                                        <select id="select_kecamatan" class="select-control text-style1" value="<?= old('kecamatan'); ?>" placeholder="Cari Kecematan..." autocomplete="off" required oninvalid="this.setCustomValidity('Mohon pilih/cari kecamatan pada input ini')" oninput="this.setCustomValidity('')"></select> -->
                                        </div>

                                        <input type="hidden" id="input-provinsi" name="provinsi">
                                        <input type="hidden" id="input-kabupaten" name="kabupaten">
                                        <input type="hidden" id="input-kecamatan" name="kecamatan">
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="alamatDomisili">Alamat Domisili</label>
                                                <textarea class="form-control" id="alamatDomisili" name="alamat_domisili"></textarea>
                                            </div>
                                        </div>


                                        <div class="d-flex justify-content-end mb-2">
                                            <button class="btn btn-primary fw-bold text-uppercase" type="submit">Simpan</button>
                                        </div>





                                    </form>
                                </div>

                                <!-- END tab-pane ubah profil -->

                                <!-- tab-pane ubah password -->
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <br>
                                    <p>Klik tombol di bawah ini, kami akan mengirimkan instruksi untuk mengatur ulang kata sandi Anda.</p>
                                    <form action="<?= url_to('forgot') ?>" method="post">
                                        <?= csrf_field() ?>

                                        <div class="form-group">
                                            <!-- <label for="email"><?= lang('Auth.emailAddress') ?></label> -->
                                            <input type="hidden" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" value="<?= $data->email; ?>" placeholder="<?= lang('Auth.email') ?>">
                                            <div class="invalid-feedback">
                                                <?= session('errors.email') ?>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.sendInstructions') ?></button>
                                    </form>
                                </div>
                                <!-- END tab-pane ubah password -->
                            </div>
                        </div>
                    </div>
                </div>

                <a class="btn" data-bs-toggle="offcanvas" href="#offcanvasBottom" role="button" aria-controls="offcanvasBottom">
                    Trigger offcanvas
                </a>
                <div class="offcanvas offcanvas-bottom rounded-5 <?= (system_status() == 'incomplete') ? 'show' : ''; ?>" tabindex="-1" id="offcanvasBottom" data-bs-keyboard="false" data-bs-backdrop="static" aria-labelledby="offcanvasBottomLabel" style="height:800px !important;">
                    <div class="offcanvas-header">
                        <h2 class="offcanvas-title" id="offcanvasBottomLabel">Melengkapi Identitas</h2>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="nav nav-tabs steps steps-counter steps-lime" data-bs-toggle="tabs">
                                            <span id="button-tab-identitas" href="#tabs-identitas" class="step-item active" data-bs-toggle="tab" disabled>Identitas</span>
                                            <span id="button-tab-pekerjaan" href="#tabs-pekerjaan" class="step-item" data-bs-toggle="tab" disabled>Pekerjaan</span>
                                            <span id="button-tab-foto-diri" href="#tabs-foto-diri" class="step-item" data-bs-toggle="tab" disabled>Foto Diri</span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?= base_url('profil/complete'); ?>" method="post" enctype="multipart/form-data">
                                            <?= csrf_field() ?>

                                            <div class="tab-content">
                                                <div class="tab-pane active show" id="tabs-identitas">
                                                    <h4>Identitas Diri</h4>

                                                    <div class="row mt-4">
                                                        <div class="col-lg-6 mb-3">
                                                            <label for="fullnameInsert" class="form-label required">Nama Lengkap</label>
                                                            <input type="text" class="form-control" id="fullnameInsert" name="fullname" placeholder="Nama Lengkap" required autofocus>
                                                            <small id="fullnameHelp" class="form-text text-muted">Tulis nama lengkap <b>tanpa gelar</b> dan <b>tidak disingkat</b>.</small>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="gelarDepanInsert" class="form-label">Gelar Depan</label>
                                                            <input type="text" class="form-control" id="gelarDepanInsert" name="gelar_depan" placeholder="Gelar Depan" autofocus>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="gelarBelakangInsert" class="form-label">Gelar Belakang</label>
                                                            <input type="text" class="form-control" id="gelarBelakangInsert" name="gelar_belakang" placeholder="Gelar Belakang" autofocus>
                                                        </div>

                                                        <div class="col-lg-6 col-md-12 mb-3">
                                                            <label for="nomorKTPInsert" class="form-label required">Nomor KTP</label>
                                                            <input type="text" class="form-control" id="nomorKTPInsert" name="nik" placeholder="Nomor KTP" required autofocus>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="pendidikanTerakhirInsert" class="form-label required">Pendidikan Terakhir</label>
                                                            <select class="select-control" name="pendidikan_terakhir" id="pendidikanTerakhirInsert" placeholder="Pilih pendidikan terakhir" required oninvalid="this.setCustomValidity('Mohon pilih pendidikan terakhir pada input ini')" oninput="this.setCustomValidity('')">
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
                                                        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
                                                        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
                                                        <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="jurusanInsert" class="form-label required">Jurusan</label>
                                                            <input type="text" class="form-control" id="jurusanInsert" name="jurusan" placeholder="Jurusan" required autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="tempatLahirInsert" class="form-label required">Tempat Lahir</label>
                                                            <input type="text" class="form-control" id="tempatLahiInsertr" name="tempat_lahir" placeholder="Tempat Lahir" required autofocus>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="tanggalLahir" class="form-label required">Tanggal Lahir</label>
                                                            <input type="date" class="form-control" id="tanggalLahir" name="tanggal_lahir" placeholder="myusername" required autofocus>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="agamaInsert" class="form-label required">Agama</label>
                                                            <select class="select-control" name="agama" id="agamaInsert" placeholder="Pilih Agama..." required oninvalid="this.setCustomValidity('Mohon pilih agama pada input ini')" oninput="this.setCustomValidity('')">
                                                                <option value=""></option>
                                                                <option value="Islam">Islam</option>
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
                                                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="L">
                                                                    <span class="form-check-label">Laki-laki</span>
                                                                </label>
                                                                <label class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="P">
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
                                                                    <label for="namaJalanInsert" class="form-label required">Nama Jalan</label>
                                                                    <input type="text" class="form-control" id="namaJalanInsert" name="nama_jalan_domisili" placeholder="Tulis alamat dengan nama jalan beserta nomornya">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-6 mb-3">
                                                                    <label for="desaInsert" class="form-label required">Desa/Kelurahan</label>
                                                                    <input type="text" class="form-control" id="desaInsert" name="desa_domisili" placeholder="Dasa" required autofocus>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 mb-3">
                                                                    <label for="kecamatanInsert" class="form-label required">Kecamatan</label>
                                                                    <select class="select-control" name="kecamatan_domisili" id="kecamatanInsert" placeholder="Pilih/tulis kecamatan domisili..." required oninvalid="this.setCustomValidity('Mohon pilih tipe pegawai pada input ini')" oninput="this.setCustomValidity('')">
                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 mb-3">
                                                                    <label for="kabupatenInsert" class="form-label required">Kabupaten/Kota</label>
                                                                    <select class="select-control" name="kabupaten_domisili" id="kabupatenInsert" placeholder="Pilih/tulis kabupaten domisili..." required oninvalid="this.setCustomValidity('Mohon pilih tipe pegawai pada input ini')" oninput="this.setCustomValidity('')">
                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 mb-3">
                                                                    <label for="provinsiInsert" class="form-label required">Provinsi</label>
                                                                    <select class="select-control" name="provinsi_domisili" id="provinsiInsert" placeholder="Pilih/tulis provinsi domisili..." required oninvalid="this.setCustomValidity('Mohon pilih tipe pegawai pada input ini')" oninput="this.setCustomValidity('')">
                                                                        <option value=""></option>
                                                                    </select>
                                                                    <!-- <input type="text" class="form-control" id="provinsiInsert" name="provinsi_domisili" placeholder="Provinsi" required autofocus> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="tab-pane" id="tabs-pekerjaan">
                                                    <h4>Pekerjaan</h4>
                                                    <div class="row mt-4">
                                                        <div class="col-lg-6 col-md-6 mb-3">
                                                            <label for="tipePegawaiInsert" class="form-label required">Tipe Pegawai</label>
                                                            <select class="select-control" name="tipe_pegawai" id="tipePegawaiInsert" placeholder="Pilih tipe pegawai" required oninvalid="this.setCustomValidity('Mohon pilih tipe pegawai pada input ini')" oninput="this.setCustomValidity('')">
                                                                <option value=""></option>
                                                                <option value="ASN Kemenkes">ASN Kemenkes</option>
                                                                <option value="ASN Non Kemenkes">ASN Non Kemenkes</option>
                                                                <option value="Non ASN">Non ASN</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 mb-3">
                                                            <label for="nomorNIPInsert" class="form-label required">Nomor Induk Pegawai (NIP)</label>
                                                            <input type="text" class="form-control" id="nomorNIPInsert" name="nip" placeholder="Nomor Induk Pegawai (NIP)" required autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="jabatanInsert" class="form-label required">Jabatan/Pekerjaan</label>
                                                            <input type="text" class="form-control" id="jabatanInsert" name="jabatan" placeholder="Jabatan/Pekerjaan" required autofocus>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="pangkatInsert" class="form-label required">Pangkat/Golongan</label>
                                                            <select class="select-control" name="pangkat_golongan" id="pangkatInsert" placeholder="Cari pangkat atau golongan..." required oninvalid="this.setCustomValidity('Mohon cari/pilih pangkat pada input ini')" oninput="this.setCustomValidity('')">
                                                                <option value=""></option>

                                                            </select>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="jenisNakesInsert" class="form-label required">Jenis Nakes</label>
                                                            <select class="select-control" name="jenis_nakes" id="jenisNakesInsert" placeholder="Cari pangkat atau golongan..." required oninvalid="this.setCustomValidity('Mohon cari/pilih jenis nakes pada input ini')" oninput="this.setCustomValidity('')">
                                                                <option value=""></option>

                                                            </select>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="namaInstansiInsert" class="form-label required">Nama Instansi</label>
                                                            <input type="text" class="form-control" id="namaInstansiInsert" name="nama_instansi" placeholder="Nama Instansi" required autofocus>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                    </div>

                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="card-title">Alamat Instansi</div>
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <label for="namaJalanInstansiInsert" class="form-label required">Nama Jalan</label>
                                                                    <input type="text" class="form-control" id="namaJalanInstansiInsert" name="nama_jalan_instansi" placeholder="Tulis alamat dengan nama jalan instansi beserta nomornya">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-6 mb-3">
                                                                    <label for="desaInstansiInsert" class="form-label required">Desa/Kelurahan</label>
                                                                    <input type="text" class="form-control" id="desaInstansiInsert" name="desa_instansi" placeholder="Dasa" required autofocus>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 mb-3">
                                                                    <label for="kecamatanInstansiInsert" class="form-label required">Kecamatan</label>
                                                                    <select class="select-control" name="kecamatan_instansi" id="kecamatanInstansiInsert" placeholder="Pilih/tulis kecamatan instansi..." required oninvalid="this.setCustomValidity('Mohon pilih tipe pegawai pada input ini')" oninput="this.setCustomValidity('')">
                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 mb-3">
                                                                    <label for="kabupatenInstansiInsert" class="form-label required">Kabupaten/Kota</label>
                                                                    <select class="select-control" name="kabupaten_instansi" id="kabupatenInstansiInsert" placeholder="Pilih/tulis kabupaten instansi..." required oninvalid="this.setCustomValidity('Mohon pilih tipe pegawai pada input ini')" oninput="this.setCustomValidity('')">
                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 mb-3">
                                                                    <label for="provinsiInstansiInsert" class="form-label required">Provinsi</label>
                                                                    <select class="select-control" name="provinsi_instansi" id="provinsiInstansiInsert" placeholder="Pilih/tulis provinsi instansi..." required oninvalid="this.setCustomValidity('Mohon pilih tipe pegawai pada input ini')" oninput="this.setCustomValidity('')">
                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <script>
                                                        $(document).ready(function() {
                                                            $('#home-tab').attr('class', 'nav-link active');
                                                            $('#home').attr('class', 'tab-pane fade show active');
                                                        });

                                                        let agamaSelect = new TomSelect('#agamaInsert', {
                                                            hideSelected: true,
                                                            valueField: 'id',
                                                            labelField: 'name',
                                                            searchField: 'name',
                                                            create: false,
                                                        });
                                                        let pendidikanSelect = new TomSelect('#pendidikanTerakhirInsert', {
                                                            hideSelected: true,
                                                            valueField: 'id',
                                                            labelField: 'name',
                                                            searchField: 'name',
                                                            create: false,
                                                        });
                                                        let tipePegawaiSelect = new TomSelect('#tipePegawaiInsert', {
                                                            hideSelected: true,
                                                            valueField: 'id',
                                                            labelField: 'name',
                                                            searchField: 'name',
                                                            create: false,
                                                        });
                                                        let pangkatSelect = new TomSelect('#pangkatInsert', {
                                                            hideSelected: true,
                                                            valueField: 'nama',
                                                            labelField: 'nama',
                                                            searchField: 'nama',
                                                            options: convertArray(dataPangkat()),
                                                            create: false,
                                                        });
                                                        let jenisNakesSelect = new TomSelect('#jenisNakesInsert', {
                                                            hideSelected: true,
                                                            valueField: 'nama',
                                                            labelField: 'nama',
                                                            searchField: 'nama',
                                                            options: convertArray(dataJenisNakes()),
                                                            create: false,
                                                        });
                                                        let provinsiSelect = new TomSelect('#provinsiInsert', {
                                                            hideSelected: true,
                                                            valueField: 'nama',
                                                            labelField: 'nama',
                                                            searchField: 'nama',
                                                            options: convertArray(dataProvinsi()),
                                                            create: true,
                                                        });
                                                        let KabupatenSelect = new TomSelect('#kabupatenInsert', {
                                                            hideSelected: true,
                                                            valueField: 'nama',
                                                            labelField: 'nama',
                                                            searchField: 'nama',
                                                            options: convertArray(dataKabupaten()),
                                                            create: true,
                                                        });
                                                        let kecamatanSelect = new TomSelect('#kecamatanInsert', {
                                                            hideSelected: true,
                                                            valueField: 'nama',
                                                            labelField: 'nama',
                                                            searchField: 'nama',
                                                            options: convertArray(dataKecamatan()),
                                                            create: true,
                                                        });
                                                        let provinsiInstansiSelect = new TomSelect('#provinsiInstansiInsert', {
                                                            hideSelected: true,
                                                            valueField: 'nama',
                                                            labelField: 'nama',
                                                            searchField: 'nama',
                                                            options: convertArray(dataProvinsi()),
                                                            create: true,
                                                        });
                                                        let KabupatenInstansiSelect = new TomSelect('#kabupatenInstansiInsert', {
                                                            hideSelected: true,
                                                            valueField: 'nama',
                                                            labelField: 'nama',
                                                            searchField: 'nama',
                                                            options: convertArray(dataKabupaten()),
                                                            create: true,
                                                        });
                                                        let kecamatanInstansiSelect = new TomSelect('#kecamatanInstansiInsert', {
                                                            hideSelected: true,
                                                            valueField: 'nama',
                                                            labelField: 'nama',
                                                            searchField: 'nama',
                                                            options: convertArray(dataKecamatan()),
                                                            create: true,
                                                        });


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

                                                    <!-- <div class="tab-pane" id="tabs-activity-7">
                                                <h4>Activity tab</h4>
                                                <div>Donec ac vitae diam amet vel leo egestas consequat rhoncus in luctus amet, facilisi sit mauris accumsan nibh habitant senectus</div>
                                            </div> -->
                                                </div>
                                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.css">
                                                <style>
                                                    #previewContainer {
                                                        width: 300px;
                                                        height: 200px;
                                                        border: 1px solid #ccc;
                                                        margin-top: 20px;
                                                        display: none;
                                                    }

                                                    #previewContainer img {
                                                        max-width: 100%;
                                                        max-height: 100%;
                                                    }
                                                </style>
                                                <div class="tab-pane" id="tabs-foto-diri">
                                                    <h4>Foto Diri</h4>
                                                    <div class="card">
                                                        <div class="row g-0">
                                                            <div class="col-12 col-md-3 border-end">
                                                                <div class="card-body">
                                                                    <h4 class="subheader">Penyesuaian Foto</h4>
                                                                    <div class="list-group list-group-flush list-group-hoverable overflow-auto" style="max-height: 50rem">
                                                                        <div id="previewContainer">
                                                                            <img id="previewImage" src="#" alt="Preview">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-md-9 d-flex flex-column">
                                                                <div class="card-body">
                                                                    <h3 class="card-title">Foto diri</h3>
                                                                    <p>keteranga...............</p>
                                                                    <div class="row align-items-center">
                                                                        <div class="col">
                                                                            <input class="form-control" type="file" id="fileFotoInsert">
                                                                        </div>

                                                                        <div>
                                                                            <button class="btn btn-primary" type="button" id="cropButton">Simpan</button>
                                                                        </div>
                                                                    </div>



                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-4">

                                                    </div>
                                                </div>

                                                <button id="submit-form" type="submit" hidden></button>




                                                <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.js"></script>
                                                <script>
                                                    var csrfName = '<?= csrf_token() ?>';
                                                    var csrfHash = '<?= csrf_hash() ?>';
                                                    const fileInput = document.getElementById('fileFotoInsert');
                                                    const previewContainer = document.getElementById('previewContainer');

                                                    const previewImage = document.getElementById('previewImage');
                                                    const cropButton = document.getElementById('cropButton');

                                                    let cropper;

                                                    fileInput.addEventListener('change', function() {
                                                        const file = fileInput.files[0];

                                                        if (file) {
                                                            const reader = new FileReader();

                                                            reader.onload = function(e) {
                                                                previewImage.src = e.target.result;
                                                                previewContainer.innerHTML = '';
                                                                previewContainer.appendChild(previewImage);
                                                                previewContainer.style.display = 'block';

                                                                if (cropper) {
                                                                    cropper.destroy();
                                                                }

                                                                cropper = new Cropper(previewImage, {
                                                                    aspectRatio: 1, // Mengatur rasio aspek yang diinginkan
                                                                    viewMode: 2, // Mengaktifkan mode pemandangan kanvas
                                                                });
                                                            };

                                                            reader.readAsDataURL(file);
                                                        }
                                                    });


                                                    cropButton.addEventListener('click', function() {
                                                        if (cropper) {
                                                            cropper.getCroppedCanvas().toBlob((blob) => {
                                                                const formData = new FormData();

                                                                // Pass the image file name as the third parameter if necessary.
                                                                formData.append('croppedImage', blob /*, 'example.png' */ );
                                                                formData.append([csrfName], csrfHash);

                                                                // Use `jQuery.ajax` method for example
                                                                $.ajax('/service/test', {
                                                                    method: 'POST',
                                                                    data: formData,
                                                                    processData: false,
                                                                    contentType: false,
                                                                    success(data) {
                                                                        console.log(data);
                                                                        console.log('Upload success');
                                                                    },
                                                                    error() {
                                                                        console.log('Upload error');
                                                                    },
                                                                });
                                                            }, 'image/png');

                                                        }
                                                    });
                                                </script>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="offcanvas-footer">
                            <div class="row justify-content-between">
                                <div class="col">
                                    <button id="button-sebelumnya" class="btn btn-ghost-primary" type="button" disabled onclick="controlButtonSebelumnya()">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M15 6l-6 6l6 6"></path>
                                        </svg>
                                        Sebelumnya
                                    </button>
                                </div>
                                <div class="col d-flex align-items-end flex-column">
                                    <button id="button-selanjutnya" class="btn btn-ghost-primary" type="button" onclick="controlButtonSelanjutnya()">
                                        Selanjutnya
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M9 6l6 6l-6 6"></path>
                                        </svg>
                                    </button>
                                    <button id="button-selanjutnya-simpan" class="btn btn-danger" type="button" onclick="$('#submit-form').click()">
                                        Simpan
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M9 6l6 6l-6 6"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <script>
                            var step = 1;
                            $(document).ready(function() {

                                $('#button-selanjutnya-simpan').hide();
                            });

                            function controlButtonSelanjutnya() {
                                switch (step) {
                                    case 2:
                                        $('#button-selanjutnya-simpan').show();
                                        $('#button-selanjutnya').hide();
                                        $id = "button-tab-foto-diri";
                                        break;

                                    default:
                                        $id = "button-tab-pekerjaan";
                                        break;
                                }
                                $('#button-sebelumnya').prop('disabled', false)
                                $('#' + $id).prop('disabled', false)
                                $('#' + $id).click()
                                $('#' + $id).prop('disabled', true)
                                step++
                            }

                            function controlButtonSebelumnya() {
                                step--
                                console.log(step);
                                switch (step) {
                                    case 2:
                                        $id = "button-tab-pekerjaan";
                                        $('#button-selanjutnya').show();
                                        $('#button-selanjutnya-simpan').hide();
                                        break;
                                    case 1:
                                        $id = "button-tab-identitas";
                                        $('#button-sebelumnya').prop('disabled', true)
                                        break;
                                    default:
                                        $('#button-sebelumnya').prop('disabled', false)
                                        break;
                                }
                                $('#' + $id).prop('disabled', false)
                                $('#' + $id).click()
                                $('#' + $id).prop('disabled', true)
                            }
                        </script>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.js" integrity="sha512-vVx8x/L4dr4OfZ+2XZd50t8+sWlINSMO7y4+LcB4t8uF4f+wJ4jDMbFOWjmR+8HiaJp+nt0qyL0Cm4+FS6UJ0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>