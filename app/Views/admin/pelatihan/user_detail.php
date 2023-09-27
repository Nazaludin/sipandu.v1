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
                            <div class="row justify-content-between mb-2">
                                <div class="col-auto">
                                    <a href="<?= base_url('pelatihan/detail/user/' . $id_pelatihan); ?>" class="btn btn-ghost-white border-0 shadow-none" aria-label="Button">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M15 6l-6 6l6 6"></path>
                                        </svg>
                                        Back</a>
                                </div>

                            </div>

                            <div class="row px-2">
                                <div class="col-auto">
                                    <!-- <h3 class="card-title  pt-3">Detail User</h3> -->
                                </div>
                            </div>

                            <div class="row px-2">
                                <div class="col-12 d-flex justify-content-center">
                                    <img src="<?php echo isset($user['lokasi_foto']) ? base_url($user['lokasi_foto']) : '../../assets/images/users/default-profil.png' ?>" class="img-fluid mb-4 mx-auto" style="width: 300px; height: 400px; object-fit: cover;">
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
                                </div>
                                <div class="row px-2 mb-5">

                                    <div class="col-auto">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title">Detail Pengguna</div>
                                                <table class="table table-responsive w-auto row">
                                                    <!-- <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">First</th>
                                                <th scope="col">Last</th>
                                                <th scope="col">Handle</th>
                                            </tr>
                                        </thead> -->



                                                    <tbody class="col-5">
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>NIP</td>
                                                            <td><?= $user['nip'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">2</th>
                                                            <td>Nomor KTP</td>
                                                            <td><?= $user['nik']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">3</th>
                                                            <td>Nama Lengkap</td>
                                                            <td><?= $user['gelar_depan']; ?> <?= $user['fullname']; ?> <?= $user['gelar_belakang']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">4</th>
                                                            <td>Jenis Kelamin</td>
                                                            <td><?php echo isset($user['jenis_kelamin']) ? (($user['jenis_kelamin'] == 'L') ? 'Laki-laki' : 'Perempuan') : ''; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">5</th>
                                                            <td>Tempat/Tanggal Lahir</td>
                                                            <td><?= $user['tempat_lahir'] ?>, <?= $user['tanggal_lahir']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">6</th>
                                                            <td>Agama</td>
                                                            <td><?= $user['agama']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">7</th>
                                                            <td>Telepon Pribadi</td>
                                                            <td><?= $user['telepon']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">8</th>
                                                            <td>Email</td>
                                                            <td><?= $user['email']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">9</th>
                                                            <td>Tanggal/Waktu Daftar</td>
                                                            <td><?= $user['created_at']; ?></td>
                                                        </tr>
                                                        <!-- <tr>
                                                    <th scope="row">3</th>
                                                    <td>Tanggal/Waktu Aktif</td>
                                                    <td>01 Mei 2023</td>
                                                </tr> -->
                                                    </tbody>
                                                    <tbody class="col-1"></tbody>
                                                    <tbody class="col-6">

                                                        <tr>
                                                            <th scope="row">11</th>
                                                            <td>Pendidikan Terakhir</td>
                                                            <td><?= $user['pendidikan_terakhir']; ?> | <?= $user['jurusan']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">11</th>
                                                            <td>Alamat Domisili</td>
                                                            <td><?php echo isset($user['nama_jalan_domisili']) ? ($user['nama_jalan_domisili'] . ', ' . $user['desa_domisili'] . ', Kec. ' . $user['kecamatan_domisili'] . ', ' . $user['kabupaten_domisili'] . ', ' . $user['provinsi_domisili'] . '.') : ''; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">10</th>
                                                            <td>Jabatan/Pekerjaan</td>
                                                            <td><?= $user['jabatan']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">12</th>
                                                            <td>Tipe Pegawai</td>
                                                            <td><?= $user['tipe_pegawai']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">13</th>
                                                            <td>Jenis Nakes</td>
                                                            <td><?= $user['jenis_nakes']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">13</th>
                                                            <td>Pangkat/Golongan</td>
                                                            <td><?= $user['pangkat_golongan']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">14</th>
                                                            <td>Nama Instansi</td>
                                                            <td><?= $user['nama_instansi']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">14</th>
                                                            <td>Alamat Instansi</td>
                                                            <td><?php echo isset($user['nama_jalan_instansi']) ? ($user['nama_jalan_instansi'] . ', ' . $user['desa_instansi'] . ', Kec. ' . $user['kecamatan_instansi'] . ', ' . $user['kabupaten_instansi'] . ', ' . $user['provinsi_instansi'] . '.') : ''; ?></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <h3>Dokumen Persyaratan</h3>
                                <div class="row px-2 mb-4">
                                    <?php if (isset($document)) {
                                        foreach ($document as $d => $doc) {  ?>
                                            <div class="col-12 my-2">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h3 class="card-title"><?= $doc['name_upload_document']; ?></h3>
                                                        <button type=" button" class="btn btn-sm border-0 shadow-none text-primary" onclick="showViewer(<?= $d; ?>, this)">Lihat Dokumen</button>
                                                        <embed id="viewer-pdf-<?= $d; ?>" style="display: none;" class="border border-dark" src="<?= $doc['link']; ?>#view=FitH&toolbar=1&navpanes=0&scrollbar=0" width="100%" height="1200" type="application/pdf">
                                                    </div>
                                                </div>
                                            </div>
                                    <?php  }
                                    } ?>
                                    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
                                    <script>
                                        function showViewer(index, e) {
                                            if ($('#viewer-pdf-' + index).is(":hidden")) {
                                                $('#viewer-pdf-' + index).show();
                                                $(e).html("Sembunyikan");
                                            } else {
                                                $('#viewer-pdf-' + index).hide();
                                                $(e).html("Lihat Dokumen");
                                            }
                                        }
                                    </script>
                                </div>
                            </div>
                            <!-- Comment Row -->


                            <!-- <form action="<?php echo base_url('pelatihan/agenda/registrasi/proses/'); ?>" method="POST" enctype="multipart/form-data">

                                <?= csrf_field() ?>

                                <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                                    Simpan
                                </button>
                                

                            </form> -->
                            <div class="row">
                                <div class="col-6 d-flex justify-content-start">
                                    <a href="<?= base_url('pelatihan/detail/user/' . $id_pelatihan) ?>" class="btn btn-outline-primary">Batal</a>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <a href="<?= base_url('pelatihan/detail/user/regis/' . $id_pelatihan . '/' . $user['id'] . '/3'); ?>" class="btn btn-orange">
                                        Revisi
                                    </a>
                                    <a href="<?= base_url('pelatihan/detail/user/regis/' . $id_pelatihan . '/' . $user['id'] . '/2'); ?>" class="btn btn-danger mx-2">
                                        Tolak
                                    </a>
                                    <a href="<?= base_url('pelatihan/detail/user/regis/' . $id_pelatihan . '/' . $user['id'] . '/1'); ?>" class="btn btn-success">
                                        Terima
                                    </a>

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
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->