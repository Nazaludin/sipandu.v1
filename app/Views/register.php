<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description" content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Sipandu | Register</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <!-- Custom CSS -->
    <link href="../../dist/css/style.min.css" rel="stylesheet">
    <!-- Tom select -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tom-select/2.2.2/css/tom-select.bootstrap5.min.css" integrity="sha512-mNN7o87hQqtNCCGWxFVdlVdaKF6d4S1wVMi3+ftJYnW572YIo0KPjK1Cns5SPlyCtKGp1Nu+z26MJUNXmpbjKA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tom-select/2.2.2/js/tom-select.complete.min.js" integrity="sha512-nSCwMPJuzxtzxg73yUXuSuLmsfecNBt+/7dimMdC7VJisuxdr7XtYoCausZOSS6V5IHUOuJ7nQMXmylVt9+jeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<style>
    html {
        height: 100%;
        background-color: rgba(201, 235, 255, 1);
        /* background-image: linear-gradient(rgba(22, 31, 24, 0.80), rgba(22, 31, 24, 0.80)), url('../../assets/images/bapelkes.jpeg');
        background-size: cover;
        background-color: rgba(22, 31, 24, 0.4);
        -webkit-backdrop-filter: blur(10px);
        backdrop-filter: blur(10px); */
    }

    body {
        height: 100%;
    }

    /* .bg {
        background-image: linear-gradient(rgba(22, 31, 24, 0.40), rgba(22, 31, 24, 0.40)), url('../../assets/images/bapelkes.jpeg');
        background-size: cover;
        background-color: rgba(22, 31, 24, 0.4);
        -webkit-backdrop-filter: blur(3px);
        backdrop-filter: blur(3px);
        
        height: 100%;
        width: 100%;
    } */

    .bg {

        background-image: url('../../assets/images/img-depan-invert.png');
        background-repeat: no-repeat;
        background-size: contain;
        /* background-image: linear-gradient(rgba(22, 31, 24, 0.40), rgba(22, 31, 24, 0.40)), url('../../assets/images/bapelkes.jpeg'); */
        /* background-size: cover; */
        /* background-color: rgba(0, 0, 0, 1); */
        /* -webkit-backdrop-filter: blur(3px); */
        /* backdrop-filter: blur(3px); */
        /* filter: brightness(40%); */
        height: 100%;
        width: 100%;
    }
</style>

