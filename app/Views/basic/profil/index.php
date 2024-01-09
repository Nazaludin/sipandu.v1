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

            <?php if (session()->has('errors')) {
                foreach (session('errors') as $error) { ?>
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
                        Overview
                    </div>
                    <h2 class="page-title">
                        Profil
                    </h2>
                    <ol class="breadcrumb mt-2" aria-label="breadcrumbs">
                        <li class="breadcrumb-item active"><a>Profil</a></li>
                        <!-- <li class="breadcrumb-item"><a>Library</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="#">Data</a></li> -->
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
                                <!-- <div class="">
                                    <a href="#" class="btn btn-primary" title="Upload new profile image" data-bs-toggle="modal" data-bs-target="#modal-foto-profil"> <i data-feather="edit"></i></a>
                                </div> -->

                                <h4 class="text-center"><?= $data->fullname; ?></h4>
                                <h5 class="text-center"><?= $data->jabatan; ?></h5>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card card-round">

                        <div class="card-header">
                            <h3 class="card-title">Detail Profil</h3>
                            <div class="card-actions">
                                <a class="btn btn-light btn-icon " data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
                                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                    </svg>
                                </a>
                                <div class="dropdown-menu" style="width:fit-content;">
                                    <a class="dropdown-item " href="<?= base_url('profil/edit'); ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                            <path d="M16 5l3 3"></path>
                                        </svg>
                                        Ubah Data Diri</a>
                                    <a class="dropdown-item " href="<?= base_url('profil/photo/edit'); ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo-star" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M15 8h.01" />
                                            <path d="M11 21h-5a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v5.5" />
                                            <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l2 2" />
                                            <path d="M17.8 20.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" />
                                        </svg>
                                        Ubah Foto</a>
                                    <a class="dropdown-item " data-bs-toggle="modal" data-bs-target="#modal-ubah-sandi">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z"></path>
                                            <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"></path>
                                            <path d="M8 11v-4a4 4 0 1 1 8 0v4"></path>
                                        </svg>
                                        Ubah Sandi</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row px-3">
                                <div class="col-12  table-responsive">
                                    <table class="table table-light text-left">
                                        <colgroup>
                                            <col style="width: 1%;">
                                            <col style="width: 30%;">
                                            <col>
                                        </colgroup>
                                        <!-- <thead>
                                            <tr>
                                                <th scope="col w-10">#</th>
                                                <th scope="col w-30">First</th>
                                                <th scope="col">Last</th>
                                            </tr>
                                        </thead> -->


                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Nomor KTP</td>
                                                <td><?= $data->nik; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>NIP/NRP</td>
                                                <td><?= $data->nip; ?>/<?= $data->nrp; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Nomor STR</td>
                                                <td><?= $data->nomor_str; ?></td>
                                            </tr>

                                            <tr>
                                                <th scope="row">4</th>
                                                <td>Nama Lengkap</td>
                                                <td><?= $data->gelar_depan; ?> <?= $data->fullname; ?> <?= $data->gelar_belakang; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">5</th>
                                                <td>Jenis Kelamin</td>
                                                <td><?php echo isset($data->jenis_kelamin) ? (($data->jenis_kelamin == 'L') ? 'Laki-laki' : 'Perempuan') : ''; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">6</th>
                                                <td>Tempat/Tanggal Lahir</td>
                                                <td><?= $data->tempat_lahir ?>, <?= $data->tanggal_lahir; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">7</th>
                                                <td>Agama</td>
                                                <td><?= $data->agama; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">8</th>
                                                <td>Telepon Pribadi</td>
                                                <td><?= $data->telepon; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">9</th>
                                                <td>Email</td>
                                                <td><?= $data->email; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">10</th>
                                                <td>Tanggal/Waktu Daftar</td>
                                                <td><?= $data->created_at; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">11</th>
                                                <td>Pendidikan Terakhir</td>
                                                <td><?= $data->pendidikan_terakhir; ?> | <?= $data->jurusan; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">12</th>
                                                <td>Alamat Domisili</td>
                                                <td><?php echo isset($data->nama_jalan_domisili) ? ($data->nama_jalan_domisili . ', ' . $data->desa_domisili . ', Kec. ' . $data->kecamatan_domisili . ', ' . $data->kabupaten_domisili . ', ' . $data->provinsi_domisili . '.') : ''; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">13</th>
                                                <td>Jabatan/Pekerjaan</td>
                                                <td><?= $data->jabatan; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">14</th>
                                                <td>Tipe Pegawai</td>
                                                <td><?= $data->tipe_pegawai; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">15</th>
                                                <td>Jenis Nakes</td>
                                                <td><?= $data->jenis_nakes; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">16</th>
                                                <td>Pangkat/Golongan</td>
                                                <td><?= $data->pangkat_golongan; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">17</th>
                                                <td>Nama Instansi</td>
                                                <td><?= $data->nama_instansi; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">18</th>
                                                <td>Alamat Instansi</td>
                                                <td><?php echo isset($data->nama_jalan_instansi) ? ($data->nama_jalan_instansi . ', ' . $data->desa_instansi . ', Kec. ' . $data->kecamatan_instansi . ', ' . $data->kabupaten_instansi . ', ' . $data->provinsi_instansi . '.') : ''; ?></td>
                                            </tr>

                                        </tbody>
                                    </table>
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
    </div>
</div>


<!-- <a class="btn" data-bs-toggle="offcanvas" href="#offcanvasBottom" role="button" aria-controls="offcanvasBottom">
                    Trigger offcanvas
                </a> -->
<div class="offcanvas offcanvas-bottom rounded-5 <?= (system_status() == 'incomplete') ? 'show' : ''; ?>" tabindex="-1" id="offcanvasBottom" data-bs-keyboard="false" data-bs-backdrop="static" aria-labelledby="offcanvasBottomLabel" style="height:800px !important;">
    <div class="offcanvas-header">
        <h2 class="offcanvas-title" id="offcanvasBottomLabel">Melengkapi Identitas</h2>
        <!-- <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button> -->
    </div>
    <?php if (session()->has('errors.complete.profil')) {
        foreach (session('errors.complete.profil') as $error) { ?>
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
                        <?= $error; ?>
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
    <?php }
    } ?>
    <div class="offcanvas-body">
        <div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="nav nav-tabs steps steps-counter steps-primary" data-bs-toggle="tabs">
                            <span id="button-tab-identitas" href="#tabs-identitas" class="step-item active" data-bs-toggle="tab" disabled>Identitas</span>
                            <span id="button-tab-pekerjaan" href="#tabs-pekerjaan" class="step-item" data-bs-toggle="tab" disabled>Pekerjaan</span>
                            <span id="button-tab-foto-diri" href="#tabs-foto-diri" class="step-item" data-bs-toggle="tab" disabled>Foto Diri</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('profil/complete'); ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="csrf" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

                            <div class="tab-content">
                                <div class="tab-pane active show" id="tabs-identitas">
                                    <h4>Identitas Diri</h4>

                                    <div class="row mt-4">
                                        <div class="col-lg-6 mb-3">
                                            <label for="fullnameInsert" class="form-label required">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="fullnameInsert" name="fullname" placeholder="Nama Lengkap" value="<?= old('fullname'); ?>" autofocus>
                                            <small id="fullnameHelp" class="form-text text-muted">Tulis nama lengkap <b>tanpa gelar</b> dan <b>tidak disingkat</b>.</small>
                                        </div>
                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <label for="gelarDepanInsert" class="form-label">Gelar Depan</label>
                                            <input type="text" class="form-control" id="gelarDepanInsert" name="gelar_depan" placeholder="Gelar Depan" value="<?= old('gelar_depan'); ?>" autofocus>
                                        </div>
                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <label for="gelarBelakangInsert" class="form-label">Gelar Belakang</label>
                                            <input type="text" class="form-control" id="gelarBelakangInsert" name="gelar_belakang" placeholder="Gelar Belakang" value="<?= old('gelar_belakang'); ?>" autofocus>
                                        </div>

                                        <div class="col-lg-6 col-md-12 mb-3">
                                            <label for="nomorKTPInsert" class="form-label required">Nomor KTP</label>
                                            <input type="text" class="form-control" id="nomorKTPInsert" name="nik" placeholder="Nomor KTP" value="<?= old('nik'); ?>" autofocus>
                                        </div>
                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <label for="pendidikanTerakhirInsert" class="form-label required">Pendidikan Terakhir</label>
                                            <select class="select-control" name="pendidikan_terakhir" id="pendidikanTerakhirInsert" placeholder="Pilih pendidikan terakhir">
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
                                            <input type="text" class="form-control" id="jurusanInsert" name="jurusan" placeholder="Jurusan" value="<?= old('jurusan'); ?>" autofocus>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <label for="tempatLahirInsert" class="form-label required">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="tempatLahiInsertr" name="tempat_lahir" placeholder="Tempat Lahir" value="<?= old('tempat_lahir'); ?>" autofocus>
                                        </div>
                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <label for="tanggalLahir" class="form-label required">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tanggalLahir" name="tanggal_lahir" placeholder="myusername" value="<?= old('tanggal_lahir'); ?>" autofocus>
                                        </div>
                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <label for="agamaInsert" class="form-label required">Agama</label>
                                            <select class="select-control" name="agama" id="agamaInsert" placeholder="Pilih Agama...">
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
                                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="L" <?= old('jenis_kelamin') == 'L' ? 'checked' : ''; ?>>
                                                    <span class="form-check-label">Laki-laki</span>
                                                </label>
                                                <label class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="P" <?= old('jenis_kelamin') == 'P' ? 'checked' : ''; ?>>
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
                                                    <input type="text" class="form-control" id="namaJalanInsert" name="nama_jalan_domisili" placeholder="Tulis alamat dengan nama jalan beserta nomornya" value="<?= old('nama_jalan_domisili'); ?>">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="desaInsert" class="form-label required">Desa/Kelurahan</label>
                                                    <input type="text" class="form-control" id="desaInsert" name="desa_domisili" placeholder="Dasa" value="<?= old('desa_domisili'); ?>" autofocus>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="kecamatanInsert" class="form-label required">Kecamatan</label>
                                                    <select class="select-control" name="kecamatan_domisili" id="kecamatanInsert" placeholder="Pilih/tulis kecamatan domisili..." value="<?= old('kecamatan_domisili'); ?>">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="kabupatenInsert" class="form-label required">Kabupaten/Kota</label>
                                                    <select class="select-control" name="kabupaten_domisili" id="kabupatenInsert" placeholder="Pilih/tulis kabupaten domisili..." value="<?= old('kabupaten_domisili'); ?>">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="provinsiInsert" class="form-label required">Provinsi</label>
                                                    <select class="select-control" name="provinsi_domisili" id="provinsiInsert" placeholder="Pilih/tulis provinsi domisili..." value="<?= old('provinsi_domisili'); ?>">
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
                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <label for="tipePegawaiInsert" class="form-label required">Tipe Pegawai</label>
                                            <select class="select-control" name="tipe_pegawai" id="tipePegawaiInsert" placeholder="Pilih tipe pegawai">
                                                <option value=""></option>
                                                <option value="ASN Kemenkes">ASN Kemenkes</option>
                                                <option value="ASN Non Kemenkes">ASN Non Kemenkes</option>
                                                <option value="Non ASN">Non ASN</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <label for="nomorNIPInsert" class="form-label required">Nomor Induk Pegawai (NIP)</label>
                                            <input type="text" class="form-control" id="nomorNIPInsert" name="nip" placeholder="Nomor Induk Pegawai (NIP)" value="<?= old('nip'); ?>" autofocus>
                                        </div>
                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <label for="nomorNRPInsert" class="form-label required">Nomor Registrasi Pokok (NRP)</label>
                                            <input type="text" class="form-control" id="nomorNRPInsert" name="nrp" placeholder="Nomor Registrasi Pokok (NRP)" value="<?= old('nrp'); ?>" autofocus>
                                        </div>
                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <label for="nomorSTRInsert" class="form-label required">Nomor STR</label>
                                            <input type="text" class="form-control" id="nomorSTRInsert" name="nomor_str" placeholder="Nomor STR" value="<?= old('nomor_str'); ?>" autofocus>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <label for="jabatanInsert" class="form-label required">Jabatan/Pekerjaan</label>
                                            <input type="text" class="form-control" id="jabatanInsert" name="jabatan" placeholder="Jabatan/Pekerjaan" value="<?= old('jabatan'); ?>" autofocus>
                                        </div>
                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <label for="pangkatInsert" class="form-label required">Pangkat/Golongan</label>
                                            <select class="select-control" name="pangkat_golongan" id="pangkatInsert" placeholder="Cari pangkat atau golongan...">
                                                <option value=""></option>

                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <label for="jenisNakesInsert" class="form-label required">Jenis Nakes</label>
                                            <select class="select-control" name="jenis_nakes" id="jenisNakesInsert" placeholder="Cari pangkat atau golongan...">
                                                <option value=""></option>

                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <label for="namaInstansiInsert" class="form-label required">Nama Instansi</label>
                                            <input type="text" class="form-control" id="namaInstansiInsert" name="nama_instansi" placeholder="Nama Instansi" value="<?= old('nama_instansi'); ?>" autofocus>
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
                                                    <input type="text" class="form-control" id="namaJalanInstansiInsert" name="nama_jalan_instansi" placeholder="Tulis alamat dengan nama jalan instansi beserta nomornya" value="<?= old('nama_jalan_instansi'); ?>">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="desaInstansiInsert" class="form-label required">Desa/Kelurahan</label>
                                                    <input type="text" class="form-control" id="desaInstansiInsert" name="desa_instansi" placeholder="Dasa" value="<?= old('desa_instansi'); ?>" autofocus>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="kecamatanInstansiInsert" class="form-label required">Kecamatan</label>
                                                    <select class="select-control" name="kecamatan_instansi" id="kecamatanInstansiInsert" placeholder="Pilih/tulis kecamatan instansi..." value="<?= old('kecamatan_instansi'); ?>">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="kabupatenInstansiInsert" class="form-label required">Kabupaten/Kota</label>
                                                    <select class="select-control" name="kabupaten_instansi" id="kabupatenInstansiInsert" placeholder="Pilih/tulis kabupaten instansi..." value="<?= old('kabupaten_instansi'); ?>">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="provinsiInstansiInsert" class="form-label required">Provinsi</label>
                                                    <select class="select-control" name="provinsi_instansi" id="provinsiInstansiInsert" placeholder="Pilih/tulis provinsi instansi..." value="<?= old('provinsi_instansi'); ?>">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        var agama = '<?= old('agama'); ?>';
                                        var pendidikan_terakhir = '<?= old('pendidikan_terakhir'); ?>';
                                        var tipe_pegawai = '<?= old('tipe_pegawai'); ?>';
                                        var pangkat_golongan = '<?= old('pangkat_golongan'); ?>';
                                        var jenis_nakes = '<?= old('jenis_nakes'); ?>';
                                        var provinsi_domisili = '<?= old('provinsi_domisili'); ?>';
                                        var kabupaten_domisili = '<?= old('kabupaten_domisili'); ?>';
                                        var kecamatan_domisili = '<?= old('kecamatan_domisili'); ?>';
                                        var provinsi_instansi = '<?= old('provinsi_instansi'); ?>';
                                        var kabupaten_instansi = '<?= old('kabupaten_instansi'); ?>';
                                        var kecamatan_instansi = '<?= old('kecamatan_instansi'); ?>';

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

                                    <!-- <div class="tab-pane" id="tabs-activity-7">
                                                <h4>Activity tab</h4>
                                                <div>Donec ac vitae diam amet vel leo egestas consequat rhoncus in luctus amet, facilisi sit mauris accumsan nibh habitant senectus</div>
                                            </div> -->
                                </div>
                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.css">
                                <style>
                                    #previewContainer {
                                        max-width: 400px;
                                        width: 100%;
                                        height: auto;
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
                                            <div class="col-lg-4 col-md-5 col-sm-12 border-end">
                                                <div class="card-body">
                                                    <!-- <h4 class="subheader"></h4> -->
                                                    <h3 class="card-title text-center">Penyesuaian Foto</h3>
                                                    <div id="container-display" class="list-group list-group-flush list-group-hoverable overflow-auto" style="max-height: 50rem">
                                                        <div class="d-flex justify-content-center">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <button class="btn btn-icon" type="button" id="move-top" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Geser Atas"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                            <path d="M12 5l0 14"></path>
                                                                            <path d="M16 9l-4 -4"></path>
                                                                            <path d="M8 9l4 -4"></path>
                                                                        </svg></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-center">
                                                            <div class="col m-auto">
                                                                <button class="btn btn-icon" type="button" id="move-left" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Geser Kiri"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                        <path d="M5 12l14 0"></path>
                                                                        <path d="M5 12l4 4"></path>
                                                                        <path d="M5 12l4 -4"></path>
                                                                    </svg></button>
                                                            </div>
                                                            <div id="previewContainer" class="m-auto">
                                                                <img id="previewImage" src="#" alt="Preview">
                                                            </div>
                                                            <div class="col m-auto">
                                                                <button class="btn btn-icon" type="button" id="move-right" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Geser Kanan"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                        <path d="M5 12l14 0"></path>
                                                                        <path d="M15 16l4 -4"></path>
                                                                        <path d="M15 8l4 4"></path>
                                                                    </svg></button>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 d-flex justify-content-center">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <button class="btn btn-icon me-2" type="button" id="move-bottom" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Geser Bawah"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                            <path d="M12 5l0 14"></path>
                                                                            <path d="M16 15l-4 4"></path>
                                                                            <path d="M8 15l4 4"></path>
                                                                        </svg></button>
                                                                </div>
                                                            </div>
                                                        </div>




                                                        <div id="cropper-toolbar" class="d-flex justify-content-center">
                                                            <button class="btn btn-primary me-2" type="button" id="crop" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Crop"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-crop" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M8 5v10a1 1 0 0 0 1 1h10"></path>
                                                                    <path d="M5 8h10a1 1 0 0 1 1 1v10"></path>
                                                                </svg>Crop</button>
                                                            <button class="btn btn-icon" type="button" id="zoom-in" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Perbesar"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-zoom-in" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                                    <path d="M7 10l6 0"></path>
                                                                    <path d="M10 7l0 6"></path>
                                                                    <path d="M21 21l-6 -6"></path>
                                                                </svg></button>
                                                            <button class="btn btn-icon me-2" type="button" id="zoom-out" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Perkecil"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-zoom-out" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                                    <path d="M7 10l6 0"></path>
                                                                    <path d="M21 21l-6 -6"></path>
                                                                </svg></button>
                                                            <!-- <button class="btn btn-icon" type="button" id="move-left" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Geser Kiri"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M5 12l14 0"></path>
                                                                    <path d="M5 12l4 4"></path>
                                                                    <path d="M5 12l4 -4"></path>
                                                                </svg></button>
                                                            <button class="btn btn-icon" type="button" id="move-right" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Geser Kanan"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M5 12l14 0"></path>
                                                                    <path d="M15 16l4 -4"></path>
                                                                    <path d="M15 8l4 4"></path>
                                                                </svg></button>
                                                            <button class="btn btn-icon" type="button" id="move-top" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Geser Atas"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M12 5l0 14"></path>
                                                                    <path d="M16 9l-4 -4"></path>
                                                                    <path d="M8 9l4 -4"></path>
                                                                </svg></button>
                                                            <button class="btn btn-icon me-2" type="button" id="move-bottom" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Geser Bawah"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M12 5l0 14"></path>
                                                                    <path d="M16 15l-4 4"></path>
                                                                    <path d="M8 15l4 4"></path>
                                                                </svg></button> -->
                                                            <button class="btn btn-icon" type="button" id="reset" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reset"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-reload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M19.933 13.041a8 8 0 1 1 -9.925 -8.788c3.899 -1 7.935 1.007 9.425 4.747"></path>
                                                                    <path d="M20 4v5h-5"></path>
                                                                </svg></button>
                                                        </div>
                                                        <div id="recrop-toolbar" class="d-flex justify-content-center">
                                                            <button class="btn btn-primary" type="button" id="recrop" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Crop Ulang">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-frame" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M4 7l16 0"></path>
                                                                    <path d="M4 17l16 0"></path>
                                                                    <path d="M7 4l0 16"></path>
                                                                    <path d="M17 4l0 16"></path>
                                                                </svg>Crop Ulang</button>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-lg-8 col-md-7 col-sm-12 d-flex flex-column">
                                                <div class="card-body">
                                                    <h3 class="card-title">Unggah Foto diri</h3>
                                                    <div class="card bg-yellow-lt text-dark mb-3">
                                                        <div class="card-body m-1">
                                                            <div class="card-subheader h3 m-0 text-warning">Ketentuan :</div>
                                                            <ul>
                                                                <li>
                                                                    Foto peserta wajib menggunakan pakaian rapi dan sopan dengan atasan berwarna putih dan bawahan berwarna hitam.
                                                                </li>
                                                                <li>
                                                                    Foto harus berwarna dengan background berwarna biru dan berukuran 3 x 4.
                                                                </li>
                                                                <li>
                                                                    Foto yang diunggah harus memiliki kualitas yang baik dengan gambar yang tajam (tidak buram) dan memiliki pencahayaan yang cukup (tidak berbayang).
                                                                </li>
                                                                <li>
                                                                    Foto yang diunggah dengan mengeklik input dibawah ini dan pastikan ukuran foto yang diunggah <strong>tidak melebihi 500kb</strong>.
                                                                </li>
                                                                <li>
                                                                    Sebelum klik tombol <strong>"Simpan"</strong> peserta wajib menyesuikan foto dan klik tombol<strong>"Crop"</strong> terlebih dahulu.
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <input class="form-control" type="file" id="fileFotoInsert" name="foto" accept="image/jpeg, image/jpg, image/png">
                                                            <input type="hidden" id="cropDir" name="crop_dir">
                                                            <input type="hidden" id="cropName" name="crop_name">
                                                            <input type="hidden" id="cropStatus" name="isCropped" value="false">
                                                        </div>

                                                        <!-- <div>
                                                                            <button class="btn btn-primary" type="button" id="cropButton">Simpan</button>
                                                                        </div> -->
                                                    </div>



                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">

                                    </div>
                                </div>

                                <!-- <a onclick="submitSend()" class="btn btn-primary mt-3 w-100" id="submit-form">Simpan Foto</a> -->
                                <button class="btn btn-primary mt-3 w-100" id="submit-form" type="submit" hidden>Simpan Foto</button>
                                <!-- <button id="trigger-submit-button" class="btn " hidden type="submit"></button> -->




                                <!-- Bagian HTML tetap sama seperti sebelumnya -->

                                <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.css" integrity="sha512-bs9fAcCAeaDfA4A+NiShWR886eClUcBtqhipoY5DM60Y1V3BbVQlabthUBal5bq8Z8nnxxiyb1wfGX2n76N1Mw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

                                <script>
                                    var csrfName = '<?= csrf_token() ?>';
                                    var csrfHash = '<?= csrf_hash() ?>';
                                    const fileInput = document.getElementById('fileFotoInsert');
                                    const previewContainer = document.getElementById('previewContainer');

                                    const reCrop = document.getElementById('recrop');
                                    // const cropperToolbar = document.getElementById('cropper-toolbar');
                                    const previewImage = document.getElementById('previewImage');
                                    const cropButton = document.getElementById('cropButton');
                                    const zoomInButton = document.getElementById('zoom-in');
                                    const zoomOutButton = document.getElementById('zoom-out');
                                    const moveLeftButton = document.getElementById('move-left');
                                    const moveRightButton = document.getElementById('move-right');
                                    const moveTopButton = document.getElementById('move-top');
                                    const moveBottomButton = document.getElementById('move-bottom');
                                    const resetButton = document.getElementById('reset');

                                    let cropper;

                                    $(document).ready(function() {
                                        $('#submit-form').attr('style', 'visibility:hidden;');
                                        $('#cropper-toolbar').attr('style', 'visibility:hidden;');
                                        $('#recrop-toolbar').attr('style', 'visibility:hidden;');
                                        $('#button-selanjutnya-simpan').attr('disabled', 'true');
                                        $('#container-display').attr('style', 'visibility:hidden;');
                                    });
                                    fileInput.addEventListener('change', function() {
                                        $('#cropName').val(getFilename());
                                        makeCropper();
                                    });

                                    function getFilename() {
                                        var filename = $('#fileFotoInsert').val().split('\\').pop();
                                        return filename;
                                    }

                                    function makeCropper() {
                                        $('#cropper-toolbar').attr('style', 'visibility:visible;');
                                        $('#recrop-toolbar').attr('style', 'visibility:hidden;');
                                        $('#container-display').attr('style', 'visibility:visible;');
                                        $('#cropStatus').val('false');
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
                                                    aspectRatio: 3 / 4, // Mengatur rasio aspek yang diinginkan
                                                    viewMode: 2,
                                                    // movable: false, // Disable image movement
                                                    zoomOnWheel: false, // Disable zoom on touch
                                                    cropBoxMovable: false,
                                                    cropBoxResizable: false,
                                                    // scalable: false,
                                                    // zoomable: false, // Mengaktifkan mode pemandangan kanvas
                                                    // Hentikan zoom melalui interaksi mouse
                                                    // zoom: function(event) {
                                                    //     if (event.type === 'wheel') {
                                                    //         event.preventDefault();

                                                    //     }
                                                    // },
                                                });
                                            };

                                            reader.readAsDataURL(file);
                                        }
                                    }
                                    // Fungsi untuk melakukan crop
                                    document.getElementById('crop').addEventListener('click', function() {
                                        if (cropper) {
                                            cropper.getCroppedCanvas().toBlob((blob) => {
                                                const formData = new FormData();

                                                // Pass the image file name as the third parameter if necessary.
                                                formData.append('croppedImage', blob /*, 'example.png' */ );
                                                formData.append([csrfName], csrfHash);

                                                // Use `jQuery.ajax` method for example
                                                $.ajax('<?= base_url('service/store-profil-image'); ?>', {
                                                    method: 'POST',
                                                    data: formData,
                                                    processData: false,
                                                    contentType: false,
                                                    success(data) {
                                                        console.log(data);
                                                        var jsonData = JSON.parse(data);
                                                        console.log(jsonData.temp_dir);
                                                        $('#button-selanjutnya-simpan').removeAttr('disabled');
                                                        $('#cropStatus').val('true');

                                                        $('#cropDir').val(jsonData.temp_dir);
                                                        $('#csrf').val(jsonData.csrf_name);
                                                        $('#cropper-toolbar').attr('style', 'visibility:hidden;');
                                                        $('#recrop-toolbar').attr('style', 'visibility:visible;');
                                                        $('#submit-form').attr('style', 'visibility:visible;');
                                                        previewImage.src = cropper.getCroppedCanvas().toDataURL('image/jpeg');
                                                        csrfHash = jsonData.csrf_name;
                                                        console.log('Upload success');
                                                        console.log($('#cropName').val());
                                                        // if (cropper) {
                                                        //     cropper.destroy();
                                                        // }
                                                    },
                                                    error() {
                                                        console.log('Upload error');
                                                    },
                                                });
                                            }, 'image/jpg');
                                        }
                                    });

                                    function submitSend() {

                                        if (cropper) {
                                            cropper.getCroppedCanvas().toBlob((blob) => {
                                                const formData = new FormData();

                                                // Pass the image file name as the third parameter if necessary.
                                                formData.append('croppedImage', blob /*, 'example.png' */ );
                                                formData.append([csrfName], csrfHash);

                                                // Use `jQuery.ajax` method for example
                                                $.ajax('<?= base_url('service/store-profil-image-final'); ?>', {
                                                    method: 'POST',
                                                    data: formData,
                                                    processData: false,
                                                    contentType: false,
                                                    success(data) {
                                                        console.log(data);
                                                        var jsonData = JSON.parse(data);
                                                        console.log(jsonData.temp_dir);

                                                        $('#cropDir').val(jsonData.temp_dir);
                                                        $('#csrf').val(jsonData.csrf_name);

                                                        csrfHash = jsonData.csrf_name;
                                                        console.log('Upload success FInal');
                                                        // if (cropper) {
                                                        //     cropper.destroy();
                                                        // }

                                                        controlSimpan();
                                                        // $('#trigger-submit-button').click();

                                                    },
                                                    error() {
                                                        console.log('Upload error');
                                                    },
                                                });
                                            }, 'image/jpg');
                                        }
                                    }

                                    reCrop.addEventListener('click', function() {
                                        makeCropper()
                                    });
                                    // Fungsi untuk zoom in
                                    zoomInButton.addEventListener('click', function() {
                                        if (cropper) {
                                            console.log(cropper, "ZOOM IN");
                                            cropper.zoom(0.1); // Sesuaikan angka zoom sesuai kebutuhan
                                        }
                                    });

                                    // Fungsi untuk zoom out
                                    zoomOutButton.addEventListener('click', function() {
                                        if (cropper) {
                                            cropper.zoom(-0.1); // Sesuaikan angka zoom sesuai kebutuhan
                                        }
                                    });
                                    // Fungsi untuk move right
                                    moveRightButton.addEventListener('click', function() {
                                        if (cropper) {
                                            cropper.move(-10, 0); // Pindahkan 10 piksel ke kanan
                                        }
                                    });

                                    // Fungsi untuk move left
                                    moveLeftButton.addEventListener('click', function() {
                                        if (cropper) {
                                            cropper.move(10, 0); // Pindahkan 10 piksel ke kiri
                                        }
                                    });
                                    // Fungsi untuk move top
                                    moveTopButton.addEventListener('click', function() {
                                        if (cropper) {
                                            cropper.move(0, 10); // Pindahkan 10 piksel ke atas

                                        }
                                    });

                                    // Fungsi untuk move bottom
                                    moveBottomButton.addEventListener('click', function() {
                                        if (cropper) {
                                            cropper.move(0, -10); // Pindahkan 10 piksel ke bawah
                                        }
                                    });
                                    // Fungsi untuk move bottom
                                    resetButton.addEventListener('click', function() {
                                        if (cropper) {
                                            cropper.reset();
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
                                                        $('#button-selanjutnya-simpan').removeAttr('disabled');
                                                        var jsonData = JSON.parse(data);
                                                        console.log(jsonData.temp_dir);
                                                        $('#cropDir').val(jsonData.temp_dir);
                                                        $('#csrf').val(jsonData.csrf_name);
                                                        console.log('Upload success');
                                                    },
                                                    error() {
                                                        console.log('Upload error');
                                                    },
                                                });
                                            }, 'image/jpg');
                                        }
                                    });
                                </script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.js" integrity="sha512-Zt7blzhYHCLHjU0c+e4ldn5kGAbwLKTSOTERgqSNyTB50wWSI21z0q6bn/dEIuqf6HiFzKJ6cfj2osRhklb4Og==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                    <button id="button-selanjutnya-simpan" class="btn btn-danger" type="button" onclick="submitSend()">
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

            function controlSimpan() {
                $('#button-tab-identitas').prop('disabled', false)
                $('#button-tab-pekerjaan').prop('disabled', false)
                $('#button-tab-foto-diri').prop('disabled', false)
                $('#submit-form').click()

            }
        </script>


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
                            <input type="file" class="form-control-file" id="image" name="foto_profil" accept="image/jpeg, image/jpg, image/png">
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

<div class="modal modal-blur fade" id="modal-ubah-sandi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">Apakah Anda Yakin??</div>
                <p>Klik tombol di bawah ini, kami akan mengirimkan instruksi untuk mengatur ulang kata sandi Anda.</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Cancel</button>
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
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.js" integrity="sha512-vVx8x/L4dr4OfZ+2XZd50t8+sWlINSMO7y4+LcB4t8uF4f+wJ4jDMbFOWjmR+8HiaJp+nt0qyL0Cm4+FS6UJ0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->