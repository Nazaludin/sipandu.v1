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

            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Pelatihan
                    </div>
                    <h2 class="page-title">
                        Detail Pendaftar
                    </h2>
                    <ol class="breadcrumb mt-2" aria-label="breadcrumbs">
                        <li class="breadcrumb-item"><a href="<?= base_url('pelatihan'); ?>">Pelatihan</a></li>
                        <li class="breadcrumb-item "><a href="<?= base_url('pelatihan/detail/' . $id_pelatihan); ?>">Detail</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('pelatihan/detail/user/' . $id_pelatihan); ?>">Pendaftar</a></li>
                        <li class="breadcrumb-item active"><a>Detail Pendaftar</a></li>
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
                                <div class="col-12 d-flex justify-content-center">
                                    <img src="<?php echo isset($data['lokasi_foto']) ? base_url($data['lokasi_foto']) : base_url('assets/images/users/default-profil.png') ?>" class="img-fluid mb-4 mx-auto" style="width: 300px; height: 400px; object-fit: cover;">
                                    <style>
                                        .card-photo {
                                            max-width: 200px;
                                            height: auto;
                                        }

                                        .card-round {
                                            border-radius: 10px;
                                        }
                                    </style>
                                </div>
                            </div>
                            <div class="row px-2 mb-5">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title">Detail Pengguna</div>
                                            <div class="row">
                                                <div class="col table-responsive">
                                                    <table class="table table-light">
                                                        <colgroup>
                                                            <col style="width: 8%;">
                                                            <col style="width: 30%;">
                                                            <col>
                                                        </colgroup>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">1</th>
                                                                <td>Nomor KTP</td>
                                                                <td><?= $data['nik']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">2</th>
                                                                <td>NIP/NRP</td>
                                                                <td><?= $data['nip']; ?>/<?= $data['nrp']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">3</th>
                                                                <td>Nomor STR</td>
                                                                <td><?= $data['nomor_str']; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">4</th>
                                                                <td>Nama Lengkap</td>
                                                                <td><?= $data['gelar_depan']; ?> <?= $data['fullname']; ?> <?= $data['gelar_belakang']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">5</th>
                                                                <td>Jenis Kelamin</td>
                                                                <td><?php echo isset($data['jenis_kelamin']) ? (($data['jenis_kelamin'] == 'L') ? 'Laki-laki' : 'Perempuan') : ''; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">6</th>
                                                                <td>Tempat/Tanggal Lahir</td>
                                                                <td><?= $data['tempat_lahir'] ?>, <?= $data['tanggal_lahir']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">7</th>
                                                                <td>Agama</td>
                                                                <td><?= $data['agama']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">8</th>
                                                                <td>Telepon Pribadi</td>
                                                                <td><?= $data['telepon']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">9</th>
                                                                <td>Email</td>
                                                                <td><?= $data['email']; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 table-responsive">
                                                    <table class="table table-light">
                                                        <colgroup>
                                                            <col style="width: 8%;">
                                                            <col style="width: 30%;">
                                                            <col>
                                                        </colgroup>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">10</th>
                                                                <td>Tanggal/Waktu Daftar</td>
                                                                <td><?= $data['created_at']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">11</th>
                                                                <td>Pendidikan Terakhir</td>
                                                                <td><?= $data['pendidikan_terakhir']; ?> | <?= $data['jurusan']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">12</th>
                                                                <td>Alamat Domisili</td>
                                                                <td><?php echo isset($data['nama_jalan_domisili']) ? ($data['nama_jalan_domisili'] . ', ' . $data['desa_domisili'] . ', Kec. ' . $data['kecamatan_domisili'] . ', ' . $data['kabupaten_domisili'] . ', ' . $data['provinsi_domisili'] . '.') : ''; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">13</th>
                                                                <td>Jabatan/Pekerjaan</td>
                                                                <td><?= $data['jabatan']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">14</th>
                                                                <td>Tipe Pegawai</td>
                                                                <td><?= $data['tipe_pegawai']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">15</th>
                                                                <td>Jenis Nakes</td>
                                                                <td><?= $data['jenis_nakes']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">16</th>
                                                                <td>Pangkat/Golongan</td>
                                                                <td><?= $data['pangkat_golongan']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">17</th>
                                                                <td>Nama Instansi</td>
                                                                <td><?= $data['nama_instansi']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">18</th>
                                                                <td>Alamat Instansi</td>
                                                                <td><?php echo isset($data['nama_jalan_instansi']) ? ($data['nama_jalan_instansi'] . ', ' . $data['desa_instansi'] . ', Kec. ' . $data['kecamatan_instansi'] . ', ' . $data['kabupaten_instansi'] . ', ' . $data['provinsi_instansi'] . '.') : ''; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="card-title mt-4 mb-1">Dokumen Persyaratan</div>
                                            <div class="row mb-4">
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
                                    </div>
                                </div>
                            </div>

                            <!-- Button button -->
                            <div class="row">
                                <div class="col-6 d-flex justify-content-start">
                                    <a href="<?= base_url('pelatihan/detail/user/' . $id_pelatihan) ?>" class="btn btn-outline-primary">Batal</a>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <!-- <a href="<?= base_url('pelatihan/detail/user/regis/' . $id_pelatihan . '/' . $data['id'] . '/3'); ?>" class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#modal-revisi-comment" onclick="">
                                        Revisi
                                    </a> -->
                                    <a class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#modal-revisi-comment" onclick="sendIDUser('<?= $data['id']; ?>')">
                                        Revisi
                                    </a>
                                    <a href="<?= base_url('pelatihan/detail/user/regis/' . $id_pelatihan . '/' . $data['id'] . '/2'); ?>" class="btn btn-danger mx-2">
                                        Tolak
                                    </a>
                                    <a href="<?= base_url('pelatihan/detail/user/regis/' . $id_pelatihan . '/' . $data['id'] . '/1'); ?>" class="btn btn-success">
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
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->


<!-- Modal Konfrimasi Publish -->
<div class="modal modal-blur fade" id="modal-revisi-comment" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-revisi-comment" action="" method="post">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-orange"></div>
                <div class="modal-body text-left py-4">
                    <h3>Isikan komentar berikut dengan penjelasan revisi yang ingin dilakukan</h3>
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="col">
                            <label class="form-label">Komentar</label>
                            <textarea name="comment" class="form-control" rows="5" style="height: 183px;" placeholder="Isikan komentar"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <!-- <div class="w-100">
                        <div class="row">
                            <div class="col"> -->
                    <a class="btn" data-bs-dismiss="modal">Batal</a>
                    <!-- </div>
                            <div class="col"> -->
                    <button type="submit" class="btn btn-orange"> Kirim Revisi</button>
                    <!-- </div>
                        </div>
                    </div> -->
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script>
    function sendIDUser(id_user) {
        console.log("MASUK");
        $('#form-revisi-comment').attr('action', "<?= base_url('pelatihan/detail/user/regis/' . $id_pelatihan); ?>" + '/' + id_user + '/3');
    }
</script>