<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<div class="container">
    <!-- <div class="row">
        <div class="col-sm-6 offset-sm-3"> -->
    <div class="card my-0 border-0 shadow-lg rounded-5 overflow-hidden" style="height: 600px;">
        <div class="row h-100">
            <div class="col-5 d-flex">
                <img class="flex-fill" src="<?= base_url('assets/images/image_login.png'); ?>" alt="" style="height: 100%; width: 100%; object-fit: cover;">
            </div>
            <div class="col-7 mb-3 p-0">
                <div class="card-header m-0 p-0 shadow">
                    <h1 class="card-title text-center my-3 fw-bold fs-1 text-green"><?= lang('Auth.register') ?></h1>
                </div>
                <form action="<?= url_to('register') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="card-body ms-2 ps-0 pe-5 overflow-auto" style="height: 450px; width: 100%;">

                        <?= view('App\Views\Auth\_message_block') ?>



                        <div class="row mb-3">
                            <div class="col-6 form-group ">
                                <label for="firstname" class="form-label required">Nama depan</label>
                                <input type="text" class="form-control <?php if (session('errors.firstname')) : ?>is-invalid<?php endif ?>" name="firstname" aria-describedby="firstnameHelp" placeholder="Nama Depan" value="<?= old('firstname') ?>">
                            </div>
                            <div class="col-6 form-group ">
                                <label for="lastname" class="form-label required">Nama Belakang</label>
                                <input type="text" class="form-control <?php if (session('errors.lastname')) : ?>is-invalid<?php endif ?>" name="lastname" aria-describedby="lastnameHelp" placeholder="Nama Belakang" value="<?= old('lastname') ?>">
                            </div>

                        </div>

                        <div class="form-group mb-3">
                            <label for="fullname" class="form-label required">Nama Lengkap</label>
                            <input type="text" class="form-control <?php if (session('errors.fullname')) : ?>is-invalid<?php endif ?>" name="fullname" aria-describedby="fullnameHelp" placeholder="Nama Lengkap" value="<?= old('fullname') ?>">
                            <small id="fullnameHelp" class="form-text text-muted">Tulis nama lengkap <b>tanpa gelar</b> dan <b>tidak disingkat</b>.</small>

                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label required"><?= lang('Auth.email') ?></label>
                            <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                            <small id="emailHelp" class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small>
                        </div>



                        <div class="form-group mb-3">
                            <label for="password" class="form-label required"><?= lang('Auth.password') ?></label>
                            <div class="input-group input-group-flat">
                                <input id="password_regis" type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" value="<?= old('password') ?>">
                                <span class="input-group-text">
                                    <a class="link-secondary" data-bs-toggle="tooltip" aria-label="Show password" data-bs-original-title="Show password" onclick="if (password_regis.type == 'text') password_regis.type = 'password';
  else password_regis.type = 'text';">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="12" cy="12" r="2"></circle>
                                            <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path>
                                        </svg>
                                    </a>
                                </span>
                            </div>
                            <small class="form-text text-muted">Harus berisi 8 karakter dengan setidaknya 1 angka, 1 symbol, dan 1 huruf kapital</small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="pass_confirm" class="form-label required"><?= lang('Auth.repeatPassword') ?></label>
                            <div class="input-group input-group-flat">
                                <input id="pass_confirm_regis" type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" value="<?= old('pass_confirm') ?>">
                                <span class="input-group-text">
                                    <a class="link-secondary" data-bs-toggle="tooltip" aria-label="Show password" data-bs-original-title="Show password" onclick="if (pass_confirm_regis.type == 'text') pass_confirm_regis.type = 'password';
  else pass_confirm_regis.type = 'text';">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="12" cy="12" r="2"></circle>
                                            <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path>
                                        </svg>
                                    </a>
                                </span>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="telepon" class="form-label required"><?= lang('Auth.telepon') ?></label>
                            <input type="text" name="telepon" class="form-control <?php if (session('errors.telepon')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.telepon') ?>" value="<?= old('telepon') ?>">
                        </div>



                        <div class="form-group mb-3">
                            <label for="select_provinsi" class="form-label required">Provinsi</label>
                            <input type="hidden" id="input-provinsi" name="provinsi">
                            <select id="select_provinsi" class="select-control text-style1 transparent-select" value="<? old('provinsi'); ?>" placeholder="Cari Provinsi.." required oninvalid="this.setCustomValidity('Mohon pilih/cari provisi pada input ini')" oninput="this.setCustomValidity('')">
                                <option value=""></option>
                            </select>
                            <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
                            <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
                            <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
                            <script>
                                let provinsiSelect = new TomSelect('#select_provinsi', {
                                    hideSelected: true,
                                    valueField: 'nama',
                                    labelField: 'nama',
                                    searchField: 'nama',
                                    sortField: 'nama',
                                    options: convertArray(dataProvinsi()),
                                    create: true,
                                    onChange: function(value) {
                                        console.log(value, provinsiSelect.getItem(value).innerText);
                                        $('#input-provinsi').val((provinsiSelect.getItem(value).innerText).toUpperCase());
                                    }
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



                                // Fungsi untuk mengkonversi data dari string JSON ke array
                                function convertArray(data) {
                                    return JSON.parse(data);
                                }

                                var provinsi = '<?= old('provinsi'); ?>';
                                if (provinsi !== '') {
                                    provinsiSelect.setValue(provinsi);
                                }
                            </script>
                        </div>


                    </div>

                    <div class="card-footer shadow p-0 pt-2 ps-2">
                        <div class="d-grid  me-5 mb-2">
                            <button type="submit" class="btn btn-primary text-light fw-bold btn-block"><?= lang('Auth.register') ?></button>
                        </div>
                        <div class="d-flex justify-content-center me-5">
                            <p><?= lang('Auth.alreadyRegistered') ?> <a class="text-success fw-bold" href="<?= url_to('login') ?>"><?= lang('Auth.signIn') ?></a></p>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <!-- 
        </div>
    </div> -->
</div>

<?= $this->endSection() ?>