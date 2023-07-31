<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
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
        <div class="container-xl">
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

                                <h4 class="text-center"><?= $data->nama; ?></h4>
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
                                                        <td><?= $data->nama; ?></td>
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
                                                        <th scope="row">10</th>
                                                        <td>Status/Spesialisasi</td>
                                                        <td><?= $data->status_kerja; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">11</th>
                                                        <td>Jabatan/Pekerjaan</td>
                                                        <td><?= $data->jabatan; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">12</th>
                                                        <td>Pangkat/Golongan</td>
                                                        <td><?= $data->pangkat; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">13</th>
                                                        <td>Nama Instansi</td>
                                                        <td><?= $data->nama_instansi; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">14</th>
                                                        <td>Alamat Instansi</td>
                                                        <td><?= $data->alamat_instansi; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">15</th>
                                                        <td>Telepon Instansi</td>
                                                        <td><?= $data->telepon_instansi; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">16</th>
                                                        <td>Alamat Domisili</td>
                                                        <td><?= $data->alamat_domisili; ?>, Kec. <?= $data->kecamatan; ?>, <?= $data->kabupaten; ?>, <?= $data->provinsi; ?>.</td>
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
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required autofocus>

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