<body class="bg-transparent bg">
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="page-wrapper bg-transparent">

            <!-- <div id="loginform"> -->
            <!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-5">
                    <div class="card flex-row my-5 border-0 shadow rounded-5 overflow-hidden">
                        <div class="card-body p-4 p-sm-5">
                            <h1 class="card-title text-center mb-5 fw-bold fs-1">Registrasi</h1>

                            <form action="<?php echo base_url('registrasi/proses'); ?>" method="post">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="NIP">NIP</label>
                                        <input type="text" class="form-control form-control-sm" id="NIP" name="nip" placeholder="NIP" required autofocus>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="nomorKTP">Nomor KTP</label>
                                        <input type="text" class="form-control form-control-sm" id="nomorKTP" name="nik" placeholder="Nomor KTP" required autofocus>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">

                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" class="form-control form-control-sm" id="nama" name="nama" placeholder="Nama Lengkap" required autofocus>

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
                                        <input type="text" class="form-control form-control-sm" id="tempatLahir" name="tempat_lahir" placeholder="Tempat Lahir" required autofocus>

                                    </div>
                                    <div class="col mb-3">

                                        <label for="tanggalLahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control form-control-sm" id="tanggalLahir" name="tanggal_lahir" placeholder="myusername" required autofocus>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="agama">Agama</label>
                                        <select class="form-control form-control-sm" name="agama" id="agama" required>
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
                                        <input type="tel" class="form-control form-control-sm" id="telepon" name="telepon" placeholder="08xxxxxxxxxxxx" required autofocus>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="password">Password</label>
                                        <div class="input-group input-group-flat">
                                            <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="password" required autofocus>
                                            <span class="input-group-text">
                                                <a class="link-secondary" data-bs-toggle="tooltip" onclick="showPW()" aria-label="Show password" data-bs-original-title="Show password">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <circle cx="12" cy="12" r="2"></circle>
                                                        <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path>
                                                    </svg>
                                                </a>
                                            </span>
                                        </div>
                                        <div class="input-group input-group-flat">
                                            <input type="text" class="form-control" autocomplete="off">
                                            <span class="input-group-text">
                                                <a href="#" class="link-secondary" title="Clear search" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/x -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M18 6l-12 12" />
                                                        <path d="M6 6l12 12" />
                                                    </svg>
                                                </a>
                                                <a href="#" class="link-secondary ms-2" title="Search settings" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/adjustments -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 10a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path d="M6 4v4" />
                                                        <path d="M6 12v8" />
                                                        <path d="M10 16a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path d="M12 4v10" />
                                                        <path d="M12 18v2" />
                                                        <path d="M16 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path d="M18 4v1" />
                                                        <path d="M18 9v11" />
                                                    </svg>
                                                </a>
                                                <a href="#" class="link-secondary ms-2 disabled" title="Add notification" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                                                        <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                                                    </svg>
                                                </a>
                                            </span>

                                        </div>
                                        <div class="col mb-3">
                                            <label for="repassword">Konfimasi Password</label>
                                            <input type="password" class="form-control form-control-sm" id="repassword" placeholder="ketik ulang password" required autofocus>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="password">Email</label>
                                            <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="password" required autofocus>

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="pendidikanTerakhir">Pendidikan Terakhir</label>
                                            <select class="form-control form-control-sm" name="pendidikan_terakhir" id="pendidikanTerakhir" required>
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
                                            <label for="status">Status</label>
                                            <input type="text" class="form-control form-control-sm" id="status" name="status" placeholder="" required autofocus>
                                        </div>
                                        <div class="col mb-3">
                                            <label for="spesialisasi">Spesialisasi</label>
                                            <input type="text" class="form-control form-control-sm" id="spesialisasi" name="spesialisasi" placeholder="" required autofocus>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="jabatan">Jabatan/Pekerjaan</label>
                                            <input type="text" class="form-control form-control-sm" id="jabatan" name="jabatan" placeholder="" required autofocus>
                                        </div>
                                        <div class="col mb-3">
                                            <label for="pangkat">Pangkat/Golongan</label>
                                            <input type="text" class="form-control form-control-sm" id="pangkat" name="pangkat" placeholder="" required autofocus>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="namaInstansi">Nama Instansi</label>
                                            <input type="text" class="form-control form-control-sm" id="namaInstansi" name="nama_instansi" placeholder="" required autofocus>
                                        </div>
                                        <div class="col mb-3">
                                            <label for="teleponInstansi">Telepon Instansi</label>
                                            <input type="text" class="form-control form-control-sm" id="teleponInstansi" name="telepon_instansi" placeholder="" required autofocus>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="alamatInstansi">Alamat Instansi</label>
                                            <textarea class="form-control form-control-sm" id="alamatInstansi" name="alamat_instansi"></textarea>
                                        </div>
                                    </div>
                                    <!-- PROVINSI -->
                                    <label for="select_provinsi" class="h1 text-style1 col-sm-4 col-form-label">Provinsi</label>
                                    <select id="select_provinsi" class="select-control text-style1 transparent-select" value="<? old('provinsi'); ?>" placeholder="Cari Provinsi.." autocomplete="off" required oninvalid="this.setCustomValidity('Mohon pilih/cari provisi pada input ini')" oninput="this.setCustomValidity('')"></select>

                                    <!-- KABUPATEN -->
                                    <label for="select_kabupaten" class="h1 text-style1 col-sm-4  col-form-label">Kabupaten</label>
                                    <select id="select_kabupaten" class="select-control text-style1" value="<?= old('kabupaten'); ?>" placeholder="Cari Kabupaten..." autocomplete="off" required oninvalid="this.setCustomValidity('Mohon pilih/cari kabupaten pada input ini')" oninput="this.setCustomValidity('')"></select>

                                    <!-- KECAMATAN -->
                                    <label for="select_kecamatan" class="h1 text-style1 col-sm-4  col-form-label">Kecamatan</label>
                                    <select id="select_kecamatan" class="select-control text-style1" value="<?= old('kecamatan'); ?>" placeholder="Cari Kecematan..." autocomplete="off" required oninvalid="this.setCustomValidity('Mohon pilih/cari kecamatan pada input ini')" oninput="this.setCustomValidity('')"></select>

                                    <input type="hidden" id="input-provinsi" name="provinsi">
                                    <input type="hidden" id="input-kabupaten" name="kabupaten">
                                    <input type="hidden" id="input-kecamatan" name="kecamatan">
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="alamatDomisili">Alamat Domisili</label>
                                            <textarea class="form-control form-control-sm" id="alamatDomisili" name="alamat_domisili"></textarea>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="d-grid mb-2">
                                        <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit">Daftar</button>
                                    </div>

                                    <a class="d-block text-center mt-2 small" href="<?php echo base_url('login'); ?>">Sudah punya akun? Masuk</a>



                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- </body> -->
        <!-- </div> -->
        <div id="recoverform" hidden>
            <div class="text-center">
                <span class="text-white">Enter your e-mail address below and we will send you instructions how to recover a password.</span>
            </div>
            <div class="row mt-3">
                <!-- Form -->
                <form class="col-12" action="index.html">
                    <!-- email -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-danger text-white h-100" id="basic-addon1"><i class="ti-email"></i></span>
                        </div>
                        <input type="text" class="form-control form-control-lg" placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <!-- pwd -->
                    <div class="row mt-3 pt-3 border-top border-secondary">
                        <div class="col-12">
                            <a class="btn btn-success text-white" href="#" id="to-login" name="action">Back To Login</a>
                            <button class="btn btn-info float-end" type="button" name="action">Recover</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <!-- Tom Select js -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        $(".preloader").fadeOut();
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
        $('#to-login').click(function() {

            $("#recoverform").hide();
            $("#loginform").fadeIn();
        });

        $(document).ready(function() {
            kabupatenSelect.disable();
            kecamatanSelect.disable();
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

</body>

</html>