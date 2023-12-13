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
                        Tambah
                    </h2>
                    <ol class="breadcrumb mt-2" aria-label="breadcrumbs">
                        <li class="breadcrumb-item"><a href="<?= base_url('pelatihan'); ?>">Pelatihan</a></li>
                        <li class="breadcrumb-item active"><a href="">Tambah</a></li>
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
                            <div class="row px-3 mb-3">
                                <h4 class="card-title">Tambah Pelatihan</h4>
                                <div class="col-12">
                                    <div class="hr-text text-green">Progres</div>
                                    <div class="col-12">
                                        <div class="steps steps-counter steps-primary">
                                            <span class="step-item">
                                                Buat Pelatihan
                                            </span>
                                            <span class="step-item ">
                                                Persyaratan Pelatihan
                                            </span>
                                            <span class="step-item active">
                                                Status Publikasi
                                            </span>
                                        </div>
                                    </div>
                                    <!-- <hr> -->
                                </div>
                                <!-- </div> -->
                                <!-- Comment Row -->
                                <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
                                <div class="row px-3">
                                    <form action="<?= base_url('pelatihan/insert/publis/proses/' . $id_pelatihan); ?>" method="post">
                                        <?= csrf_field() ?>
                                        <div class="hr-text hr-text-left mb-3">Atur Status Pelatihan</div>
                                        <div class="row">
                                            <div class="col card bg-yellow-lt text-dark mb-3">
                                                <div class="card-body m-1">
                                                    <div class="card-subheader h3 m-0 text-warning">Petunjuk!</div>
                                                    <ul>
                                                        <li>
                                                            Status publikasi berguna untuk mengatur publikasi dari pelatihan yang Anda buat.
                                                        </li>
                                                        <li>
                                                            Saat Anda memilih tombol <strong>Simpan</strong> maka secara otomatis pelatihan akan terdaftar sebagai <strong>draft</strong>.
                                                        </li>
                                                        <li>
                                                            Namun jika Anda memilih tombol <strong>Simpan & Publish</strong> maka pelatihan akan terdaftar sebagai <strong>publis</strong>.
                                                        </li>
                                                        <li>
                                                            Status publish artinya pelatihan yang Anda buat telah lengkap dan siap untuk ditampilkan di halaman pengguna.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label class="form-check">
                                                    <input id="checkbox-persetujuan" type="checkbox" class="form-check-input" name="confirm_publish" oninvalid="this.setCustomValidity('Anda harus menyetujui persyaratan ini untuk mempublikasi.')" oninput="this.setCustomValidity('')" />
                                                    <span class="form-check-label required">
                                                        Dengan ini saya menyatakan dengan sesungguhnya bahwa semua data yang saya input adalah benar dan saya ingin membagikannya kepada pengguna Sipandu. </span>
                                                </label>
                                                <input type="hidden" name="publish" id="input-publis" value="false">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6 d-flex justify-content-start">
                                                <a href="<?= base_url('pelatihan'); ?>" class="btn btn-outline-primary">Batal</a>
                                            </div>
                                            <div class="col-6 d-flex justify-content-end">
                                                <button type="button" class="btn btn-success mx-2" onclick="save()">Simpan</button>
                                                <button type="button" class="btn btn-danger" onclick="savePublish()">Simpan & Publish</button>
                                            </div>
                                        </div>

                                        <button id="button-submit" type="submit" hidden></button>
                                    </form>

                                </div>

                                <script>
                                    function savePublish() {
                                        $('#input-publis').val('true');
                                        $('#checkbox-persetujuan').prop('required', true);
                                        $('#button-submit').click();
                                        // console.log($('#checkbox-persetujuan').prop('required'));
                                        // console.log($('#input-publis').val());
                                    }

                                    function save() {
                                        $('#input-publis').val('false');
                                        $('#checkbox-persetujuan').prop('required', false);
                                        $('#checkbox-persetujuan')[0].setCustomValidity('');
                                        $('#button-submit').click();
                                        // console.log($('#checkbox-persetujuan').prop('required'));
                                        // console.log($('#input-publis').val());
                                    }
                                </script>
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